@extends('layouts/app')

@section('title', 'Dashboard - Petty Cash')

@section('main_content')

        <main class="page-content" id="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h5>Petty Cash</h5>
                            </div>
                            @if(session('success'))
                                <h1 class="text-success">{{session('success')}}</h1>
                            @endif
                            @if(session('error'))
                                 <h1 class="text-danger">{{session('error')}}</h1>
                            @endif
                            <div class="card-body">
                                <form method="post" action="{{ route('petty_cash.store') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-12">
                                            <div style="padding: 1rem;background-color: #f1f1f1;">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label>Select Location</label>
                                                            <select class="form-control" name="location">
                                                                <option value="1">2101 - Electra</option>
                                                                <option value="2">2102 - Muroor</option>
                                                                <option value="3">2103 - Madina Zayed</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label>Balance</label>
                                                            <input type="text" v-model="balance" class="form-control" readonly="" name="balance">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label>Date</label>
                                                            <input id="datetimepicker" type="text" class="form-control" name="date" autocomplete="off" value="{{ date('Y/m/d h:m:s') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label>Expensed Amount</label>
                                                            <input type="text" v-model="expensed_amount" class="form-control" name="Expensed Amount">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Particulars</label>
                                                            <input type="text" v-model="particulars" class="form-control" name="Particulars">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label>Expensed By</label>
                                                            <input type="text" v-model="expensed_by" class="form-control" name="Expensed By">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <button type="submit" class="btn btn-primary btn-draft mt-3">draft</button>
                                        <button type="submit" class="btn btn-primary mt-3">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
@endsection

@push('js_script')

<script>

$('#datetimepicker').datetimepicker();
$('#requisitiondate').datetimepicker();
$('#vendordate').datetimepicker();
$('#shippingdate').datetimepicker();


$("#chkPassport").on('click', function(){
    if($(this).is(':checked')){
         $("#dvPassport").css('display', 'block');
    }else{
        $("#dvPassport").css('display', 'none');
    }

});

</script>
@endpush