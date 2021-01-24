<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link rel='stylesheet' type="text/css" href='{{ asset("assets/css/bootstrap.css") }}'>
    <link rel='stylesheet' type="text/css" href='{{ asset("assets/css/all.min.css") }}'>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/jquery.datetimepicker.min.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/styles.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    <link rel="shortcut icon" href="{{ asset('fav-green.png') }}">
    {{--<link rel="stylesheet" href="https://unpkg.com/vue-rangedate-picker/dist/vue-rangedate-picker.css" /> --}}
    
{{--     <script type="text/javascript" src="https://unpkg.com/vue-select@latest"></script>
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/vue-select@latest/dist/vue-select.css">

 --}}
 <script type="text/javascript" src="{{ asset('js/vue-select.js') }}"></script>
<link rel="stylesheet" type="text/css" href="{{ asset('css/vue-select.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="page-wrapper chiller-theme toggled">
@include('partials/sidebar')
        <!-- sidebar-wrapper  -->
@include('partials/header')
        {{-- Item Track LPO Modal --}}
        <div class="modal modalLpo fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title text-warning text-center" id="exampleModalLabel">Warning</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <p class="text-danger text-center">This reference id already received!</p>
              </div>
            </div>
          </div>
        </div>
        <div class="modal fade" id="itemTrackModal" tabindex="-1" role="dialog" aria-labelledby="itemTrackModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="itemTrackModalLabel">Item Track</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="get" action="{{ route('lpo_receive.create') }}">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Reference No</label>
                                    <input type="text" class="form-control" name="reference_no" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Vendor Invoice No</label>
                                    <input type="text" class="form-control" name="vendor_invoice_no" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary mt-4">Send</button>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>


        <!--Item Track TRN Modal-->
        <div class="modal fade" id="shopTrackModal" tabindex="-1" role="dialog" aria-labelledby="shopTrackModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="shopTrackModalLabel">Shop Track</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="get" action="{{ route('tnt_receive.create') }}">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Reference No</label>
                                    <input type="text" class="form-control" name="reference_no" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Shop Code</label>
                                    <input type="text" class="form-control" name="shop_code" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary mt-4">Send</button>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
@yield('main_content')

       
      <!-- page-content" -->
      
</div>
    <!-- page-wrapper -->
    {{--
    <script type="text/javascript" src='{{ asset("assets/js/popper.js") }}'></script>
    <script type="text/javascript" src='{{ asset("assets/js/bootstrap.js") }}'></script>

    <script type="text/javascript" src='{{ asset("assets/js/jquery-3.4.1.min.js") }}'></script>
    --}}
    
    <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.0/moment-with-locales.min.js"></script>
    <script type="text/javascript" src='{{ asset("assets/js/all.min.js") }}'></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript" src="{{ asset('assets/js/select2.min.js') }}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
    <script type="text/javascript" src="{{ asset('assets/js/jquery.datetimepicker.full.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/rainbow-custom.min.js') }}"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script type="text/javascript" src="{{ asset('assets/js/script.js') }}"></script>
    
@stack('js_script')
<script>
    var msg = '{{Session::get('warningss')}}';
    var exist = '{{Session::has('warningss')}}';
    if(exist){
      $('.modalLpo').modal('show');
    }
</script>
</body>
</html>