<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\FacultyNotes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class ClassDetailsController extends Controller
{
    //notes tab
    public function classTab(Request $request){
        // dd($request->schedule_id);
        $tabs = ["Notes","Notice"];

        if($request->name === "notes"){
            $data = DB::table('course_time_schedules')
                    ->join('faculties','faculties.id','=','course_time_schedules.faculty_id')
                    ->join('courses','courses.id', '=', 'course_time_schedules.course_id')
                    ->join('sections','sections.id', '=','course_time_schedules.section_id')
                    ->select('course_time_schedules.*',DB::raw("CONCAT(faculties.first_name, ' ' , faculties.last_name) as faculty_name"),'faculties.email as faculty_email','faculties.rank as faculty_rank',
                    'courses.course_name as course_name','courses.credit as course_credit','sections.name as section_name')
                    ->where('course_time_schedules.id',$request->schedule_id)
                    ->get();

            // dd($data);
            $facultyNotes = FacultyNotes::where('course_time_schedule_id',$request->schedule_id)->get();
            $filesInfo = [];
            foreach($facultyNotes as $facultyNote){
                $path = $facultyNote->filename;
                $size = $this->fileformation($path);
                // $size = Storage::size($path);
                $filesInfo[] = [
                    'path' => $path,
                    'upload_date' => $facultyNote->created_at,
                    'size' => $size
                ];

            }
            // dd($filesInfo);
            $params =[
                // "tabs" => $tabs,
                "datas" => $data,
                "fileInfo" => $filesInfo,
                "class"    => "nav-link active",
            ];

            return view('user.classdetails.details',$params);
        }
        else{
            $params =[
                // "tabs" => $tabs,
                "noticeClass"    => "nav-link active",
            ];
            return view('user.classdetails.details',$params);
        }
        
        
    }

    //file download
    public function fileDownload(Request $request){
        // dd($request->path);
        $fullPath = storage_path('app/facultynotes/' . $request->path);
        return Response::download($fullPath);
    }
}
