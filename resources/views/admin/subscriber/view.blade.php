
@extends('layouts.master')

@section('title') My Profile @endsection
@section('css')
    <link href="{{ asset('assets/libs/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')

@component('components.breadcrumb')
@slot('li_1') {{$module}} @endslot
@slot('title') {{$title}} @endslot
@slot('page_title') User Management @endslot
@endcomponent


<div class="row">
    <div class="col-12 col-xl-6">
        <div class="card overflow-hidden profile-card">
            <div class="bg-primary bg-soft">
                <div class="row">
                    <div class="col-7">
                        
                    </div>
                    <div class="col-5 align-self-end">
                        <img src="{{ asset('assets/images/view-profile.png') }}" alt="" class="img-fluid mt-4">
                    </div>
                </div>
            </div>
            <div class="card-body pt-0">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="avatar-md profile-user-wid mb-3 admin-user-profile">
                            @if(!empty($r->picture))
                            <img src="{{ asset('uploads/profile/'.$r->picture) }}" alt="" class="img-thumbnail rounded-circle">
                            @else
                            <img src="{{ asset('assets/images/users/blank.png') }}" alt="" class="img-thumbnail rounded-circle">
                            @endif
                        </div>
                        <h5 class="font-size-15 text-truncate">{{$r->name.' '.$r->last_name}}</h5>
                        <p class="text-muted mb-0 text-truncate">{{roleName($r->role)}}</p>
                    </div>

                    <div class="col-sm-8">
                        
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col">
                        <div class="btn-set">
                            <a href="{{route('admin.subscriber.edit',$r->id)}}" class="btn btn-primary-soft btn-rounded"><i class="ti ti-pencil-minus"></i> Edit
                                Profile</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    <div class="col-12 col-xl-6">        
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Basic Information</h4>
            </div>
            <div class="card-body">
                
                <div class="table-responsive">
                    <table class="table table-nowrap mt-0 mb-0">
                        <tbody>
                            <tr>
                                <th scope="row">User Name</th>
                                <td>{{$r->username}}</td>
                            </tr>
                            <tr>
                                <th scope="row">Store Number</th>
                                <td>{{$r->storenumber}}</td>
                            </tr>
                            <tr>
                                <th scope="row">Store Sub Domain</th>
                                <td>{{$r->dns}}</td>
                            </tr>
                            <tr>
                                <th scope="row">Full Name</th>
                                <td>{{$r->name.' '.$r->last_name}}</td>
                            </tr>
                            <tr>
                                <th scope="row">Email Address</th>
                                <td>{{$r->email}}</td>
                            </tr>
                            <tr>
                                <th scope="row">Phone Number</th>
                                <td>{{$r->phone}}</td>
                            </tr>
                            <tr>
                                <th scope="row">Location</th>
                                <td>{{$r->address.' '.$r->zipcode}}</td>
                            </tr>                  
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Database Information</h4>
            </div>
            <div class="card-body">
                
                <div class="table-responsive">
                    <table class="table table-nowrap mt-0 mb-0">
                        <tbody>
                            <tr>
                                <th scope="row">Driver</th>
                                <td>{{$db->dbctdriver}}</td>
                            </tr>
                            <tr>
                                <th scope="row">Host name</th>
                                <td>{{$db->dbcthost}}</td>
                            </tr>
                            <tr>
                                <th scope="row">Username</th>
                                <td>{{$db->dbctusername}}</td>
                            </tr>
                            <tr>
                                <th scope="row">Password</th>
                                <td>{{$db->dbctpassword}}</td>
                            </tr>
                            <tr>
                                <th scope="row">Database Name</th>
                                <td>{{$db->dbctname}}</td>
                            </tr>                  
                        </tbody>
                    </table>
                </div>
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
        $("#user").addClass("mm-active");
        $("#user_sub").addClass("mm-show");
        $("#manage").addClass("mm-active");
    });
</script>

@endsection




<?php /*

<div class="row">
    <div class="col-lg-12 col-md-12 mx-auto">

        <div class="card">
            <div class="card-header">
                <h4 class="card-title">My Profile</h4>
            </div>            
            <form class="needs-validation" novalidate method="post" action="{{ route('admin.my_profile_save',$r->id) }}"  enctype="multipart/form-data">
            @csrf
                <div class="card-body">
                    @include('widget/notifications')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label>Name <code>*</code></label>
                                <div class="input-group">
                                    <div class="input-group-text"><i class="isax isax-user"></i></div>
                                    <input type="text" class="form-control" name="name" required value="{{ old('name', $r->name) }}">
                                </div>                                
                                <span class="text-danger">{{ $errors->first('name', ':message') }}</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="formrow-password-input" class="form-label">Last Name</label>
                                <div class="input-group">
                                    <div class="input-group-text"><i class="isax isax-user"></i></div>
                                    <input type="text" class="form-control" name="last_name" value="{{ old('last_name', $r->last_name) }}">
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label>E-Mail <code>*</code></label>
                                <div class="input-group">
                                    <div class="input-group-text"><i class="isax isax-sms-tracking"></i></div>
                                    <input type="email" class="form-control" name="email" required value="{{ old('email', $r->email) }}">
                                </div>
                                <span class="text-danger">{{ $errors->first('email', ':message') }}</span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label  class="form-label">Telephone</label>
                                <div class="input-group">
                                    <div class="input-group-text"><i class="isax isax-call-calling"></i></div>
                                    <input type="text" class="form-control" name="phone" value="{{ old('phone', $r->phone) }}"  >
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label>Address</label>
                                <div class="input-group">
                                    <div class="input-group-text"><i class="isax isax-location"></i></div>
                                    <input type="text" class="form-control" name="address" required value="{{ old('address', $r->address) }}">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label  class="form-label">Zipcode</label>
                                <div class="input-group">
                                    <div class="input-group-text"><i class="isax isax-map"></i></div>
                                    <input type="text" class="form-control" name="zipcode" value="{{ old('zipcode', $r->zipcode) }}">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Profile Picture</label>
                                <div class="input-group">
                                    <div class="input-group-text"><i class="isax isax-gallery"></i></div>
                                    <input class="form-control" name="picture" type="file" id="formFile">
                                </div>
                            </div>
                            @if($r->picture!="")
                                <div class="mb-3">
                                    <img class="rounded-circle avatar-xl" src="{{ asset('uploads/profile/'.$r->picture) }}">
                                </div>
                            @endif
                        </div>

                        
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label>New Password </label>
                                <div class="input-group">
                                    <div class="input-group-text"><i class="isax isax-lock-1"></i></div>
                                    <input type="password" class="form-control" name="new_password" required >
                                </div>                                
                                <span class="text-danger">{{ $errors->first('new_password', ':message') }}</span>
                            </div>
                        </div>
                    </div>
                </div>            
                <div class="card-footer">
                    <div class="d-flex space-between align-center">
                        <a href="{{route('admin.subscriber.manage_trainer')}}" class="btn btn-transparent btn-rounded"><i class="ti ti-arrow-left"></i> Back</a>
                        <button class="btn btn-primary btn-rounded">Update Profile</button>
                    </div>                
                </div>
            </form>
        </div>
    </div>
</div>




@endsection


*/ ?>