<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\User;
use App\Notifications\WelcomeNewStudentNotification;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;


class StudentController extends Controller
{
    // Get Table Column List
    private function getColumns(){
        $columns = ['#', 'user_id', 'first_name','middle_name', 'last_name','father_name','mother_name', 'email','mobile','dob','presentaddress','permanentaddress','sex', 'nationality','religion','maritalstatus','department', 'program', 'credit', 'cgpa', 'is_graduated', 'action'];
        return $columns;
    }

    // Get DataTable Column List
    private function getDataTableColumns(){
        $columns = ['index', 'user_id', 'first_name','middle_name', 'last_name','father_name','mother_name', 'email','mobile','dob','presentaddress','permanentaddress','sex', 'nationality','religion', 'maritalstatus', 'department_name', 'program', 'credit', 'cgpa','is_graduated','action' ];
        return $columns;
    }
    //GetModel
    private function getModel(){
        return new User();
    }

   //show student list
   public function index(Request $request){  

    // $data = $this->getModel()
    //                      ->select('users.*')
    //                      ->join('departments', 'departments.id', '=', 'users.department_id')
    //                      ->select('departments.curriculum_short_name')
    //                      ->get();
    // dd($data);
    if( $request->ajax() )
    {
    
        return $this->getDataTable($request);
    }
    $params = [
        'nav'               => 'student',
        'subNav'            => 'student.list',
        'tableColumns'      => $this->getColumns(),
        'dataTableColumns'  => $this->getDataTableColumns(),
        "dataTableUrl"           => URL::current(),
        'create'            => route('admin.assign_student',['name' => $request->name]),
        'report'            => route('admin.student.report',['name' => $request->name]),
        'pageTitle'         => $request->name.'Student List',
        'tableStyleClass'   => 'bg-success',
       
    ];
    return view('administrator.table', $params);
   }

   //create new student
   public function create(Request $request){
        $params = [

            "title"       => "Assign",
            "form_url"    => route('admin.student.store'),
            "name"        => $request->name,
            "department"  => Department::where('curriculum_short_name',$request->name)->get()

        ];
   
        return view('administrator.student.create',$params);
   }

   //store student
   public function store(Request $request){

    $random = mt_rand(10000000,99999999);
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

        $data->id         =  Str::uuid();
        $data->first_name = $request->first_name;
        $data->middle_name = $request->middle_name;
        $data->last_name = $request->last_name;
        $data->email = $request->email;
        $data->dob = $request->dob;
        $data->mobile = $request->mobile;
        $data->father_name = $request->father_name;
        $data->mother_name = $request->mother_name;
        $data->presentaddress = $request->presentaddress;
        $data->permanentaddress = $request->permanentaddress;
        $data->sex = $request->sex;
        $data->nationality = $request->nationality;
        $data->religion = $request->religion;
        $data->program  = $request->name;
        $data->cgpa  = $request->cgpa ?? 0;
        $data->credit  = $request->credit ?? 0;
        $data->maritalstatus = $request->maritalstatus;
        $data->department_id = $request->department_id;
        $data->password = bcrypt($random);
        $data->save();
        
        DB::commit();
        try{
            if($request->id == 0){
                event(new Registered($data));
                $data->notify(new WelcomeNewStudentNotification($data,$random));
            }
        }catch(Exception $e){
                //
        }
        }catch(Exception $e){
            DB::rollBack();
            return back()->with("error", $this->getError($e))->withInput();
        }
        
        return back()->with("success", $request->id == 0 ? "Student Added Successfully" : "Student Updated Successfully");
   
    }

    //update student
    public function edit(Request $request){
        $params = [
              "title"       => "Edit",
              "form_url"    => route('admin.student.store'),
              "data"        => $this->getModel()->find($request->id),
              "name"        => $request->name,
              "department"  => Department::where('curriculum_short_name',$request->name)->get()

        ];
        return view('administrator.student.create',$params);
       
    }

    //Report Download
    public function report(Request $request){
        $params = [
            'downloads' => User::with('department')->get()
        ];
        
        $pdf = Pdf::loadview('administrator.student.report',$params);
        return $pdf->download('StudentList.pdf');
    }

    protected function getDataTable($request){
        if ($request->ajax()) {
            $data = DB::table('users')
                    ->join('departments', 'departments.id', '=', 'users.department_id')
                    ->where('departments.curriculum_short_name', $request->name)
                    ->select('users.*','departments.name','departments.curriculum_short_name')
                    ->latest()
                    ->get();
                
            return DataTables::of($data)->addIndexColumn()
                ->addColumn('index', function(){ return ++$this->index; })
                ->addColumn('sex', function($row){ return $this->getSex($row->sex); })
                ->addColumn('maritalstatus', function($row){ return Str::ucfirst($row->maritalstatus); })
                ->addColumn('is_graduated',function($row){ return $row->is_graduated == 0 ? "Undergraduate" : "Graduated" ;})
                ->addColumn('added_by', function($row){ return $row->addedBy->first_name ?? "N/A"; })
                ->addColumn('updated_by', function($row){ return $row->updatedBy->first_name ?? "N/A"; })
                ->addColumn('department_name', function($row){ return $row->name; })
                ->addColumn('program', function($row){ return strtoupper($row->curriculum_short_name); })
                ->addColumn('action', function($row){
                    $btn = '<a href="'.route('admin.student.edit',['name'=>$row->curriculum_short_name,'id' => $row->id]).'" class="btn btn-primary btn-sm">Edit</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }


    }
    // protected function getDataTable($request)
    // {
    //     if ($request->ajax()) {
    //         $cacheKey = 'datatable.results.' . md5(json_encode($request->all()));
            
    //         if (Cache::has($cacheKey)) {
    //             $data = Cache::get($cacheKey);
    //         } else {
    //             $data = $this->getModel()->get();
                
    //             Cache::put($cacheKey, $data, 60);
    //         }
            
    //         return DataTables::of($data)->addIndexColumn()
    //             ->addColumn('index', function () {
    //                 return ++$this->index;
    //             })
    //             ->addColumn('sex', function ($row) {
    //                 return $this->getSex($row->sex);
    //             })
    //             ->addColumn('maritalstatus', function ($row) {
    //                 return Str::ucfirst($row->maritalstatus);
    //             })
    //             ->addColumn('is_graduated', function ($row) {
    //                 return $row->is_graduated == 0 ? "Undergraduate" : "Graduated";
    //             })
    //             ->addColumn('added_by', function ($row) {
    //                 return $row->addedBy->first_name ?? "N/A";
    //             })
    //             ->addColumn('updated_by', function ($row) {
    //                 return $row->updatedBy->first_name ?? "N/A";
    //             })
    //             ->addColumn('department_name', function ($row) {
    //                 return $row->department->name;
    //             })
    //             ->addColumn('action', function ($row) {
    //                 $btn = '<a href="' . route('admin.student.edit', ['name' => $row->department->curriculum_short_name, 'id' => $row->id]) . '" class="btn btn-primary btn-sm">Edit</a>';
    //                 return $btn;
    //             })
    //             ->rawColumns(['action'])
    //             ->make(true);
    //     }
    // }
    

}
