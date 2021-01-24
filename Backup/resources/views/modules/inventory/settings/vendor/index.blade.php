@extends("layouts.app")

@section("title", "Aweer Inventory - Vendor")


@section("main_content")

        <main class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h5>Vendor</h5>
                                <div class="title-icons">
                                    <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" onclick="add()"><i class="fas fa-plus-square"></i> Add</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Vcode</th>
                                            <th>Company</th>
                                            <th>Name</th>
                                            <th>Payment Terms</th>
                                            <th>Email</th>
                                            <th>Contact No</th>
                                            <th>City</th>
                                            <th>Address</th>
                                            <th>Type</th>
                                            <th>Discount</th>
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



        <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addStoreModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addStoreModalLabel">Vendor</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="err"></div>
                        <form>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label>Vcode</label>
                                    <input type="text" class="form-control" id="inpCode">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Vat No</label>
                                    <input type="text" class="form-control" id="inpVat">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Company</label>
                                    <input type="text" class="form-control" id="inpCompany">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Email Address</label>
                                    <input type="text" class="form-control" id="inpEmail">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Name</label>
                                    <input type="text" class="form-control" id="inpName">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Payment Terms</label>
                                    <input type="text" class="form-control" id="inpPaymentTerm">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Contact No</label>
                                    <input type="text" class="form-control" id="inpPhone">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Address</label>
                                    <input type="text" class="form-control" id="inpAddress">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>City</label>
                                    <input type="text" class="form-control" id="inpCity">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Country</label>
                                    <input type="text" class="form-control" id="inpCountry">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Type</label>
                                    <select id="inpType" name="type" class="form-control">
                                        <option>Principle vendor</option>
                                        <option>Alternative Vendor</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Discount</label>
                                    <input id="inpDiscount" type="text" name="discount" class="form-control">
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
        scrollX: true,
        ajax: "{{ route('vendors_list') }}",
        columns: [
            {data: 'sl', name: 'sl'},
            {data: 'code', name: 'code'},
            {data: 'company', name: 'company'},
             {data: 'name', name: 'name'},
            {data: 'payment_term', name: 'payment_term'},
            {data: 'email', name: 'email'},
            {data: 'phone', name: 'phone'},
            {data: 'city', name: 'city'},
            {data: 'address', name: 'address'},
            {data: 'type', name: 'type'},
            {data: 'discount', name: 'discount'},
            {data: 'action', name: 'action'}
        ]
    });


function edit(id){
    $('#err').html('');
 $.ajax({
        url: "{{ route('vendors.detail') }}",
        type: "post",
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {'id':id} ,
        success: function (response) {
            let data  = response;
            $("#tracker").val('1');
            $("#inpCode").val(response.code);
            $("#inpCity").val(response.city);
            $("#inpCountry").val(response.country);
            $("#inpVat").val(response.vat_no);
            $("#inpPaymentTerm").val(response.payment_term);
            $("#inpCompany").val(response.company);
            $("#inpName").val(response.name);
            $("#inpEmail").val(response.email);
            $("#inpPhone").val(response.phone);
            $("#inpid").val(response.id);
            $("#inpAddress").val(response.address);
            $("#inpType").val(response.type);
            $("#inpDiscount").val(response.discount);

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
            $("#inpCity").val('');
            $("#inpCountry").val('');
            $("#inpVat").val('');
            $("#inpPaymentTerm").val('');
            $("#inpCompany").val('');
            $("#inpName").val('');
            $("#inpEmail").val('');
            $("#inpPhone").val('');
            $("#inpid").val('');
            $("#inpAddress").val('');
            $("#inpType").val('');
            $("#inpDiscount").val('');

            $('#addModal').modal('show');
}


function saveData(){
            var tracker = $("#tracker").val();
            var code = $("#inpCode").val();
            var city = $("#inpCity").val();
            var country = $("#inpCountry").val();
            var vat = $("#inpVat").val();
            var payment_term = $("#inpPaymentTerm").val();
            var company = $("#inpCompany").val();
            var name = $("#inpName").val();
            var email = $("#inpEmail").val();
            var phone = $("#inpPhone").val();
            var id = $("#inpid").val();
            var address = $("#inpAddress").val();
            var type = $("#inpType").val();
            var discount = $("#inpDiscount").val();
 $.ajax({
        url: "{{ route('vendors.store') }}",
        type: "post",
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {'id':id, 'city':city, 'country':country, 'vat':vat,'payment_term':payment_term, 'company':company, 'code':code, 'name':name, 'address':address, 'email':email, 'phone':phone, 'tracker':tracker, 'discount':discount, 'type':type},
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
            $("#inpCity").val('');
            $("#inpCountry").val('');
            $("#inpVat").val('');
            $("#inpPaymentTerm").val('');
            $("#inpCompany").val('');
            $("#inpName").val('');
            $("#inpEmail").val('');
            $("#inpPhone").val('');
            $("#inpid").val('');
            $("#inpAddress").val('');
            $("#inpType").val('');
            $("#inpDiscount").val('');
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
        url: "{{ route('vendors.deletedata') }}",
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