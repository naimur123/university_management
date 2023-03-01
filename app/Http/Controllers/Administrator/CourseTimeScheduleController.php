<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseTimeSchedule;
use App\Models\Department;
use App\Models\Faculty;
use App\Models\Section;
use Carbon\Carbon;
use Exception;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        //Days get
        // $days = [];
        $days = [];
        $now = Carbon::now()->startOfWeek(Carbon::SUNDAY);
        for ($i = 0; $i < 7; $i++) {
            $day = $now->copy()->addDays($i)->format('l');
            if ($day !== 'Friday') {
                $days[] = $day;
            }
        }
    
        //semeseter add
        $year = Carbon::now()->year;
        $month = Carbon::now()->month;
        if ($month >= 1 && $month <= 6) {
            $session = 'Summer'.'-'. $year;
        } else {
            $session = 'Fall'.'-'. $year;
        }
        $params = [
            "title"       =>   "Course Time Schedule",
            "form_url"    =>   route('admin.course_schedule.store'),
            "faculties"   =>   Faculty::where("department_id",$dpt_id)->get(),
            "courses"     =>   Course::where("department_id", $dpt_id)->get(),
            "sections"    =>   Section::orderBy('name','asc')->get(),
            "days"        =>   $days,
            "session"    =>   $session
        ];
        return view('administrator.courseschedule.create',$params);
    }

    //store course time schedule
    public function store(Request $request){
       
        // $request->validate([
        //     'day' => 'required|array',
        //     'day.*' => 'string',
        // ]);
       
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
    
}
