@extends('guests.layouts.main')
@section('container')
    {{-- <div class=""
        style="background-image: url('../assets/img/bg7.jpg'); background-size: cover; background-position: top center;">
        <div class="row mt-5">
            @if (session()->has('success'))
                <div class="alert alert-success">
                    <div class="container-fluid">
                        <div class="alert-icon">
                            <i class="material-icons">check</i>
                        </div>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true"><i class="material-icons">clear</i></span>
                        </button>
                        <b>Success Alert:</b> {{ session('success') }}
                    </div>
                </div>
            @endif
            <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
                <div class="card card-signup">
                    @if (session()->has('loginError'))
                        <div class="alert alert-danger">
                            <div class="container-fluid">
                                <div class="alert-icon">
                                    <i class="material-icons">warning</i>
                                </div>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true"><i class="material-icons">clear</i></span>
                                </button>
                                <b>Alert: </b> {{ session('loginError') }}
                            </div>
                        </div>
                    @endif
                    <form class="form" method="post" action="/login">
                        @csrf

                        <h3 class="description text-center">Form Login</h3>
                        <div class="card-content text-center">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">email</i>
                                </span>
                                <input type="email" name="email"
                                    class="form-control @error('email') is-invalid @enderror " placeholder="Email..."
                                    value="{{ old('email') }}" autofocus required>
                                @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">lock_outline</i>
                                </span>
                                <input type="password" name="password" required placeholder="Password..."
                                    class="form-control" />
                            </div>
                            <div class="text-center">
                                <button class="w-80 btn btn-primary btn-round ">Login</button>
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
                        <Small>Not registerd ? <a href="/register" class="text-primary">Register Now</a></Small>
                    </div>
                </div>
            </div>
        </div>

    </div> --}}


    <div class="page-header header-filter"
        style="background-image: url('../assets/img/bg7.jpg'); background-size: cover; background-position: top center;">
        <div class="container mt-5">
            <div class="row mt-4">
                <div class="col-lg-4 col-md-6 col-sm-8 ml-auto mr-auto">
                    <form class="form" method="post" action="/login">
                        @csrf

                        <div class="card card-login card-hidden">
                            <div class="card-header card-header-primary text-center">
                                <h4 class="card-title">Login Page</h4>
                            </div>
                            <div class="card-body ">
                                @if (session()->has('loginError'))
                                    <div class="alert alert-danger">
                                        <div class="container-fluid">
                                            <div class="alert-icon">
                                                <i class="material-icons">warning</i>
                                            </div>
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true"><i class="material-icons">clear</i></span>
                                            </button>
                                            <b>Alert: </b> {{ session('loginError') }}
                                        </div>
                                    </div>
                                @endif
                                <span class="bmd-form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="material-icons">email</i>
                                            </span>
                                        </div>
                                        <input type="email" name="email" class="form-control" placeholder="Email..."
                                            value="{{ old('email') }}" autofocus required>
                                        @error('email')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </span>
                                <span class="bmd-form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="material-icons">lock_outline</i>
                                            </span>
                                        </div>
                                        <input type="password" name="password" class="form-control"
                                            placeholder="Password...">
                                    </div>
                                </span>
                            </div>
                            <div class="card-footer justify-content-center">
                                <button type="submit" style="font-weight: 600 !important;"
                                    class="btn btn-rose btn-link btn-lg">Login</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
