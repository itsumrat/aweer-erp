<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PromotionalProduct;
use DataTables;
use Illuminate\Support\Facades\Validator;
use Auth;
use Illuminate\Support\Facades\DB;
class PromotionalProductController extends Controller
{
    private $root = "modules/inventory/promotional_items/";

    public function index(){
        $stores = DB::table('stores')->get();
        $data = [
            'stores'=>$stores 
        ];
        return view($this->root . 'index',$data);
    }

    public function itemListDatatableData(Request $request){
        // $users = PromotionalProduct::all();
        $store_id = $request->store_id;
        $users = PromotionalProduct::with(['item']);
         // if ($store_id != 0) {
         //    $users = $users->where('store_ids', $store_id);
         // }
  
         $users = $users->get();
         

        return Datatables::of($users)
                ->addIndexColumn()
                ->editColumn('location', function(PromotionalProduct $product){
                    $store_ids = explode(',',$product->store_ids);
                    $location = '';
                    // return $store_ids;
                    if ($store_ids != null) {
                       
                    foreach ($store_ids as $store_id) {
                        $info = \App\Store::select('name')->where('id',$store_id)->first();
                        $location .= $info->name. ' / ';
                        // $location .= $store_id .', ';

                    }
                }
                    return $location;
                })
                ->editColumn('item', function(PromotionalProduct $product){
                    return $product->item->name;
                })
                ->editColumn('item_price', function(PromotionalProduct $product){
                    $item_id = $product->item->id;
                    $pricing = \App\ProductPricing::where('product_id',$item_id)->first();
                    return $pricing->final_price;
                })
                ->editColumn('promo_date', function(PromotionalProduct $product){
                    return $product->promotion_start .' - '. $product->promotion_end;
                })
                ->editColumn('action', function(PromotionalProduct $product){
                    return '<a href="/item/promotion/'.$product->id.'/edit"><i class="far fa-edit"></i></a>
                        <a href="#" data-toggle="modal" onclick="deleteData('.$product->id.')"><i class="far fa-trash-alt"></i></a>';
                })
                ->make();
    }


    public function create(){
    	return view($this->root . 'create');
    }

    public function store(Request $request){
        $request->validate([
            'date' => 'required',
            'location' => 'required',
            'promotional_price' => 'required',
            'promotion_date' => 'required',

        ],[
            'date.required' => 'This field is required',
            'location.required' => 'This field is required',
            'promotional_price.required' => 'This field is required',
            'promotion_date.required' => 'This field is required',
        ]);
        $location_data = explode(',', $request->location);


        $price = new \App\PromotionalProduct();
        $promotion_date = $request->promotion_date;
        $promotion_date = explode('-', $promotion_date);

        $price->date = $request->date;
        $price->reference = $request->reference;
        // dd(implode(',',$location_data));
        $price->store_ids = implode(',',$location_data);
        $price->item_id = $request->product_id;
        $price->promotion_start = $promotion_date[0];
        $price->promotion_end = $promotion_date[1];
        $price->promotion_price = $request->promotional_price;
        $price->note = $request->note;
        $price->user_id = \Auth::id();

        if($price->save()){
            return redirect()->back()->with('success', 'Added Successfully!');
        }else{
            return redirect()->back()->with('error', 'Something wrong!');
        }
    }


    public function edit($id){
        $promotional_product = PromotionalProduct::find($id);
        // $promotional_product->store_ids = explode(',',$promotional_product->store_ids);
        $product_pricing = \App\ProductPricing::where('product_id', $promotional_product->item_id)->first();
        $data = [
            'promotional_product' => $promotional_product,
            'product_pricing'=> $product_pricing
        ];
        // dd($data);
        return view($this->root . 'edit', $data);
    }

    public function update(Request $request, $id){
        $request->validate([
            'date' => 'required',
            'location' => 'required',
            'promotional_price' => 'required',
            'promotion_date' => 'required',

        ],[
            'date.required' => 'This field is required',
            'location.required' => 'This field is required',
            'promotional_price.required' => 'This field is required',
            'promotion_date.required' => 'This field is required',
        ]);
        $location_data = explode(',', $request->location);


        $price = \App\PromotionalProduct::find($id);
        $promotion_date = $request->promotion_date;
        $promotion_date = explode('-', $promotion_date);

        $price->date = $request->date;
        $price->reference = $request->reference;
        // dd(implode(',',$location_data));
        $price->store_ids = implode(',',$location_data);
        $price->item_id = $request->product_id;
        $price->promotion_start = $promotion_date[0];
        $price->promotion_end = $promotion_date[1];
        $price->promotion_price = $request->promotional_price;
        $price->note = $request->note;

        if($price->save()){
            return redirect()->back()->with('success', 'Update Successfully!');
        }else{
            return redirect()->back()->with('error', 'Something wrong!');
        }
    }
    public function deleteData(Request $request){
        $product = PromotionalProduct::find($request->id);
        if($product->delete()){
            return response()->json(['data'=>['msg'=>'delete success']]);
        }
    }
}
