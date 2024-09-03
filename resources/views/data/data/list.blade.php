@extends('layouts.master')

@section('title') Manage @endsection
@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/sweet-alert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('assets/libs/ion-rangeslider/ion-rangeslider.min.css') }}" rel="stylesheet" type="text/css" />
    <style>
        .container_filter .row .col-md-auto button {
            width: 100%;
        }
        @media only screen and (max-width: 767px){
            .container_filter .row .row .col-12:not(:first-child) label {
                display: none;
            }
            .container_filter .row .col-md-auto label {
                display: none;
            }
        }
    </style>
@endsection
@section('content')

@component('components.breadcrumb')
@slot('li_1') Roles @endslot
@slot('title') Manage @endslot
@endcomponent
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-5">List</h4>
                <div class="row">
                    <div class="col-lg-2 mx-auto text-md-right text-center mb-2 mt-2">
                        <a href="{{route('datas.data.new')}}" class="btn btn-primary">Add New</a>
                    </div>
                </div>
                @include('widget/notifications')
                <table  class="table align-middle table-nowrap dt-responsive nowrap w-100 table-striped table-bordered" id="datatable-inline">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Series Name</th>
                            <th>HD No</th>
                            <th>HD Size</th>
                            <th>Available space in GB</th>
                            <th>Occupied space</th>
                            <th>Location</th>
                            <th>Created At</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="container_filter ">
    
    <div class="row mb-2">
        <div class="col">
            <div class="row">
                <div class="col-12 col-md-4 col-sm-12 mb-2">
                    <!-- <h5 class="font-size-14 mb-3"></h5> -->
                    <label for="">Min-Max</label>
                    <input type="text" id="range_02">
                </div>
                <div class="col-12 col-md-2 col-sm-6 mb-2">
                    <label for="">&nbsp;</label>
                    <input type="text" class="form-control series_name" placeholder="Series Name" >
                </div>
                <div class="col-12 col-md-2 col-sm-6 mb-2">
                    <label for="">&nbsp;</label>
                    <input type="text" class="form-control hard_disk_number" placeholder="Hard Disk  Number" >
                </div>
                <div class="col-12 col-md-2 col-sm-6 mb-2">
                    <label for="">&nbsp;</label>
                    <select class="form-control hd_size" >
                        <option value="">Hard disk size</option>
                        @if(!empty($record))
                        @foreach($record as $r)
                        <option value="{{$r->hd_size}}">{{$r->hd_size}}</option>
                        @endforeach
                        @endif
                    </select> 
                </div>
                <div class="col-12 col-md-2 col-sm-6 mb-2">
                    <label for="">&nbsp;</label>
                    <select class="form-control location" >
                        <option value="">Hard Location</option>
                        <option value="Home">Home</option>
                        <option value="Office">Office</option>
                    </select> 
                </div>
            </div>
        </div>
        <div class="col-12 col-md-auto">
            <label class="w-100">&nbsp;</label>
            <button type="button" class="btn btn-light  btn-label search">
                <i class="bx bx-search-alt-2 label-icon "></i> Search
            </button>
        </div>
    </div>
    
</div>
@endsection

@section('script')
 <!-- Required datatable js -->
<script src="{{ URL::asset('assets/libs/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/sweet-alert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('assets/plugins/sweet-alert2/jquery.sweet-alert2.init.js') }}"></script>
<!-- Ion Range Slider-->
<script src="{{ URL::asset('assets/libs/ion-rangeslider/ion-rangeslider.min.js') }}"></script>

<script type="text/javascript">
    $(document).ready(function() {
       var table = $('#datatable-inline').DataTable({
            processing: true,
            serverSide: true,
            pageLength: 25,           
            ajax: {
                url:'{!! route('datas.data.showAjaxList') !!}',
                data:function(d){
                    d.series_name = $('.series_name').val(),
                    d.hard_disk_number = $('.hard_disk_number').val(),
                    d.hd_size = $('.hd_size').val(),
                    d.location = $('.location').val(),
                    d.available_space = $('#range_02').val()
                },
            },
            columns: [
                { data: 'id', name: 'id'},
                { data: 'series_name', name: 'series_name'},    
                { data: 'hd_no', name: 'hd_no'}, 
                { data: 'hd_size', name: 'hd_size'},      
                { data: 'available_space', name: 'available_space'},     
                { data: 'occupied_space', name: 'occupied_space'},    
                { data: 'location', name: 'location'},           
                { data: 'created_at', name: 'created_at' },
                { data: 'actions', name: 'actions', orderable: false, searchable: false }
            ]
        });
        $("#data").addClass("mm-active");



        $("body").on("click",".search",function(){
            $('#datatable-inline').DataTable().draw();
        });        
     
        


        $("#data").addClass("mm-active");

        $("#range_02").ionRangeSlider({
            skin: "square",
            grid: !0,
            min: 1,
            max: 10000,
            from: 1,
            step: 1,
            prettify_enabled: !0,
            prefix: "GB: ",
            onFinish: function (data) {                
                $('#datatable-inline').DataTable().draw();
            }
        });
        $(".container_filter").insertAfter("#datatable-inline_wrapper .row:first-child"); 
    });

    
</script>

@endsection
