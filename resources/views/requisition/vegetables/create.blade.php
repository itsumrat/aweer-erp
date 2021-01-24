@extends('layouts/app')

@section('title', 'Dashboard - Vegetable Requisition Create')

@section('main_content')
        <main class="page-content" id="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h5>Add requisition</h5>
                            </div>
                                          @if(session('success'))
                                                <h1 class="text-success">{{session('success')}}</h1>
                                            @endif
                                            @if(session('error'))
                                                 <h1 class="text-danger">{{session('error')}}</h1>
                                            @endif
                            <div class="card-body">
                                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="{{ route('vegetable_requisition.create') }}" role="tab" aria-controls="pills-vegetables" aria-selected="true">Vegetables</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('dc_requisition.create') }}" role="tab" aria-controls="pills-dc" aria-selected="false">DC</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('dsd_requisition.create') }}" role="tab" aria-controls="pills-dsd" aria-selected="false">DSD</a>
                                    </li>
                                </ul>

                                <div class="tab-content" id="pills-tabContent">
                                    <div class="tab-pane fade show active" id="pills-vegetables" role="tabpanel" aria-labelledby="pills-vegetables-tab">
                                        <form action="{{ route('vegetable_requisition.store') }}" method="POST">
                                            @csrf
                                            <div class="row">
                                                <div class="col-12">
                                                    <div style="padding: 1rem;background-color: #f1f1f1;">
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label>Date</label>
                                                                    <input id="datetimepicker" type="text" class="form-control" name="date" value="{{ date('Y/m/d h:m:s') }}" required="required">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label>Reference</label>
                                                                    <input type="text" class="form-control" readonly="" name="reference" v-model="reference" required="required">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label>Status</label>
                                                                    <select class="form-control" name="status" required="required">
                                                                        <option value="0">Pending</option>
                                                                        <option value="1">Sent</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12 mt-1">
                                                    <div style="padding: 1rem;background-color: #f1f1f1;">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label>Requision from*</label>
                                                                <input type="hidden" name="requisition_from" v-model="selected_requisition_from.id">
                                                                <div class="form-group">
                                                                    <v-select @search="fetchRequisitionFromList" :options="requisition_from_list" @input="fetch_requisition_from_info" >


                                                                    </v-select>
                                                                    

                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label>Requistion To *</label>
                                                                    <input type="hidden" name="requisition_to" v-model="selected_requisition_to.id">
                                                                    <div class="form-group">
                                                                        <v-select @search="fetchRequisitionToList" :options="requisition_to_list" @input="fetch_requisition_to_info" >

                                                                  
                                                                        </v-select>
                                                                        
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 mt-1">
                                                    <div style="padding: 1rem;background-color: #f1f1f1">
                                                        <div class="row">
                                                            <div class="col-7">
                                                                <label>Select item</label>
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text"><i class="fas fa-barcode"></i></span>
                                                                    </div>
                                                                    <v-select @search="fetchItems" :options="item_info" @input="fetch_item_info" />
                                                                </div>
                                                            </div>
                                                            <div class="col-12 mt-3">
                                                                <table class="table table-striped table-bordered" style="width:100%">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Item name (Item code)</th>
                                                                            <th>Final Cost</th>
                                                                            <th>Stock</th>
                                                                            <th>Quantity</th>
                                                                            <th>Last 7 days avg sale</th>
                                                                            <th>Last 30 days avg sale</th>
                                                                            <th>Subtotal(AED)</th>
                                                                            <th><i class="far fa-trash-alt"></i></th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr v-for="(item, index) in selected_items">
                                                                            <td>@{{ item.product_pricing.code }} - @{{ item.product_pricing.name }}</td>
                                                                            <td>@{{ item.final_cost }}</td>
                                                                            <td>@{{ item.stock }}</td>
                                                                            <td><input type="hidden" v-bind:name="getInputName(index, 'id')" :value="item.product_id">
                                                                            <input type="hidden" v-bind:name="getInputName(index, 'barcode')" :value="item.barcode">

                                                                                <input type="number" class="form-control" v-model="selected_items[index].quantity" v-bind:name="getInputName(index, 'quantity')" required="required" v-on:keyup="countTotals"></td>
                                                                            <td>@{{ item.last_7_day_sale }}</td>
                                                                            <td>@{{ item.last_30_day_sale }}</td>
                                                                            <td>@{{ selected_items[index].quantity * item.final_cost }}</td>
                                                                            <td><a v-on:click="removeItemFromList(item.id)"><i class="far fa-window-close"></i></a></td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 mt-1">
                                                    <div style="padding: 1rem;background-color: #f1f1f1">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label>Note</label>
                                                                <textarea class="form-control" rows="3" name="note"></textarea>
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
                                        <div class="total-requision mt-2">
                                            <table class="table table-bordered">
                                                <tbody>
                                                    <tr>
                                                      <td>Total Items <span>@{{ total_item }}</span></td>
                                                      <td>Total Quantity <span>@{{ total_qty }}</span></td>
                                                      <td>Grand Total <span>@{{ grand_total }}</span></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>




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
Vue.component('v-select', VueSelect.VueSelect);
const app = new Vue({
    el: '#page-content',
    data: {
        item_info: [],
        req_store: [],
        selected_items: [],
        requisition_to_list : [],
        requisition_from_list : [],
        selected_requisition_to: {},
        selected_requisition_from: {},
        total_item: 0,
        total_qty: 0,
        grand_total: 0,
        reference: '{{ old('reference') }}'

    },
    methods:{
        fetchItems: function(search, loading){
            let ref = this;
            if(search != ''){
            axios.post('/api/item/list',{'search':search}).then(function(response){
                ref.item_info = response.data.results;
            });
            }

        },
        fetch_item_info: function(value){
            let ref = this;
            // let itemP = $(this).val();
            // alert(itemP);
            let product_id = value.code;
            ref.selected_item_buy = {};
            let location_id = '';
            if(Object.keys(ref.selected_requisition_from).length == 0){
                alert("Please Select Location First");
                return;
            }else{
            location_id = ref.selected_requisition_from.id;
            }
            axios.post('/api/item/info', {'id':product_id, 'location_id':location_id}).then(function(response){
                ref.selected_item_buy = response.data;
                //console.log(response.data);
                // ref.selected_item_buy.id = response.data.id;
                // ref.selected_item_buy.cost = response.data.prices.final_cost;
                // ref.selected_item_buy.markup = response.data.prices.markup + ' %';
                // ref.selected_item_buy.price = response.data.prices.final_price;
                let data = response.data;
                data.quantity = 1;
                // console.log(ref.selected_item_buy);
                ref.selected_items.push(data);
                ref.countTotals();
            });

        },
        fetchRequisitionFromList: function(search, loading){
            let ref = this;

            if(search != ''){
            axios.post('/api/location/list',{'search':search}).then(function(response){
                ref.requisition_from_list = response.data.results;
            });
            }
        },
        fetchRequisitionToList: function(search, loading){
            let ref = this;

            if(search != ''){
            axios.post('/api/storereq/list',{'search':search}).then(function(response){
                ref.requisition_to_list = response.data.results;
            });
            }
        },
        fetch_requisition_from_info: function(value){
            let ref = this;
            let store_id = value;
            axios.post('/api/location/info', {'id':store_id}).then(function(response){

                ref.selected_requisition_from.id = response.data[0].id;
                ref.selected_requisition_from.name = response.data[0].name;
            });
        },

        fetch_requisition_to_info:function(value){
            let ref = this;
            let store_id = value;
            axios.post('/api/storereq/info', {'id':store_id}).then(function(response){
                //console.log(ref.selected_requisition_to);
                ref.selected_requisition_to.id = response.data[0].id;
                ref.selected_requisition_to.req_store = response.data[0].req_store;
            });
        },
        removeItemFromList: function(id){
            let ref = this;
            ref.selected_items = ref.selected_items.filter(function(item){
                return item.id != id; 
                
            });
            ref.countTotals();
        },
        countTotals(){
            let ref = this;
            let countable_list = ref.selected_items;
            let counted_elements = [];
            ref.total_item = 0;
            ref.total_qty = 0;
            ref.grand_total = 0;
            //console.log(countable_list);
            for (var i = 0; i < countable_list.length; i++) {
                console.log(counted_elements.includes(countable_list[i]));
                if(!counted_elements.includes(countable_list[i].code )){
                    counted_elements.push(countable_list[i].code);
                    ref.total_item = ref.total_item + 1;
                }

                if(countable_list[i].quantity == ''){
                    countable_list[i].quantity = 0;
                }
                ref.total_qty = parseInt(ref.total_qty) + parseInt(countable_list[i].quantity);
                ref.grand_total = (ref.grand_total + (countable_list[i].quantity * countable_list[i].final_cost));
            }

        },
        getInputName: function(index, dataName){
          return "requisition_items["+index+"]["+dataName+"]";
        },
        autoGenerateRef: function(){
            let ref = this;
            axios.post('/api/reference/generate', {'table':'requisitions', 'refcode':'RQSN'}).then(function(response){
                ref.reference = response.data.reference;
            });

        } 

    },
    created: function(){
        this.autoGenerateRef();
    }

});

$('#datetimepicker').datetimepicker();
	
</script>
@endpush