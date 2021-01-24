<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Requisition;
use DataTables;
// use Yajra\DataTables\Html\Builder;
use App\Store;

class RequisitionController extends Controller
{
    public function summary(){
    	return view('requisition/summary');
    }
    
    public function requisitionSummeryData(Request $request){
       $pagination = $request->pagination;
       $requisition_type = $request->requisition_type;
       $page = $pagination['current'];
       $limit = $pagination['limit'];
       $offset = ($page -1) * $limit;

        $requisition = Requisition::with(['requisition_items', 'requisition_items.item'])->groupBy('requisition_to')->get();
        $requisitionItems = \App\RequisitionWiseItem::with(['requistion', 'item']);
        if($requisition_type != ''){
            $requisitionItems = $requisitionItems->whereHas('requistion', function($query)use($requisition_type){
                 $query->where('type', $requisition_type);
            });
        }
        $requisitionItems = $requisitionItems->groupBy('item_id')->offset($offset)->limit($limit)->get();
        $total_data = \App\RequisitionWiseItem::groupBy('item_id')->get()->toArray();
        $total = count($total_data);
        $stores = Store::all();
        $columns = ['Item'];
        foreach ($stores as $key => $value) {
            array_push($columns, $value->code);
        }
        array_push($columns, 'Total');
        $requisition_summary = [];
        foreach ($requisitionItems as $key=>$item) {
            $new_arr = [];
               $total = 0;
            $new_arr[] = $item->item->name;
            foreach ($stores as $k => $store) {
 
                $store_id = $store->id;
                $store_wise_quantity = \App\RequisitionWiseItem::where('item_id', $item->item_id)->whereHas('requistion', function($query)use($store_id){
                    return $query->where('requisition_to', '=',$store_id);
                })->sum('quantity');
               $new_arr[] = (int)$store_wise_quantity;
               $total += (int)$store_wise_quantity;
            }
            $new_arr[] = $total;
            array_push($requisition_summary, $new_arr);
        }

        $data = [
            'columns' => $columns,
            'summary' => $requisition_summary,
            'total' => $total,
            'next' => $page + 1,
            'prev' => $page -1,
        ];

        return response()->json($data);
        
        
    }

    public function requstionItemsById(Request $request){
    	$id = $request->id;

    	$requisition = Requisition::with(['requisition_items', 'requisition_items.item', 'requisition_items.item.prices'])->where('id', $id)->first();
			foreach ($requisition->requisition_items as $key => $value) {
				$requisition->requisition_items[$key]->item->stock = 0;
				$requisition->requisition_items[$key]->item->last_7_day_sale = 0;
				$requisition->requisition_items[$key]->item->last_30_day_sale = 0;
			}
    	return response()->json($requisition);
    }

    public function show($id){
        $requisition = Requisition::with(['requisition_from_location', 'requisition_to_location', 'requisition_items', 'requisition_items.item'])->where('id', $id)->first();
        $data = [
            'requisition' => $requisition,
        ];

        return view('requisition.show', $data);
    }
}
