<?php

namespace App\Console\Commands;
use Helpers;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class StockInOutOperation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'operation:stockinout {stock_info*}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Stock In Out Operation using artisan';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        //print_r(json_decode($this->argument('data')));

        /*$data = array(
            array(1,1,2,10,1),
            array(1,2,1,9,1)
        );*/
        $alldata = $this->argument('stock_info');

        $data = $alldata['item_location'];

        $vendor_data = $alldata['item_vendor'];

        //var_dump($data);
        //return 0;

        $result=0;
        $msg = "!Transaction Failed!";

        DB::beginTransaction();
        try{

            $perfect = 0;
            foreach ($data as $value) {                
                
                $perfect = Helpers::StockInOut($value);
                //echo "perfect:".$perfect;
                if($perfect < 1) {
                    $result = 0;
                    $msg = "!!Item No Available!!";
                    break;
                }
            }

            if( isset($vendor_data) && !empty($vendor_data)){

                foreach ($vendor_data as $value) {                
                
                    $perfect = Helpers::StockInOutVendor($value);
                    //echo "perfect:".$perfect;
                    if($perfect < 1) {
                        $result = 0;
                        $msg = "!!Item No Available!!";
                        break;
                    }
                }
            }
        
            if($perfect > 0) {
                DB::commit();
                $result = 1;
                $msg = "*Transaction Complete*";
            }else{
                DB::rollBack();    
            }
            
        }catch(Exception $e){
            DB::rollBack();
            $result = 0;
            $msg = "!Transaction Failed!";        
        }

        //echo $result."=".$msg;
        //Helpers::StockInOut(1,1,2,4,1);
        //Helpers::StockInOut(1,2,2,2,1);
        echo json_encode(['result'=>$result, 'msg'=>$msg], true);
    }
}
