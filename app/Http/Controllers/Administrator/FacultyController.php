<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Faculty;
use Brian2694\Toastr\Facades\Toastr;
use Exception;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class FacultyController extends Controller
{

    // Get Table Column List
    private function getColumns(){
        $columns = ['#', 'user_id', 'rank', 'first_name', 'last_name', 'email','mobile','dob','presentaddress','permanentaddress','sex', 'nationality','religion','maritalstatus','department', 'added_by', 'updated_by', 'action'];
        return $columns;
    }

    // Get DataTable Column List
    private function getDataTableColumns(){
        $columns = ['index', 'user_id', 'rank', 'first_name', 'last_name', 'email','mobile','dob','presentaddress','permanentaddress','sex', 'nationality','religion','maritalstatus','department_name','admin_name', 'updated_by','action' ];
        return $columns;
    }

    //GetModel
    private function getModel(){
        return new Faculty();
    }

    // show faculty list
    public function index(Request $request){        
        if( $request->ajax() ){
            return $this->getDataTable($request);
        }
        $params = [
            'nav'               => 'faculty',
            'subNav'            => 'faculty.list',
            'tableColumns'      => $this->getColumns(),
            'dataTableColumns'  => $this->getDataTableColumns(),
            'dataTableUrl'      => Null,
            'create'            => route('admin.assign_faculty'),
            'pageTitle'         => 'Faculty List',
            'tableStyleClass'   => 'bg-success',
           
        ];
        return view('administrator.table', $params);
     
        
        // echo $data;
    }

    //create new faculty
    public function create(Request $request){
        $params = [
            "title"       =>   "Assign",
            "form_url"    => route('admin.faculty.store'),
            "departments"  => Department::all()

       ];
       
       return view('administrator.faculty.create',$params);
    }

    //store faculty
    public function store(Request $request){

        try{
            DB::beginTransaction();
            if( $request->id == 0 ){

                $data = $this->getModel();
                $data->id         =  Str::uuid();
                $data->added_by = $request->user()->id;
                
            }
            else{
                $data = $this->getModel()->find($request->id);
                $data->updated_by = $request->user()->id;
            }

            $data->rank = $request->rank;
            $data->first_name = $request->first_name;
            $data->last_name = $request->last_name;
            $data->email = $request->email;
            $data->mobile = $request->mobile;
            $data->dob = $request->dob;
            $data->presentaddress = $request->presentaddress;
            $data->permanentaddress = $request->permanentaddress;
            $data->sex = $request->sex;
            $data->nationality = $request->nationality;
            $data->religion = $request->religion;
            $data->maritalstatus = $request->maritalstatus;
            $data->department_id = $request->department_id;
            $data->password = bcrypt(8);
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

        // Toastr::success('Faculty Added Successfully', 'Success', ["positionClass" => "toast-top-right"]);
        
        return back()->with("success", $request->id == 0 ? "Faculty Added Successfully" : "Faclty Updated Successfully");
        // return back();
    }

    //update faculty
    public function edit(Request $request){
        $params =[
              "title" => "Edit",
              "data" => $this->getModel()->find($request->id),
              "form_url"    => route('admin.faculty.store'),
              "departments"  => Department::all()

        ];
        return view('administrator.faculty.create',$params);
       
    }


    protected function getDataTable($request){
        if ($request->ajax()) {
            $data= $this->getModel()
                        ->select('faculties.*', 'administrators.first_name as admin_name', 'updated.first_name as updated_by', 'departments.name as department_name')
                        ->orderBy('created_at', 'DESC')
                        ->join('administrators', 'administrators.id', '=', 'faculties.added_by')
                        ->leftJoin('administrators as updated', 'updated.id', '=', 'faculties.updated_by')
                        ->join('departments', 'departments.id', '=', 'faculties.department_id')
                        ->get();
          
            return DataTables::of($data)->addIndexColumn()
                ->addColumn('index', function(){ return ++$this->index; })
                ->addColumn('sex', function($row){ return $this->getSex($row->sex); })
                ->addColumn('maritalstatus', function($row){ return Str::ucfirst($row->maritalstatus); })
                ->addColumn('action', function($row){
                    $btn = '<a href="'.route('admin.faculty.edit',['id' => $row->id]).'" class="btn btn-primary btn-sm">Edit</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

    
    }
    

            
    
}
