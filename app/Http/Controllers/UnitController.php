<?php

namespace App\Http\Controllers;

use App\Unit;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Validator;

class UnitController extends Controller
{
    private $root = "modules/inventory/settings/unit/";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view($this->root. 'index');
    }

    public function unitList(){
        $dept = Unit::all();

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


    public function allUnitData(){
        $cat = Unit::all();
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
        $note = $request->note;
        $tracker = $request->tracker;

        if($tracker == 0 && $id==''){
            $dept = new Unit();
            $dept->name = $name;
            $dept->note = $note;

            if($dept->save()){
                $data = [
                    'status'=>201,
                    'msg' => 'Success',
                    'process'=>'add'
                ];
            }

        }else{
            $dept =Unit::find($id);
            $dept->name = $name;
            $dept->note = $note;

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
     * @param  \App\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function show(Unit $unit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function edit(Unit $unit)
    {
        //
    }
    public function unitDetail(Request $request){
        $id = $request->id;
        $unit = Unit::find($id);
        return response()->json($unit);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Unit $unit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Unit $unit)
    {
        //
    }

    public function deleteData(Request $request){
        $id = $request->id;

        $dept = Unit::find($id);
        if($dept->delete()){
            $data = [
                'msg' => 'Data Deleted successfully',
                'code'=> 200,
            ];

            return response()->json($data);
        }
    }
}
