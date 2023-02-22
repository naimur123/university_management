<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Models\Faculty;
use Brian2694\Toastr\Facades\Toastr;
use Exception;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Yajra\DataTables\Facades\DataTables;

class FacultyController extends Controller
{

    // Get Table Column List
    private function getColumns(){
        $columns = ['#', 'user_id', 'first_name', 'last_name', 'email','mobile', 'added_by', 'updated_by', 'action'];
        return $columns;
    }

    // Get DataTable Column List
    private function getDataTableColumns(){
        $columns = ['id', 'user_id', 'first_name', 'last_name', 'email','mobile', 'added_by', 'updated_by','action' ];
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
    }
    public function create(Request $request){
        $params = [
            "title"       =>   "Assign",
            "form_url"    => route('admin.assign_faculty.store')

       ];
       
       return view('administrator.faculty.create',$params);
    }
    public function store(Request $request){

        try{
            DB::beginTransaction();
            if( $request->id == 0 ){

                $data = $this->getModel();
                $data->added_by = $request->user()->id;
                
            }
            else{
                $data = $this->getModel()->find($request->id);
                $data->updated_by = $request->user()->id;
            }

            // $data->user_id = uniqid(5);
            $data->first_name = $request->first_name ?? "n/a";
            $data->last_name = $request->last_name ?? 'n/a';
            $data->email = $request->email ?? 'n/a';
            $data->rank = $request->rank ?? 'n/a';
            $data->dob = $request->dob ?? '';
            $data->mobile = $request->mobile ?? '';
            $data->presentaddress = $request->presentaddress ?? "";
            $data->permanentaddress = $request->permanentaddress ?? "";
            $data->sex = $request->sex ?? '';
            $data->nationality = $request->nationality ?? '';
            $data->religion = $request->religion ?? '';
            $data->maritalstatus = $request->maritalstatus ?? '';
            $data->password = uniqid(8);
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


    protected function getDataTable($request){
        if ($request->ajax()) {
            $data = $this->getModel()->select('faculties.*', 'added.first_name as added_by','updated.first_name as updated_by')
                                    ->join('administrators as added', 'added.id', '=', 'faculties.added_by')
                                    ->leftjoin('administrators as updated', 'updated.id', '=', 'faculties.updated_by')
                                    ->get();
            
            return DataTables::of($data)->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '<a href="javascript:void(0)" class="btn btn-primary btn-sm">View</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

    
    }
    

            
    
}
