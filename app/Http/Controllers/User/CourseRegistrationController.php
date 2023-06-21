<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseTimeSchedule;
use App\Models\StudentRegistrationTime;
use App\Models\StudentTakenCourse;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class CourseRegistrationController extends Controller
{
    // Get Table Column List
    private function getColumns(){
        $columns = ['#', "code", "course_name", "prereq",  "credit"];
        return $columns;
    }

    // Get DataTable Column List
    private function getDataTableColumns(){
        $columns = ['index', 'code', 'course_name','prereq', 'credit'];
        return $columns;
    }


    // GetModel
    private function getModel(){
        return new StudentTakenCourse();
    }
    public function index(Request $request){

        $id = $this->extractId($request->user()->user_id);
        $params = [
            "today" => Carbon::now()->toDateString(),
            "now"   => Carbon::now()->toTimeString(),
            "registrationTime" => StudentRegistrationTime::where('from',$id)->orWhere('to',$id)->get(),
            "courses"          => Course::with('courseTimeSchedule')->where('department_id', $request->user()->department_id)->get(),
            "takenCourses"    => StudentTakenCourse::with('course_time')->where('user_id',$request->user()->id)->get(),
            "form_url"        => route('student.course.registration.store'),
            "registeredCourseUrl" => route('student.course.registered.list'),
            "dropUrl"             => route('student.course.registered.drop'),
        ];
        return view('user.courseregistration.start',$params);

    }

    public function store(Request $request){
        try{

            if($request->course_schedule_id != null){
                $existingCourseIds = $this->getMOdel()->where('user_id', $request->user()->id)
                ->where('is_confirmed',1)
                ->where('is_completed',0)
                ->pluck('course_time_schedule_id')
                ->toArray();

                $changeFromDatabase = array_diff($existingCourseIds, $request->course_schedule_id);
                $changeFromCheckbox = array_diff($request->course_schedule_id,$existingCourseIds);

                if(!empty($changeFromDatabase)){

                    $this->getModel()->where('user_id', $request->user()->id)->whereIn('course_time_schedule_id',$changeFromDatabase)
                                     ->delete();
                    foreach($changeFromDatabase as $checkScheduleId){
                           $data = CourseTimeSchedule::find($checkScheduleId);
                           if ($data && $data->available_seat > 0 && $data->available_seat <= 40){
                                $data->registered_seat--;
                                $data->available_seat++;
                                $data->save();
        
                                DB::commit();
                           }
                    }
                }
                else if($changeFromCheckbox && empty($changeFromDatabase)){

                    foreach ($request->course_schedule_id as $scheduleid) {
                       $getTakenCourseId = StudentTakenCourse::where('user_id', $request->user()->id)->where('course_time_schedule_id',$scheduleid)->value('id');
                       $checkTakenCourse = $this->getModel()->find($getTakenCourseId);
                       if($checkTakenCourse){
                          $checkTakenCourse->save();
                           $checkTakenCourse->user_id = $checkTakenCourse->user_id;
                           $checkTakenCourse->course_time_schedule_id = $checkTakenCourse->course_time_schedule_id;
                           $checkTakenCourse->is_confirmed = $checkTakenCourse->is_confirmed;
                           $checkTakenCourse->is_completed = $checkTakenCourse->is_completed;
                           $checkTakenCourse->save();
                       

                           $courseTimeSchedule = CourseTimeSchedule::find($scheduleid);
                           $courseTimeSchedule->registered_seat = $courseTimeSchedule->registered_seat;
                           $courseTimeSchedule->available_seat = $courseTimeSchedule->available_seat;
                           $courseTimeSchedule->save();

                           DB::commit();
                       }
                       else{

                       $courseTimeSchedule = CourseTimeSchedule::find($scheduleid);
                       if ($courseTimeSchedule && $courseTimeSchedule->available_seat > 0 && $courseTimeSchedule->available_seat <= 40) {
                           $newCourse = new StudentTakenCourse();
                           $newCourse->id = Str::uuid();
                           $newCourse->user_id = $request->user()->id;
                           $newCourse->course_time_schedule_id = $scheduleid;
                           $newCourse->is_confirmed = 1;
                           $newCourse->is_completed = 0;
                           $newCourse->save();
               
                           $courseTimeSchedule->registered_seat++;
                           $courseTimeSchedule->available_seat--;
                           $courseTimeSchedule->save();
   
                           DB::commit();
                       } 
                       else{
                           DB::rollBack();
                           return back()->with("filled","Section full");
                        }
                       }
                   }
                }
                else{
                    return back()->with("alreadyReg","Already registered");
                }
                
            }
            else{
                return back()->with("selectCourse","Select atleast one course");
            }
            
            
        }catch(Exception $e){
            DB::rollBack();
            return back()->with("error", $this->getError($e))->withInput();
        }
        
        return back()->with("success","Course taken Successfully");
    }


    // Get courseRegisteredList for modal
    public function courseRegisteredList(Request $request){
        if( $request->ajax() ){
            $data = StudentTakenCourse::with('course_time.courses')->where('user_id', $request->user()->id)->get();
            // $data =DB::table('student_taken_courses')
            //             ->join('course_time_schedules', 'course_time_schedules.id', '=', 'student_taken_courses.course_time_schedule_id')
            //             ->join('courses', 'courses.id', '=', 'course_time_schedules.course_id')
            //             ->select('courses.*', 'course_time_schedules.*')
            //             ->where('student_taken_courses.user_id', $request->user()->id)
            //             ->get();
        }
        return json_encode($data);
    }

    public function dropRegCourse(Request $request){
        try{
            $data = $this->getModel()->where('id',$request->course_takenid)->where('user_id', $request->user()->id)->first();
            $courseScheduleid = $this->getModel()->where('id',$request->course_takenid)->where('user_id', $request->user()->id)->value('course_time_schedule_id');
            if($data){
                $data->delete();
                $courseTimeSchedule = CourseTimeSchedule::find($courseScheduleid);
                if($courseTimeSchedule && $courseTimeSchedule->available_seat > 0 && $courseTimeSchedule->available_seat <= 40){
                    $courseTimeSchedule->registered_seat--;
                    $courseTimeSchedule->available_seat++;
                    $courseTimeSchedule->save();
                }
            }
        }catch(Exception $e){
            return back()->with("error", $this->getError($e))->withInput();
        }
    }

            
       
}
