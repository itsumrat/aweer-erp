@extends('layouts/app')

@section('title', 'Dashboard - LPO Receive Create')

@section('main_content')

      <main class="page-content" id="page-content">
                                <form action="{{ route('lpo_receive.store') }}" method="POST">
                                    @csrf

            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h5>Receive LPO</h5>
                            </div>
                            <div class="card-body">
                                          @if(session('success'))
                                                <h1 class="text-success">{{session('success')}}</h1>
                                            @endif
                                            @if(session('error'))
                                                 <h1 class="text-danger">{{session('error')}}</h1>
                                            @endif



                                    <input type="hidden" name="reference_no" value="{{ $reference_no }}">
                                    <input type="hidden" name="vendor_invoice_no" value="{{ $vendor_invoice_no }}">
                                    <div class="row">
                                        <div class="col-12">
                                            <div style="padding: 1rem;background-color: #f1f1f1;">
                                                <div class="row">
                                                    <div class="col-md-9 col-sm-12">
                                                        <div class="form-group">
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
                                                            <input type="text" class="form-control" v-model="selected_item.code">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label>Unit Cost</label>
                                                            <input type="text" class="form-control" v-model="selected_item.unit_cost">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label>Quantity</label>
                                                            <input type="text" class="form-control" v-model="selected_item.purchase.quantity" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label>Discount</label>
                                                            <input type="text" class="form-control" v-model="selected_item.purchase.discount" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label>Shelf Life</label>
                                                            <input type="text" class="form-control" name="shelf_life">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label>Expiry Date</label>
                                                            <input id="datetimepicker" type="text" class="form-control" name="exipre_date">
                                                        </div>
                                                    </div>
                                                    <input type="hidden" name="receiveditem" :value="selected_items">
                                                    <div class="col-md-3">
                                                         <button type="button" class="btn btn-primary mt-4" v-on:click="send_item">Send</button>
                                                    </div>

                                                    <div class="col-12">
                                                       

                                                        <button type="submit" class="btn btn-success mt-4">Finish</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12 mt-3">
                                            <table class="table table-striped table-bordered" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>Date</th>
                                                        <th>Reference</th>
                                                        <th>Payment date</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>{{ $dates['current_date'] }}</td>
                                                        <td><input class="form-control" type="text" name="reference" :value="reference" readonly></td>
                                                        <td>{{ $dates['payment_date'] }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                
                            </div>
                            <div class="card-body">
                                <h5>Purchase Order</h5>
                                <div class="row">
                                    <div class="col-12 mt-1">
                                        <div style="padding: 1rem;background-color: #f1f1f1;">
                                            <div class="row">
                                                <div class="col-md-7">
                                                    <div class="form-group">
                                                        <label>Vendor</label>
                                                        <input type="text" class="form-control" value="{{ $purchase->vendor->name }}" readonly>
                                                    </div>
                                                    <div class="row">
                                                        <div class="input-group input-group-sm col-md-4">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">Discount Term</span>
                                                            </div>
                                                            <input type="text" class="form-control" value="{{ $purchase->vendor->discount . '%' }}" readonly="">
                                                        </div>
                                                        <div class="input-group input-group-sm col-md-4">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">Payment Term</span>
                                                            </div>
                                                            <input type="text" class="form-control" value="{{ $purchase->vendor->payment_term }}" readonly="">
                                                        </div>
                                                        <div class="input-group input-group-sm col-md-4">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">Vendor Type</span>
                                                            </div>
                                                            <input type="text" class="form-control" value="Principle" readonly="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
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
                                                                <td><input type="number" class="form-control" :value="selected_item.purchase.cost" v-bind:name="getInputName(index, 'cost')" readonly ></td>
                                                                <td><input type="number" class="form-control" :value="selected_item.purchase.quantity" v-bind:name="getInputName(index, 'quantity')" readonly ></td>
                                                                <td><input type="number" class="form-control" :value="selected_item.purchase.discount" v-bind:name="getInputName(index, 'discount')" readonly></td>
                                                                <td>@{{ (selected_items[index].purchase.quantity * selected_item.prices.final_cost) - (((selected_items[index].purchase.quantity * selected_item.prices.final_cost)*selected_items[index].purchase.discount)/100) }}</td>
                                                               {{--  <td><a href="#"><i class="far fa-window-close"></i></a></td> --}}
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <div class="col-md-2 float-right">
                                                        <div class="input-group input-group-sm">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" >Discount</span>
                                                            </div>
                                                            <input type="text" class="form-control" v-model="overall_discount" v-on:keyup="countTotals">
                                                        </div>
                                                        <div class="input-group input-group-sm mt-3">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" >Tax</span>
                                                            </div>
                                                            <input type="text" class="form-control" v-model="tax" v-on:keyup="countTotals">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="total-requision mt-2">
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                              <td>Total Items <span>@{{ total_item }}</span></td>
                                              <td>Total Quantity <span>@{{ total_qty }}</span></td>
                                              {{-- <td>Grand Total <span><input type="text" value="@{{ grand_total }}"></span></td> --}}
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
        </form>
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
            purchase:{
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
        purchase_id: {{ $purchase->id }}

    },
    methods:{
        fetchItems: function(search, loading){
            let ref = this;

            if(search != ''){
            axios.post("{{ url('/api/item/list') }}",{'search':search}).then(function(response){
                ref.item_info = response.data.results;
            });
            }

        },
        fetch_item_info: function(value){
            let ref = this;
            let product_id = value.code;
            ref.selected_item = {};
            axios.post("{{ url('/api/item/info/with/purchase') }}", {'id':product_id, 'purchase_id': ref.purchase_id}).then(function(response){
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
            axios.post("{{ url('/api/check/item/in/purchase') }}",{'item_id':id, 'purchase_id': ref.purchase_id}).then(function(response){
                
                if (response.data == 1) {
                    console.log("in");
                    ref.selected_items.push(ref.selected_item);
                    ref.countTotals();
                }else{
                    // ref.selected_items.push(ref.selected_item);
                    // ref.countTotals();
                    alert("This item is not listed in this purchase");
                }
        ref.selected_item =  {
                    purchase:{
                        discount:0,
                        quantity:0
                    }
                };
            }); 

        },
        fetch_location_list: function(search, loading){
            let ref = this;

            if(search != ''){
            axios.post("{{ url('/api/location/list') }}",{'search':search}).then(function(response){
                ref.location_list = response.data.results;
            });
            }
        },
        fetch_location_info: function(value){
            let ref = this;
            let store_id = value;
            axios.post("{{ url('/api/location/info') }}", {'id':store_id}).then(function(response){

                ref.selected_location.id = response.data[0].id;
                ref.selected_location.name = response.data[0].name;
            });
        },


        fetch_vendor_list: function(search, loading){
            let ref = this;

            if(search != ''){
            axios.post("{{ url('/api/vendor/list') }}",{'search':search}).then(function(response){
                ref.vendor_list = response.data.results;
            });
            }
        },
        fetch_vendor_info: function(value){
            let ref = this;

            let store_id = value;
            axios.post("{{ url('/api/vendor/info') }}", {'id':store_id}).then(function(response){

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
            console.log(countable_list);
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

                if(countable_list[i].purchase.quantity == ''){
                    countable_list[i].purchase.quantity = 0;
                }
                ref.total_qty = parseInt(ref.total_qty) + parseInt(countable_list[i].purchase.quantity);

                tot = parseFloat(ref.grand_total) + (parseInt(countable_list[i].purchase.quantity) * parseFloat(countable_list[i].prices.final_cost));

                tot = tot - (tot * parseFloat(countable_list[i].purchase.discount))/100;
                tot = tot - (tot * parseFloat(ref.overall_discount))/100;
                tot = tot + (tot * parseFloat(ref.tax))/100;

                ref.grand_total += tot;
            }

        },
        getInputName: function(index, dataName){
          return "received_items["+index+"]["+dataName+"]";
        },
        autoGenerateRef: function(){
            let ref = this;
            axios.post("{{ url('/api/reference/generate') }}", {'table':'lpo_receives', 'refcode':'GRN'}).then(function(response){
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