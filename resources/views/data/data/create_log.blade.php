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
                <form class="custom-validation" novalidate autocomplete="off" method="post" action="{{ route('datas.data.new_save_log',$id) }}"  enctype="multipart/form-data">
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
                                    <p>Total Space : {{$r->hd_size}} GB</p>
                                    <p>Available Space : {{$r->available_space}} GB</p>
                                    <p>Occupied Space : {{$r->occupied_space}} GB</p>
                                    
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Shoot Type <code>*</code></label>
                                    <select class="form-control" id="shoot_type" name="shoot_type" required>
                                        <option value="">Choose Type</option>
                                        <option value="Wedding">Wedding</option>
                                        <option value="Fashion">Fashion</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 shoot_type" style="display:none;">
                                <div class="mb-3">
                                    <label>Name<code>*</code></label>
                                    
                                    <select class="form-control"  id="wedding_type" name="shoot_id">
                                        @if(!empty($wedding))
                                        @foreach($wedding as $w)
                                        <option value="{{$w->id}}">{{$w->client_name}}</option>
                                        @endforeach
                                        @endif                                    
                                    </select>
                                    <select class="form-control"  id="fashion_type" name="shoot_id" >
                                        @if(!empty($fashion))
                                        @foreach($fashion as $w)
                                        <option value="{{$w->id}}">{{$w->client_name}}</option>
                                        @endforeach
                                        @endif 
                                    </select>
                                </div>
                            </div>
                            

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Conent Type <code>*</code></label>
                                    <select class="form-control" name="content_type" required>
                                        <option value="Photo">Photo</option>
                                        <option value="Video">Video</option>
                                        <option value="Both">Both</option>
                                    </select>
                                </div>
                            </div>
                            

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Use space <code>*</code></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="use_space" required value="{{ old('use_space') }}">
                                        <div class="input-group-append" bis_skin_checked="1">
                                            <span class="input-group-text">
                                                GB
                                            </span>
                                        </div>
                                    </div>
                                    
                                    <span class="text-danger">{{ $errors->first('use_space', ':message') }}</span>
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
<script src="{{ URL::asset('/assets/libs/select2/select2.min.js') }}"></script>

<!-- form advanced init -->
<script src="{{ URL::asset('assets/js/pages/form-advanced.init.js') }}"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $("#data").addClass("mm-active");
        $(".select2").select2({
            placeholder: "Choose..",
            allowClear: true,
        });
        $(".shoot_type").hide();
        $("#wedding_type").hide();
        $("#wedding_type").attr('disabled','disabled');
        $("#fashion_type").hide();
        $("#fashion_type").attr('disabled','disabled');

        $("#shoot_type").change(function(){
            $(".shoot_type").hide();
            $("#wedding_type").hide();
            $("#wedding_type").attr('disabled','disabled');
            $("#fashion_type").hide();
            $("#fashion_type").attr('disabled','disabled');
            var $this = $(this);
            if($this.val() == "Wedding"){
                $(".shoot_type").show();
                $("#wedding_type").show();
                $("#wedding_type").removeAttr('disabled');
                $("#fashion_type").attr('disabled','disabled');
            }else if($this.val() == "Fashion"){
                $(".shoot_type").show();
                $("#fashion_type").show();
                $("#fashion_type").removeAttr('disabled');
                $("#wedding_type").attr('disabled','disabled');
            }

        })
    });
</script>

@endsection
