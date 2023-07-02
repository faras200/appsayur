@extends('dashboard.layouts.main')

@section('container')
    @if (session()->has('success'))
        @php
            $p = session('success');
        @endphp
        <script>
            Swal.fire({
                title: 'Berhasil!!',
                text: '<?= $p ?>',
                icon: 'success',
            })
        </script>
    @endif
    <div class="row">
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header card-header-icon card-header-rose">
                                <div class="card-icon">
                                    <i class="material-icons">perm_identity</i>
                                </div>
                                <h4 class="card-title">Edit Profile Ormawa-
                                    <small class="category">Complete your profile</small>
                                </h4>
                            </div>
                            <div class="card-body mt-4">
                                <form method="post" action="/dashboard/profile/{{ $ormawa->id }}"
                                    class="form-horizontal">
                                    @method('put')
                                    @csrf

                                    <div class="row">
                                        <div class="col-md-6 mb-4">
                                            <label class="">Nama Organisasi</label>
                                            <input type="text" name="nama" id="name"class="form-control" required
                                                autofocus value="{{ old('nama', $ormawa->nama) }}">
                                            @error('nama')
                                                <div class="text-danger"> {{ $message }} </div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <label class="">Email Organisasi</label>
                                            <input type="email" name="email" id="email"class="form-control" required
                                                autofocus value="{{ old('email', $ormawa->email) }}">
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
                    <div class="col-md-3">
                        <div class="card card-profile">
                            <div class="card-avatar">
                                <a href="#pablo">
                                    <img class="img" src="{{ $user->ormawa->logo }}" />
                                </a>
                            </div>
                            <div class="card-body">


                                <h4 class="card-title">{{ $user->name }}</h4>
                                <p class="card-description">{{ $user->email }}</p>
                                <p class="card-description">
                                    {{ $user->ormawa->profil }}
                                </p>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end col-md-12 -->
    </div>
    <!-- end row -->
    <script>
        var route_prefix = "../../../laravel-filemanager";
        $('#lfm').filemanager('image', {
            prefix: route_prefix
        });
    </script>
@endsection
