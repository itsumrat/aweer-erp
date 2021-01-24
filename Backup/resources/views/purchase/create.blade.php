@extends('layouts/app')

@section('title', 'Dashboard - Purchase Order Create')

@section('main_content')

        <main class="page-content" id="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h5>purchase order</h5>
                            </div>
                                                      @if(session('success'))
                                                <h1 class="text-success">{{session('success')}}</h1>
                                            @endif
                                            @if(session('error'))
                                                 <h1 class="text-danger">{{session('error')}}</h1>
                                            @endif
                            <div class="card-body">
                                <form method="post" action="{{ route('purchase.store') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-12">
                                            <div style="padding: 1rem;background-color: #f1f1f1;">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label>Date</label>
                                                            <input id="datetimepicker" type="text" class="form-control" name="date" autocomplete="off" value="{{ date('Y/m/d h:m:s') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label>Requisition Date</label>
                                                            <input id="requisitiondate" type="text" class="form-control" name="requisition_date" autocomplete="off" value="{{ date('Y/m/d h:m:s') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label>Vendor Confirm Date</label>
                                                            <input id="vendordate" type="text" class="form-control" name="vendor_confirm_date" autocomplete="off" value="{{ date('Y/m/d h:m:s') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label>Shipping Date</label>
                                                            <input id="shippingdate" type="text" class="form-control" name="shipping_date" autocomplete="off" value="{{ date('Y/m/d h:m:s') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label>Reference</label>
                                                            <input type="text" v-model="reference" class="form-control" readonly="" name="reference">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="hidden" name="location_id" v-model="selected_location.id">
                                                        <div class="form-group">
                                                            <label>Location</label>
                                                                      <v-select @search="fetch_location_list" :options="location_list" @input="fetch_location_info" >

                                                                 
                                                                        </v-select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label>Status</label>
                                                            <select class="form-control" name="status">
                                                                <option value="0">Draft</option>
                                                                <option value="1">Final</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label>Attach Document</label>
                                                        <div class="input-group mb-3">
                                                            <div class="custom-file">
                                                                <input name="document" type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                                                                <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 mt-1">
                                            <div style="padding: 1rem;background-color: #f1f1f1;">
                                                <div class="row">
                                                    <div class="col-md-7">
                                                        <label>Vendor*</label>
                                                        <input type="hidden" name="vendor_id" v-model="selected_vendor.id">
                                                        <div class="form-group">
                                                            <v-select @search="fetch_vendor_list" :options="vendor_list" @input="fetch_vendor_info" >

                                                            
                                                                        </v-select>
                                                        </div>
                                                        <div class="row">
                                                            <div class="input-group input-group-sm col-4">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">Discount Term</span>
                                                                </div>
                                                                <input type="text" class="form-control" v-model="selected_vendor.discount" readonly="">
                    
                                                            </div>
                                                            <div class="input-group input-group-sm col-4">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">Payment Term</span>
                                                                </div>
                                                                <input type="text" class="form-control" :value="showvendor" readonly="">
                                                            </div>
                                                            <div class="input-group input-group-sm col-4">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">Vendor Type</span>
                                                                </div>
                                                                <input type="text" class="form-control" v-model="selected_vendor.type" readonly="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <label for="chkPassport">
                                                            <input type="checkbox" id="chkPassport" name="is_foc" />
                                                            Any FOC?
                                                        </label>
                                                        
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
                                                                    <th>Last GRN Cost</th>
                                                                    <th>Final Cost</th>
                                                                    <th>Quantity</th>
                                                                    <th>Discount</th>
                                                                    <th>Subtotal(AED)</th>
                                                                    <th><i class="far fa-trash-alt"></i></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr v-for="(item, index) in selected_items">
                                                                    <td>@{{ item.code }} - @{{ item.name }}</td>
                                                                    <td>@{{ item.prices.last_grn_cost }}</td>
                                                                    <td>
                                                                    
                                                                        <input class="form-control" type="text" v-bind:name="getInputName(index, 'cost')" v-model="selected_items[index].prices.final_cost" readonly>
                                                                    </td>
                                                                    <td>
                                                                        <input type="hidden" v-bind:name="getInputName(index, 'id')" v-model="item.id">

                                                                        <input type="number" class="form-control" v-model="selected_items[index].quantity" v-bind:name="getInputName(index, 'quantity')" required="required" v-on:keyup="countTotals"></td>
                                                                    <td><input type="number" class="form-control" v-model="selected_items[index].discount" v-bind:name="getInputName(index, 'discount')" required="required" v-on:keyup="countTotals" value="0"></td>
                                                                    <td>@{{ (selected_items[index].quantity * item.prices.final_cost) - (((selected_items[index].quantity * item.prices.final_cost)*selected_items[index].discount)/100) }}</td>
                                                                    <td><a v-on:click="removeItemFromList(item.id)"><i class="far fa-window-close"></i></a></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <div id="dvPassport" style="display: none; width: 60%;">
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"><i class="fas fa-barcode"></i></span>
                                                                </div>
                                                                <v-select @search="fetchFOCItems" :options="item_foc_info" @input="fetch_foc_item_info" />
                                                            </div>
                                                            <table id="adjustment-addition" class="table table-striped table-bordered mt-2" style="width:100%">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Item name (Item code)</th>
                                                                        <th>Cost</th>
                                                                        <th>Qty</th>
                                                                        <th><i class="far fa-trash-alt"></i></th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr v-for="(item, index) in selected_foc_items">
                                                                        <td>@{{ item.code }} - @{{ item.name }}</td>
                                                                    <td>@{{ item.prices.final_cost }}</td>
                                                                    {{-- <td> --}}
                                                                        
                                                                        <td><input type="hidden" v-bind:name="getInputNameFOC(index, 'id')" v-model="item.id">

                                                                            <input type="number" class="form-control" v-bind:name="getInputNameFOC(index, 'quantity')"></td>
                                                                        <td><a v-on:click="removeFOCItemFromList(item.id)"><i class="far fa-window-close"></i></a></td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <div class="col-2 float-right">
                                                            <div class="input-group input-group-sm">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">Discount</span>
                                                                </div>
                                                                <input type="text" class="form-control" v-model="overall_discount" v-on:keyup="countTotals" name="discount">
                                                            </div>
                                                            <div class="input-group input-group-sm mt-3">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">Tax</span>
                                                                </div>
                                                                <input type="text" class="form-control" v-model="tax" v-on:keyup="countTotals" name="tax">
                                                            </div>
                                                        </div>
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
    props: ['showvendor'],
    data: {
        item_info: [],
        selected_items: [],
        item_foc_info: [],
        selected_foc_items: [],
        location_list : [],
        selected_location: {},

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
            });
            }

        },
        fetch_item_info: function(value){
            let ref = this;
            let product_id = value.code;
            ref.selected_item_buy = {};
            let location_id = '';
            if(Object.keys(ref.selected_location).length == 0){
                alert("Please Select Location First");
                return;
            }else{
            location_id = ref.selected_location.id;
            }
            
            axios.post("{{url('/api/item/info')}}", {'id':product_id, 'location_id':location_id}).then(function(response){
                // ref.selected_item_buy.id = response.data.id;
                // ref.selected_item_buy.cost = response.data.prices.final_cost;
                // ref.selected_item_buy.markup = response.data.prices.markup + ' %';
                // ref.selected_item_buy.price = response.data.prices.final_price;
                let data = response.data;
                data.quantity = 1;
                data.discount = 0;
                // console.log(ref.selected_item_buy);
                ref.selected_items.push(data);
                ref.countTotals();
            });

        },
// FOC

        fetchFOCItems: function(search, loading){
            let ref = this;

            if(search != ''){
            axios.post("{{url('/api/item/list')}}",{'search':search}).then(function(response){
                ref.item_foc_info = response.data.results;
            });
            }

        },
        fetch_foc_item_info: function(value){
            let ref = this;
            let product_id = value.code;
            ref.selected_item_buy = {};
            axios.post("{{url('/api/item/info')}}", {'id':product_id}).then(function(response){
                // ref.selected_item_buy.id = response.data.id;
                // ref.selected_item_buy.cost = response.data.prices.final_cost;
                // ref.selected_item_buy.markup = response.data.prices.markup + ' %';
                // ref.selected_item_buy.price = response.data.prices.final_price;
                let data = response.data;
                data.quantity = 1;
                data.discount = 0;
                // console.log(ref.selected_item_buy);
                ref.selected_foc_items.push(data);
                // ref.countTotals();
            });

        },
        removeFOCItemFromList: function(id){
            let ref = this;
            ref.selected_foc_items = ref.selected_foc_items.filter(function(item){
                return item.id != id; 
                
            });
            // ref.countTotals();
        },

// End Foc




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
            console.log(value);
            let store_id = value;
            axios.post("{{url('/api/vendor/info')}}", {'id':store_id}).then(function(response){

                ref.selected_vendor.id = response.data[0].id;
                ref.selected_vendor.name = response.data[0].name;
                ref.selected_vendor.discount = response.data[0].discount;
                ref.selected_vendor.payment_term = response.data[0].payment_term;
                ref.selected_vendor.type = response.data[0].type;
                ref.showvendor = response.data[0].payment_term;
                
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
                tot = tot - (tot * countable_list[i].discount)/100;
                tot = tot - (tot * ref.overall_discount)/100;
                tot = tot + (tot * ref.tax)/100;
                ref.grand_total = tot;
            }

        },
        getInputName: function(index, dataName){
          return "purchase_order_items["+index+"]["+dataName+"]";
        },
        getInputNameFOC: function(index, dataName){
          return "foc_items["+index+"]["+dataName+"]";
        },
        autoGenerateRef: function(){
            let ref = this;
            axios.post("{{url('/api/reference/generate')}}", {'table':'purchases', 'refcode':'LPO'}).then(function(response){
                ref.reference = response.data.reference;
            });

        } 

    },
    created: function(){
        this.autoGenerateRef();
    }

});

$('#datetimepicker').datetimepicker();
$('#requisitiondate').datetimepicker();
$('#vendordate').datetimepicker();
$('#shippingdate').datetimepicker();


$("#chkPassport").on('click', function(){
    if($(this).is(':checked')){
         $("#dvPassport").css('display', 'block');
    }else{
        $("#dvPassport").css('display', 'none');
    }

});

</script>
@endpush