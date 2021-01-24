@extends('layouts/app')

@section('title', 'Dashboard - Vegetable Requisition Create')

@section('main_content')
      <main class="page-content" id="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h5>add transfer</h5>
                            </div>
                            <div class="card-body">
                                          @if(session('success'))
                                                <h1 class="text-success">{{session('success')}}</h1>
                                            @endif
                                            @if(session('error'))
                                                 <h1 class="text-danger">{{session('error')}}</h1>
                                            @endif
                                <form method="post" action="{{ route('transfer.store') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-12">
                                            <div style="padding: 1rem;background-color: #f1f1f1;">
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label>Date</label>
                                                            <input id="datetimepicker" type="text" class="form-control" name="date" value="{{ date('Y/m/d h:m:s') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label>Reference No</label>
                                                            <input type="text" class="form-control" readonly="true" v-model="reference" name="reference">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>From</label>
                                                            <input type="hidden" name="transfer_from" v-model="from_location.id">
                                                            <!-- <input type="text" class="form-control" readonly="true" value="6016-Aweer Fruits & Vegetable Shop"> -->
                                                            <v-select @search="fetch_location_list" :options="location_list" @input="fetch_from_location_info" >

</v-select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <input type="hidden" name="transfer_to" v-model="to_location.id">
                                                        <div class="form-group">
                                                            <label>To</label>
                                                                      <v-select @search="fetch_location_list" :options="location_list" @input="fetch_to_location_info" >
                                                                        </v-select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label>Status</label>
                                                            <select class="form-control" name="status">
                                                                <option value="1">Sent</option>
                                                                <option value="2">Received</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label>Attach Document</label>
                                                        <div class="input-group mb-3">
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" name="document">
                                                                <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 mt-1">
                                            <div style="padding: 1rem;background-color: #f1f1f1">
                                                <div class="row">
                                                    <div class="col-9">
                                                        <label>Select item</label>
                                                        <div class="input-group flex-nowrap">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="addon-wrapping"><i class="fas fa-barcode"></i></span>
                                                            </div>
                                                            <v-select @search="fetchItems" :options="item_info" @input="fetch_item_info" />
                                                        </div>
                                                    </div>
                                                    <div class="col-10 mt-3">
                                                        <table id="adjustment-addition" class="table table-striped table-bordered" style="width:100%">
                                                            <thead>
                                                                <tr>
                                                                    <th>Item name (Item code)</th>
                                                                    <th>Net Unit Cost</th>
                                                                    <th>Quantity</th>
                                                                    <th>Subtotal(AED)</th>
                                                                    <th><a href="#"><i class="far fa-trash-alt"></i></a></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr v-for="(item,index) in selected_items">
                                                                    <td>@{{ item.product_pricing.code }} - @{{ item.product_pricing.name }}</td>
                                                                    <td>@{{ item.final_cost }}</td>
                                                                    <td><input type="hidden" v-bind:name="getInputName(index, 'id')" v-model="item.id">
                                                                    <input type="hidden" v-bind:name="getInputName(index, 'barcode')" v-model="item.barcode">
                                                                        <input type="number" class="form-control" v-model="selected_items[index].quantity" v-bind:name="getInputName(index, 'quantity')" required="required" v-on:keyup="countTotals"></td>
                                                                    <td>@{{ item.final_cost * selected_items[index].quantity }}</td>
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
        </main>
      
@endsection

@push('js_script')

<script>

Vue.component('v-select', VueSelect.VueSelect);
const app = new Vue({
    el: '#page-content',
    data: {
        item_info: [],
        selected_items: [],
        location_list : [],
        // selected_location: {},
        from_location: {},
        to_location: {},

        vendor_list : [],
        selected_vendor: {},

        total_item: 0,
        overall_discount: 0,
        tax: 0,
        total_qty: 0,
        grand_total: 0,
        reference: '{{ old('reference') }}'

    },
    methods:{
        fetchItems: function(search, loading){
            let ref = this;

            if(search != ''){
            axios.post("{{url('/api/item/list')}}",{'search':search}).then(function(response){
                ref.item_info = response.data.results;
                console.log(ref.item_info);
            });
            }

        },
        fetch_item_info: function(value){
            let ref = this;
            let product_id = value.code;
            ref.selected_item_buy = {};
            axios.post("{{url('/api/item/info')}}", {'id':product_id}).then(function(response){
                // ref.selected_item_buy.id = response.data.id;
                // ref.selected_item_buy.cost = response.data.prices.final_cost;
                // ref.selected_item_buy.markup = response.data.prices.markup + ' %';
                // ref.selected_item_buy.price = response.data.prices.final_price;
                let data = response.data;
                console.log(data);
                data.quantity = 1;
                data.discount = 0;
                // console.log(ref.selected_item_buy);
                ref.selected_items.push(data);
                ref.countTotals();
            });

        },
        fetch_location_list: function(search, loading){
            let ref = this;

            if(search != ''){
            axios.post("{{url('/api/location/list')}}",{'search':search}).then(function(response){
                ref.location_list = response.data.results;
            });
            }
        },
        fetch_from_location_info: function(value){
            let ref = this;
            let store_id = value;
            axios.post("{{url('/api/location/info')}}", {'id':store_id}).then(function(response){

                ref.from_location.id = response.data[0].id;
                ref.from_location.name = response.data[0].name;
            });
        },
        fetch_to_location_info: function(value){
            let ref = this;
            let store_id = value;
            axios.post("{{url('/api/location/info')}}", {'id':store_id}).then(function(response){

                ref.to_location.id = response.data[0].id;
                ref.to_location.name = response.data[0].name;
            });
        },


        fetch_vendor_list: function(search, loading){
            let ref = this;

            if(search != ''){
            axios.post("{{url('/api/vendor/list')}}",{'search':search}).then(function(response){
                ref.vendor_list = response.data.results;
            });
            }
        },
        fetch_vendor_info: function(value){
            let ref = this;

            let store_id = value;
            axios.post("{{url('/api/vendor/info')}}", {'id':store_id}).then(function(response){

                ref.selected_vendor.id = response.data[0].id;
                ref.selected_vendor.name = response.data[0].name;
                ref.selected_vendor.discount = response.data[0].discount;
                ref.selected_vendor.payment_term = response.data[0].payment_term;
                ref.selected_vendor.type = response.data[0].type;
                
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
            let tot = 0;
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

                tot = (ref.grand_total + (countable_list[i].quantity * countable_list[i].final_cost));
                // tot = tot - (tot * countable_list[i].discount)/100;
                // tot = tot - (tot * ref.overall_discount)/100;
                // tot = tot + (tot * ref.tax)/100;
                ref.grand_total += tot;
            }

        },
        getInputName: function(index, dataName){
          return "transfer_items["+index+"]["+dataName+"]";
        },
        autoGenerateRef: function(){
            let ref = this;
            axios.post("{{url('/api/reference/generate')}}", {'table':'transfers', 'refcode':'TRN'}).then(function(response){
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