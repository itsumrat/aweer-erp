<?php

namespace App\Http\Controllers;

use App\Store;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Validator;

class StoreController extends Controller
{
    private $root = "modules/inventory/settings/store/";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view($this->root. 'index');
    }

    public function storeList(){
        $data = Store::all();

        return Datatables::of($data)
            ->addColumn('sl', function($data){
                return $data->id;
            })
            ->addColumn('action', function($data){
                return '<a href="#" data-toggle="modal" onclick="edit('.$data->id.')"><i class="far fa-edit"></i></a>
                    <a href="#" data-toggle="modal" onclick="deleteData('.$data->id.')"><i class="far fa-trash-alt"></i></a>';
            })
            ->make();
    }


    public function locationInit(){
        $products = Store::orderBy('id', 'desc')->get();
        $data =[];

        foreach ($products as $key => $product) {
            $single = [];
           $single = [
            'label'=> $product->name,
            'code'=> $product->id
           ];

           array_push($data, $single);
        }

        $final = [
            'results'=>$data
        ];
        return response()->json($final);
    }
    
    public function locationInitWithAll(){
        $products = Store::orderBy('id', 'desc')->get();
        $data =[
            [
                'label' => 'All Location',
                'code' => 0
            ]
            ];

        foreach ($products as $key => $product) {
            $single = [];
           $single = [
            'label'=> $product->name,
            'code'=> $product->id
           ];

           array_push($data, $single);
        }

        $final = [
            'results'=>$data
        ];
        return response()->json($final);
    }

    public function selectedStoreForSelectBoxById(Request $request){
        $id = $request->id;
        $product = Store::find($id);
        $data = [
            'label' => $product->name,
            'code' => $product->id
        ];
        $final = [
            'results'=>$data
        ];
        return response()->json($final);
    }


    public function locationInfoById(Request $request){
        $info = Store::find($request->id);

        return response()->json($info);
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
        if($request->tracker == 0 && $request->id == ''){
      $validator = Validator::make($request->all(), 
        [
            'code' => 'required|unique:stores',
            'name' => 'required',
            'email' => 'required|unique:stores|email:rfc,dns',
            'phone' => 'required|unique:stores',
            'address' => 'required',

        ]
    );
  }else{
      $validator = Validator::make($request->all(), 
        [
            'code' => 'required',
            'name' => 'required',
            'email' => 'required|email:rfc,dns',
            'phone' => 'required',
            'address' => 'required',

        ]
    );
  }

        if (!$validator->passes()) {
            $errorData = [
                'error'=>$validator->errors()->all(),
                'tracker'=>0,
                ];
            return response()->json($errorData);
        }


        $id = $request->id;
        $code = $request->code;
        $name = $request->name;
        $email = $request->email;
        $phone = $request->phone;
        $address = $request->address;
        $tracker = $request->tracker;

        if($tracker == 0 && $id==''){
            $dept = new Store();
            $dept->code = $code;
            $dept->name = $name;
            $dept->email = $email;
            $dept->phone = $phone;
            $dept->address = $address;

            if($dept->save()){
                $data = [
                    'status'=>201,
                    'msg' => 'Success',
                    'process'=>'add'
                ];
            }

        }else{
            $dept =Store::find($id);
            $dept->code = $code;
            $dept->name = $name;
            $dept->email = $email;
            $dept->phone = $phone;
            $dept->address = $address;

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
     * @param  \App\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function show(Store $store)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function edit(Store $store)
    {
        //
    }

    public function storeDetail(Request $request){
        $id = $request->id;
        $unit = Store::find($id);
        return response()->json($unit);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Store $store)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function destroy(Store $store)
    {
        //
    }
    public function deleteData(Request $request){
        $id = $request->id;

        $dept = Store::find($id);
        if($dept->delete()){
            $data = [
                'msg' => 'Data Deleted successfully',
                'code'=> 200,
            ];

            return response()->json($data);
        }
    }
}
