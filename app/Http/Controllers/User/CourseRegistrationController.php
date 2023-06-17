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
        // $data = DB::table('student_taken_courses')
        // ->leftJoin('course_time_schedules', 'course_time_schedules.id', '=', 'student_taken_courses.course_time_schedule_id')
        // ->leftJoin('courses', 'courses.id', '=', 'course_time_schedules.course_id')
        // ->select('courses.*', 'course_time_schedules.*')
        // ->where('student_taken_courses.user_id', $request->user()->user_id)
        // ->get();
       
        $params = [
            "today" => Carbon::now()->toDateString(),
            "now"   => Carbon::now()->toTimeString(),
            "registrationTime" => StudentRegistrationTime::where('from',$id)->orWhere('to',$id)->get(),
            "courses"          => Course::with('courseTimeSchedule')->where('department_id', $request->user()->department_id)->get(),
            "takenCourses"    => StudentTakenCourse::with('course_time')->where('user_id',$request->user()->id)->get(),
            "form_url"        => route('student.course.registration.store'),
            "registeredCourseUrl" => route('student.course.registered.list'),
            "user_id" => $request->user()->user_id,
        ];
        return view('user.courseregistration.start',$params);

    }

    public function store(Request $request){
        try{

            if($request->course_schedule_id != null){
                $existingCourseIds = $this->getMOdel()->where('user_id', $request->user()->id)
                ->where('is_confirmed',0)
                ->where('is_completed',0)
                ->pluck('course_time_schedule_id')
                ->toArray();
                if($existingCourseIds){
                    $this->getModel()->whereIn('course_time_schedule_id',$existingCourseIds)
                                     ->delete();
                }
                foreach ($request->course_schedule_id as $scheduleid) {
                        $newCourse = new StudentTakenCourse();
                        $newCourse->id = Str::uuid();
                        $newCourse->user_id = $request->user()->id;
                        $newCourse->course_time_schedule_id = $scheduleid;
                        $newCourse->is_confirmed = 0;
                        $newCourse->is_completed = 0;
                        $newCourse->save();
                        DB::commit();
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

    public function getRegisteredCourseTable(Request $request){
        // if($request->ajax()){
        //     $data =  $data = StudentTakenCourse::with('course_time.courses')->where('user_id', $request->user()->user_id)->get();
        // }
        // dd($data);
        // return DataTables::of($data)->addIndexColumn()
        //         ->addColumn('index', function(){ return ++$this->index; })
        //         // ->addColumn('course_name', function($row){ return $row->course_time->courses->course_name ?? "N/A"; })
        //         ->rawColumns(['action'])
        //         ->make(true);
    }

            
       
}
