@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10 col-sm-6 col-md-6">
            <div class="well well-sm">

            @if ($message = Session::get('error'))
                <div class="alert alert-danger alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>    
                    <strong>{{ $message }}</strong>
                </div>
            @endif

            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>    
                    <strong>{{ $message }}</strong>
                </div>
            @endif

            <form action="{{ url('/update-profile-password') }}" method="POST"  id="updatePasswordForm" name="updatePasswordForm">
            @csrf
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label"> Name </label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control"  name="name"  id="name" value="{{$userdetails->name}}" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label"> Email </label>
                    <div class="col-sm-10">
                    <input type="email" class="form-control"  name="email" id="email" value="{{$userdetails->email}}" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Old Password </label>
                    <div class="col-sm-10">
                    <input type="password" class="form-control"  name="userold_password" id="userold_password">
                    <span id="uschkoldpwd" ></span>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">New Password </label>
                    <div class="col-sm-10">
                    <input type="password" class="form-control"  name="usernew_password" id="usernew_password"  require>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Confirm Passsword</label>
                    <div class="col-sm-10">
                    <input type="password" class="form-control"  name="userconfirm_pass" id="userconfirm_pass" require>
                    </div>
                </div>
                <button type="submit" >Submit</button>
            </form>
            </div>
        </div>
    </div>
</div>


@endsection

