@extends('layouts.master')

@section('title') My Profile @endsection
@section('css')
    <link href="{{ asset('assets/libs/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')

    @component('components.breadcrumb')
        @slot('li_1') Data Manager @endslot
        @slot('title') My Profile @endslot
    @endcomponent



<div class="row">
    <div class="col-lg-8 col-md-12 mx-auto">

        <div class="card">
            <div class="card-body">
            @include('widget/notifications')

                <form class="needs-validation" novalidate method="post" action="{{ route('datas.my_profile_save',$r->id) }}"  enctype="multipart/form-data">


                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label>Name <code>*</code></label>
                                <input type="text" class="form-control" name="name" required value="{{ old('name', $r->name) }}">
                                <span class="text-danger">{{ $errors->first('name', ':message') }}</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="formrow-password-input" class="form-label">Last Name</label>
                                <input type="text" class="form-control" name="last_name" value="{{ old('last_name', $r->last_name) }}"  >
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label>E-Mail <code>*</code></label>
                                <input type="email" class="form-control" name="email" required value="{{ old('email', $r->email) }}">
                                <span class="text-danger">{{ $errors->first('email', ':message') }}</span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label  class="form-label">Telephone</label>
                                <input type="text" maxlength="10" class="form-control" name="phone" value="{{ old('phone',$r->phone) }}"  >
                            </div>
                        </div>
                    </div>

                    

                    <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="formFile" class="form-label">Profile Picture</label>
                                    <input class="form-control" name="picture" type="file" id="formFile">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="formFileAdhar" class="form-label">Adhaar Number <code>*</code></label>
                                    <input class="form-control" name="adhar_card" type="text" value="{{$r->adhar_card}}" >
                                </div>
                            </div>

                            @if($r->picture!="")
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <img class="rounded-circle avatar-xl" src="{{ asset('uploads/profile/'.$r->picture) }}">
                                </div>
                            </div>
                            @endif
                            
                        </div>

                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label>New Password </label>
                                <input type="password" class="form-control" name="new_password" required >
                                <span class="text-danger">{{ $errors->first('new_password', ':message') }}</span>
                            </div>
                        </div>
                    </div>
                    <button type="" class="btn btn-primary w-md mb-2">Update Profile</button>
                    <div>

                    </div>
                </form>

            </div>
        </div>
    </div>
</div>




@endsection

@section('script')
<!-- form advanced init -->
<script src="{{ URL::asset('assets/js/pages/form-advanced.init.js') }}"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $("#myprofile").addClass("mm-active");
    });
</script>

@endsection
