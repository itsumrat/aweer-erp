@extends('layouts/app')

@section('title', 'Dashboard - Vegetable Requisition Create')

@section('main_content')
        <main class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h5>payment voucher (All Locations)</h5>
                                <div class="title-icons">
                                    <div class="dropdown show" style="display: inline-block;">
                                        <a class="dropdown-toggle" href="#" id="locationFilterDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-map-marker-alt"></i>
                                        </a>

                                        <div class="dropdown-menu" aria-labelledby="locationFilterDropdown">
                                            <a class="dropdown-item" href="#"><i class="fas fa-store-alt"></i> All Locations</a>
                                            <a class="dropdown-item" href="#"><i class="fas fa-store-alt"></i> Another action</a>
                                            <a class="dropdown-item" href="#"><i class="fas fa-store-alt"></i> Something else here</a>
                                      </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Select Date Range</label>
                                            <input type="text" name="lpo-range" class="form-control"/>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Vendor</label>
                                        <div class="form-group">
                                            <select class="vendor-select form-control">
                                                <option></option>
                                               <option>121212-siraj uddin</option>
                                               <option>454545-miraj uddin</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <table id="paymentvoucher-table" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>PVCH Date</th>
                                            <th>Reference</th>
                                            <th>Vendor Code</th>
                                            <th>Total Invoices</th>
                                            <th>Total Locations</th>
                                            <th>Total Debit</th>
                                            <th>Other Debit</th>
                                            <th>Total Credit</th>
                                            <th>Other Credit</th>
                                            <th>Net Amount</th>
                                            <th>Payment</th>
                                            <th>Adj Advance</th>
                                            <th>Check No</th>
                                            <th>A/C No</th>
                                            <th>Action</th>
                                        </tr>
                                        <tr id="paymentVoucherfilterrow">
                                            <th>PVCH Date</th>
                                            <th>Reference</th>
                                            <th>Vendor Code</th>
                                            <th>Total Invoices</th>
                                            <th>Total Locations</th>
                                            <th>Total Debit</th>
                                            <th>Other Debit</th>
                                            <th>Total Credit</th>
                                            <th>Other Credit</th>
                                            <th>Net Amount</th>
                                            <th>Payment</th>
                                            <th>Adj Advance</th>
                                            <th>Check No</th>
                                            <th>A/C No</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
      <!-- page-content" -->

        <!-- Item Delete Modal -->
        <div class="modal fade" id="itemDelModal" tabindex="-1" role="dialog" aria-labelledby="itemDelModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="itemDelModalLabel">Item Delete</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <p>Want to delete the item?</p>
                            <div>
                                <button type="button" class="btn btn-secondary mt-3" data-dismiss="modal">No</button>
                                <button type="button" class="btn btn-primary mt-3">Yes, Delete</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Adjustment modal -->
        <div class="modal fade" id="adjusmentModal" tabindex="-1" role="dialog" aria-labelledby="adjusmentModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="adjusmentModalLabel">Adjust Advanced</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form>
                  <div class="form-row">
                    <div class="form-group col-md-4">
                      <label for="date">Date</label>
                      <input type="date" class="form-control" id="date">
                    </div>
                    <div class="form-group col-md-8">
                      <label for="vendor">Select Vendor</label>
                      <select id="vendor" class="form-control">
                        <option selected>Choose...</option>
                        <option>...</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="description">Description</label>
                    <input type="text" class="form-control" id="description" placeholder="Description">
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-4">
                      <label for="amount">Amount</label>
                      <input type="number" class="form-control" id="amount">
                    </div>
                    <div class="form-group col-md-8">
                      <label for="paid_by">Paid By</label>
                      <input type="text" class="form-control" id="paid_by" placeholder="Paid By">
                    </div>
                  </div>
                  <button type="submit" class="btn btn-primary">Submit</button>
                </form>
              </div>
            </div>
          </div>
        </div>
@endsection

@push('js_script')

<script>

var table = $('#paymentvoucher-table').DataTable({
        //processing: true,
        serverSide: true,
        scrollX: true,
        ajax: {
            url:"{{ route('payment_voucher_list') }}",
            data: function(data){
               // data.store_id = $('.ls-store-filter').val();
            }
       },
        lengthMenu: [[50, 100, 200, -1], [50, 100, 200, "All"]],
        columns: [
            {data: 'date', name: 'PVCH Date'},
            {data: 'reference', name: 'Reference'},
            {data: 'vendor', name: 'Vendor Code'},
            {data: 'total_invoice', name: 'Total Invoices'},
            {data: 'total_location', name: 'Total Locations'},
            {data: 'total_debit', name: 'Total Debit'},
            {data: 'other_debit', name: 'Other Debit'},
            {data: 'total_credit', name: 'Total Credit'},
            {data: 'other_credit', name: 'Other Credit'},
            {data: 'net_amount', name: 'Net Amount'},
            {data: 'payment_amount', name: 'Payment'},
            {data: 'adj_advance', name: 'Adj Advance'},
            {data: 'check_no', name: 'Check No'},
            {data: 'ac_no', name: 'A/C No'},
            {data: 'action', name: 'action', searchable: false, sortable:false},
        ],
        initComplete: function () {
            this.api().columns().every(function (col) {
                                    var column = this;
                                    //console.log(column);
                if(col != 10){

                    var input = document.createElement("input");
                    input.placeholder = "Search";
                    input.className  = "form-control";
                    $(input).appendTo($(column.header()).empty())
                    .on('keyup', function () {
                        column.search($(this).val(), false, false, true).draw();
                    });
                }else{
                    $('').appendTo($(column.header()).empty())
                }

            });
        }

    });


    
</script>
@endpush