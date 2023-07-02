@extends('dashboard.layouts.main')

@section('container')
    <div class="row">
        <div class="col-md-12" style="padding: 0px 0px !important">
            <div class="card ">
                <div class="card-header card-header-rose card-header-icon">
                    <div class="card-icon">
                        <i class="material-icons">
                            person_add_alt_1
                        </i>
                    </div>
                    <h4 class="card-title">Ubah Admin Ormawa</h4>
                </div>
                <div class="card-body mt-4">
                    <form method="post" action="/dashboard/admin-ormawa/{{ $admin->id }}" class="form-horizontal">
                        @method('put')
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label class="">Nama Admin</label>
                                <input type="text" name="name" id="name"class="form-control" required autofocus
                                    value="{{ old('name', $admin->name) }}">
                                @error('name')
                                    <div class="text-danger"> {{ $message }} </div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-4">
                                <label class="">Username Admin</label>
                                <input type="text" name="username" id="username"class="form-control" required autofocus
                                    value="{{ old('username', $admin->username) }}">
                                @error('username')
                                    <div class="text-danger"> {{ $message }} </div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-4">
                                <label class="">Email</label>
                                <input type="email" name="email" id="email"class="form-control" required autofocus
                                    value="{{ old('email', $admin->email) }}">
                                @error('email')
                                    <div class="text-danger"> {{ $message }} </div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="form-group ">
                                    <label for="">Role</label>
                                    <select id="" name="role" class="form-control mt-4"
                                        aria-label="With textarea">
                                        <option value="{{ $admin->role }}" selected>{{ $admin->role }}</option>
                                        <option value="ormawa">Ormawa</option>
                                        <option value="BEM">BEM Universitas</option>
                                        <option value="DEMA">Dewan Mahasiswa</option>
                                    </select>
                                    @error('role')
                                        <div class="text-danger"> {{ $message }} </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="form-group ">
                                    <label for="">Tanggung Jawab Ormawa</label>
                                    <select id="ormawa" name="ormawa_id" class="form-control mt-4"
                                        aria-label="With textarea">
                                        <option value="{{ $admin->ormawa_id }}" selected>{{ $admin->ormawa->nama }}
                                        </option>
                                        @foreach ($ormawas as $ormawa)
                                            <option value="{{ $ormawa->id }}">{{ $ormawa->nama }}</option>
                                        @endforeach
                                    </select>
                                    @error('ormawa_id')
                                        <div class="text-danger"> {{ $message }} </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <label class="">Password</label>
                                <input type="password" name="password" id="password"class="form-control" autofocus
                                    value="{{ old('password') }}">
                                <p class="text-warning">Kosongkan apabila password tidak diubah!!</p>
                                @error('password')
                                    <div class="text-danger"> {{ $message }} </div>
                                @enderror
                            </div>
                        </div>

                </div>
                <div class="card-footer ">
                    <div class="col-12">

                        <div class="text-right">

                            <a href="../" class="btn btn-grey text-left">Kembali</a>

                            <button type="submit" class="btn btn-rose">Ubah</button>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- end row -->
@endsection
