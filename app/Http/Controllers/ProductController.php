<?php

namespace App\Http\Controllers;

use App\Combo;
use App\PriceUpdateHistory;
use App\Product;
use App\ProductPricing;
use Auth;
use DataTables;
use Helpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
class ProductController extends Controller
{
    private $root = "modules/inventory/items/";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stores = ProductPricing::with('productPricing.category', 'productPricing.department', 'unitPrice')
                  ->orderBy('id', 'desc')
                  ->get();
        // foreach ($stores as $key => $value) {
        //     dd($value->productPricing->department->name);
        // }
        // dd($stores);

        $stores = DB::table('stores')->get();
        $data = [
            'stores'=>$stores 
        ];
        return view($this->root . 'index',$data);
    }

    public function itemDetailIndex(){
        $stores = DB::table('stores')->get();
        $data = [
            'stores'=>$stores 
        ];
        //echo "<pre>";var_dump($data);echo "</pre>";die();
        return view($this->root . 'item_detail',$data);


    }

    public function priceUpdateHistoyIndex(){
        $stores = DB::table('stores')->get();
        $data = [
            'stores'=>$stores 
        ];
        return view($this->root . 'price_update_history',$data);
    }

    public function priceUpdateHsitoryEdit($id){
        $tax = \App\Tax::first();
        $priceupdateData = PriceUpdateHistory::find($id);
        $data = [
            'price_update_data' => $priceupdateData,
            'tax' => !empty($tax)?$tax->amount:0,
        ];
        return view($this->root . 'price_update_history_edit', $data);
    }

    public function priceUpdateHsitoryUpdate(Request $request, $id){
        // dd($id);
        $request->validate([
            'date' => 'required',
            'location' => 'required',
            'new_price' => 'required',

        ],[
            'date.required' => 'This field is required',
            'location.required' => 'This field is required',
            'new_price.required' => 'This field is required',
        ]);
        
        $price = \App\PriceUpdateHistory::find($id);

        $price->date = $request->date;
        $price->reference = $request->reference;
        $price->store_id = $request->location;
        $price->prev_price = $request->prev_price;
        $price->item_id = $request->id;
        $price->prev_cost = $request->prev_cost;
        $price->prev_markup = (float)$request->prev_markup;
        $price->updated_markup = $request->new_markup;
        $price->updated_price = $request->new_price;
        $price->note = $request->note;

        if($price->save()){
            return redirect()->back()->with('success', 'Updated Successfully!');
        }else{
            return redirect()->back()->with('error', 'Something wrong!');
        }
    }

    public function priceUpdateHistoyDatatableData(Request $request){
       // $users = PriceUpdateHistory::all();
       $store_id = $request->store_id;
       $priceUpd = PriceUpdateHistory::with(['item']);
        if ($store_id != 0) {
            $priceUpd = $priceUpd->where('store_id', $store_id);
        }
 
        $priceUpd = $priceUpd->get();
        

        return Datatables::of($priceUpd)
                ->addIndexColumn()
                ->editColumn('location', function(PriceUpdateHistory $product){
                    return $product->store->name;
                })
                ->editColumn('item', function(PriceUpdateHistory $product){
                    return $product->item->name;
                })
                ->editColumn('update_date', function(PriceUpdateHistory $product){
                    return $product->created_at;
                })
                ->editColumn('action', function(PriceUpdateHistory $product){
                    return '<a href="/item/price_update/'.$product->id.'/edit"><i class="far fa-edit"></i></a>
                        <a href="#" data-toggle="modal" onclick="deleteData('.$product->id.')"><i class="far fa-trash-alt"></i></a>';
                })
                ->make();
    }

    public function itemListDatatableData(Request $request){
        $store_id = $request->store_id;
        //$users = Product::with(['prices'])->get();
        $users = ProductPricing::with('productPricing.category', 'productPricing.department', 'unitPrice')
                  ->orderBy('id', 'desc')
                  ->get();
        $current_stock = 0;

        return Datatables::of($users)
                ->editColumn('code', function(ProductPricing $product){
                    return $product->productPricing->code;
                })
                ->editColumn('name', function(ProductPricing $product){
                    return $product->productPricing->name;
                })
                ->editColumn('department', function(ProductPricing $product){
                    return $product->productPricing->department->name;
                })
                ->editColumn('category', function(ProductPricing $product){
                    return $product->productPricing->category->name;
                })
                ->editColumn('cost', function(ProductPricing $product){
                    return $product->final_cost;
                })
                ->editColumn('markup', function(ProductPricing $product){
                    return $product->markup;
                })
                ->editColumn('current_stock', function(ProductPricing $product)use($store_id){
                    if($store_id != 0){
                        return Helpers::currentStockLocationWise($product->product_id, $store_id);
                       
                    }else{
                      return Helpers::currentStock($product->product_id);
                    }
                })
                ->editColumn('price', function(ProductPricing $product)use($store_id){
                    if($store_id != 0){
                       $price = Helpers::getProductPrice($product->product_id, $store_id);
                       return $price['price'];
                    }
                    return $product->final_price;
                })
                ->editColumn('unit', function(ProductPricing $product){
                    return $product->unitPrice->name;
                })
                ->editColumn('eval', function(ProductPricing $product){
                    return 'N/A';
                })
                ->editColumn('action', function(ProductPricing $product){
                    return '<a href="items/'.$product->id.'/edit"><i class="far fa-edit"></i></a>
                        <a href="#" data-toggle="modal" onclick="deleteData('.$product->id.')"><i class="far fa-trash-alt"></i></a>';
                })
                ->make();
    }

    public function reqStore() 
    {
        $reStore = RequisitionStore::all();
        return response()->json($reStore);
    }

    public function productDataForSelectBox(Request $request){
        $search = $request->search;

        $products = ProductPricing::with('productPricing', 'unitPrice')
                  ->where('final_price', '!=', 0)
                  ->orWhere('barcode', 'like', '%'.$search.'%')
                  ->orWhereHas('productPricing', function($q) use ($search) {
                    $q->where('name', 'like', '%'.$search.'%');
                  })
                  ->orWhereHas('productPricing', function($q) use ($search) {
                    $q->where('code', 'like', '%'.$search.'%');
                  })
                  ->get();

            $data =[];


            foreach ($products as $key => $product) {
                $single = [];
               $single = [
                'label'=> $product->productPricing->code .' - '.$product->productPricing->name. ' - ' .$product->barcode,
                'code'=> $product->barcode
               ];

               array_push($data, $single);
            }

            $final = [
                'results'=>$data,
                'status'=> 0,
            ];
        return response()->json($final);
        // return response()->json($products);

        // $barproduct = Product::with(['prices'])->where('barcode', $search)->first();

        // if(!empty($barproduct)){
        //     $data  = [
        //         'product_info' => $barproduct,
        //         'status' => 1
        //     ];
        //     return response()->json($data);

        // }else{
        //         $products = Product::where('name', 'LIKE' , '%'.$search.'%')->limit(10)->orderBy('id', 'desc')->get();
        //         $data =[];


        //         foreach ($products as $key => $product) {
        //             $single = [];
        //            $single = [
        //             'label'=> $product->code .' - '.$product->name,
        //             'code'=> $product->barcode
        //            ];

        //            array_push($data, $single);
        //         }

        //         $final = [
        //             'results'=>$data,
        //             'status'=> 0,
        //         ];
        //         return response()->json($final);
        // }


    }

    public function selectedItemForSelectBoxById(Request $request){
        $id = $request->id;
        $product = Product::find($id);
     
        $data = [
             'label'=> $product->code .' - '.$product->name .' - '.$product->barcode,
            'code'=> $product->barcode
        ];

        $final = [
            'results'=>$data
        ];
        return response()->json($final);
    }


    public function productInit(){
        $products = Product::limit(10)->orderBy('id', 'desc')->get();
        $data =[];

        foreach ($products as $key => $product) {
            $single = [];
           $single = [
            'label'=> $product->code .' - '.$product->name .' - '.$product->barcode,
            'code'=> $product->barcode
           ];

           array_push($data, $single);
        }

        $final = [
            'results'=>$data
        ];
        return response()->json($final);
    }

    public function productInfoById(Request $request){
        $info = Product::with(['prices','product_wise_vendor'])->where('barcode',$request->id)->first();

        return response()->json($info);
    }

        /**
     * product info by code
     *
     * @return \Illuminate\Http\Response
     */
    public function productInfoByCode(Request $request){
        $info = Product::with(['prices','product_wise_vendor'])->where('code',$request->id)->first();

        return response()->json($info);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tax = \App\Tax::first();
        $data = [
            'tax' => !empty($tax)?$tax->amount:0,
        ];
        return view($this->root . 'create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'code' => 'required|unique:products',
            // 'barcode' => 'required|unique:products',
            'department_id' => 'required',
            'category_id' => 'required',
            'unit_id' => 'required',
            'evalucation' => 'required',
            // 'purchase_cost' => 'required|numeric',
            // 'cost_with_tax' => 'required|numeric',
            // 'quantity' => 'required',
            'delivery_mode' => 'required'

        ],[
            'name.required' => 'This field is required',
            'code.required' => 'This field is required and unique',
            // 'barcode.required' => 'This field is required',
            'department_id.required' => 'This field is required',
            'category_id.required' => 'This field is required',
            'unit_id.required' => 'This field is required',
            'evalucation.required' => 'This field is required',
            // 'purchase_cost.required' => 'This field is required',
            // 'cost_with_tax.required' => 'This field is required',
            // 'quantity.required'=> 'This field is required',
            'delivery_mode.required'=> 'This field is required'

        ]
    );

        //dd($request->all());

        $item = new Product();

        $item->name = $request->name;
        $item->delivery_mode = $request->delivery_mode;
        $item->code = $request->code;
        // $item->barcode = $request->barcode;
        $item->department_id = $request->department_id;
        $item->category_id = $request->category_id;
        $item->unit_id = $request->unit_id;
        $item->alert_quantity = $request->alert_quantity;
        // $item->quantity = $request->quantity;
        $item->evaluation = $request->evalucation;
        $item->dept_wise_category = $request->dept_wise_category;
        $item->generic_description = $request->generic_description;
        $item->short_description = $request->short_description;
        // $item->long_description = $request->long_description;
        // $item->note = $request->note;
        $item->tax_amount = $request->tax_amount;
        $item->user_id = Auth::id();
        if($item->save()){
            $cost = new \App\ProductCosting();
            $cost->product_id = $item->id;
            $cost->purchase_cost = $request->purchase_cost;
            $cost->cost_with_tax = $request->cost_with_tax;
            $cost->unit_id = $request->unit_id;

            // $vendors = $request->vendors;
           
            // if(!empty($vendors)){
            //     foreach ($vendors as $vendor) {
            //         $vend = new \App\ProductWiseVendor();

            //         $vend->vendor_id = $vendor['id'];
            //         $vend->vendor_price = $vendor['price'];

            //         $item->product_wise_vendor()->save($vend);
            //     }
            // }


            if($item->costs()->save($cost)){
                return redirect()->back()->with('success', 'Added Successfully!');
            }else{
                return redirect()->back()->with('error', 'Something wrong!');
            }
        }else{
                return redirect()->back()->with('error', 'Something wrong!');
        }



    }


    public function promotionAdd()
    {
        return view($this->root . 'promotion_add');
    }



    public function promotionStore(Request $request)
    {
        // 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = ProductPricing::with('productPricing.category', 'productPricing.department', 'unitPrice', 'vendorPrice')->where('id', $id)->first();
       // dd($product);
        $tax = \App\Tax::first();

        // $productWiseVendor =  $product->vendorPrice;
        // $vendor_data = array();

        // foreach ($productWiseVendor as $key => $value) {
        //     $vend = array();

        //     $vend = array(
        //         'serial'=> $key,
        //         'product_id' => $value->product_id,
        //         'vendor_id'=> $value->vendor_id,
        //         'price'=> $value->price,
        //     );

        //     $vendor_data[] = $vend;
        // }


        $data = [
            'item_info' => $product,
            'tax' => !empty($tax)?$tax->amount:0
            //'vendor_data'=> json_encode($vendor_data)
        ];


        return view($this->root . 'edit', $data);
    }


    public function priceEdit()
    {
        $tax = \App\Tax::first();
        $data = [
            'tax' => !empty($tax)?$tax->amount:0,
        ];
        return view($this->root . 'price_edit', $data);
    }

    public function priceUpdate(Request $request)
    {
        $request->validate([
            'date' => 'required',
            'location' => 'required',
            'new_price' => 'required',

        ],[
            'date.required' => 'This field is required',
            'location.required' => 'This field is required',
            'new_price.required' => 'This field is required',
        ]);
        $location_data = explode(',', $request->location);
        if($location_data[0] == 0){
            $location_data = \App\Store::all()->pluck('id');
        }

        foreach ($location_data as $key => $location) {
            $price = new \App\PriceUpdateHistory();
            $prevous_price = \App\PriceUpdateHistory::where('item_id', $request->id)->where('store_id', $location)->orderBy('id', 'DESC')->first();
            if(!empty($prevous_price)){
                $prev_price = $prevous_price->updated_price;
                $prev_cost = $prevous_price->prev_cost;
                $prev_markup = $prevous_price->updated_markup;
            }else{
                $product = Product::with(['prices'])->where('id', $request->id)->first();

                $prev_price = $product->prices->final_price;
                $prev_cost = $product->prices->final_cost;
                $prev_markup = $product->prices->markup;
            }
            
            $price->date = $request->date;
            $price->reference = $request->reference;
            $price->store_id = $location;
            $price->prev_price = $prev_price;
            $price->item_id = $request->id;
            $price->prev_cost = $prev_cost;
            $price->prev_markup = (float)$prev_markup;
            $price->updated_markup = $request->new_markup;
            $price->updated_price = $request->new_price;
            $price->note = $request->note;
            $res = $price->save();
   
        }

             //Product Pricing Update
        if($res){
            $productPrice = \App\ProductPricing::where('product_id', $request->id)->first();
            $productPrice->final_price = $request->new_price;
            $productPrice->markup = $request->new_markup;
            $productPrice->save();
            return redirect()->back()->with('success', 'Added Successfully!');
        }else{
            return redirect()->back()->with('error', 'Something wrong!');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $request->validate([
            'name' => 'required',
            'code' => 'required',
            // 'barcode' => 'required',
            'department_id' => 'required',
            'category_id' => 'required',
            'unit_id' => 'required',
            'alert_quantity' => 'required',
            'evalucation' => 'required',
            'final_cost' => 'required|numeric',
            'avg_cost' => 'required|numeric',
            'last_grn_cost' => 'required|numeric',
            'markup' => 'required',
            'final_price' => 'required|numeric',
            'quantity' => 'required',
            'delivery_mode' => 'required'

        ],[
            'name.required' => 'This field is required',
            'code.required' => 'This field is required',
            // 'barcode.required' => 'This field is required',
            'department_id.required' => 'This field is required',
            'category_id.required' => 'This field is required',
            'unit_id.required' => 'This field is required',
            'alert_quantity.required' => 'This field is required',
            'evalucation.required' => 'This field is required',
            'final_cost.required' => 'This field is required',
            'avg_cost.required' => 'This field is required',
            'last_grn_cost.required' => 'This field is required',
            'markup.required' => 'This field is required',
            'final_price.required' => 'This field is required',
            'quantity.required'=> 'This field is required',
            'delivery_mode.required'=> 'This field is required'

        ]
    );

        $item = Product::find($id);

        $item->name = $request->name;
        $item->delivery_mode = $request->delivery_mode;
        $item->code = $request->code;
        // $item->barcode = $request->barcode;
        $item->department_id = $request->department_id;
        $item->category_id = $request->category_id;
        $item->unit_id = $request->unit_id;
        $item->alert_quantity = $request->alert_quantity;
        // $item->quantity = $request->quantity;
        $item->evaluation = $request->evalucation;
        $item->generic_description = $request->generic_description;
        $item->short_description = $request->short_description;
        // $item->long_description = $request->long_description;
        $item->note = $request->note;
        if($item->save()){
            $price = \App\ProductPricing::where('product_id', $id)->first();
            $price->final_cost = $request->final_cost;
            $price->avg_cost = $request->avg_cost;
            $price->last_grn_cost = $request->last_grn_cost;
            $price->final_price = $request->final_price;
            $price->price_without_tax = $request->price_without_tax;
            $price->markup = $request->markup;

            // $vendors = $request->vendors;

            // if(!empty($vendors)){
            //     \App\ProductWiseVendor::where('product_id', $id)->delete();
            //     foreach ($vendors as $vendor) {
                   
                    

            //         $vend = new \App\ProductWiseVendor();

            //         $vend->vendor_id = $vendor['id'];
            //         $vend->vendor_price = $vendor['price'];

            //         $item->product_wise_vendor()->save($vend);
            //     }
            // }


            if($item->prices()->save($price)){
                return redirect()->back()->with('success', 'Updated Successfully!');
            }else{
                return redirect()->back()->with('error', 'Something wrong!');
            }
        }else{
                return redirect()->back()->with('error', 'Something wrong!');
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }

    public function itemDelete(Request $request){
        $product = Product::find($request->id);
        if($product->delete()){
            return response()->json(['data'=>['msg'=>'delete success']]);
        }
    }

    public function productWiseVendorData(Request $request){
        $product_wise_vendor = \App\ProductWiseVendor::with(['vendor'])->where('product_id',$request->product_id)->get();

        return response()->json($product_wise_vendor);
    }


// Anatomy
    public function itemAnatomyIndex(){
        $stores = DB::table('stores')->get();
        $data = [
            'stores'=>$stores 
        ];
        return view($this->root . 'anatomy',$data);
    }

    public function itemAnatomoyDatatableData(){
        $users = Product::with(['prices'])->get();

        return Datatables::of($users)
                ->addIndexColumn()
                ->editColumn('department', function(Product $product){
                    return $product->department->name;
                })
                ->editColumn('category', function(Product $product){
                    return $product->category->name;
                })
                ->editColumn('final_cost', function(Product $product){
                    return $product->prices->final_cost;
                })
                ->editColumn('markup', function(Product $product){
                    return $product->prices->markup;
                })
                ->editColumn('final_price', function(Product $product){
                    return $product->prices->final_price;
                })
                ->editColumn('unit', function(Product $product){
                    return $product->unit->name;
                })
                ->editColumn('opening_stock', function(Product $product){
                    return $product->quantity;
                })
                ->editColumn('adjustment', function(Product $product){
                    return 'test_data';
                })
                ->editColumn('damage', function(Product $product){
                    return 'test_data';
                })
                ->editColumn('purchase', function(Product $product){
                    return 'test_data';
                })
                ->editColumn('sold', function(Product $product){
                    return 'test_data';
                })
                ->editColumn('transfer', function(Product $product){
                    return 'test_data';
                })
                ->editColumn('current_stock', function(Product $product){
                    return 'test_data';
                })
                ->editColumn('svc', function(Product $product){
                    return 'test_data';
                })
                ->editColumn('svp', function(Product $product){
                    return 'test_data';
                })
                ->editColumn('action', function(Product $product){
                    return '<a href="items/'.$product->id.'/edit"><i class="far fa-edit"></i></a>
                        <a href="#" data-toggle="modal" onclick="deleteData('.$product->id.')"><i class="far fa-trash-alt"></i></a>';
                })
                ->make();
    }


    public function productAnatomoyById(Request $request){
        $store_id = $request->store_id;
        $info = Product::with(['prices', 'department', 'unit', 'category', 'product_wise_vendor'])->where('barcode',$request->id)->first();
        $info->updated_price = Helpers::getProductPrice($info->id, $store_id);

        $barcodes = Product::select('barcode')->where('code', $info->code)->get();
        // dd($barcodes);
        $transactions = [
            'damage'=> \App\Damage::where('item_id', $info->id)->where('location', $store_id)->sum('quantity'),
            'adjustment'=> \App\Adjustment::where('item_id', $info->id)->where('location', $store_id)->sum('quantity'),
        ];

        $purchase = [
            'purchase' => \App\PurchaseOrderWiseItem::where('item_id', $info->id)->where('location_id', $store_id)->sum('quantity'),
            'sold'=> 0,
            'transfer' => \App\TransferItems::where('item_id', $info->id)->sum('quantity')
        ];



        $stocks =[
            'current_stock' =>Helpers::currentStockLocationWise($info->id, $store_id),
            'svc' => 0,
            'svp' =>0,
            'opening_stock' => 0
        ];

        $vendor_info = \App\ProductWiseVendor::with(['vendor'])->where('product_id',$info->id)->get();
        $data = [
            'item_info'=> $info,
            'transaction'=> $transactions,
            'vendors' => $vendor_info,
            'barcodes' => $barcodes,
            'purchase' => $purchase,
            'stocks' => $stocks

        ];

        return response()->json($data);
    }

    public function productListForTrack(Request $request){
        $search = $request->search;
        $barproduct = Product::with(['prices'])->where('code', $search)->first();

        if(!empty($barproduct)){
            $data  = [
                'product_info' => $barproduct,
                'status' => 1
            ];
            return response()->json($data);

        }else{
                $products = Product::where('name', 'LIKE' , '%'.$search.'%')->limit(10)->orderBy('id', 'desc')->get();
                $data =[];


                foreach ($products as $key => $product) {
                    $single = [];
                   $single = [
                    'label'=> $product->code .' - '.$product->name,
                    'code'=> $product->barcode
                   ];

                   array_push($data, $single);
                }

                $final = [
                    'results'=>$data,
                    'status'=> 0,
                ];
                return response()->json($final);
        }
    }


    public function priceUpdateHsitoryDelete(Request $request){
        $product = PriceUpdateHistory::find($request->id);
        if($product->delete()){
            return response()->json(['data'=>['msg'=>'delete success']]);
        }
    }


    // kkkkkkkkk

    public function allProductsWithBarcode() {
        $products = ProductPricing::with('productPricing', 'unitPrice')
                  ->where('final_price', 0)
                  ->orderBy('id', 'desc')
                  ->limit(100)->get();
        return response()->json($products);
    }

    public function fetchProductBarcode(Request $request) {
        $product = ProductPricing::with('productPricing', 'unitPrice', 'costs')
                  ->where('barcode', $request->barcode)->first();
        return response()->json($product);
    }


}
