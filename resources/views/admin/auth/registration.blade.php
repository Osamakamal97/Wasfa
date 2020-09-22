@extends('admin.auth.master')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-4 col-md-6 col-sm-8 ml-auto mr-auto">
            <form id="RegisterValidation" action="{{ route('register') }}" method="POST" novalidate="novalidate">
                @csrf
                <div class="card ">
                    <div class="card-header card-header-rose card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons">mail_outline</i>
                        </div>
                        <h4 class="card-title">Register Form</h4>
                    </div>
                    <div class="card-body ">
                        <div class="form-group bmd-form-group @error('email') has-danger @enderror">
                            <div class="row">
                                <div class="input-group-prepend col-md-1">
                                    <span class="input-group-text">
                                        <i class="material-icons" @error('email') style="padding-bottom: 18px;"
                                            @enderror>email</i>
                                    </span>
                                </div>
                                <div class="col-md-10">
                                    <label for="exampleEmails" class="bmd-label-floating"> Email Address</label>
                                    <input type="email" class="form-control" id="exampleEmails" required="true"
                                        name="email" aria-required="true" aria-invalid="true"
                                        value="{{ old('email') }}">
                                    @error('email')
                                    <label id="exampleEmails-error" class="error" for="exampleEmails">
                                        {{ $message }}
                                    </label>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group bmd-form-group @error('name') has-danger @enderror">
                            <div class="row">
                                <div class="input-group-prepend col-md-1">
                                    <span class="input-group-text">
                                        <i class="material-icons" @error('name') style="padding-bottom: 18px;"
                                            @enderror>face</i>
                                    </span>
                                </div>
                                <div class="col-md-10">
                                    <label for="exampleEmails" class="bmd-label-floating"> Name... </label>
                                    <input type="email" class="form-control" id="exampleEmails" required="true"
                                        name="name" aria-required="true" aria-invalid="true" value="{{ old('name') }}">
                                    @error('name')
                                    <label id="exampleEmails-error" class="error" for="exampleEmails">
                                        {{ $message }}
                                    </label>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group bmd-form-group @error('password') has-danger @enderror">
                            <div class="row">
                                <div class="input-group-prepend col-md-1">
                                    <span class="input-group-text">
                                        <i class="material-icons" @error('password') style="padding-bottom: 18px;"
                                            @enderror>lock</i>
                                    </span>
                                </div>
                                <div class="col-md-10">
                                    <label for="exampleEmails" class="bmd-label-floating"> password</label>
                                    <input type="password" class="form-control" id="exampleEmails" required="true"
                                        name="password" aria-required="true" aria-invalid="true"
                                        value="{{ old('password') }}">
                                    @error('password')
                                    <label id="exampleEmails-error" class="error" for="exampleEmails">
                                        {{ $message }}
                                    </label>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group bmd-form-group @error('password_confirmation') has-danger @enderror">
                            <div class="row">
                                <div class="input-group-prepend col-md-1">
                                    <span class="input-group-text">
                                        <i class="material-icons" @error('password_confirmation')
                                            style="padding-bottom: 18px;" @enderror>lock_outline</i>
                                    </span>
                                </div>
                                <div class="col-md-10">
                                    <label for="exampleEmails" class="bmd-label-floating"> Password Confirmation</label>
                                    <input type="password" class="form-control" id="exampleEmails" required="true"
                                        name="password_confirmation" aria-required="true" aria-invalid="true"
                                        value="{{ old('password_confirmation') }}">
                                    @error('password_confirmation')
                                    <label id="exampleEmails-error" class="error" for="exampleEmails">
                                        {{ $message }}
                                    </label>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button type="submit" class="btn btn-rose" style="margin-left: 10px;">Register</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection