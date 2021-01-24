<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vendor;
use DataTables;
use Illuminate\Support\Facades\Validator;

class VendorController extends Controller
{
    private $root = "modules/inventory/settings/vendor/";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view($this->root. 'index');
    }

    public function vendorList(){
        $data = Vendor::all();

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

    public function allVendorData(){
        $cat = Vendor::all();
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
        if($request->tracker == 0 && $request->id == ''){
      $validator = Validator::make($request->all(), 
        [
            'code' => 'required|unique:vendors',
            'name' => 'required',
            'email' => 'required|unique:vendors|email:rfc,dns',
            'phone' => 'required|unique:vendors',
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
        $country = $request->country;
        $company = $request->company;
        $city = $request->city;
        $vat_no = $request->vat;
        $payment_term = $request->payment_term;
        $phone = $request->phone;
        $address = $request->address;
        $type = $request->type;
        $discount = $request->discount;
        $tracker = $request->tracker;

        if($tracker == 0 && $id==''){
            $dept = new Vendor();
            $dept->code = $code;
             $dept->company = $company;
            $dept->name = $name;
            $dept->email = $email;
            $dept->phone = $phone;
            $dept->country = $country;
            $dept->vat_no = $vat_no;
            $dept->city = $city;
            $dept->payment_term = $payment_term;
            $dept->address = $address;
            $dept->type = $type;
            $dept->discount = $discount;

            if($dept->save()){
                $data = [
                    'status'=>201,
                    'msg' => 'Success',
                    'process'=>'add'
                ];
            }

        }else{
            $dept =Vendor::find($id);
            $dept->code = $code;
             $dept->company = $company;
            $dept->name = $name;
            $dept->email = $email;
            $dept->phone = $phone;
            $dept->country = $country;
            $dept->city = $city;
            $dept->vat_no = $vat_no;
            $dept->city = $city;
            $dept->payment_term = $payment_term;
            $dept->address = $address;
            $dept->type = $type;
            $dept->discount = $discount;

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
     * @param  \App\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function show(Vendor $vendor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function edit(Vendor $vendor)
    {
        //
    }


    public function vendorDetail(Request $request){
        $id = $request->id;
        $unit = Vendor::find($id);
        return response()->json($unit);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vendor $vendor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vendor $vendor)
    {
        //
    }
    public function deleteData(Request $request){
        $id = $request->id;

        $dept = Vendor::find($id);
        if($dept->delete()){
            $data = [
                'msg' => 'Data Deleted successfully',
                'code'=> 200,
            ];

            return response()->json($data);
        }
    }
    
    
    public function vendorDataForSelectBox(Request $request){
    	        $search = $request->search;
        $locations = Vendor::where('name', 'LIKE' , '%'.$search.'%')->orWhere('code', 'LIKE' , '%'.$search.'%')->limit(10)->orderBy('id', 'desc')->get();
        $data =[];

        foreach ($locations as $key => $product) {
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


    public function vendorDataById(Request $request){
        $info = Vendor::find($request->id);

        return response()->json($info);
    }
}
