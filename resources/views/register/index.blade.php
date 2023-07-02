@extends('layouts.main')
@section('container')
<div class="" style="background-image: url('../assets/img/bg7.jpg'); background-size: cover; background-position: top center;">
        <div class="row mt-5">
            <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
                <div class="card card-signup">
                    <form class="form" method="post" action="/register">
                        @csrf
                        <div class="header header-primary text-center">
                            <h4 class="card-title">From Registration</h4>
                            <div class="social-line">
                                <a href="#pablo" class="btn btn-just-icon btn-simple">
                                    <i class="fa fa-facebook-square"></i>
                                </a>
                                <a href="#pablo" class="btn btn-just-icon btn-simple">
                                    <i class="fa fa-twitter"></i>
                                </a>
                                <a href="#pablo" class="btn btn-just-icon btn-simple">
                                    <i class="fa fa-google-plus"></i>
                                </a>
                            </div>
                        </div>
                        <p class="description text-center">Or Be Classical</p>
                        <div class="card-content text-center">

                            <div class="input-group ">
                                <span class="input-group-addon">
                                    <i class="material-icons">home</i>
                                </span>
                                <input type="text" class="form-control  @error('name') is-invalid @enderror" name="name" placeholder="Name..." value="{{ old('name') }}">
                                @error('name')
                                   <small class="text-danger ml--5"> {{ $message }} </small>
                                @enderror
                            </div>
                            
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">face</i>
                                </span>
                                <input type="text" class="form-control" name="username" placeholder="username..." value="{{ old('username') }}">
                                @error('username')
                                <small class="text-danger ml--5"> {{ $message }} </small>
                             @enderror
                            </div>

                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">email</i>
                                </span>
                                <input type="email" name="email" class="form-control is-invalid" placeholder="Email..." value="{{ old('email') }}">
                                @error('email')
                                <small class="text-danger ml--5"> {{ $message }} </small>
                             @enderror
                            </div>

                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">lock_outline</i>
                                </span>
                                <input type="password" name="password" placeholder="Password..." class="form-control" >
                                @error('password')
                                <small class="text-danger ml--5"> {{ $message }} </small>
                             @enderror
                            </div>
                            <div class="text-center">
                                <button class="w-80 btn btn-primary btn-round " type="submit">Register</button>
                            </div>

                            <!-- If you want to add a checkbox to this form, uncomment this code

                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="optionsCheckboxes" checked>
                                    Subscribe to newsletter
                                </label>
                            </div> -->
                        </div>
                        
                    </form>
                    <div class="footer text-center">
                        <Small>I have account ? <a href="/login" class="text-primary">Login Now</a></Small>
                    </div>
                </div>
            </div>
        </div>
    
</div>

@endsection