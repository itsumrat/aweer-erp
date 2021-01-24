<?php

namespace App\Http\Controllers;

use App\Department;
use Illuminate\Http\Request;
// use Yajra\DataTables\Services\DataTable;
use DataTables;
use Illuminate\Support\Facades\Validator;

class DepartmentController extends Controller
{
    private $root = "modules/inventory/settings/department/";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view($this->root. 'index');
    }

    public function departmentList(){
        $dept = Department::all();

        return Datatables::of($dept)
            ->addColumn('sl', function($dept){
                return $dept->id;
            })
            ->addColumn('action', function($dept){
                return '<a href="#" data-toggle="modal" onclick="edit('.$dept->id.')"><i class="far fa-edit"></i></a>
                    <a href="#" data-toggle="modal" onclick="deleteData('.$dept->id.')"><i class="far fa-trash-alt"></i></a>';
            })
            ->make();
    }

    public function allDepartmentData(){
        $cat = Department::all();
        return response()->json($cat);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), 
        [
            'name' => 'required',
            'code' => 'required',

        ],
        [
            'name.required' => 'Name field is required',
        ]
    );
        if (!$validator->passes()) {
            $errorData = [
                'error'=>$validator->errors()->all(),
                'tracker'=>0,
                ];
            return response()->json($errorData);
        }



        $id = $request->id;
        $name = $request->name;
        $code = $request->code;
        $desc = $request->desc;
        $tracker = $request->tracker;

        if($tracker == 0 && $id==''){
            $dept = new Department();
            $dept->name = $name;
            $dept->code = $code;
            $dept->description = $desc;

            if($dept->save()){
                $data = [
                    'status'=>201,
                    'msg' => 'Success',
                    'process'=>'add'
                ];
            }

        }else{
            $dept =Department::find($id);
            $dept->name = $name;
            $dept->code = $code;
            $dept->description = $desc;

            if($dept->save()){
                $data = [
                    'status'=>201,
                    'msg' => 'Success',
                    'process'=>'update'
                ];
            }
        }

        return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function show(Department $department)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function edit(Department $department)
    {
        //
    }

    public function departmentDetail(Request $request){
        $id = $request->id;
        $dept = Department::find($id);
        return response()->json($dept);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Department $department)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy(Department $department)
    {
        //
    }


    public function deleteData(Request $request){
        $id = $request->id;

        $dept = Department::find($id);
        if($dept->delete()){
            $data = [
                'msg' => 'Data Deleted successfully',
                'code'=> 200,
            ];

            return response()->json($data);
        }
    }
}
