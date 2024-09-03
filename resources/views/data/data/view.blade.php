@extends('layouts.master')

@section('title'){{$title}} | {{$module}}@endsection

@section('css')
<link href="{{ URL::asset('/assets/libs/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('/assets/libs/bootstrap-timepicker/bootstrap-timepicker.min.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('content')

@component('components.breadcrumb')
@slot('li_1') {{$module}} @endslot
@slot('title') {{$title}} @endslot
@endcomponent


<div class="row">
    <div class="col-xl-8 mx-auto">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-bordered">
                            <tr>
                                <th>Series Name</th>
                                <td>{{$r->series_name}}</td>
                            </tr>
                            <tr>
                                <th>HD No</th>
                                <td>{{$r->hd_no}}</td>
                            </tr>
                            <tr>
                                <th>HD Size</th>
                                <td>{{$r->hd_size}} GB</td>
                            </tr>
                            <tr>
                                <th>Available space in GB</th>
                                <td>{{$r->available_space}} GB</td>
                            </tr>
                            <tr>
                                <th>Occupied Space</th>
                                <td>{{$r->occupied_space}} GB</td>
                            </tr>
                            <tr>
                                <th>Location</th>
                                <td>{{$r->location}}</td>
                            </tr>
                            
                        </table>
                    </div>
                </div>
                
            </div>
        </div>
        <!-- end card -->
    </div> <!-- end col -->


</div>

<div class="row">
            <div class="col-xl-8 mx-auto">
                <div class="card">
                    <div class="card-body">
                        @include('widget/notifications')
                        <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" href="#home1" role="tab">
                                    <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                    <span class="d-none d-sm-block">Entries</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#profile1" role="tab">
                                    <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                    <span class="d-none d-sm-block">Delete Entries</span>
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content p-3 text-muted">
                            <div class="tab-pane active" id="home1" role="tabpanel">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h3>HD Content Logs</h3>
                                        <table class="table table-bordered">
                                            @if(!empty($logs))
                                                <tr>
                                                    <th>Shoot Type</th>
                                                    <th>Shoot Name</th>
                                                    <th>Content Type</th>
                                                    <th>Use Space</th>
                                                    <th>Action</th>
                                                </tr>
                                                @foreach($logs as $log)
                                                    <tr>
                                                        <td>{{ $log->shoot_type }}</th>
                                                        <td>{{ shootInfo($log->shoot_id,'client_name') }}
                                                            </th>
                                                        <td>{{ $log->content_type }}</th>
                                                        <td>{{ $log->use_space }} GB</td>
                                                        <td><a href="javascript:void(0);" data-id="{{ $log->id }}"
                                                                class="btn btn-danger del_log">Delete</a></td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="3">No logs found!</td>
                                                </tr>
                                            @endif
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="profile1" role="tabpanel">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h3>HD Content Logs - Deleted</h3>
                                        <table class="table table-bordered">
                                            @if(!empty($logs_del))
                                                <tr>
                                                    <th>Shoot Type</th>
                                                    <th>Shoot Name</th>
                                                    <th>Content Type</th>
                                                    <th>Use Space</th>
                                                    <th>Remark</th>
                                                </tr>
                                                @foreach($logs_del as $log)
                                                    <tr>
                                                        <td>{{ $log->shoot_type }}</th>
                                                        <td>{{ shootInfo($log->shoot_id,'client_name') }}
                                                            </th>
                                                        <td>{{ $log->content_type }}</th>
                                                        <td>{{ $log->use_space }} GB</td>
                                                        <td>{{$log->remark}}</td>

                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="3">No logs found!</td>
                                                </tr>
                                            @endif
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>

        <div id="status_modal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel">Delete Entry</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="post" action="{{ route('datas.data.delete_log') }}">
                        <div class="modal-body">
                            <div class="mt-3">
                                <label>Remark</label>
                                <textarea class="form-control" required name="remark"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            @csrf
                            <input type="hidden" name="log_id" id="log_id" value="" id="id">
                            <button type="submit" class="btn btn-success waves-effect status_update">Delete</button>
                            <button type="button" class="btn btn-secondary waves-effect"
                                data-bs-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

@endsection

@section('script')
<script src="{{ URL::asset('/assets/libs/parsleyjs/parsleyjs.min.js') }}"></script>
<script src="{{ URL::asset('/assets/js/pages/form-validation.init.js') }}"></script>


<!-- form advanced init -->
<script src="{{ URL::asset('assets/js/pages/form-advanced.init.js') }}"></script>


<script type="text/javascript">
    $(document).ready(function() {
        $("#data").addClass("mm-active");
        $("body").on('click', '.del_log', function () {
            var $this = $(this);
            record_id = $this.attr('data-id');
            $("#log_id").val($this.attr('data-id'))
            $("#status_modal").modal('show');
        });
    });
</script>

@endsection
