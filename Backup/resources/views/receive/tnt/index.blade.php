@extends('layouts/app')

@section('title', 'Dashboard - Vegetable Requisition Create')

@section('main_content')


        <main class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h5>All TRN Receivings (<span id="loc-text">All Locations</span>)</h5>
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
                                <div style="width: 25%">
                                    <div class="form-group">
                                        <label>Select Date Range</label>
                                        <input type="text" name="trn-range" class="form-control"/>
                                    </div>
                                </div>
                                <table id="datatable" class="table table-hover" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Reference</th>
{{--                                             <th>From</th>
                                            <th>To</th> --}}
                                            {{-- <th>Total Item</th> --}}
                                            <th>Quantity</th>
                                            <th>Total Cost</th>
                                            <th>Status</th>
                                            <th>Received by</th>
                                            {{-- <th>Action</th> --}}
                                        </tr>
                                        <tr id="trnListfilterrow">
                                            <th>Date</th>
                                            <th>Reference</th>
{{--                                             <th>From</th>
                                            <th>To</th> --}}
                                            {{-- <th>Total Item</th> --}}
                                            <th>Quantity</th>
                                            <th>Total Cost</th>
                                            <th>Status</th>
                                            <th>Received by</th>
                                            {{-- <th>Action</th> --}}
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
@endsection

@push('js_script')

<script>

    var table = $('#datatable').DataTable({
        processing: true,
        serverSide: true,
        scrollX: true,
        ajax: {
            url:"{{ route('tnt_receive_data') }}",
            data: function(data){
                data.store_id = $('.ls-store-filter').val();
            }
       },
        lengthMenu: [[50, 100, 200, -1], [50, 100, 200, "All"]],
        columns: [
            {data: 'created_at', name: 'created_at'},
            {data: 'reference_no', name: 'reference_no'},
            {data: 'quantity', name: 'quantity'},
            {data: 'unit_cost', name: 'unit_cost'},
            {data: 'status', name: 'status'},
            {data: 'received_by', name: 'received_by'},
            // {data: 'action', name: 'action', searchable: false, sortable:false},
        ],
        initComplete: function () {
            this.api().columns().every(function (col) {
                                    var column = this;
                                    console.log(column);
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
</script>
@endpush