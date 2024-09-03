@extends('layouts.master')

@section('title') {{$title}} | {{$module}} @endsection

@section('css')
@endsection

@section('content')

@component('components.breadcrumb')
@slot('li_1') {{$module}} @endslot
@slot('title') {{$title}} @endslot
@slot('page_title') User Management @endslot
@endcomponent


<div class="row">
    <div class="col-xl-12 mx-auto">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">{{$title}}</h5>
            </div>
            @include('widget/notifications')
            <form class="custom-validation" novalidate autocomplete="off" method="post" action="{{ route('admin.subscriber.new_save') }}"  enctype="multipart/form-data">
            @csrf                
                <div class="card-body">
                
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs nav-tabs-custom mb-4" role="tablist">

                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#basic" role="tab">
                                <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                <span class="d-none d-sm-block">Profile Information</span>
                            </a>
                        </li>

                        
                    </ul>

                    <div class="tab-content create-new-user">
                        <div class="tab-pane active" id="basic" role="tabpanel">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label>Name <code>*</code></label>
                                        <div class="input-group">
                                            <div class="input-group-text"><i class="isax isax-user"></i></div>
                                            <input type="text" class="form-control" name="name" required value="{{ old('name') }}">
                                        </div>                                    
                                        <span class="text-danger">{{ $errors->first('name', ':message') }}</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="formrow-password-input" class="form-label">Last Name</label>
                                        <div class="input-group">
                                            <div class="input-group-text"><i class="isax isax-user"></i></div>
                                            <input type="text" class="form-control" name="last_name" value="{{ old('last_name') }}"  >
                                        </div> 
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label>Store Number <code>*</code></label>
                                        <div class="input-group">
                                            <div class="input-group-text"><i class="isax isax-user"></i></div>
                                            <input type="text" class="form-control" name="storenumber" required value="{{ old('storenumber') }}">
                                        </div>
                                        <span class="text-danger">{{ $errors->first('storenumber', ':message') }}</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label>Sub-Domain <code>*</code></label>
                                        <div class="input-group">
                                            <div class="input-group-text"><i class="isax isax-user"></i></div>
                                            <input type="text" class="form-control" name="dns" required value="{{ old('dns') }}">
                                        </div>
                                        <span class="text-danger">{{ $errors->first('dns', ':message') }}</span>
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label>E-Mail <code>*</code></label>
                                        <div class="input-group">
                                            <div class="input-group-text"><i class="isax isax-sms-tracking"></i></div>
                                            <input type="email" class="form-control" name="email" required value="{{ old('email') }}">
                                        </div> 
                                        <span class="text-danger">{{ $errors->first('email', ':message') }}</span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label  class="form-label">Telephone <code>*</code></label>
                                        <div class="input-group">
                                            <div class="input-group-text"><i class="isax isax-call-calling"></i></div>
                                            <input type="text" maxlength="10" class="form-control" name="phone" required value="{{ old('phone') }}"  >
                                        </div> 
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label>Street Address  <code>*</code></label>
                                        <div class="input-group">
                                            <div class="input-group-text"><i class="isax isax-location"></i></div>
                                            <input type="text" class="form-control" name="address" required value="{{ old('address') }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label  class="form-label">Zipcode</label>
                                        <div class="input-group">
                                            <div class="input-group-text"><i class="isax isax-map"></i></div>
                                            <input type="text" class="form-control" name="zipcode" value="{{ old('zipcode') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label>Status </label>
                                        <div class="input-group">
                                            <div class="input-group-text"><i class="isax isax-receipt-edit"></i></div>
                                            <select class="form-control" name="status">
                                                <option value="1">Active</option>
                                                <option value="0">De-Active</option>
                                            </select>
                                        </div> 
                                        
                                    </div>
                                </div>
                            </div>

                        
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label>Password </label>
                                        <div class="input-group">
                                            <div class="input-group-text"><i class="isax isax-lock-1"></i></div>
                                            <input type="password" class="form-control" name="password" required >
                                        </div>                                    
                                        <span class="text-danger">{{ $errors->first('password', ':message') }}</span>
                                    </div>
                                </div>
            
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="formFile" class="form-label">Profile Picture</label>
                                        <div class="input-group">
                                            <div class="input-group-text"><i class="isax isax-gallery"></i></div>
                                            <input class="form-control" name="picture" type="file" id="formFile">
                                        </div>                                    
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3"><h3>Database Configuration</h3></div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label>Database Driver <code>*</code></label>
                                        <div class="input-group">
                                            <div class="input-group-text"><i class="isax isax-user"></i></div>
                                            <input type="text" class="form-control" name="dbctdriver" required value="{{ old('dbctdriver') }}">
                                        </div>
                                        <span class="text-danger">{{ $errors->first('dbctdriver', ':message') }}</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label>Database Name <code>*</code></label>
                                        <div class="input-group">
                                            <div class="input-group-text"><i class="isax isax-user"></i></div>
                                            <input type="text" class="form-control" name="dbctname" required value="{{ old('dbctname') }}">
                                        </div>
                                        <span class="text-danger">{{ $errors->first('dbctname', ':message') }}</span>
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label>Database Host Name <code>*</code></label>
                                        <div class="input-group">
                                            <div class="input-group-text"><i class="isax isax-sms-tracking"></i></div>
                                            <input type="text" class="form-control" name="dbcthost" required value="{{ old('dbcthost') }}">
                                        </div> 
                                        <span class="text-danger">{{ $errors->first('dbcthost', ':message') }}</span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label  class="form-label">Database User-Name <code>*</code></label>
                                        <div class="input-group">
                                            <div class="input-group-text"><i class="isax isax-call-calling"></i></div>
                                            <input type="text"  class="form-control" name="dbctusername" required value="{{ old('dbctusername') }}"  >
                                        </div> 
                                        
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label>Database Password </label>
                                        <div class="input-group">
                                            <div class="input-group-text"><i class="isax isax-lock-1"></i></div>
                                            <input type="text" required value="{{ old('dbctpassword') }}" class="form-control" name="dbctpassword" >
                                        </div>                                    
                                        <span class="text-danger">{{ $errors->first('dbctpassword', ':message') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="card-footer">
                    <div class="d-flex space-between align-center">
                        <a href="{{route('admin.subscriber.manage')}}" class="btn btn-transparent btn-rounded"><i class="ti ti-arrow-left"></i> Back</a>
                        <button class="btn btn-primary btn-rounded">Save Changes</button>
                    </div>
                    
                </div>
            </form>
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
        $("#user").addClass("mm-active");
        $("#user_sub").addClass("mm-show");
        $("#create").addClass("mm-active");
    });
</script>

@endsection
