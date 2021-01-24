@extends('layouts/app')

@section('title', 'Dashboard - Vegetable Requisition Create')

@section('main_content')

        <main class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h5>payment advanced</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 offset-md-3">
                                        <div class="card">
                                            <div class="card-body">
                                                <form action="{{ route('payment_advanced.store') }}" method="POST">
                                                    @csrf
                                                  <div class="form-row">
                                                    <div class="form-group col-md-5">
                                                      <label for="date">Date</label>
                                                      <input type="date" class="form-control" id="date" name="date">
                                                    </div>
                                                    <div class="form-group col-md-7">
                                                      <label for="vendor_id">Select Vendor</label>
                                                      <select id="vendor_id" name="vendor_id" class="form-control">
                                                        <option selected>Choose...</option>
                                                        @foreach($vendors as $vendor)
                                                        <option value="{{ $vendor->id }}">{{ $vendor->name }}</option>
                                                        @endforeach
                                                      </select>
                                                    </div>
                                                  </div>
                                                  <div class="form-group">
                                                    <label for="description">Description</label>
                                                    <input type="text" class="form-control" id="description" placeholder="Description" name="description">
                                                  </div>
                                                  <div class="form-row">
                                                    <div class="form-group col-md-5">
                                                      <label for="amount">Amount</label>
                                                      <input type="number" class="form-control" id="amount" name="amount">
                                                    </div>
                                                    <div class="form-group col-md-7">
                                                      <label for="paid_by">Paid By</label>
                                                      <input type="text" class="form-control" name="paid_by" id="paid_by" placeholder="Paid By">
                                                    </div>
                                                  </div>
                                                  <button type="submit" class="btn btn-primary">Submit</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <table id="paymentView" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Vendor Name</th>
                                            <th>Description</th>
                                            <th>Amount</th>
                                            <th>Paid By</th>
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
      
@endsection

@push('js_script')

<script>

var table = $('#paymentView').DataTable({
        processing: false,
        serverSide: true,
        scrollX: true,
        ajax: {
            url:"{{ route('payment_advanced_view') }}",
            data: function(data){
                // data.store_id = $('.ls-store-filter').val();
                // data.vendor_id = $('.ls-vendor-filter').val();
            }
       },
        lengthMenu: [[50, 100, 200, -1], [50, 100, 200, "All"]],
        columns: [
            {data: 'date', name: 'date'},
            {data: 'vendor', name: 'vendor name'},
            {data: 'description', name: 'Description'},
            {data: 'amount', name: 'amount'},
            {data: 'paid_by', name: 'paid by'},
            {data: 'action', name: 'action', searchable: false, sortable:false},

        ],

    });
    
</script>
@endpush