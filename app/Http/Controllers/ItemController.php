<?php

namespace App\Http\Controllers;

use App\Item;
use App\ProductPricing;
use Helpers;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function itemDataForSelectBox(Request $request){
        $search = $request->search;
        $barproduct = Item::with(['prices'])->where('barcode', $search)->first();

        if(!empty($barproduct)){
            $data  = [
                'product_info' => $barproduct,
                'status' => 1
            ];
            return response()->json($data);

        }else{
                $products = Item::where('name', 'LIKE' , '%'.$search.'%')->limit(10)->orderBy('id', 'desc')->get();
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

    public function itemInfoById(Request $request){
        //return response()->json($request->all());
        $location_id = isset($request->location_id)?$request->location_id:'';
        // $info = Item::with(['prices','product_wise_vendor'])->where('code',$request->id)->first();
        $info = ProductPricing::with('productPricing', 'unitPrice', 'costs')
                  ->where('barcode', $request->id)->first();
        $stock = 0;
        if($location_id != ''){
            $stock = Helpers::currentStockLocationWise($info->product_id, $location_id);
            $info['updated_price'] = Helpers::getProductPrice($info->product_id, $location_id);
        }else{
            $upd['markup'] = $info->markup;
            $upd['price'] = $info->final_price;
            $upd['cost'] = $info->final_cost;
            $info->updated_price = $upd;
        }
        $info['stock'] = $stock;
        $info['last_7_day_sale'] = 0;
        $info['last_30_day_sale'] = 0;
        return response()->json($info);
    }

    public function itemInfoByIdWithAll(Request $request){
        $location_id = isset($request->location_id)?$request->location_id:'';
        $info = Item::with(['prices','product_wise_vendor'])->where('barcode',$request->id)->first();
        $stock = 0;
        if($location_id != 0){
            $stock = Helpers::currentStockLocationWise($info->id, $location_id);
            $info['updated_price'] = Helpers::getProductPrice($info->id, $location_id);
        }else{
            $upd['markup'] = $info->prices->markup;
            $upd['price'] = $info->prices->final_price;
            $upd['cost'] = $info->prices->final_cost;
            $info->updated_price = $upd;
        }

        $info['stock'] = $stock;
        $info['last_7_day_sale'] = 0;
        $info['last_30_day_sale'] = 0;
        return response()->json($info);
    }
}
