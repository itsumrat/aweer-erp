@extends('layouts/app')

@section('title', 'Dashboard - Trial Balance')

@section('main_content')
        <main class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h5>Trial Balance</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Select Date Range</label>
                                            <input type="text" name="lpo-range" class="form-control"/>
                                        </div>
                                    </div>
                                </div>
                                <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Ledger Name</th>
                                            <th>Debit Amount</th>
                                            <th>Credit Amount</th>
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
            url:"{{ route('unpaid_grn_data') }}",
            data: function(data){
                data.store_id = $('.ls-store-filter').val()
            }
       },
        lengthMenu: [[50, 100, 200, -1], [50, 100, 200, "All"]],
        columns: [
            {data: 'created_at', name: 'created_at'},
            {data: 'location', name: 'location'},
            {data: 'reference_no', name: 'reference_no'},
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
          url: "{{ route('lpo_mark_as_paid') }}",
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