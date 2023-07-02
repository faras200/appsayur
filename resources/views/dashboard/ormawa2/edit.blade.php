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
                    <h4 class="card-title">Ubah Data Organisasi Mahasiswa</h4>
                </div>
                <div class="card-body mt-4">
                    <form method="post" action="/dashboard/ormawa/{{ $ormawa->id }}" class="form-horizontal">
                        @method('put')
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label class="">Nama Organisasi</label>
                                <input type="text" name="nama" id="name"class="form-control" required autofocus
                                    value="{{ old('nama', $ormawa->nama) }}">
                                @error('nama')
                                    <div class="text-danger"> {{ $message }} </div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-4">
                                <label class="">Email Organisasi</label>
                                <input type="email" name="email" id="email"class="form-control" required autofocus
                                    value="{{ old('email', $ormawa->email) }}">
                                @error('email')
                                    <div class="text-danger"> {{ $message }} </div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-4">
                                <label class="">Visi</label>
                                <textarea name="visi" class="form-control" id="" rows="7" placeholder="visi organisasi...">{{ old('visi', $ormawa->visi) }}</textarea>

                                @error('visi')
                                    <div class="text-danger"> {{ $message }} </div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-4">
                                <label class="">Misi</label>
                                <textarea name="misi" class="form-control" id="" rows="7" placeholder="misi organisasi...">{{ old('misi', $ormawa->misi) }}</textarea>

                                @error('misi')
                                    <div class="text-danger"> {{ $message }} </div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-4">
                                <label class="">Profil</label>
                                <textarea name="profil" class="form-control" id="" rows="7" placeholder="profil organisasi...">{{ old('profil', $ormawa->profil) }}</textarea>

                                @error('profil')
                                    <div class="text-danger"> {{ $message }} </div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-4">
                                <label class=" col-form-label">Logo</label>
                                <div class="input-group">
                                    <input id="thumbnail" class="form-control" type="text" name="logo"
                                        value="{{ old('logo', $ormawa->logo) }}">
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
                            <button type="submit" class="btn btn-rose">Ubah</button>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        var route_prefix = "../../../laravel-filemanager";
        $('#lfm').filemanager('image', {
            prefix: route_prefix
        });
    </script>
    <!-- end row -->
@endsection
