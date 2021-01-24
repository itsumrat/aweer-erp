@extends("layouts.app")

@section("title", "Aweer Inventory - Ledgers")


@section("main_content")

        <main class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h5>Ledgers</h5>
                                <div class="title-icons">
                                    <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" onclick="add()"><i class="fas fa-plus-square"></i> Add</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Main Account</th>
                                            <th>Account Category</th>
                                            <th>Report Type</th>
                                            <th>Ledger Code</th>
                                            <th>Ledger Head</th>
                                            <th>Actions</th>
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

        <!-- Add Modal -->



        <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addLedgerModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addLedgerModalLabel">Ledger</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="err"></div>
                        <form>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label>Main Account</label>
                                    <select class="form-control" id="mainAccount">
                                        <option value="1">Asset</option>
                                        <option value="2">Liability</option>
                                        <option value="3">Revenue</option>
                                        <option value="4">Expense</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-8">
                                    <label>Account Category</label>
                                    <select class="form-control" id="acCategory">
                                        <option value="1">Current Assets</option>
                                        <option value="2">Non Current Assets</option>
                                        <option value="3">Property Plant and Equipment</option>
                                        <option value="4">Current Liabilities</option>
                                        <option value="5">Non Current Liabilities</option>
                                        <option value="6">Equity</option>
                                        <option value="7">Sales</option>
                                        <option value="8">Other Income</option>
                                        <option value="9">Cost of Good Solds</option>
                                        <option value="10">Expenses</option>
                                        <option value="11">Financial Costs</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-8">
                                    <label>Report Type</label>
                                    <select class="form-control" id="reportType">
                                        <option value="1">Balance Sheet</option>
                                        <option value="2">Income Statement</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-8">
                                    <label>Ledger Code</label>
                                    <input type="text" class="form-control" id="ledgerCode">
                                </div>
                                <div class="form-group col-md-8">
                                    <label>Ledger Head</label>
                                    <input type="text" class="form-control" id="ledgerHead">
                                </div>
                            </div>
                            <input type="hidden" id="tracker" value="0">
                            <input type="hidden" id="inpid">
                            <a onclick="saveData()" class="btn btn-warning btn-aweer">Submit</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Modal -->
        <div class="modal fade" id="delModal" tabindex="-1" role="dialog" aria-labelledby="delLedgerModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="delLedgerModalLabel">delete confirmation</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="confDel(0)">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                   
                            <p>Are you sure want to delete?</p>
                            <input type="hidden" id="deleteId">
                            <button onclick="confDel()" class="btn btn-warning del-aweer">Yes, delete</button>
                       
                    </div>
                </div>
            </div>
        </div>
@endsection


@push("js_script")
<script>


    var table = $('#datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('ledger_list') }}",
        columns: [
            {data: 'sl', name: 'sl'},
            {data: 'main_ac', name: 'main_ac'},
            {data: 'ac_category', name: 'ac_category'},
            {data: 'report_type', name: 'report_type'},
            {data: 'ledger_code', name: 'ledger_code'},
            {data: 'ledger_head', name: 'ledger_head'},
            {data: 'action', name: 'action'}
        ]
    });


function edit(id){
    $('#err').html('');
 $.ajax({
        url: "{{ route('ledger.detail') }}",
        type: "post",
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {'id':id} ,
        success: function (response) {
            let data  = response;
            $("#tracker").val('1');
            $("#mainAccount").val(response.main_ac);
            $("#acCategory").val(response.ac_category);
            $("#reportType").val(response.report_type);
            $("#ledgerCode").val(response.ledger_code);
            $("#ledgerHead").val(response.ledger_head);
            $("#inpid").val(response.id);

            $('#addModal').modal('show');
        },
        error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
        }
    });
}


function add(){
    $('#err').html('');
            $("#tracker").val('0');
            $("#mainAccount").val('');
            $("#acCategory").val('');
            $("#reportType").val('');
            $("#ledgerCode").val('');
            $("#ledgerHead").val('');
            $("#inpid").val('');

            $('#addModal').modal('show');
}


function saveData(){
            var id = $("#inpid").val();
            var main_ac = $("#mainAccount").val();
            var ac_category = $("#acCategory").val();
            var report_type = $("#reportType").val();
            var ledger_code = $("#ledgerCode").val();
            var ledger_head = $("#ledgerHead").val();
            var tracker = $("#tracker").val();

 $.ajax({
        url: "{{ route('ledger.store') }}",
        type: "post",
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {'id':id, 'main_ac':main_ac, 'ac_category':ac_category, 'report_type':report_type, 'ledger_code':ledger_code, 'ledger_head':ledger_head, 'tracker':tracker},
        success: function (response) {
          let  data = response;
          if(data.tracker == 0){
                       error = "<ul>";

                       for(var i=0; i<data.error.length; i++){
                           error += "<li style='color:#EF4030'>"+data.error[i]+"</li>";
                       }
                       error += "</ul>";
                         $('#err').html('');
                       $('#err').append(error);
            }else{
          
                $("#inpid").val('');
                $("#mainAccount").val('');
                $("#acCategory").val('');
                $("#reportType").val('');
                $("#ledgerCode").val('');
                $("#ledgerHead").val('');
                $("#tracker").val('0');
                table.draw();
                $('#addModal').modal('hide');
            }


        },
        error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
        }
    });
}


var confirmation = '';

function confDel(){
var id = $("#deleteId").val();
 $.ajax({
        url: "{{ route('ledger.deletedata') }}",
        type: "post",
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {'id':id} ,
        success: function(response){
            table.draw();
            $('#delModal').modal('hide');
        }
    });
}


function deleteData(id){
    $("#deleteId").val(id);
$('#delModal').modal('show');


}
</script>
@endpush