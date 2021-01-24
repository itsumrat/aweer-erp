@extends('layouts/app')

@section('title', 'Dashboard - Vegetable Requisition Create')

@section('main_content')


        <main class="page-content" id="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h5>Receive TRN</h5>

                            </div>
                            <div class="card-body">
                                          @if(session('success'))
                                                <h1 class="text-success">{{session('success')}}</h1>
                                            @endif
                                            @if(session('error'))
                                                 <h1 class="text-danger">{{session('error')}}</h1>
                                            @endif
                                            
                                <form method="post" action="{{ route('tnt_receive.store') }}">
                                    @csrf



                                    <input type="hidden" name="reference_no" value="{{ $reference_no }}">
                                    <input type="hidden" name="shop_code" value="{{ $shop_code }}">
                                    <div class="row">
                                        <div class="col-12">
                                            <div style="padding: 1rem;background-color: #f1f1f1;">
                                                <div class="row">
                                                    <div class="col-9">
                                                        <div class="form-group">
                                                            <input type="hidden" name="item_id" v-model="selected_item.id">
                                                            <div class="input-group flex-nowrap">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text" id="addon-wrapping"><i class="fas fa-barcode"></i></span>
                                                                </div>
                                                                 <v-select @search="fetchItems" :options="item_info" @input="fetch_item_info" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label>Item Code</label>
                                                            <input type="text" class="form-control" name="item_code" v-model="selected_item.code">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label>Unit Cost</label>
                                                            <input type="text" class="form-control" name="unit_cost" v-model="selected_item.unit_cost">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label>Quantity</label>
                                                            <input type="text" class="form-control" name="quantity" v-model="selected_item.transfer.quantity" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <button type="button" class="btn btn-primary mt-4" v-on:click="send_item">Send</button>
                                                    </div>
                                                    <div class="col-12">
                                                       

                                                       <button type="submit" class="btn btn-success mt-4">Finish</button>
                                                   </div>
                                                </div>
                                                <div class="col-12 mt-1">
                                        <div style="padding: 1rem;background-color: #f1f1f1">

                                            <div class="row">

                                                <div class="col-12">
                                                    <table class="table table-striped table-bordered" style="width:100%">
                                                        <thead>
                                                            <tr>
                                                                <th>Item name (Item code)</th>
                                                                <th>Last GRN Cost</th>
                                                                <th>Final Cost</th>
                                                                <th>Quantity</th>
                                                                <th>Discount</th>
                                                                <th>Subtotal(AED)</th>
                                                                {{-- <th><a href="#"><i class="far fa-trash-alt"></i></a></th> --}}
                                                            </tr>
                                                        </thead>
                                                        <tbody v-if="selected_items.length > 0">
                                                            <tr v-for="(selected_item, index) in selected_items">
                                                                <td>
                                                                <input type="hidden" class="form-control" v-bind:name="getInputName(index, 'id')" :value="selected_item.id">
                                                                @{{ selected_item.code + '-' + selected_item.name}}</td>
                                                                <td>@{{ selected_item.prices.last_grn_cost }}</td>
                                                                <td><input type="number" class="form-control" :value="selected_item.prices.final_cost" v-bind:name="getInputName(index, 'cost')" readonly ></td>
                                                                <td><input type="number" class="form-control" :value="selected_item.transfer.quantity" v-bind:name="getInputName(index, 'quantity')" readonly ></td>
                                                                <td><input type="number" class="form-control" :value="selected_item.transfer.discount" v-bind:name="getInputName(index, 'discount')" readonly></td>
                                                                <td>@{{ (selected_items[index].transfer.quantity * selected_item.prices.final_cost) - (((selected_items[index].transfer.quantity * selected_item.prices.final_cost)*selected_items[index].transfer.discount)/100) }}</td>
                                                               {{--  <td><a href="#"><i class="far fa-window-close"></i></a></td> --}}
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

Vue.component('v-select', VueSelect.VueSelect);
const app = new Vue({
    el: '#page-content',
    data: {
        item_info: [],
        selected_item: {
            transfer:{
                discount:0,
                quantity:0
            }
        },
        selected_items: [],
        location_list : [],
        selected_location: {},

        vendor_list : [],
        selected_vendor: {},

        total_item: 0,
        overall_discount: 0,
        tax: 0,
        total_qty: 0,
        grand_total: 0,
        reference: '{{ old('reference') }}',
        transfer_id: {{ $transfer->id }}

    },
    methods:{
        fetchItems: function(search, loading){
            let ref = this;

            if(search != ''){
            axios.post("{{url('/api/item/list')}}",{'search':search}).then(function(response){
                ref.item_info = response.data.results;
            });
            }

        },
        fetch_item_info: function(value){
            let ref = this;
            let product_id = value.code;
            ref.selected_item = {};
            axios.post("{{ url('/api/item/info/with/transfer') }}", {'id':product_id, 'transfer_id': ref.transfer_id}).then(function(response){
                let data = response.data;
                ref.selected_item = response.data;
                // ref.countTotals();
                ref.selected_item.unit_cost = data.prices.final_cost;
                console.log(ref.selected_item);
            });

        },

        send_item: function(){

            let ref = this;
            let id = ref.selected_item.id;
            axios.post("{{ url('/api/check/item/in/transfer') }}",{'item_id':id, 'transfer_id': ref.transfer_id}).then(function(response){
                
                if (response.data == 1) {
                    console.log("in");
                    ref.selected_items.push(ref.selected_item);
                    ref.countTotals();
                }else{
                    // ref.selected_items.push(ref.selected_item);
                    // ref.countTotals();
                    alert("This item is not listed in this transfer");
                }
                ref.selected_item =  {
                    transfer:{
                        discount:0,
                        quantity:0
                    }
                };
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
        fetch_location_info: function(value){
            let ref = this;
            let store_id = value;
            axios.post("{{url('/api/location/info')}}", {'id':store_id}).then(function(response){

                ref.selected_location.id = response.data[0].id;
                ref.selected_location.name = response.data[0].name;
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

                tot = (ref.grand_total + (countable_list[i].quantity * countable_list[i].prices.final_cost));
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
            axios.post("{{url('/api/reference/generate')}}", {'table':'trn_receives', 'refcode':'GTRN'}).then(function(response){
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