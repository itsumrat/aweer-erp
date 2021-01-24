@extends('layouts/app')

@section('title', 'Dashboard - Ledger Entry')

@section('main_content')

        <main class="page-content" id="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h5>Ledger Entry</h5>
                            </div>
                            @if(session('success'))
                                <h1 class="text-success">{{session('success')}}</h1>
                            @endif
                            @if(session('error'))
                                 <h1 class="text-danger">{{session('error')}}</h1>
                            @endif
                            <div class="card-body">
                                <form method="post" action="{{ route('ledger_entry.store') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-12">
                                            <div style="padding: 1rem;background-color: #f1f1f1;">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label>Date</label>
                                                            <input id="datetimepicker" type="text" class="form-control" name="date" autocomplete="off" value="{{ date('Y/m/d h:m:s') }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <label>SubLedger*</label>
                                                        <input type="hidden" name="subledger_id" v-model="selected_subledger.id">
                                                        <div class="form-group">
                                                            <v-select @search="fetch_subledger_list" :options="subledger_list" @input="fetch_subledger_info" >

                                                            </v-select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label>Location</label>
                                                            <select class="form-control" name="posting_type">
                                                                <option value="1">ASM Electra</option>
                                                                <option value="2">ASM Muroor</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label>Balance</label>
                                                            <input type="text" v-model="balance" class="form-control" name="Balance">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="form-group">
                                                            <label>Particulars</label>
                                                            <input type="text" v-model="particulars" class="form-control" name="Particulars">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label>Amount</label>
                                                            <input type="text" v-model="amount" class="form-control" name="Amount">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label>Status</label>
                                                            <select class="form-control" name="Staus">
                                                                <option value="1">Hold</option>
                                                                <option value="2">Approved</option>
                                                                <option value="3">Cancelled</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <button type="submit" class="btn btn-primary btn-draft mt-3">Draft</button>
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