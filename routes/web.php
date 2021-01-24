<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
     return redirect()->route('dashboard');
});

Route::get('/clear', function() {

   Artisan::call('cache:clear');
   Artisan::call('config:clear');
   Artisan::call('config:cache');
   Artisan::call('view:clear');

   return "Cleared!";

});

Route::get('/testing', function(){
	//dd(Helpers::getProductPrice(3,4));
	/*
	$data=[
     [1,1,1,7,1],
     [1,2,1,2,1]
    ];
    Helpers::callStockInOut($data);
    */
    //var_dump(Helpers::stockTotalItems(3,2));

});
   
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware'=>'auth'], function(){


Route::get('dashboard', 'DashboardController@index')->name('dashboard');

	// Settings - department
	Route::resource('department', 'DepartmentController');
	Route::get('department_list', 'DepartmentController@departmentList')->name('department_list');
	Route::post('department_detail', 'DepartmentController@departmentDetail')->name('department.detail');
	Route::post('department/deletedata', 'DepartmentController@deleteData')->name('department.deletedata');

	// Settings - unit
	Route::resource('unit', 'UnitController');
	Route::get('unit_list', 'UnitController@unitList')->name('unit_list');
	Route::post('unit_detail', 'UnitController@unitDetail')->name('unit.detail');
	Route::post('unit/deletedata', 'UnitController@deleteData')->name('unit.deletedata');

	// Settings - store
	Route::resource('stores', 'StoreController');
	Route::get('store_list', 'StoreController@storeList')->name('store_list');
	Route::post('store_detail', 'StoreController@storeDetail')->name('store.detail');
	Route::post('store/deletedata', 'StoreController@deleteData')->name('store.deletedata');

	// Settings - category
	Route::resource('category', 'CategoryController');
	Route::get('category_list', 'CategoryController@categoryList')->name('category_list');
	Route::post('category_detail', 'CategoryController@categoryDetail')->name('category.detail');
	Route::post('category/deletedata', 'CategoryController@deleteData')->name('category.deletedata');

	// Settings - vendor
	Route::resource('vendors', 'VendorController');
	Route::get('vendors_list', 'VendorController@vendorList')->name('vendors_list');
	Route::post('vendors_detail', 'VendorController@vendorDetail')->name('vendors.detail');
	Route::post('vendors/deletedata', 'VendorController@deleteData')->name('vendors.deletedata');


	// Settings - tax
	Route::resource('tax', 'TaxController');


// Inventory

	Route::resource('items', 'ProductController'); //Standard
	Route::get('item/list', 'ProductController@itemListDatatableData')->name('item_list');
	Route::get('item/price/edit', 'ProductController@priceEdit')->name('item.price.edit');
	Route::get('item/price_update/history', 'ProductController@priceUpdateHistoyIndex')->name('item.price.update.history');
	Route::get('item/price_update/{id}/edit', 'ProductController@priceUpdateHsitoryEdit')->name('item.price.update.history.edit');
	Route::post('item/price_update/{id}', 'ProductController@priceUpdateHsitoryUpdate')->name('item.price.update.history.update');
	Route::post('price/update/history/delete', 'ProductController@priceUpdateHsitoryDelete')->name('price.update.history.delete');

	Route::get('item/price_update/history/datatableData', 'ProductController@priceUpdateHistoyDatatableData')->name('price_update_history_list');
	Route::post('item/price/update', 'ProductController@priceUpdate')->name('item.price.update');
	Route::post('item/delete','ProductController@itemDelete')->name('item.delete');
	Route::get('item/detail', 'ProductController@itemDetailIndex')->name('item.detail');

	// Promotional product
	Route::get('item/promotion/index', 'PromotionalProductController@index')->name('item.promotion.index');
	Route::get('item/promotion/create', 'PromotionalProductController@create')->name('item.promotion.create');
	Route::post('item/promotion/store', 'PromotionalProductController@store')->name('item.promotion.store');
	Route::get('item/promotion/{id}/edit', 'PromotionalProductController@edit')->name('item.promotion.edit');
	Route::post('item/promotion/{id}', 'PromotionalProductController@update')->name('item.promotion.update');
	Route::post('item/promotion/delete/destroy', 'PromotionalProductController@deleteData')->name('item_promotion_delete');

	Route::get('item/promotion/list', 'PromotionalProductController@itemListDatatableData')->name('promotional_item_list');

	// Offer
	Route::resource('offer', 'OfferController');
	Route::get('offer/list/data', 'OfferController@offerListDatatableData')->name('offer.list.data');
	Route::post('item_offer_delete', 'OfferController@deleteOffer')->name('item_offer_delete');
	Route::resource('combo', 'ComboController');//combo
	Route::resource('repacking', 'RepackingController');//combo


	// Adjustment
	Route::resource('adjustment', 'AdjustmentController');
	Route::get('adjustments/list/data', 'AdjustmentController@adjustmentListDatatableData')->name('adjustments.list.data');
	Route::post('adjustments/delete','AdjustmentController@adjustmentDelete')->name('adjustment.delete');

	//  
	Route::resource('damage', 'DamageController');
	Route::get('damages/list/data', 'DamageController@damageListDatatableData')->name('damages.list.data');
	Route::post('damages/delete','DamageController@damageDelete')->name('damage.delete');

	// Item anatomy
	Route::get('item/anatomy/index', 'ProductController@itemAnatomyIndex')->name('item.anatomy.index');
	Route::get('item/anatomy/datatable/data', 'ProductController@itemAnatomoyDatatableData')->name('item.anatomy.datatabledata');

	
// Stock Calculation
	Route::resource('stock_calculation', 'StockCalculationController');
	Route::get('zone/count/list/data', 'StockCalculationController@zoneCountListData')->name('zone_count.list.data');
	Route::post('damage/from/zone/history', 'StockCalculationController@makeDamange')->name('make_damage');
	Route::post('adjustment/from/zone/history', 'StockCalculationController@makeAdjustment')->name('make_adjustment');


// Inventory End

Route::resource('vegetable_requisition', 'VegetableRequisitionController');
Route::get('vegetable_requisition_list', 'VegetableRequisitionController@VegetableRequisitionTableData')->name('vegetable_requisition_list');



Route::resource('dc_requisition', 'DCRequisitionController');
Route::get('dc_requisition_list', 'DCRequisitionController@dcRequisitionTableData')->name('dc_requisition_list');


Route::resource('dsd_requisition', 'DSDRequisitionController');
Route::get('dsd_requisition_list', 'DSDRequisitionController@dsdRequisitionTableData')->name('dsd_requisition_list');


Route::get('requisition/summery', 'RequisitionController@summary')->name('requisition_summery');
Route::post('requisition/summery/data', 'RequisitionController@requisitionSummeryData')->name('requisition_summery_data');
Route::get('requisition/show/{id}', 'RequisitionController@show')->name('requisition_show');


// Purchase
Route::resource('purchase', 'PurchaseController');
Route::get('purchase_order_list', 'PurchaseController@purchaseOrderTableData')->name('purchase_order_list');

// Purchase
Route::resource('transfer', 'TransferController');
Route::get('transfer_order_list', 'TransferController@transferOrderTableData')->name('transfer_order_list');

Route::resource('cash_purchase', 'CashPurchaseController');
Route::get('cash_purchase_data', 'CashPurchaseController@cashPurchaseTableData')->name('cash_purchase_data');

// Receive

Route::resource('lpo_receive', 'LPOReceiveController');
Route::get('lpo_receive_data', 'LPOReceiveController@lpoReceiveDatatableData')->name('lpo_receive_data');
Route::post('lpo_mark_as_paid','LPOReceiveController@markAsPaid')->name('lpo_mark_as_paid');
Route::post('lpo_mark_as_unpaid','LPOReceiveController@markAsUnPaid')->name('lpo_mark_as_unpaid');

Route::resource('tnt_receive', 'TNTReceiveController');
Route::get('tnt_receive_data', 'TNTReceiveController@tntReceiveDatatableData')->name('tnt_receive_data');

// Return 

Route::resource('purchase_return', 'PurchaseReturnController');
Route::get('purchase_return_list', 'PurchaseReturnController@purchaseReturnData')->name('purchase_return_list');


Route::resource('transfer_return', 'TransferReturnController');
Route::get('transfer_return_list', 'TransferReturnController@transferReturnData')->name('transfer_return_list');
// Acounts

Route::get('unpaid_grn', 'AccountController@unpaidGrn')->name('unpaid_grn');
Route::get('unpaid_grn_data', 'AccountController@unpadiGrnData')->name('unpaid_grn_data');
Route::get('paid_grn_data', 'AccountController@padiGrnData')->name('paid_grn_data');

Route::get('paid_grn', 'AccountController@paidGrn')->name('paid_grn');
Route::get('vendor_trasaction', 'AccountController@vendorTransaction')->name('vendor_trasaction');
Route::get('vendor_transaction_view', 'AccountController@vendorTransactionView')->name('vendor_transaction_view');
Route::post('vendor__payment_voucher', 'AccountController@vendorPaymentVoucher')->name('vendor__payment_voucher');
Route::get('payment_voucher', 'AccountController@paymentVoucher')->name('payment_voucher');
Route::get('payment_voucher_list', 'AccountController@paymentVoucherShow')->name('payment_voucher_list');
Route::get('payment_summary', 'AccountController@paymentSummary')->name('payment_summary');
Route::get('payment_advanced', 'AccountController@paymentAdvanced')->name('payment_advanced');
Route::get('payment_advanced_view', 'AccountController@paymentAdvancedView')->name('payment_advanced_view');
Route::post('payment_advanced', 'AccountController@paymentAdvancedStore')->name('payment_advanced.store');

Route::post('other_debit', 'AccountController@otherDebit')->name('other_debit');
Route::post('other_credit', 'AccountController@otherCredit')->name('other_credit');
Route::get('/vendorAdvancedAmount/{id}', 'AccountController@vendorAdvancedAmount');
Route::post('advPayment', 'AccountController@advPayment')->name('advPayment');
Route::post('payment_method', 'AccountController@paymentMethod')->name('payment_method');

// Finance

Route::resource('ledger', 'LedgerController');
Route::get('ledger_list', 'LedgerController@ledgerList')->name('ledger_list');
Route::post('ledger_detail', 'LedgerController@ledgerDetail')->name('ledger.detail');
Route::post('ledger/deletedata', 'LedgerController@deleteData')->name('ledger.deletedata');

Route::resource('subledger', 'SubLedgerController');
Route::get('subledger_list', 'SubLedgerController@subLedgerList')->name('subledger_list');
Route::post('subledger_detail', 'SubLedgerController@subLedgerDetail')->name('subledger.detail');
Route::post('subledger/deletedata', 'SubLedgerController@deleteData')->name('subledger.deletedata');

Route::resource('ledger_entry', 'LedgerEntryController');
Route::get('transaction_list', 'LedgerEntryController@transactionTableData')->name('transaction_list');

Route::resource('audit_hand_over', 'AuditHandOverController');
Route::get('audit_hand_over_data', 'AuditHandOverController@auditHandOver')->name('audit_hand_over_data');
Route::resource('daily_cash_closing', 'CashClosingController');
Route::get('daily_cash_closing_data', 'CashClosingController@cashClosing')->name('daily_cash_closing_data');

Route::resource('petty_cash', 'PettyCashController');
Route::get('petty_cash_manage', 'PettyCashController@pettyCashData')->name('petty_cash_manage');

Route::get('daily_cash_flow', 'FinanceController@dailyCashFlow')->name('daily_cash_flow');
Route::get('daily_cash_flow_data', 'FinanceController@dailyCashFlowData')->name('daily_cash_flow_data');
Route::get('daily_bank_flow', 'FinanceController@dailyBankFlow')->name('daily_bank_flow');
Route::get('daily_bank_flow_data', 'FinanceController@dailyBankFlowData')->name('daily_bank_flow_data');

Route::get('monthly_cash_flow', 'FinanceController@monthlyCashFlow')->name('monthly_cash_flow');
Route::get('monthly_cash_flow_data', 'FinanceController@monthlyCashFlowData')->name('monthly_cash_flow_data');
Route::get('monthly_bank_flow', 'FinanceController@monthlyBankFlow')->name('monthly_bank_flow');
Route::get('monthly_bank_flow_data', 'FinanceController@monthlyBankFlowData')->name('monthly_bank_flow_data');

Route::get('balance_sheet', 'FinanceController@balanceSheet')->name('balance_sheet');
Route::get('balance_sheet_data', 'FinanceController@balanceSheetData')->name('balance_sheet_data');
Route::get('trial_balance', 'FinanceController@trialBalance')->name('trial_balance');
Route::get('trial_balance_data', 'FinanceController@trialBalanceData')->name('trial_balance_data');
Route::get('pnl_report', 'FinanceController@pnlReport')->name('pnl_report');
Route::get('pnl_report_data', 'FinanceController@pnlReportData')->name('pnl_report_data');

// VAT Return
// Route::get('vat_return', 'FinanceController@vatReturn')->name('vat_return');
// Route::get('vat_return_data', 'FinanceController@vatReturnData')->name('vat_return_data');
Route::get('vat_return/index', 'FinanceController@vatReturnIndex')->name('vat_return.index');

// Reports
Route::get('vendor_analysis', 'VendorAnalysisController@vendorAnalysis')->name('vendor_analysis');
Route::get('vendor_analysis_data', 'VendorAnalysisController@vendorAnalysisData')->name('vendor_analysis_data');

// POS
Route::get('pos', 'Version2Controller@pos')->name('pos');
Route::get('warehouse', 'Version2Controller@warehouse')->name('warehouse');
Route::get('shelfbar', 'Version2Controller@shelfbar')->name('shelfbar');
Route::get('pdtscan', 'Version2Controller@pdtscan')->name('pdtscan');
Route::post('customerPayment', 'Version2Controller@customerPayment')->name('customerPayment');

});




// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
