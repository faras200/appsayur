@extends('dashboard.layouts.main')

@section('container')
    <div class="row">
        <div class="col-md-12" style="padding: 0px 0px !important">
            <div class="card ">
                <div class="card-header card-header-rose card-header-icon">
                    <div class="card-icon">
                        <i class="material-icons">
                            personal
                        </i>
                    </div>
                    <h4 class="card-title">Ubah Data Anggota</h4>
                </div>
                <div class="card-body mt-4">

                    <form method="post" action="/dashboard/ormawa/anggota/{{ $anggota->id }}" class="form-horizontal">
                        @method('put')
                        @csrf
                        <input type="hidden" name="ormawa_id" value="{{ $_GET['ormawa_id'] }}">
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label class="">Nama</label>
                                <input type="text" name="nama" id="name"class="form-control" required autofocus
                                    value="{{ old('name', $anggota->nama) }}">
                                @error('name')
                                    <div class="text-danger"> {{ $message }} </div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-4">
                                <label class="">NIM </label>
                                <input type="number" name="nim" id="nim"class="form-control" required autofocus
                                    value="{{ old('nim', $anggota->nim) }}">
                                @error('nim')
                                    <div class="text-danger"> {{ $message }} </div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-4">
                                <label class="">Email</label>
                                <input type="email" name="email" id="email"class="form-control" required autofocus
                                    value="{{ old('email', $anggota->email) }}">
                                @error('email')
                                    <div class="text-danger"> {{ $message }} </div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-4">
                                <label class="">Nomor Telephone </label>
                                <input type="number" name="no_hp" id="no_hp"class="form-control" required autofocus
                                    value="{{ old('no_hp', $anggota->no_hp) }}">
                                @error('no_hp')
                                    <div class="text-danger"> {{ $message }} </div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="form-group ">
                                    <label for="">Jabatan Anggota</label>
                                    <select id="jabatan" name="jabatan" class="form-control mt-4"
                                        aria-label="With textarea">
                                        <option value="{{ $anggota->jabatan }}" selected>{{ $anggota->jabatan }}
                                        </option>
                                        <option value="ketua">Ketua Umum</option>
                                        <option value="wakil">Wakil Ketua</option>
                                        <option value="sekretaris">Sekretaris</option>
                                        <option value="bendahara">Bendahara</option>
                                        <option value="anggota">Anggota</option>
                                    </select>
                                    @error('jabatan')
                                        <div class="text-danger"> {{ $message }} </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <label class="">Alamat</label>
                                <textarea name="alamat" class="form-control" id="" rows="7">{{ $anggota->alamat }}</textarea>

                                @error('alamat')
                                    <div class="text-danger"> {{ $message }} </div>
                                @enderror
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
    <!-- end row -->
@endsection
