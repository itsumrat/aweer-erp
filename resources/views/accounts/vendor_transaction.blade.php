@extends('layouts/app')

@section('title', 'Dashboard - Vegetable Requisition Create')

@section('main_content')

        <main class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h5>vendor transaction (All Locations)</h5>
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
                                        <button id="btnSubmit" disabled="" type="buton" class="btn btn-primary btn-draft payment_voucher mt-3 remove-disable">make payment voucher</button>
                                        <span class="v-style">*Please select first vendor.</span>
                                    </div>
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
                                               @foreach($purchases as $purchase)
                                               <option value="{{$purchase->vendor_id}}">{{$purchase->vendor->name}}</option>
                                               @endforeach
                                               <input type="hidden" name="vendor_filter" class="ls-vendor-filter" value="0">
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <table id="vtransactiontableView" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th><input class="sel" type="checkbox" value="all">
                                            </th>
                                            <th>Transaction Date</th>
                                            <th>Reference</th>
                                            <th>Vendor</th>
                                            <th>Vendor Invoice</th>
                                            <th>Location</th>
                                            <th>Debit</th>
                                            <th>Credit</th>
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
      <style>
          span.v-style {
                margin-left: 6%;
                font-size: 11px;
                color: red;
            }
      </style>  
      
@endsection

@push('js_script')

<script>

var table = $('#vtransactiontableView').DataTable({
        processing: false,
        serverSide: true,
        scrollX: true,
        ajax: {
            url:"{{ route('vendor_transaction_view') }}",
            data: function(data){
                data.store_id = $('.ls-store-filter').val();
                data.vendor_id = $('.ls-vendor-filter').val();
            }
       },
        lengthMenu: [[50, 100, 200, -1], [50, 100, 200, "All"]],
        columns: [
        {data: 'checkbox', name: 'checkbox', orderable:false, searchable:false},
            {data: 'date', name: 'transaction date'},
            {data: 'reference', name: 'reference'},
            {data: 'vendor', name: 'vendor'},
            {data: 'invoice', name: 'vendor invoice'},
            {data: 'location', name: 'location'},
            {data: 'debit', name: 'debit'},//
            {data: 'credit', name: 'credit'},
        ],

    });

    // function checkAll(all) {
    //     var ss = $(this).val();
    //     alert(ss);
    //     if($(this).val() == 'all'){
    //          $('input:checkbox').prop('checked', this.checked); 
    //     }
    // }

    $('input[type="checkbox"]').click(function(){
        if($(this).val() == 'all'){
             $('input:checkbox').prop('checked', this.checked); 
        }
    });

    $('.payment_voucher').on('click', function(){
        let selected = $('input[name="count_history"]:checked').map(function(){
                 return $(this).val();
            }).get();
        $.ajax({
          type: "POST",
          url: "{{ route('vendor__payment_voucher') }}",
          data: {'selected':selected},
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          cache: false,
          success: function(data){
             table.draw();
          }
        });

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
        $('#btnSubmit').attr("disabled", false);
    });

    // $('.remove-disable').on('click', function(){
    //     alert('Please selected first vendor!')
    // });

    
</script>
@endpush