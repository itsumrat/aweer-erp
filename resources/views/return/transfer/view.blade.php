@extends("layouts.app")

@section("title", "Aweer Inventory - Department")


@section("content")
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
                                        <p class="doc-no">*RTRN12345678*</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="pt-3 pb-1 pl-2 pr-2">
                                            Return To: <br>
                                            <address>
                                                <h5>6016 - Aweer Fruits & Vegetables</h5>
                                                Aweer, Dubai, UAE
                                            </address>
                                        </div>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <div class="pt-3 pb-1 pl-2 pr-2">
                                            Return From <br>
                                            <address>
                                                <h5>2101 - Electra</h5>
                                                Abu Dhabi, UAE
                                            </address>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <table class="simple-table">
                                            <thead>
                                                <th>Return Date</th>
                                                <th>Returned By</th>
                                                <th>Updated By</th>
                                                <th>Store Confirmation</th>
                                            </thead>
                                            <tbody>
                                                <td>11/08/2020</td>
                                                <td>Shohel</td>
                                                <td>Mizan</td>
                                                <td><span class="badge badge-warning">Partially Received</span></td>
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
                                                    <th>Final Cost</th>
                                                    <th>Quantity</th>
                                                    <th width="180">Subtotal</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>101052 - AL DHAFRA DATES DABBAS 1KG</td>
                                                    <td>5</td>
                                                    <td>10</td>
                                                    <td>50</td>
                                                </tr>
                                                <tr>
                                                    <td>101052 - AL DHAFRA DATES DABBAS 1KG</td>
                                                    <td>5</td>
                                                    <td>10</td>
                                                    <td>50</td>
                                                </tr>
                                                <tr>
                                                    <td>101052 - AL DHAFRA DATES DABBAS 1KG</td>
                                                    <td>5</td>
                                                    <td>10</td>
                                                    <td>50</td>
                                                </tr>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="3" style="text-align:right; padding-right:10px;">Total
                                                    </td>
                                                    <td style="text-align:right; padding-right:10px;">150.00 AED</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3" style="text-align:right; padding-right:10px;">(+) Shipment Cost <i class="fas fa-plus-square"></i>
                                                    </td>
                                                    <td colspan="2" style="text-align:right; padding-right:10px;">0.00 AED</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3" style="text-align:right; padding-right:10px; font-weight:bold;">(=) Net Amount
                                                    </td>
                                                    <td style="text-align:right; padding-right:10px; font-weight:bold;">150.00 AED
                                                    </td>
                                                </tr>
                                            </tfoot>
                                        </table>
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


@push("script")

@endpush
