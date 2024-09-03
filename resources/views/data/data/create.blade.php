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
            @include('widget/notifications')
                <form class="custom-validation" novalidate autocomplete="off" method="post" action="{{ route('datas.data.new_save') }}"  enctype="multipart/form-data">
                @csrf
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Series Name <code>*</code></label>
                                    <input type="text" class="form-control" name="series_name" required value="{{ old('series_name') }}">
                                    <span class="text-danger">{{ $errors->first('series_name', ':message') }}</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>HD No </label>
                                    <input type="text" class="form-control" name="hd_no" required value="{{ old('hd_no') }}">
                                    <span class="text-danger">{{ $errors->first('hd_no', ':message') }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>HD Size <code>*</code></label>
                                    <div class="input-group">
                                        <input type="number" step="any" min="0.5"  class="form-control" name="hd_size" required value="{{ old('hd_size') }}">
                                        <div class="input-group-append" bis_skin_checked="1">
                                            <span class="input-group-text">
                                                GB
                                            </span>
                                        </div>
                                    </div>
                                    
                                    <span class="text-danger">{{ $errors->first('hd_size', ':message') }}</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Location <code>*</code></label>
                                    <select class="form-control" name="location" required>
                                        <option value="Home">Home</option>
                                        <option value="Office">Office</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary w-md mb-2">Create</button>
                </form>
            </div>
        </div>
        <!-- end card -->
    </div> <!-- end col -->


</div>

@endsection

@section('script')
<script src="{{ URL::asset('/assets/libs/parsleyjs/parsleyjs.min.js') }}"></script>
<script src="{{ URL::asset('/assets/js/pages/form-validation.init.js') }}"></script>


<!-- form advanced init -->
<script src="{{ URL::asset('assets/js/pages/form-advanced.init.js') }}"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $("#data").addClass("mm-active");
    });
</script>

@endsection
