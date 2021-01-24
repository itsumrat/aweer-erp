@extends("layouts.app")

@section("title", "Aweer Inventory - Department")


@section("main_content")
      <main class="page-content" id="adjustment">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h5>Add Adjustment</h5>
                            </div>
                            <div class="card-body">
                            @if(session('success'))
                                                <h1 class="text-success">{{session('success')}}</h1>
                                            @endif
                                            @if(session('error'))
                                                 <h1 class="text-danger">{{session('error')}}</h1>
                                            @endif
                                <form method="post" action="{{ route('adjustment.store') }}" enctype='multipart/form-data'>
                                	@csrf

                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Date</label>
                                                <input id="datetimepicker" type="text" class="form-control" name="date" required="" autocomplete="off" value="{{ date('Y/m/d h:m:s') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Reference</label>
                                                <input type="text" class="form-control" name="reference" v-model="reference" readonly="readonly">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                        	<input type="hidden" name="location" :value="selected_location.id">
                                            <div class="form-group">
                                                <label>Location*</label>
                                                <v-select :options="location_list" @input="fetch_location_info" location>
                                                	  
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
                                                    <v-select @search="fetchItems" :options="item_info" @input="fetch_product_info" >
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
                                                            <select class="custom-select" id="inputGroupSelect04" v-model="selected_item.unit_id" name="unit_id" readonly>
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
                                            <textarea class="form-control" rows="3" name="note"></textarea>
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
        	id: '',
            name:'',
            quantity: '',
            unit_id: ''
        },
        selected_item_info:[
        ],
        new_price: '',
        reference: '',
        location_list: [],
        selected_location: {
            id: '',
            name: ''
        },

    },
    methods:{
        
        fetchItems: function(search, loading){
            let ref = this;
            console.log(search);
            axios.post("{{ url('/api/item/list') }}",{'search':search}).then(function(resposne){
                let data = resposne.data;
                console.log(data);
                if(data.status == 1){
                ref.selected_item.id = data.product_info.id;
                ref.selected_item.name = data.product_info.name;
                }else{
                    ref.item_info = resposne.data.results;
                }
            });
        },

        fetchInitItems: function(){
            let ref = this;
<<<<<<< HEAD
            axios.get("{{ url('/api/item/list/init') }}") .then(function(resposne){
=======
            axios.get("{{ url('/api/item/list/init') }}").then(function(resposne){
>>>>>>> 68468ee42c4386f21838f4a24cc617bd22f6d722
                ref.item_info = resposne.data.results;
            });
        },
        fetch_unit: function(){
            var ref = this;
            ref.units = null;
            let url = "{{ url('/api/unit/list') }}";
            axios.get(url).then(function(resposne){
                ref.units = resposne.data; 
            });

        },

        fetch_product_info: function(value){
            let ref = this;
            let product_id = value.code;
            axios.post("{{ url('/api/item/info') }}", {'id':product_id}).then(function(resposne){
                
                ref.selected_item.id = resposne.data.id;
                ref.selected_item.name = resposne.data.name;
                ref.selected_item.unit_id = resposne.data.unit_id;
                
            });

        },
        fetchLocation: function(){
            let ref = this;
            axios.get("{{ url('/api/location/list/init') }}").then(function(resposne){
                ref.location_list = resposne.data.results;
            });
        },
        fetch_location_info: function(value){
            let ref = this;
            let store_id = value;
            axios.post("{{ url('/api/location/info') }}", {'id':store_id}).then(function(resposne){
                ref.selected_location.id = resposne.data[0].id;
                ref.selected_location.name = resposne.data[0].name;
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
            axios.post("{{ url('/api/reference/generate') }}", {'table':'adjustments', 'refcode':'ADJ'}).then(function(response){
                ref.reference = response.data.reference;
            });

        } 
    },
    created: function(){
        this.fetchInitItems();
        this.fetchLocation();
        this.fetch_unit();
        this.autoGenerateRef();

    },
});

// var dateNow = new Date();
$('#datetimepicker').datetimepicker();

</script>
@endpush
