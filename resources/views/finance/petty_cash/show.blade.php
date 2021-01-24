@extends("layouts.app")

@section("title", "Purchase Show")


@section("main_content")

        <main class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 mt-3 text-right">
                        <div class="btn-group" role="group" aria-label="Basic example">
                          <button type="button" class="btn btn-secondary">Edit</button>
                          <button type="button" class="btn btn-secondary">Print</button>
                          <button type="button" class="btn btn-secondary">Download</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5>Mohammed Akter Supermarket LLC</h5>
                                        <p>PO Box: 8603, Musaffah-44</p>
                                        <p>Tel: 02-5511402, Abu Dhabi</p>
                                        <p><b>TRN: 100523495800003</b></p>
                                    </div>
                                    <div class="col-md-2">
                                        <img src="" alt="logo">
                                    </div>
                                    <div class="col-md-4 text-right">
                                        <img src="https://5a135-0f-akt3r-9r0up.com/admin/misc/barcode/UlFTTjAxMDAwMjQ2/code128/74/0/1" alt="RQSN01000246" class="bcimg">
                                        <br>
                                        <p class="doc-no">*{{ $purchase->reference }}*</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="pt-3 pb-1 pl-2 pr-2">
                                            Supplier Details: <br>
                                            <address>
                                                <h5>{{ $purchase->vendor->name }} ({{ $purchase->vendor->code }})</h5>
                                                {{ $purchase->vendor->company }} <br>   
                                                {{ $purchase->vendor->address }} <br>
                                                Tel: {{ $purchase->vendor->phone }} <br>
                                                VAT Number: {{ $purchase->vendor->vat_no }}
                                            </address>
                                        </div>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <div class="pt-3 pb-1 pl-2 pr-2">
                                            Purchase Order <br>
                                            <address>
                                                <h5>Order No : {{ $purchase->reference }}</h5>
                                                Date: {{ $purchase->date }}<br>
                                                Order By : {! $purchase->user->name !}<br>
                                                Store Name : {{ $purchase->location->name }}
                                            </address>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <table class="simple-table">
                                            <thead>
                                                <th>Promised Ship Date</th>
                                                <th>Ship To</th>
                                                <th>Payment Terms</th>
                                                <th>Vendor Invoice No</th>
                                                <th>Payment Status</th>
                                            </thead>
                                            <tbody>
                                                <td>16/08/2020</td>
                                                <td>6016 - Aweer Fruits & Vegetables</td>
                                                <td>30 Days</td>
                                                <td>123456</td>
                                                <td>Unpaid</td>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <table class="table table-striped table-bordered" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Item name (Item code)</th>
                                                    <th>Last GRN Cost</th>
                                                    <th>AVG Cost</th>
                                                    <th>Final Cost</th>
                                                    <th>Quantity</th>
                                                    <th>Taxable Amount</th>
                                                    <th>Line Discount</th>
                                                    <th>Subtotal</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($purchase->purchase_items as $item)
                                                <tr>
                                                    <td>{{ $item->item->code }} - {{ $item->item->name }}</td>
                                                    <td>{{ $item->item->prices->last_grn_cost }}</td>
                                                    <td>{{ $item->item->prices->avg_cost }}</td>
                                                    <td>{{ $item->item->prices->final_cost }}</td>
                                                    <td>{{ $item->quantity }}</td>
                                                    <td>{{ $item->item->prices->final_price }}</td>
                                                    <td>{{ $item->discount }}</td>
                                                    <td>{{ ($item->quantity * $item->item->final_cost) - ((($item->quantity * $item->item->final_cost) * $item->discount)/100) }}</td>
                                                </tr>
                                                @endforeach
                                                
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="6" style="text-align:right; padding-right:10px;">Total
                                                    </td>
                                                    <td colspan="2" style="text-align:right; padding-right:10px;">150.00 AED</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="6" style="text-align:right; padding-right:10px; font-weight:bold;">(-) Line Discount
                                                    </td>
                                                    <td colspan="2" style="text-align:right; padding-right:10px;">6.00 AED</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="6" style="text-align:right; padding-right:10px; font-weight:bold;">(-) Total Discount
                                                    </td>
                                                    <td colspan="2" style="text-align:right; padding-right:10px;">0.00 AED
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="6" style="text-align:right; padding-right:10px; font-weight:bold;">(=) 
                                                    </td>
                                                    <td colspan="2" style="text-align:right; padding-right:10px;">144.00 AED
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="6" style="text-align:right; padding-right:10px; font-weight:bold;">(+) Total Taxable Amount
                                                    </td>
                                                    <td colspan="2" style="text-align:right; padding-right:10px;">7.5 AED
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="6" style="text-align:right; padding-right:10px; font-weight:bold;">(=) Net Amount
                                                    </td>
                                                    <td colspan="2" style="text-align:right; padding-right:10px; font-weight:bold;">151.50 AED
                                                    </td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="card bg-light pt-3 pb-1 pl-2 pr-2">
                                                    <h4>Terms & Conditions</h4>
                                                    <p>
                                                        1. LPO Copy to be enclosed along with invoice. <br>
                                                        2. All goods delivered must exactly be as described in the purchase order. <br>
                                                        3. Cash/Cheque will not be released without receiving an official company receipt.
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="card bg-light text-right pt-3 pb-1 pl-2 pr-2">
                                                    <p>Created By: Rakim Khan<br>
                                                    Date: 08/08/2020 12:12
                                                    </p>
                                                    <p>Updated By: Rakim Khan<br>
                                                    Date: 09/08/2020 04:56
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">                    
                                                <p class="bold">NOTE: For smooth payment please submit your monthly statement. Email:- fna@aktergroup.ae; arobin@aktergroup.ae</p>
                                            </div>
                                        </div>
                                        <div class="row mt-5">
                                            <div class="col-4">
                                                <span>______________________</span><br>
                                                <span class="bold">Created By</span>
                                            </div>
                                            <div class="col-4 text-center">
                                                <span>______________________</span><br>
                                                <span class="bold">Checked By</span>
                                            </div>
                                            <div class="col-4 text-right">
                                                <span>______________________</span><br>
                                                <span class="bold">Received By</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
      
@endsection


@push("js_script")

@endpush
