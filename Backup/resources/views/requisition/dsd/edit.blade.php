@extends('layouts/app')

@section('title', 'Dashboard - Vegetable Requisition Edit')

@section('main_content')
        <main class="page-content" id="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h5>Edit requisition</h5>
                            </div>
                                          @if(session('success'))
                                                <h1 class="text-success">{{session('success')}}</h1>
                                            @endif
                                            @if(session('error'))
                                                 <h1 class="text-danger">{{session('error')}}</h1>
                                            @endif
                            <div class="card-body">

                                <div class="tab-content" id="pills-tabContent">
                                    <div class="tab-pane fade show active" id="pills-vegetables" role="tabpanel" aria-labelledby="pills-vegetables-tab">
                                        <form action="{{ route('dsd_requisition.update', $requisition->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="row">
                                                <div class="col-12">
                                                    <div style="padding: 1rem;background-color: #f1f1f1;">
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label>Date</label>
                                                                    <input id="datetimepicker" type="text" class="form-control" name="date" value="{{ $requisition->date }}" required="required">
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
                                                                        <option {{ ($requisition->status == 0)?'selected':'' }} value="0">Pending</option>
                                                                        <option {{ ($requisition->status == 1)?'selected':'' }} value="1">Sent</option>
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
                                                                    <v-select @search="fetchRequisitionFromList" :options="requisition_from_list" @input="fetch_requisition_from_info" v-model="selected_requisition_from_edit">

                                                                  

                                                                    </v-select>
                                                                    

                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label>Requistion To *</label>
                                                                    <input type="hidden" name="requisition_to" v-model="selected_requisition_to.id">
                                                                    <div class="form-group">
                                                                        <v-select @search="fetchRequisitionToList" :options="requisition_to_list" @input="fetch_requisition_to_info"
                                                                        v-model="selected_requisition_to_edit" >

                                                                  
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
                                                                            <td>@{{ item.code }} - @{{ item.name }}</td>
                                                                            <td>@{{ item.prices.final_cost }}</td>
                                                                            <td>@{{ item.stock }}</td>
                                                                            <td><input type="hidden" v-bind:name="getInputName(index, 'id')" :value="item.id">

                                                                                <input type="number" class="form-control" v-model="selected_items[index].quantity" v-bind:name="getInputName(index, 'quantity')" required="required" v-on:keyup="countTotals"></td>
                                                                            <td>@{{ item.last_7_day_sale }}</td>
                                                                            <td>@{{ item.last_30_day_sale }}</td>
                                                                            <td>@{{ selected_items[index].quantity * item.prices.final_cost }}</td>
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
        selected_requisition_id: '{{ $requisition->id }}',
        selected_items: [],
        requisition_to_list : [],
        requisition_from_list : [],
        selected_requisition_from: {
            name : '{{ $requisition->requisition_from_location->name }}',
            id: '{{ $requisition->requisition_from_location->id }}',
        },
        selected_requisition_to: {
            name : '{{ $requisition->requisition_from_location->name }}',
            id: '{{ $requisition->requisition_from_location->id }}',
        },

        selected_requisition_from_edit: {
            label : '{{ $requisition->requisition_from_location->name }}',
            code: '{{ $requisition->requisition_from_location->id }}',
        },
        selected_requisition_to_edit: {
            label : '{{ $requisition->requisition_to_location->name }}',
            code: '{{ $requisition->requisition_to_location->id }}',
        },
        total_item: 0,
        total_qty: 0,
        grand_total: 0,
        reference: '{{ $requisition->reference }}'

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
            let product_id = value.code;
            ref.selected_item_buy = {};
            axios.post('/api/item/info', {'id':product_id}).then(function(response){
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
            axios.post('/api/location/list',{'search':search}).then(function(response){
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
            axios.post('/api/location/info', {'id':store_id}).then(function(response){

                ref.selected_requisition_to.id = response.data[0].id;
                ref.selected_requisition_to.name = response.data[0].name;
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
            for (var i = 0; i < countable_list.length; i++) {
                if(!counted_elements.includes(countable_list[i].code )){
                    counted_elements.push(countable_list[i].code);
                    ref.total_item = ref.total_item + 1;
                }

                if(countable_list[i].quantity == ''){
                    countable_list[i].quantity = 0;
                }
                ref.total_qty = parseInt(ref.total_qty) + parseInt(countable_list[i].quantity);
                ref.grand_total = (ref.grand_total + (countable_list[i].quantity * countable_list[i].prices.final_cost));
            }

        },
        getInputName: function(index, dataName){
          return "requisition_items["+index+"]["+dataName+"]";
        },
        autoGenerateRef: function(){
            let ref = this;
            if (ref.reference == '') {
            ref.reference =  'req_'+Date.now();
            }

        },
        edit_selected_requisitions: function(){
            let ref = this;
            let requisition_id = ref.selected_requisition_id;
            axios.post('/api/requisition/items/by/id', {'id': requisition_id}).then(function(resposne){
                let requisition_items = resposne.data.requisition_items;
                ref.selected_items = [];
                for (var i = 0; i < requisition_items.length; i++) {

                   requisition_items[i].item.quantity = requisition_items[i].quantity;
                    ref.selected_items.push(requisition_items[i].item);
                }
                console.log(ref.selected_items);
                ref.countTotals();
            });
        } 

    },
    created: function(){
        this.autoGenerateRef();
        this.edit_selected_requisitions();
    }

});

$('#datetimepicker').datetimepicker();
    
</script>
@endpush