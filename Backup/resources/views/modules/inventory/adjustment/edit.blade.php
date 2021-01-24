@extends("layouts.app")

@section("title", "Aweer Inventory - Department")


@section("main_content")
      <main class="page-content" id="adjustment">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h5>Edit Adjustment</h5>
                            </div>
                            <div class="card-body">
                            @if(session('success'))
                                                <h1 class="text-success">{{session('success')}}</h1>
                                            @endif
                                            @if(session('error'))
                                                 <h1 class="text-danger">{{session('error')}}</h1>
                                            @endif
                                <form method="post" action="{{ route('adjustment.update', $adjustment->id) }}" enctype='multipart/form-data'>
                                	@csrf
                                    @method('PUT')

                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Date</label>
                                                <input id="datetimepicker" type="text" class="form-control" name="date" required="" autocomplete="off" value="{{ $adjustment->date }}">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Reference</label>
                                                <input type="text" class="form-control" name="reference" value="{{ $adjustment->reference }}" readonly="readonly">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                        	<input type="hidden" name="location" v-model="selected_location.id">
                                            <div class="form-group">
                                                <label>Location*</label>
                                                <v-select :options="location_list" @input="fetch_location_info" v-model="selected_location">
                                                	  
                                                </v-select>
                                                
                                                @error('location')
                                                                    <p class="text-danger">{{ $message }}</p>
                                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label>Attach Document</label>
                                                <input type="file" class="form-control" name="doc_file">
                                            </div>
                                        </div> <br>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label>Item</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-barcode"></i></span>
                                                    </div>
                                                    <v-select @search="fetchItems" :options="item_info" @input="fetch_product_info" v-model="selected_item_info">
                                                	  <template #search="{attributes, events}">
													    <input
													      class="vs__search"
													      :required="!selected_item.id"
													      v-bind="attributes"
													      v-on="events"
													    />
													  </template>
                                                    </v-select>
                                                                    @error('items')
                                                                    <p class="text-danger">{{ $message }}</p>
                                                                @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-9">
                                            <table id="adjustment-addition" class="table table-striped table-bordered" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>Item name</th>
                                                        <th>Unit</th>
                                                        <th>Quantity</th>
                                                        <th><a href="#"><i class="far fa-trash-alt"></i></a></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>@{{ selected_item.name }}
                                                        	<input type="hidden" name="product_id" v-model="selected_item.id">
                                                        </td>
                                                        <td>
                                                            <select class="custom-select" id="inputGroupSelect04" v-model="selected_item.unit_id" name="unit_id" required="required">
                                                                <option selected>Choose...</option>
                                                                 <option v-for="unit in units" :key="unit.id" :value="unit.id">@{{ unit.name }}</option>
                                                            </select>
                                                            <input type="hidden" name="unit_id" v-model="selected_item.unit_id">
                                                        </td>
                                                        <td><input type="number" class="form-control" v-model="selected_item.quantity" name="quantity" required="required"></td>
                                                        <td><a href="#"><i class="far fa-window-close"></i></a></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-md-6">
                                            <h5>Note</h5>
                                            <textarea class="form-control" rows="3" name="note"> {{ $adjustment->note }} </textarea>
                                        </div>
                                    </div>
                                    <div>
                                        <button type="submit" class="btn btn-primary btn-draft mt-3">draft</button>
                                        <button type="submit" class="btn btn-primary mt-3">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

@endsection


@push("js_script")
<script>


Vue.component('v-select', VueSelect.VueSelect);

const app = new Vue({
    el: '#adjustment',
    data: {
        item_info: [],
        units:{},
        selected_item: {
        	id: {{ $adjustment->product->id }},
            name:'{{ $adjustment->product->name }}',
            quantity: {{ $adjustment->quantity }},
            unit_id: {{ $adjustment->unit_id }}
        },
        selected_item_info:{
            id: {{ $adjustment->product->id }},
            label: '{{ $adjustment->product->name }}'
        },
        new_price: '',
        reference: '',
        location_list: [],
        selected_location: {
            id: {{ $adjustment->store->id }},
            label: '{{ $adjustment->store->name }}'
        },

    },
    methods:{
        
        fetchItems: function(search, loading){
            let ref = this;
            console.log(search);
            axios.post('/api/item/list',{'search':search}).then(function(resposne){
                ref.item_info = resposne.data.results;
            });
        },

        fetchInitItems: function(){
            let ref = this;
            axios.get('/api/item/list/init').then(function(resposne){
                ref.item_info = resposne.data.results;
            });
        },
        fetch_unit: function(){
            var ref = this;
            ref.units = null;
            let url = '/api/unit/list';
            axios.get(url).then(function(resposne){
                
                ref.units = resposne.data; 
            });


        },

        fetch_product_info: function(value){
            let ref = this;
            let product_id = value.code;
            axios.post('/api/item/info', {'id':product_id}).then(function(resposne){
                ref.selected_item.id = resposne.data.id;
                ref.selected_item.name = resposne.data.name;
                // ref.selected_item.markup = resposne.data.prices.markup + ' %';
                // ref.selected_item.price = resposne.data.prices.final_price;

            });

        },
        fetchLocation: function(){
            let ref = this;
            axios.get('/api/location/list/init').then(function(resposne){
                ref.location_list = resposne.data.results;
            });
        },
        fetch_location_info: function(value){
            let ref = this;
            let store_id = value;
            axios.post('/api/location/info', {'id':store_id}).then(function(resposne){
                ref.selected_location = {};
                ref.selected_location.id = resposne.data[0].id;
                ref.selected_location.label = resposne.data[0].name;

                console.log(ref.selected_location);
            });
        },

        generateItemPrice: function(field = ''){
            let ref = this;
            if (field == 'markup') {
                if (isNaN(ref.selected_item.new_markup )) {
                    ref.selected_item.new_markup = '';
                    return;
                }
            }

            let total_price = 0;
            total_price = ref.selected_item.cost + ((ref.selected_item.cost * ref.selected_item.new_markup)/100);
            ref.selected_item.new_price = total_price;
           
        },
        removeItem: function(id){
            let ref = this;
            ref.selected_item_info = ref.selected_item_info.filter(function(item){
                return item.id != id; 
            });

            this.generateItemPrice();
        },
        getInputName: function(index, dataName){
          return "items["+index+"]["+dataName+"]";
        },
        autoGenerateRef: function(){
            let ref = this;
            if (ref.reference == '') {
            ref.reference =  'pr_'+Date.now();
            }

            console.log(ref.selected);

        } 
    },
    created: function(){
        this.fetchInitItems();
        this.fetchLocation();
        this.fetch_unit();
        this.autoGenerateRef();

    },
});

var dateNow = new Date();
$('#datetimepicker').datetimepicker({
  useCurrent: false,
  defaultDate: dateNow

});
// $('#datetimepicker').val();
</script>
@endpush
