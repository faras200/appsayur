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
                    <h4 class="card-title">Detail Pengambilan Dana</h4>
                </div>
                <div class="card-body mt-4">
                    <form method="post" action="/dashboard/ambil-dana/{{ $dana->id }}" class="form-horizontal">
                        @method('put')
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label class="">Ormawa</label>
                                <input type="text" value="{{ $dana->ormawa->nama }}" class="form-control"
                                    id="dengan-rupiah" name="ormawa_id" readonly>
                                @error('ormawa_id')
                                    <div class="text-danger"> {{ $message }} </div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-4">
                                <label class="">Pengajuan</label>
                                <input type="text" value="{{ $dana->pengajuan->subjek }}" class="form-control"
                                    id="dengan-rupiah" name="pengajuan_id" readonly>
                                @error('pengajuan_id')
                                    <div class="text-danger"> {{ $message }} </div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-4">
                                <label class="">Jadwal Pengambilan</label>
                                <input type="text" class="form-control" name="jadwal_pengambilan"
                                    value="{{ is_null($dana->jadwal_pengambilan) ? 'Belum diambil' : $dana->jadwal_pengambilan->isoFormat('dddd, D MMM Y') }}"
                                    readonly>
                            </div>
                            <div class="col-md-6 mb-4">
                                <label class="">Jumlah Dana</label>
                                <input type="text" class="form-control" id="dengan-rupiah" name="jumlah_dana"
                                    value="Rp. {{ number_format($dana->jumlah_dana, 0, ',', '.') }}" readonly>
                                @error('jadwal_pengambilan')
                                    <div class="text-danger"> {{ $message }} </div>
                                @enderror
                            </div>

                            @canany('role', ['ormawa', 'dema', 'bem'])
                                <div class="col-md-6 mb-4">
                                    <label class="">Keterangan</label>
                                    <textarea name="visi" class="form-control" id="" rows="7" readonly>
                                        {{ $dana->keterangan }}
                                    </textarea>

                                </div>
                                <div class="col-md-6 mb-4">
                                    <label class="">Tanggal Pengambilan</label>
                                    <input type="text" class="form-control" name="tanggal_pengambilan"
                                        value="{{ is_null($dana->tanggal_pengambilan) ? 'Belum diambil' : $dana->tanggal_pengambilan->isoFormat('dddd, D MMM Y') }}"
                                        readonly>

                                </div>
                                <div class="col-md-6 mb-4">
                                    <label class=" col-form-label">Bukti Pengambilan</label>
                                    <div class="input-group">
                                        <img class="img img-fluid" src="{{ $dana->bukti }}" alt="">
                                    </div>
                                </div>
                            @endcanany

                            @canany('role', ['baak', 'upt_it', 'warek'])
                                <div class="col-md-6 mb-4">
                                    <label class="">Keterangan</label>
                                    <input type="text" class="form-control" name="keterangan">
                                    @error('keterangan')
                                        <div class="text-danger"> {{ $message }} </div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label class="">Tanggal Pengambilan</label>
                                    <input type="date" class="form-control" name="tanggal_pengambilan">
                                    @error('tanggal_pengambilan')
                                        <div class="text-danger"> {{ $message }} </div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label class=" col-form-label">Bukti Pengambilan</label>
                                    <div class="input-group">
                                        <input id="thumbnail" class="form-control" type="text" name="bukti">
                                        <span class="input-group-btn">
                                            <a id="lfm" data-input="thumbnail" data-preview="holder"
                                                class="btn btn-fab btn-round btn-primary">
                                                <i class="fa fa-picture-o text-white"></i>
                                            </a>
                                        </span>
                                        @error('bukti')
                                            <div class="text-danger"> {{ $message }} </div>
                                        @enderror
                                    </div>
                                </div>
                            @endcanany
                        </div>
                </div>
                <div class="card-footer ">
                    <div class="col-12">
                        <div class="text-right">
                            <button onclick="history.back()" class="btn btn-grey text-left">Kembali</button>
                            @canany('role', ['baak', 'upt_it', 'warek'])
                                <button type="submit" class="btn btn-rose">Selesaikan</button>
                            @endcanany
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
