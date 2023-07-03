<?php

namespace App\Http\Controllers\Faculty;

use App\Http\Controllers\Controller;
use App\Models\FacultyNotes;
use App\Models\StudentTakenCourse;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Yajra\DataTables\Facades\DataTables;

class ClassViewController extends Controller
{
    // Get Table Column List
    private function getColumns(){
        $columns = ['#','student_name', 'email','mobile','action'];
        return $columns;
    }

    // Get DataTable Column List
    private function getDataTableColumns(){
        $columns = ['index','student_name', 'email','mobile','action' ];
        return $columns;
    }

    //class view
    public function classView(Request $request){
        // $data = StudentTakenCourse::where('course_time_schedule_id', $request->schedule_id)->where('is_confirmed', 1)->where('is_completed', 0)->get();
        // $params = [
        //     "data" => StudentTakenCourse::where('course_time_schedule_id', $request->schedule_id)->where('is_confirmed', 1)->where('is_completed', 0)->get()
        // ];
        if( $request->ajax() ){
            return $this->getDataTable($request);
        }
        $params = [
            'nav'               => 'faculty',
            'subNav'            => 'faculty.list',
            'tableColumns'      => $this->getColumns(),
            'dataTableColumns'  => $this->getDataTableColumns(),
            'dataTableUrl'      => URL::current(),
            'upload'            => route('faculty.upload_notes',['schedule_id' => $request->schedule_id]),
            'pageTitle'         => 'Class view',
            'tableStyleClass'   => 'bg-success',
           
        ];
        return view('faculty.table', $params);

   
              
    }

    //upload notes
    public function uploadNotes(Request $request){
        // dd($request->schedule_id);
        try{
            $uploadedFiles = [];
            if ($request->hasFile('files')) {
                $files = $request->file('files');
                foreach ($files as $file) {
                    $originalFilename = $file->getClientOriginalName();
                    $timestamp = time().rand(1,99);
                    $filename = $timestamp . '_' . $originalFilename;
                    $path = $file->storeAs('facultynotes', $filename);
                    $uploadedFiles[] = $path;
                }
            }

            //filename save to database
            foreach ($uploadedFiles as $path) {
                $facultyNote = new FacultyNotes();
                $facultyNote->filename = $path;
                $facultyNote->course_time_schedule_id = $request->schedule_id;
                $facultyNote->save();
                DB::commit();
            }
            return redirect()->back()->with('success', 'Files uploaded successfully.');

        }catch(Exception $e){
            DB::rollBack();
            return back()->with("error", $this->getError($e))->withInput();
        }
    }

    protected function getDataTable($request){
        if ($request->ajax()) {
            $data = DB::table('student_taken_courses')
                    ->join('users','users.id','=','student_taken_courses.user_id')
                    ->select(
               DB::raw("CONCAT(users.first_name, ' ', users.last_name) AS student_name"),
                        'users.email','users.mobile')
                    ->where('student_taken_courses.course_time_schedule_id',$request->schedule_id)
                    ->where('student_taken_courses.is_confirmed', 1)
                    ->where('student_taken_courses.is_completed', 0)
                    ->get();
            return DataTables::of($data)->addIndexColumn()
                ->addColumn('index', function(){ return ++$this->index; })
                ->addColumn('action', function($row){                
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
}
