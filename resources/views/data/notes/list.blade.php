@extends('layouts.master')

@section('title') Manage @endsection
@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/sweet-alert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css">
    
@endsection
@section('content')

@component('components.breadcrumb')
@slot('li_1') notess @endslot
@slot('title') Manage @endslot
@endcomponent
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">List</h4>
                <div class="row">
                    <div class="col-lg-2 mx-auto text-md-right text-center mb-2 mt-2">
                        <a href="{{route('datas.notes.new')}}" class="btn btn-primary">Add New</a>
                    </div>
                </div>
                @include('widget/notifications')
                <table  class="table align-middle table-nowrap dt-responsive nowrap w-100 table-striped table-bordered" id="datatable-inline">
                    <thead>
                        <tr>
                            <th scope="col" style="width: 70px;">#</th>
                            <th>Name</th>
                            <th>Create Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
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
            pageLength: 25,
            ajax: '{!! route('datas.notes.showAjaxList') !!}',
            columns: [
                { data: 'id', name: 'id'},
                { data: 'name', name: 'name'},               
                { data: 'created_at', name: 'created_at' },
                { data: 'status', name: 'status' },
                { data: 'actions', name: 'actions', orderable: false, searchable: false }
            ]
        });
        $("#notes").addClass("mm-active");
    });
</script>

@endsection
