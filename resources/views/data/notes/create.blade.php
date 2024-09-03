@extends('layouts.master')

@section('title') Add New @endsection

@section('css')
@endsection

@section('content')

@component('components.breadcrumb')
@slot('li_1') Roles @endslot
@slot('title') Create @endslot
@endcomponent


<div class="row">
    <div class="col-xl-8 mx-auto">
        <div class="card">
            <div class="card-body">
            @include('widget/notifications')
                <form class="custom-validation" novalidate autocomplete="off" method="post" action="{{ route('datas.notes.new_save') }}"  enctype="multipart/form-data">
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
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label>Name <code>*</code></label>
                                    <input type="text" class="form-control" name="name" required value="{{ old('name') }}">
                                    <span class="text-danger">{{ $errors->first('name', ':message') }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label>Description</label>
                                    <textarea class="form-control" name="description">{{old('description')}}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Status </label>
                                    <input type="text" class="form-control" name="status" required value="{{ old('status') }}">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary w-md mb-2 update-button">Create</button>
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
        $("#notes").addClass("mm-active");
    });
</script>

@endsection
