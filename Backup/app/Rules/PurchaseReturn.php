<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class PurchaseReturn implements Rule
{

    public $location;
    public $vendor;
    public $items;
    private $message=null;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($location, $vendor, $items)
    {
        $this->location = $location;
        $this->vendor = $vendor;
        $this->items = $items;

    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {

        $result = 1;
        $item_ids = array_column($this->items, 'id');
        //dd($this->items);

        $stocks = DB::table('stock_balances')
        ->select(['item_id','balance_quantity'])
        ->where('location_id',$this->location)
        ->whereIn('item_id',$item_ids)
        ->pluck('balance_quantity','item_id')->toArray();

        $vendor_stocks = DB::table('vendor_stock_balances')
        ->select(['item_id','balance_quantity'])
        ->where('vendor_id',$this->vendor)
        ->whereIn('item_id',$item_ids)
        ->pluck('balance_quantity','item_id')->toArray();
        //dd($stocks);
        
        foreach($this->items as $item){

            if( ! isset($stocks[(int)$item['id']]) ){
                $result = 0;
                $this->message.="Item: ".$item['id']." is not available for, location:".$this->location."<br/>";

            }else if( ! isset($vendor_stocks[(int)$item['id']]) ){
                $result = 0;
                $this->message.="Item: ".$item['id']." is not available for, vendor:".$this->vendor."<br/>";

            }
            else{

                if( 
                    
                    ((int)$item['quantity'] > $stocks[(int)$item['id']] )
                    &&
                    ((int)$item['quantity'] > $vendor_stocks[(int)$item['id']] ) 

                ){
                    $result = 0;
                    $this->message.="Item:".$item['id']." is not available for, quantity:".$item['quantity']."<br/>";    
                }else{
                    $result = 1;
                }
            }            
        }

        //dd($result);

        return $result;
    }



    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->message;
    }
}
