@extends("layouts.app")

@section("title", "Aweer Inventory - Department")


@section("main_content")

        <main class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h5>Department</h5>
                                <div class="title-icons">
                                    <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" onclick="add()"><i class="fas fa-plus-square"></i> Add</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <table id="datatable-dept-list" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Code</th>
                                            <th>Name</th>
                                            <th>Description</th>
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
        <div class="modal fade" id="addDeptModal" tabindex="-1" role="dialog" aria-labelledby="addDeptModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addDeptModalLabel">Add Department</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="err"></div>
                        <form>
                            <div class="form-group">
                                <label>Code:</label>
                                <input type="text" class="form-control" id="inpCode">
                            </div>
                            <div class="form-group">
                                <label>Name:</label>
                                <input type="text" class="form-control" id="inpName">
                            </div>
                            <div class="form-group">
                                <label>Description:</label>
                                <textarea class="form-control" rows="1" id="inpDescription"></textarea>
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
        <div class="modal fade" id="delModal" tabindex="-1" role="dialog" aria-labelledby="delDeptModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="delDeptModalLabel">delete confirmation</h5>
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


    var table = $('#datatable-dept-list').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('department_list') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'code', name: 'code'},
            {data: 'name', name: 'name'},
            {data: 'description', name: 'description'},
            {data: 'action', name: 'action'}
        ]
    });


function edit(id){
    $('#err').html('');
 $.ajax({
        url: "{{ route('department.detail') }}",
        type: "post",
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    	},
        data: {'id':id} ,
        success: function (response) {
        	let data  = response;
        	$("#tracker").val('1');
        	$("#inpName").val(response.name);
            $("#inpid").val(response.id);
        	$("#inpCode").val(response.code);
        	$("#inpDescription").val(response.description);

        	$('#addDeptModal').modal('show');
        },
        error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
        }
    });
}


function add(){
    $('#err').html('');
        	$("#tracker").val('0');
        	$("#inpName").val('');
        	$("#inpCode").val('');
        	$("#inpDescription").val('');
        	$("#inpid").val('');

        	$('#addDeptModal').modal('show');
}


function saveData(){
			var id = $("#inpid").val();
        	var name = $("#inpName").val();
        	var code = $("#inpCode").val();
        	var desc = $("#inpDescription").val();
        	var tracker = $("#tracker").val();
 $.ajax({
        url: "{{ route('department.store') }}",
        type: "post",
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    	},
        data: {'id':id, 'name':name, 'code': code, 'desc':desc, 'tracker':tracker} ,
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
            $("#tracker").val('0');
            $("#inpid").val('');
            $("#inpName").val('');
            $("#inpCode").val('');
            $("#inpDescription").val('');
            table.draw();
            $('#addDeptModal').modal('hide');
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
        url: "{{ route('department.deletedata') }}",
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