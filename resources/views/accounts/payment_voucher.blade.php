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

                                        <div class="dropdown-menu store-filter" aria-labelledby="locationFilterDropdown">
                                            <a class="dropdown-item" data-id="0"> <i class="fas fa-store-alt"></i> All Locations</a>
                                            @foreach ($stores as $store)
                                               <a class="dropdown-item" data-id="{{ $store->id}}" data-name="{{ $store->name}}"><i class="fas fa-store-alt"></i> {{$store->name}}</a>
                                            @endforeach
                                      </div>
                                      <input type="hidden" name="store_filter" class="ls-store-filter" value="0">
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
                                               @foreach($payments as $payment)
                                               <option value="{{$payment->vendor_code}}">{{$payment->vendor->name}}</option>
                                               @endforeach
                                               <input type="hidden" name="vendor_filter" class="ls-vendor-filter" value="0">
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
                <form action="{{ route('advPayment') }}" method="POST">
                  @csrf
                  <div class="form-row">
                    <div class="form-group col-md-4">
                      <label for="adv_balance">Advance Balance</label>
                      <input type="number" readonly value="" class="form-control adv" id="adv_balance">
                    </div>
                    <div class="form-group col-md-4">
                      <label for="adj_amount">Adjust Amount</label>
                      <input type="number" value="" name="ad_amount" class="form-control adj_amount" id="adj_amount">
                      <input type="hidden" name="vendor_id" value="" class="form-control" id="vendor_id">
                    </div>
                  </div>
                  <button type="submit" class="btn btn-primary">Submit</button>
                </form>
              </div>
            </div>
          </div>
        </div>

        <!-- other debit modal -->
        <div class="modal fade" id="otherDebitModal" tabindex="-1" role="dialog" aria-labelledby="otherDebitModal" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="otherDebitModal">Other Debit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form action="{{ route('other_debit') }}" method="POST">
                  @csrf
                  <div class="form-row">
                    <div class="form-group col-md-4">
                      <label for="other_debit">Other Debit Amount</label>
                      <input type="number" value="" name="other_debit" class="form-control" id="other_debit">
                      <input type="hidden" value="" name="id" class="form-control" id="other_debit_id">
                    </div>
                  </div>
                  <button type="submit" class="btn btn-primary">Submit</button>
                </form>
              </div>
            </div>
          </div>
        </div>

        <!-- other credit modal -->
        <div class="modal fade" id="otherCreditModal" tabindex="-1" role="dialog" aria-labelledby="otherCreditModal" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="otherCreditModal">Other Credit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form action="{{ route('other_credit') }}" method="POST">
                  @csrf
                  <div class="form-row">
                    <div class="form-group col-md-4">
                      <label for="other_credit">Other Credit Amount</label>
                      <input type="number" value="" name="other_credit" class="form-control" id="other_credit">
                      <input type="hidden" value="" name="id" class="form-control" id="other_credit_id">
                    </div>
                  </div>
                  <button type="submit" class="btn btn-primary">Submit</button>
                </form>
              </div>
            </div>
          </div>
        </div>

        <!-- other credit modal -->
        <div class="modal fade" id="paymentMethod" tabindex="-1" role="dialog" aria-labelledby="paymentMethod" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="paymentMethod">Other Credit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form action="{{ route('payment_method') }}" method="POST">
                  @csrf
                  <div class="container">
                      <div class="form-group row">
                      <label for="payment_amount">Payment Method</label>
                      <input type="text" value="" name="payment_amount" class="form-control" id="payment_amount">
                      <input type="hidden" value="" name="id" class="form-control" id="payment-medhod-id">
                    </div>
                    <div class="form-group row">
                      <label for="account_no">A/C No</label>
                      <input type="number" value="" name="account_no" class="form-control" id="account_no">
                    </div>
                    <div class="form-group row">
                      <label for="check_no">Cheque No</label>
                      <input type="number" value="" name="check_no" class="form-control" id="check_no">
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
               data.store_id = $('.ls-store-filter').val();
               data.vendor_id = $('.ls-vendor-filter').val();
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

    $('.store-filter a').on('click', function(){
        store_id=$(this).data('id');
        store_name = $(this).data('name');
        $('#loc-text').text('');
        $('#loc-text').text(store_name);
        $('.ls-store-filter').val(store_id);
        table.draw();
    });

    $('.vendor-select').on('change', function() {
        vendor_id=this.value;
        vendor_name = $(this).data('name');
        $('#loc-text').text('');
        $('#loc-text').text(vendor_name);
        $('.ls-vendor-filter').val(vendor_id);
        table.draw();
    });


    $('.adj_amount').on('change', function() {
        vendor_id=this.value;
        vendor_name = $(this).data('name');
        $('#loc-text').text('');
        $('#loc-text').text(vendor_name);
        $('.ls-vendor-filter').val(vendor_id);
        table.draw();
    });

    // $('.adj_amount').keyup(function() {
    //     var getValue = $(this).val();
    //     var adv = $('.adv').val();
    //     if (getValue > adv) {
    //         alert('Payment amount more than Advance Amount');
    //     }
    //     var adva = adv - getValue;
    //     $('#adv_balance').val(adva);
    // });

    function otherDebitModal(id){
        $('#other_debit_id').val(id);
        $('#otherDebitModal').modal('show');

    }

    function otherCreditModal(id){
        $('#other_credit_id').val(id);
        $('#otherCreditModal').modal('show');

    }

    function paymentMethod(id){
        $('#payment-medhod-id').val(id);
        $('#paymentMethod').modal('show');

    }

    function adjusmentModal(id){
        $.ajax({
            url: '/vendorAdvancedAmount/'+id,
            type: "GET",
            dataType: "json",
            success:function(data) {
                $('#vendor_id').val(data.vendor_id);
                $('#adv_balance').val(data.amount);
                $('#adjusmentModal').modal('show');
            }
        });

    }

</script>
@endpush