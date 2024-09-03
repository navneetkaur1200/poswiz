@extends('layouts.master')

@section('title') {{$title}} | {{$module}} @endsection
@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/sweet-alert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css">
@endsection
@section('content')

@component('components.breadcrumb')
@slot('li_1') {{$module}} @endslot
@slot('title') {{$title}} @endslot
@slot('page_title') User Management @endslot
@endcomponent
<div class="row">
    <div class="col-12">
        <div class="card manage-user-card">
            <div class="card-body">
                {{--<h4 class="card-title">{{$title}}</h4>--}}
                
                @include('widget/notifications')
                <div class="table-responsive">
                <table  class="table align-middle table-nowrap dt-responsive nowrap w-100 table-striped table-bordered" id="datatable-inline">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>Username</th>
                            <th>Name</th>
                            <th>Role</th>
                            <th>E-mail</th>
                            <th>Telephone</th>
                            <th>Register Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
                </div>  
            </div>
        </div>
    </div>
</div>

<div class="table_heading">
    <h2 >{{$title}}</h2>

    <div class="top-filter mt-1">
        <label>Role Wise</label>
        <div class="input-group" >
            <select class="form-control" id="rolewise">
                <option value="">All</option>
                <option value="1">Admin</option>
                <option value="2">Staff</option>
            </select>
        </div>
    </div>
</div>
<div class="table_add_btn">
    <a href="{{route('admin.subscriber.new_user')}}" class="table_head_btn"><i class="bx bx-plus"></i> Create New</a>
</div>

@endsection

@section('script')
 <!-- Required datatable js -->
<script src="{{ URL::asset('assets/libs/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/sweet-alert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('assets/plugins/sweet-alert2/jquery.sweet-alert2.init.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function() {
       var table = $('#datatable-inline').DataTable({
            processing: true,
            serverSide: true,
            lengthChange: false,
            pageLength: 25,
            responsive:false,
            language: {
                search : '<i class="ti ti-search"></i>',
                searchPlaceholder: "Search by name, email..."
            },
            ajax: {
                url:'{!! route('admin.subscriber.showAjaxList') !!}',
                data:function(d){
                    d.rolewise = $('#rolewise').val()
                }
            },
            columns: [
                { data: 'id', name: 'id'},
                { data: 'picture', name: 'picture', orderable: false, searchable: false },
                { data: 'username', name: 'username'},
                { data: 'name', name: 'name'},
                { data: 'role', name: 'role'},
                { data: 'email', name: 'email' },
                { data: 'phone', name: 'phone' },
                { data: 'created_at', name: 'created_at' },
                { data: 'status', name: 'status',orderable: false, searchable: false },
                { data: 'actions', name: 'actions', orderable: false, searchable: false }
            ]
        });
        $("#user").addClass("mm-active");
        $("#user_sub").addClass("mm-show");
        $("#manage").addClass("mm-active");
        $(".table_heading").appendTo("#datatable-inline_wrapper .row:first-child > .col-md-6:first-child"); 
        $(".table_add_btn").appendTo("#datatable-inline_wrapper .row:first-child > .col-md-6:last-child .dataTables_filter"); 
        $("body").on("change","#rolewise",function(){
            $('#datatable-inline').DataTable().draw();
        });
    });
</script>

@endsection
