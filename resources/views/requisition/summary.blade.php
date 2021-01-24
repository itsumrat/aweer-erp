@extends('layouts/app')

@section('title', 'Dashboard - Vegetable Requisition Create')

@section('main_content')
        <main class="page-content" id="app">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h5>Requisition Summary</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Select Date Range</label>
                                            <input type="text" name="requisitionSummary-range" class="form-control" v-model="date_range" v-on:change="dateRangeFilter"/>
                                            <div class="content">
                                                <div class="title m-b-md">
                                                    <date-range-picker v-model="dateRange"></date-range-picker>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Select requisition</label>
                                            <select class="form-control" v-on:change="changeType" v-model="requisition_type">
                                                <option hidden >Select any</option>
                                                <option value="1">Vegetables Requisition</option>
                                                <option value="2">DC Requisition</option>
                                                <option value="3">DSD Requisition</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <table id="" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th v-for="column in columns">@{{ column }}</th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="req in summary">
                                            <td v-for="dat in req">@{{ dat }}</td>
                                            
                                        </tr>
                                        
                                    </tbody>
                                </table>
                                <div class="row">
                                    <div class="col-md-9">
                                        <button type="button" class="btn btn-primary btn-draft mt-3"><i class="fas fa-file-download"></i> &nbsp; Download PDF</button>
                                        <button type="button" class="btn btn-primary mt-3"><i class="fas fa-file-download"></i> &nbsp; Download XLS</button>
                                    </div>
                                    <div class="col-md-3">
                                         <button class="btn btn-default float-right border border-secondary" v-on:click="next_page" :disabled="pagination.current * pagination.limit >= pagination.total ">Next</button>
                                        <button class="btn btn-default float-right border border-secondary" v-on:click="previous_page" :disabled="prev==0">Prev</button>
                                       
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        @php $date = date('d/m/Y')  @endphp
@endsection

@push('js_script')

<script>
const app = new Vue({
    // components: { DateRangePicker },
    el: '#app',
    data: {
        summary:[],
        columns:[],
        pagination:{
            current: 1,
            limit: 50,
            total: 0
        },
        prev: 0,
        next: 0,
        date_range:'',
        requisition_type:'',
        //daterange
        dateRange: {
            startDate: {{ $date }},
            endDate: {{ $date }},
        },
    },
    methods:{
        get_data: function(){
            let ref = this;

            console.log("Test");
            axios.post("{{ url('/requisition/summery/data')}}", {'pagination': ref.pagination, 'requisition_type':ref.requisition_type}).then(function(response){
                let data = response.data;
                ref.summary = data.summary;
                ref.columns = data.columns;
                ref.pagination.total = data.total;
                ref.prev = data.prev;
                ref.next = data.next;

                console.log(ref.prev);
              
            });
        },

        next_page: function(){
            let ref = this;
            ref.pagination.current = ref.next;
            ref.get_data();

        },
        previous_page: function(){
            let ref = this;
            ref.pagination.current = ref.prev;
            ref.get_data();
        },
        dateRangeFilter: function(){
            let ref = this;
            console.log(ref.date_range);
        },
        changeType: function(){
            let ref = this;
            ref.get_data();

        }
    },
    created: function(){
        this.get_data();
    }


});
</script>
@endpush