<?php 

use App\Product;
use App\Damage;
use App\Adjustment;
use App\PriceUpdateHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
/**
 * Helper functions that need globally
 */
class Helpers
{
	
	function __construct()
	{
		# code...
	}

	public static function currentStock($item_id){

    /*
		$product = Product::with(['prices', 'purchase_items', 'purchase_return_items'])->where('id', $item_id)->first();
    $damage = Damage::where('item_id', $item_id)->sum('quantity');
    $adjustment = Adjustment::where('item_id', $item_id)->sum('quantity');

          $purchase_items =  $product->purchase_items;
          $purchase_quantity = 0;
          $total = 0;
          foreach($purchase_items as $item){
              $purchase_quantity += $item->quantity;
          }

          $purchase_return_items =  $product->purchase_return_items;
          $purchase_return_quantity = 0;
          foreach($purchase_return_items as $item){
              $purchase_return_quantity += $item->quantity;
          }

          $total = $purchase_quantity - $purchase_return_quantity;
          $total = $total - $damage;
          $total = $total + $adjustment;
          return $total;
    */
          return self::stockTotalItems($item_id);
	} 
  public static function currentStockLocationWise($item_id, $location){
    /*
    $product = Product::with(['prices', 'purchase_items'=>function($query)use($location){

        $query->where('location_id','=', $location);

    }, 'purchase_return_items'=>function($query)use($location){

        $query->where('location_id','=', $location);

    }])->where('id', $item_id)->first();
    $damage = Damage::where('location', $location)->where('item_id', $item_id)->sum('quantity');
    $adjustment = Adjustment::where('location', $location)->where('item_id', $item_id)->sum('quantity');
          $purchase_item_list =  $product->purchase_items;
          $purchase_quantity = 0;
          $total = 0;
          foreach($purchase_item_list as $item){
              $purchase_quantity += $item->quantity;
          }

          $purchase_return_item_list =  $product->purchase_return_items;
          $purchase_return_quantity = 0;
          foreach($purchase_return_item_list as $item){
              $purchase_return_quantity += $item->quantity;
          }

          $total = $purchase_quantity - $purchase_return_quantity;
          $total = $total - $damage;
          $total = $total + $adjustment;

          return $total;
          */
          return self::stockTotalItems($item_id, $location);
  } 

  public static function purchaseGrandTotal($purchase_id){
    $purchaseItems = App\PurchaseOrderWiseItem::with(['item', 'item.prices'])->where('purchase_id', $purchase_id)->get();
    $total = 0;
    $tax = 0;
    $tax_data = App\Tax::first();
    if($tax_data != null){
      $tax = $tax_data->amount;
    }
    foreach ($purchaseItems as $item) {
      $sub = 0;
        $sub = ($item->cost * $item->quantity);
        $sub = $sub - ($sub * $item->discount)/100;
        $sub = $sub + ($sub * $tax)/100;
        $total += $sub;
    }
    return number_format($total, 2);
  }


  public static function purchaseGrandTotalLocationWise($purchase_id, $location){
    $purchaseItems = App\PurchaseOrderWiseItem::with(['item', 'item.prices'])->where('purchase_id', $purchase_id)->where('location_id', $location)->get();
    $total = 0;
    $tax = 0;
    $tax_data = App\Tax::first();
    if($tax_data != null){
      $tax = $tax_data->amount;
    }

    $tax = $tax_data->amount;
    foreach ($purchaseItems as $item) {
      $sub = 0;
        $sub = ($item->cost * $item->quantity);
        $sub = $sub - ($sub * $item->discount)/100;
        $sub = $sub + ($sub * $tax)/100;
        $total += $sub;
    }
    return number_format($total, 2);
  }


  public static function getProductPrice($item_id, $location){
            $prevous_price = \App\PriceUpdateHistory::where('item_id', $item_id)->where('store_id', $location)->orderBy('id', 'DESC')->first();
            if(!empty($prevous_price)){
                $price = $prevous_price->updated_price;
                $cost = $prevous_price->prev_cost;
                $markup = $prevous_price->updated_markup;
            }else{
                $product = Product::with(['prices'])->where('id', $item_id)->first();

                $price = $product->prices->final_price;
                $cost = $product->prices->final_cost;
                $markup = $product->prices->markup;
            }
            $data = [
              'price' => $price,
              'cost' => $cost,
              'markup' => $markup
            ];
      return $data;
  }


  public static function generateReference($table_name, $ref_code){
    $lastData = DB::table($table_name)->orderBy('id', 'DESC')->first();
    if(!empty($lastData->reference_no)){
      $ref = $lastData->reference_no;
      $field = 'reference_no';
    }else{
          $ref = $lastData->reference;
          $field = 'reference';
    }
  $config = [
      'table' => $table_name,
      'length' => 9,
      'prefix' => $ref_code,
      'field' => $field
  ];

    $new_ref = self::generate($config);

    return $new_ref;
    
  }



  // generator
    private function getFieldType($table, $field)
    {
        $colsType = DB::select('describe ' . $table);
        $fieldType = null;
        foreach ($colsType as $col) {
            if ($field == $col->Field) {
                $fieldType = $col->Type;
                break;
            }
        }

        if ($fieldType == null) throw new Exception("$field not found in $table table");
        return $fieldType;
    }

    public static function generate($configArr)
    {
        if (!array_key_exists('table', $configArr) || $configArr['table'] == '') {
            throw new Exception('Must need a table name');
        }
        if (!array_key_exists('length', $configArr) || $configArr['length'] == '') {
            throw new Exception('Must specify the length of ID');
        }
        if (!array_key_exists('prefix', $configArr) || $configArr['prefix'] == '') {
            throw new Exception('Must specify a prefix of your ID');
        }

        if (array_key_exists('where', $configArr)) {
            if (is_string($configArr['where']))
                throw new Exception('where clause must be an array, you provided string');
            if (!count($configArr['where']))
                throw new Exception('where clause must need at least an array');
        }

        $table = $configArr['table'];
        $field = array_key_exists('field', $configArr) ? $configArr['field'] : 'id';
        $prefix = $configArr['prefix'];
        $resetOnPrefixChange = array_key_exists('reset_on_prefix_change', $configArr) ? $configArr['reset_on_prefix_change'] : false;
        $length = $configArr['length'];

        $fieldType = (new self)->getFieldType($table, $field);
        preg_match("/^([\w\-]+)/", $fieldType, $type);
        $tableFieldType = $type[0];
        preg_match("/(?<=\().+?(?=\))/", $fieldType, $tblFieldLength);
        $tableFieldLength = $tblFieldLength[0];

        if (in_array($tableFieldType, ['int', 'bigint', 'numeric']) && !is_numeric($prefix)) {
            throw new Exception("table field type is $tableFieldType but prefix is string");
        }

        if ($length > $tableFieldLength) {
            throw new Exception('ID length is bigger then field length');
        }

        $prefixLength = strlen($configArr['prefix']);
        $idLength = $length - $prefixLength;
        $whereString = '';

        if (array_key_exists('where', $configArr)) {
            $whereString .= " WHERE ";
            foreach ($configArr['where'] as $row) {
                $whereString .= $row[0] . "=" . $row[1] . " AND ";
            }
        }
        $whereString = rtrim($whereString, 'AND ');


        $totalQuery = sprintf("SELECT count(%s) total FROM %s %s", $field, $configArr['table'], $whereString);
        $total = DB::select($totalQuery);

        if ($total[0]->total) {
            if ($resetOnPrefixChange) {
                $maxQuery = sprintf("SELECT MAX(%s) maxId from %s WHERE %s like %s", $field, $table, $field, "'" . $prefix . "%'");
            } else {
                $maxQuery = sprintf("SELECT MAX(%s) maxId from %s", $field, $table);
            }

            $queryResult = DB::select($maxQuery);
            $maxFullId = $queryResult[0]->maxId;

            $maxId = substr($maxFullId, $prefixLength, $idLength);
            return $prefix . str_pad($maxId + 1, $idLength, '0', STR_PAD_LEFT);

        } else {
            return $prefix . str_pad(1, $idLength, '0', STR_PAD_LEFT);
        }
    }

    //stock and stock balance in out
    public static function StockInOut($data){

            //first check balaance from stock_balance table
            $item = $data[0];
            $location = $data[1];
            $optype = $data[2];
            $quantity = $data[3];
            $ep = isset($data[4])?$data[4]:null;

            $stock_balance = DB::table('stock_balances')
            ->select('balance_quantity')
            ->where(['item_id'=>$item,'location_id'=>$location])
            ->first();

            $balance = isset($stock_balance)?$stock_balance->balance_quantity:0;

            if(($balance-$quantity) < 0 && $optype == 2){
                return 0;
            }else{
                
                $balance = $optype == 1 ? $balance+$quantity : $balance - $quantity;  
                
               

                    DB::table('stocks')->insert([
                        'item_id'=>$item,
                        'location_id'=>$location,
                        'quantity'=>$quantity,
                        'op_type'=>$optype,
                        'e_p'=>$ep,
                        'user_id'=>\Auth::id(),
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ]);
                    if(isset($stock_balance)){                  
                        DB::table('stock_balances')
                        ->where(['item_id'=>$item,'location_id'=>$location])
                        ->update([
                            'balance_quantity' => $balance,
                            'op_type'=>$optype,
                            'updated_at' => Carbon::now(),
                        ]);

                    }else{
                        DB::table('stock_balances')->insert([
                            'item_id'=>$item,
                            'location_id'=>$location,
                            'balance_quantity'=>$balance,
                            'op_type'=>$optype,
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now(),
                        ]);
                    }

                    
                    return 1;
          }
    }


    //stock and stock balance in out
    public static function StockInOutVendor($data){

            //first check balaance from stock_balance table
            $item = $data[0];
            $location = $data[1];
            $optype = $data[2];
            $quantity = $data[3];
            $ep = isset($data[4])?$data[4]:null;

            $stock_balance = DB::table('vendor_stock_balances')
            ->select('balance_quantity')
            ->where(['item_id'=>$item,'vendor_id'=>$location])
            ->first();

            $balance = isset($stock_balance)?$stock_balance->balance_quantity:0;

            if(($balance-$quantity) < 0 && $optype == 2){
                return 0;
            }else{
                
                $balance = $optype == 1 ? $balance+$quantity : $balance - $quantity;  
                
               

                    DB::table('vendor_stocks')->insert([
                        'item_id'=>$item,
                        'vendor_id'=>$location,
                        'quantity'=>$quantity,
                        'op_type'=>$optype,
                        'e_p'=>$ep,
                        'user_id'=>\Auth::id(),
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ]);
                    if(isset($stock_balance)){                  
                        DB::table('vendor_stock_balances')
                        ->where(['item_id'=>$item,'vendor_id'=>$location])
                        ->update([
                            'balance_quantity' => $balance,
                            'op_type'=>$optype,
                            'updated_at' => Carbon::now(),
                        ]);

                    }else{
                        DB::table('vendor_stock_balances')->insert([
                            'item_id'=>$item,
                            'vendor_id'=>$location,
                            'balance_quantity'=>$balance,
                            'op_type'=>$optype,
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now(),
                        ]);
                    }

                    
                    return 1;
          }
    }

    public static function stockTotalItems($item_id, $location_id=null){
      
      $query = isset($location_id)? 
      "SELECT sum(balance_quantity) as total from stock_balances group by item_id,location_id having item_id = ? and location_id = ?" :
      "SELECT sum(balance_quantity) as total from stock_balances group by item_id having item_id = ?";
      $result = DB::select($query, isset($location_id)?[$item_id, $location_id]:[$item_id]);
      return isset($result[0])?$result[0]->total:0;

    }

    public static function callStockInOut($data, $vendor_data=null){
      \ob_start();
      $alldata = ['item_location'=>$data, 'item_vendor'=>$vendor_data];
      \Artisan::call('operation:stockinout',['stock_info'=>$alldata]);
      $output = \ob_get_clean();
      //file_put_contents('data.txt', $output);
      return json_decode($output,true);      

    }

}

