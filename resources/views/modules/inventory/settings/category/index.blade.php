@extends("layouts.app")

@section("title", "Aweer Inventory - Category")


@section("main_content")

        <main class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h5>Category</h5>
                                <div class="title-icons">
                                    <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" onclick="add()"><i class="fas fa-plus-square"></i> Add</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Code</th>
                                            <th>Name</th>
                                            <th>Parent Category</th>
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



        <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addSubCatModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addSubCatModalLabel">store</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="err"></div>
                        <form>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label>Code</label>
                                    <input type="text" class="form-control" id="inpCode">
                                </div>
                                <div class="form-group col-md-8">
                                    <label>Name</label>
                                    <input type="text" class="form-control" id="inpName">
                                </div>
                                <div class="form-group col-md-9">
                                    <label>Department</label>
                                    <select class="form-control" id="inpDepartment">
                                        <option value="">--Select--</option>
                                        @foreach($departments as $department)
                                            <option value="{{ $department->id }}">{{ $department->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-9">
                                    <label>Parent Category</label>
                                    <select class="form-control" id="inpParent">
                                        <option value="">--Select--</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                        
                                    </select>
                                </div>
                                <div class="form-group col-md-9">
                                    <label>Description</label>
                                    <textarea class="form-control" rows="2" id="inpDescription"></textarea>
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


    var table = $('#datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('category_list') }}",
        columns: [
            {data: 'sl', name: 'sl'},
            {data: 'code', name: 'code'},
            {data: 'name', name: 'name'},
            {data: 'parent_category', name: 'parent_category'},

            {data: 'action', name: 'action'}
        ]
    });


function edit(id){
    $('#err').html('');
 $.ajax({
        url: "{{ route('category.detail') }}",
        type: "post",
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {'id':id} ,
        success: function (response) {
            let data  = response;
            $("#tracker").val('1');
            $("#inpCode").val(response.code);
            $("#inpName").val(response.name);
            $("#inpDepartment").val(response.department_id);
            $("#inpParent").val(response.parent_category);
            $("#inpDescription").val(response.description);
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
            $("#inpCode").val('');
            $("#inpName").val('');
            $("#inpDepartment").val('');
            $("#inpParent").val('');
            $("#inpDescription").val('');
            $("#inpid").val('');

            $('#addModal').modal('show');
}


function saveData(){
            var id = $("#inpid").val();
            var code = $("#inpCode").val();
            var name = $("#inpName").val();
            var department = $("#inpDepartment").val();
            var parent_cat = $("#inpParent").val();
            var tracker = $("#tracker").val();
             var description = $("#inpDescription").val();

 $.ajax({
        url: "{{ route('category.store') }}",
        type: "post",
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {'id':id, 'code':code, 'name':name, 'department':department, 'parent_cat':parent_cat, 'description':description, 'tracker':tracker} ,
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
            $("#inpCode").val('');
            $("#inpName").val('');
            $("#inpDepartment").val('');
            $("#inpParent").val('');
            $("#inpDescription").val('');
            $("#inpid").val('');
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
        url: "{{ route('category.deletedata') }}",
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