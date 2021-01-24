@extends("layouts.app")

@section("title", "EI-365 | SubLedgers")


@section("main_content")

        <main class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h5>SubLedgers</h5>
                                <div class="title-icons">
                                    <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" onclick="add()"><i class="fas fa-plus-square"></i> Add</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Ledger Head</th>
                                            <th>Posting Type</th>
                                            <th>SubLedger Code</th>
                                            <th>SubLedger Head</th>
                                            <th>Opening Balance</th>
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



        <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addSubLedgerModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addSubLedgerModalLabel">SubLedger</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="err"></div>
                        <form>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label>Select Ledger</label>
                                    <select class="form-control" id="ledgerId">
                                        <option value="">--Select--</option>
                                        @foreach($subledgers as $subledger)
                                            <option value="{{ $subledger->id }}">{{ $ledger->ledger_head }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-8">
                                    <label>Posting Type</label>
                                    <select class="form-control" id="postingType">
                                        <option value="1">Debit</option>
                                        <option value="2">Credit</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-8">
                                    <label>SubLedger Code</label>
                                    <input type="text" class="form-control" id="subLedgerCode">
                                </div>
                                <div class="form-group col-md-8">
                                    <label>SubLedger Head</label>
                                    <input type="text" class="form-control" id="subLedgerHead">
                                </div>
                                <div class="form-group col-md-8">
                                    <label>Opening Balance</label>
                                    <input type="text" class="form-control" id="opBalance">
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
        ajax: "{{ route('subledger_list') }}",
        columns: [
            {data: 'sl', name: 'sl'},
            {data: 'ledger_id', name: 'ledger_id'},
            {data: 'posting_type', name: 'posting_type'},
            {data: 'subledger_code', name: 'subledger_code'},
            {data: 'subledger_head', name: 'subledger_head'},
            {data: 'op_balance', name: 'op_balance'},
            {data: 'action', name: 'action'}
        ]
    });


function edit(id){
    $('#err').html('');
 $.ajax({
        url: "{{ route('subledger.detail') }}",
        type: "post",
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {'id':id} ,
        success: function (response) {
            let data  = response;
            $("#tracker").val('1');
            $("#ledgerId").val(response.ledger_id);
            $("#postingType").val(response.posting_type);
            $("#subledgerCode").val(response.subledger_code);
            $("#subledgerHead").val(response.subledger_head);
            $("#opBalance").val(response.op_balance);
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
            $("#ledgerId").val('');
            $("#postingType").val('');
            $("#subledgerCode").val('');
            $("#subledgerHead").val('');
            $("#opBalance").val('');
            $("#inpid").val('');

            $('#addModal').modal('show');
}


function saveData(){
            var id = $("#inpid").val();
            var ledger_id = $("#ledgerId").val();
            var posting_type = $("#postingType").val();
            var subledger_code = $("#subledgerCode").val();
            var subledger_head = $("#subledgerHead").val();
            var op_balance = $("#opBalance").val();
            var tracker = $("#tracker").val();

 $.ajax({
        url: "{{ route('subledger.store') }}",
        type: "post",
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {'id':id, 'ledger_id':ledger_id, 'posting_type':posting_type, 'subledger_code':subledger_code, 'subledger_head':subledger_head, 'op_balance':op_balance, 'tracker':tracker},
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
                $("#ledgerId").val('');
                $("#postingType").val('');
                $("#subledgerCode").val('');
                $("#subledgerHead").val('');
                $("#opBalance").val('');
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
        url: "{{ route('subledger.deletedata') }}",
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