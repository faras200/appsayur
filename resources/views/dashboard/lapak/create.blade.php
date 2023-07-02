@extends('dashboard.layouts.main')

@section('container')
    <div class="row">
        <div class="col-md-12" style="padding: 0px 0px !important">
            <div class="card ">
                <div class="card-header card-header-rose card-header-icon">
                    <div class="card-icon">
                        <i class="material-icons">
                            security
                        </i>
                    </div>
                    <h4 class="card-title">Tambah Lapak</h4>
                </div>
                <div class="card-body mt-4">
                    <form method="post" action="/dashboard/lapak" class="form-horizontal">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label class="">Nama Lapak</label>
                                <input type="text" name="nama" id="name"class="form-control" required autofocus
                                    value="{{ old('name') }}">
                                @error('name')
                                    <div class="text-danger"> {{ $message }} </div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-4">
                                <label class="">Email Lapak</label>
                                <input type="email" name="email" id="email"class="form-control" required autofocus
                                    value="{{ old('email') }}">
                                @error('email')
                                    <div class="text-danger"> {{ $message }} </div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-4">
                                <label class=" col-form-label">Logo</label>
                                <div class="input-group">
                                    <input id="thumbnail" class="form-control" type="text" name="logo">
                                    <span class="input-group-btn">
                                        <a id="lfm" data-input="thumbnail" data-preview="holder"
                                            class="btn btn-fab btn-round btn-primary">
                                            <i class="fa fa-picture-o text-white"></i>
                                        </a>
                                    </span>
                                    @error('logo')
                                        <div class="text-danger"> {{ $message }} </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                </div>
                <div class="card-footer ">
                    <div class="col-12">
                        <div class="text-right">
                            <button onclick="history.back()" class="btn btn-grey text-left">Kembali</button>
                            <button type="submit" class="btn btn-rose">Tambah</button>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        var route_prefix = "../../laravel-filemanager";
        $('#lfm').filemanager('image', {
            prefix: route_prefix
        });
    </script>
    <!-- end row -->
@endsection
