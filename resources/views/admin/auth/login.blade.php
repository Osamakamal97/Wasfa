@extends('admin.auth.master')
@section('title', 'Login')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-4 col-md-6 col-sm-8 ml-auto mr-auto">
            <form class="form" method="POST" action="{{ route('admin.login') }}">
                @csrf
                <div class="card card-login">
                    <div class="card-header card-header-rose text-center">
                        <h4 class="card-title">Login</h4>
                        <div class="social-line">
                            <a href="#pablo" class="btn btn-just-icon btn-link btn-white">
                                <i class="fa fa-facebook-square"></i>
                            </a>
                            <a href="#pablo" class="btn btn-just-icon btn-link btn-white">
                                <i class="fa fa-twitter"></i>
                            </a>
                            <a href="#pablo" class="btn btn-just-icon btn-link btn-white">
                                <i class="fa fa-google-plus"></i>
                            </a>
                        </div>
                    </div>
                    <div class="card-body ">
                        <p class="card-description text-center">Or Be Classical</p>

                        <div class="form-group bmd-form-group @error('email') has-danger @enderror">
                            <div class="row">
                                <div class="input-group-prepend col-md-1">
                                    <span class="input-group-text">
                                        <i class="material-icons" style="padding-bottom: 20px;">email</i>
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
                        <div class="form-group bmd-form-group @error('password') has-danger @enderror">
                            <div class="row">
                                <div class="input-group-prepend col-md-1">
                                    <span class="input-group-text">
                                        <i class="material-icons">lock_outline</i>
                                    </span>
                                </div>
                                <div class="col-md-10">
                                    <label for="exampleEmails" class="bmd-label-floating"> Password </label>
                                    <input type="password" class="form-control" id="exampleEmails" required="true"
                                        name="password" aria-required="true" aria-invalid="true">
                                    @error('password')
                                    <label id="exampleEmails-error" class="error">
                                        {{ $message }}
                                    </label>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer justify-content-center">
                        <input type="submit" class="btn btn-rose btn-link btn-lg" value="Lets Go">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection