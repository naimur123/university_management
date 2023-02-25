<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class CourseController extends Controller
{
    // Get Table Column List
    private function getColumns(){
        $columns = ['#', "code", "course_name","prereq","credit","sem","action"];
        return $columns;
    }

    // Get DataTable Column List
    private function getDataTableColumns(){
        $columns = ['index',"code", "course_name","prereq","credit","sem",'action' ];
        return $columns;
    }

    //GetModel
    private function getModel(){
        return new Course();
    }

    // show faculty list
    public function index(Request $request){       
        if( $request->ajax() ){
            return $this->getDataTable($request);
        }
        $params = [
            'nav'               => 'course',
            'subNav'            => 'course.list',
            'tableColumns'      => $this->getColumns(),
            'dataTableColumns'  => $this->getDataTableColumns(),
            'dataTableUrl'      => Null,
            'pageTitle'         => strtoupper($request->name) ."". '-Course List',
            'tableStyleClass'   => 'bg-success',
           
        ];
        return view('administrator.table', $params);
     
        
        // echo $data;
    }

    protected function getDataTable($request){
        if ($request->ajax()) {
           
            if($request->name =="cse"){
                $data = $this->getModel()
                             ->where('department_id','=',1)
                             ->get();
            }
          
            return DataTables::of($data)->addIndexColumn()
                ->addColumn('index', function(){ return ++$this->index; })
                ->addColumn('action', function($row){
                    $btn = '<a href="" class="btn btn-primary btn-sm">Edit</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

    
    }
}
