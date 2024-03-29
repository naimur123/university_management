<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseTimeSchedule;
use App\Models\Department;
use App\Models\Faculty;
use App\Models\Section;
use Barryvdh\Debugbar\Facades\Debugbar;
use Carbon\Carbon;
use Exception;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CourseTimeScheduleController extends Controller
{
    //GetModel
    private function getModel(){
        return new CourseTimeSchedule();
    }

    //create 
    public function create(Request $request){

        $dpt_id = Department::where('curriculum_short_name',$request->name)->value('id');    
        $params = [
            "title"       =>    "Course Time Schedule",
            "form_url"    =>    route('admin.course_schedule.store'),
            "courses"     =>    Course::where("department_id", $dpt_id)->get(),
            "days"        =>    $this->daysGet(),
            "session"     =>    $this->semAdd(),
            "dataUrl"     =>    route('admin.reg.course',$request->name),
            "dpt_id"      =>    $dpt_id
        ];
        return view('administrator.courseschedule.create',$params);
    }

    //store course time schedule
    public function store(Request $request){
        $validate = [
            "day"   =>  'required|array',
        ];
        Validator::make($request->all(), $validate,[
            "day.required" => "Error! At least One day is required"

        ])->validate();

        try{
            DB::beginTransaction();
            if( $request->id == 0 ){
                $data = $this->getModel();
                $data->id =  Str::uuid();
            }
            else{
                $data = $this->getModel()->find($request->id);
                
            }

            $data->course_id  = $request->course_id;
            $data->day        = $request->day;
            $data->start_time = $request->start_time;
            $data->end_time   = $this->getEndTime($request);
            $data->faculty_id = $request->faculty_id;
            $data->section_id = $request->section_id;
            $data->session    = $request->session;
            $data->total_seat = 40;
            $data->registered_seat = 0;
            $data->available_seat = 40;
            $data->save();
            
            DB::commit();
            try{
                if($request->id == 0){
                    event(new Registered($data));
                }
            }catch(Exception $e){
                //
            }
        }catch(Exception $e){
            DB::rollBack();
            return back()->with("error", $this->getError($e))->withInput();
        }

        return back()->with("success", $request->id == 0 ? "Course Schedule Time Added SuccessFully" : "Course Schedule Time Updated Successfully");
    }

    //Get End time
    public function getEndTime($request){

        $start_time = Carbon::parse($request->start_time);
        $credit = Course::where("id",$request->course_id)->value('credit');
        if($credit == 3){
            $end_time = $start_time->copy()->addHours(1)->addMinutes(30);
        }
        else{
            $end_time = $start_time->copy()->addHours(3);
        }
        return $end_time;

    }

    //get available sections and faculties without registered course
    public function getFacultySection(Request $request){
        
            $faculties = DB::table('faculties')
                ->where('department_id',$request->dpt_id)
                ->whereNotIn('id', function($query) use ($request){
                    $query->select('faculty_id')
                          ->from('course_time_schedules')
                          ->where('course_id', $request->course_id);
                })
                ->where(function($query) {
                    $query->where('rank', '<>', 'Teaching Assistant')
                          ->orWhereNull('rank');
                })
                ->get();

            $sections = DB::table('sections')
                        ->where('reserved', false)
                        ->whereNotIn('id', function($query) use ($request) {
                            $query->select('section_id')
                                ->from('course_time_schedules')
                                ->where('course_id', $request->course_id);
                        })
                        ->orderBy('name', 'asc')
                        ->get();
            

            return response()->json([
                'faculties' => $faculties,
                'sections' => $sections
            ]);

    }
    
}
