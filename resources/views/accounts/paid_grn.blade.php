@extends('layouts/app')

@section('title', 'Dashboard - Vegetable Requisition Create')

@section('main_content')
        <main class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h5>Paid GRN (All Locations)</h5>
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
                                        <button type="buton" class="btn btn-primary btn-draft mt-3 btn-mark-paid">mark as unpaid</button>
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
                                               @foreach($paidgnrs as $paidgnr)
                                               <option value="{{$paidgnr->vendor_id}}">{{$paidgnr->vendor->name}}</option>
                                               @endforeach
                                               <input type="hidden" name="vendor_filter" class="ls-vendor-filter" value="0">
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th><input class="sel" type="checkbox" value="all" onclick="checkAll('all')">
                                            </th>
                                            <th>Receive Date</th>
                                            <th>Location</th>
                                            <th>Reference</th>
                                            <th>Vendor</th>
                                            <th>Vendor Invoice</th>
                                            <th>Total Paid</th>
                                            <th>Payment Date</th>
                                        </tr>

                                        
                                    </thead>
                                    <tbody>
                                       
                                    </tbody>
                                </table>
                                <div>
                                    <button type="button" class="btn btn-primary btn-draft mt-3"><i class="fas fa-file-download"></i> &nbsp; Download PDF</button>
                                    <button type="button" class="btn btn-primary mt-3"><i class="fas fa-print"></i> &nbsp; print</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
      
@endsection

@push('js_script')

<script>
  var table = $('#datatable').DataTable({
        processing: true,
        serverSide: true,
        scrollX: true,
        ajax: {
            url:"{{ route('paid_grn_data') }}",
            data: function(data){
                data.store_id = $('.ls-store-filter').val();
                data.vendor_id = $('.ls-vendor-filter').val();
            }
       },
        lengthMenu: [[50, 100, 200, -1], [50, 100, 200, "All"]],
        columns: [
        {data: 'checkbox', name: 'checkbox', orderable:false, searchable:false},
            {data: 'created_at', name: 'created_at'},
            {data: 'location', name: 'location'},
            {data: 'reference_no', name: 'reference_no'},
            {data: 'vendor', name: 'vendor'},
            {data: 'vendor_invoice', name: 'vendor_invoice'},//
            {data: 'grand_total', name: 'grand_total'},
            {data: 'payment_date', name: 'payment_date'},
        ],

    });

    table.columns().every(function() {
    var that = this;
    $('#Requisition-range').on('keyup change', function() {
        if (that.search() == this.value) {
            that.search(this.value).draw();
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
    });

    $('input[type="checkbox"]').click(function(){
        if($(this).val() == 'all'){
             $('input:checkbox').prop('checked', this.checked); 
        }
    });

    $('.btn-mark-paid').on('click', function(){
    let selected = $('input[name="count_history"]:checked').map(function(){
                 return $(this).val();
            }).get();

        $.ajax({
          type: "POST",
          url: "{{ route('lpo_mark_as_unpaid') }}",
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
    
</script>
@endpush