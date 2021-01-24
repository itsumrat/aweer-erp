<?php

namespace App\Http\Controllers;

use App\Offer;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class OfferController extends Controller
{
    private $root = "modules/inventory/offer_items/";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stores = DB::table('stores')->get();
        $data = [
            'stores'=>$stores 
        ];
        return view($this->root . 'index',$data);
    }

    public function offerListDatatableData(Request $request){
        // $users = PromotionalProduct::all();
        $store_id = $request->store_id;
        $users = Offer::with(['buy_item', 'get_item']);
         if ($store_id != 0) {
            $users = $users->where('store_ids', $store_id);
         }
  
         $users = $users->get();

        return Datatables::of($users)
                ->addIndexColumn()
                ->editColumn('location', function(Offer $product){
                    $store_ids = explode(',', $product->store_ids);
                    $location = '';
                    foreach ($store_ids as $key => $store_id) {
                        $info = \App\Store::find($store_id);
                        $location .= $info->name. ', ';

                    }
                    return $location;
                })
                ->editColumn('unit', function(Offer $product){
                    return $product->unit->name;
                })
                ->editColumn('buy_product', function(Offer $product){
                    return $product->buy_item->name;
                })
                ->editColumn('buy_quantity', function(Offer $product){
                    $item_id = $product->buy_item->name;
                })
                ->editColumn('get_product', function(Offer $product){
                    return $product->get_item->name;
                })
                ->editColumn('get_quantity', function(Offer $product){
                    $item_id = $product->get_item->name;
                })
                ->editColumn('action', function(Offer $product){
                    return '<a href="/offer/'.$product->id.'/edit"><i class="far fa-edit"></i></a>
                        <a href="#" data-toggle="modal" onclick="deleteData('.$product->id.')"><i class="far fa-trash-alt"></i></a>';
                })
                ->make();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view($this->root . 'create');
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
            'date' => 'required',
            'code' => 'required',
            'reference' => 'required',
            'name' => 'required',
            'unit' => 'required',
            'price' => 'required',
            'location' => 'required',
            'product_to_buy' => 'required',
            'buy_quantity' => 'required',
            'product_to_get' => 'required',
            'get_quantity' => 'required',

        ]);
        $location_data = explode(',', $request->location);
        $offer = new Offer();
        $offer->date = $request->date;
        $offer->code = $request->code;
        $offer->reference = $request->reference;
        $offer->barcode = $request->barcode;
        $offer->name = $request->name;
        $offer->unit_id = $request->unit;
        $offer->price = $request->price;
        $offer->store_ids = implode(',',$location_data);
        $offer->buy_product_id = $request->product_to_buy;
        $offer->buy_quantity = $request->buy_quantity;
        $offer->get_product_id = $request->product_to_get;
        $offer->get_quantity = $request->get_quantity;
        $offer->note = $request->note;

        if($offer->save()){
            return redirect()->back()->with('success', 'Added Successfully!');
        }else{
            return redirect()->back()->with('error', 'Something Wrong!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function show(Offer $offer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function edit(Offer $offer)
    {
        $data = [
            'offer_info'=> $offer,
        ];
        return view($this->root . 'edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request);
        $request->validate([
            'date' => 'required',
            'code' => 'required',
            'reference' => 'required',
            'name' => 'required',
            'unit' => 'required',
            'price' => 'required',
            'location' => 'required',
            'product_to_buy' => 'required',
            'buy_quantity' => 'required',
            'product_to_get' => 'required',
            'get_quantity' => 'required',

        ]);
        $location_data = explode(',', $request->location);
        $offer = Offer::find($id);
        $offer->date = $request->date;
        $offer->code = $request->code;
        $offer->reference = $request->reference;
        $offer->barcode = $request->barcode;
        $offer->name = $request->name;
        $offer->unit_id = $request->unit;
        $offer->price = $request->price;
        $offer->store_ids = implode(',',$location_data);
        $offer->buy_product_id = $request->product_to_buy;
        $offer->buy_quantity = $request->buy_quantity;
        $offer->get_product_id = $request->product_to_get;
        $offer->get_quantity = $request->get_quantity;
        $offer->note = $request->note;

        if($offer->save()){
            return redirect()->back()->with('success', 'Added Successfully!');
        }else{
            return redirect()->back()->with('error', 'Something Wrong!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Offer $offer)
    {
        //
    }

    public function deleteOffer(Request $request){
        $product = Offer::find($request->id);
        if($product->delete()){
            return response()->json(['data'=>['msg'=>'delete success']]);
        }
    }
}
