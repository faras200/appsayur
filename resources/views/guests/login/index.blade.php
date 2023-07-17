@extends('guests.layouts.main')
@section('container')
    <div class="page-header header-filter"
        style="background-image: url('../assets/img/bg88.jpeg'); background-size: cover; background-position: top center; ">
        <div class="container mt-5">
            <div class="row mt-4">
                <div class="col-lg-4 col-md-6 col-sm-8 ml-auto mr-auto">
                    <form class="form" method="post" action="/login">
                        @csrf

                        <div class="card card-login card-hidden">
                            <div class="card-header card-header-success text-center">
                                <h4 class="card-title">Login Page</h4>
                            </div>
                            <div class="card-body" style="padding: 0px 20px !important ">
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
                            <div class="text-center" style="margin-top:-15px; margin-bottom:15px">
                                <Small>Belum Punya Akun ? <a href="/register" class="text-primary">Register Now</a></Small>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
