@extends('dashboard.layouts.main')

@section('container')
    <div class="row">
        <div class="col-md-12" style="padding: 0px 0px !important">
            <div class="card ">
                <div class="card-header card-header-rose card-header-icon">
                    <div class="card-icon">
                        <i class="material-icons">
                            post_add
                        </i>
                    </div>
                    <h4 class="card-title">Tambah Pengajuan</h4>
                </div>
                <div class="card-body mt-4">
                    <form method="post" action="/dashboard/pengajuan" class="form-horizontal">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label class="">Subjek</label>
                                <input type="text" name="subjek" id="subjek"class="form-control" required autofocus
                                    value="{{ old('subjek') }}">
                                @error('subjek')
                                    <div class="text-danger"> {{ $message }} </div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="form-group ">
                                    <label for="">Jenis Pengajuan</label>
                                    <select id="" name="jenis" class="form-control mt-4"
                                        aria-label="With textarea">
                                        <option value="" selected disabled>jenis</option>
                                        <option value="proposal">Proposal</option>
                                        <option value="lpj">LPJ</option>
                                        <option value="lainnya">Lainnya</option>
                                    </select>
                                    @error('jenis')
                                        <div class="text-danger"> {{ $message }} </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <p>Ingin diajukan dan minta persetujuan kemana?</p>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input name="baak" class="form-check-input" type="checkbox" value="1">
                                        Persetujuan BAAK?
                                        <span class="form-check-sign">
                                            <span class="check"></span>
                                        </span>
                                        @error('baak')
                                            <div class="text-danger"> {{ $message }} </div>
                                        @enderror
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input name="warek" class="form-check-input" type="checkbox" value="1">
                                        Persetujuan Warek 3?
                                        <span class="form-check-sign">
                                            <span class="check"></span>
                                        </span>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input name="bem" class="form-check-input" type="checkbox" value="1">
                                        Persetujuan BEM-U?
                                        <span class="form-check-sign">
                                            <span class="check"></span>
                                        </span>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input name="dema" class="form-check-input" type="checkbox" value="1">
                                        Persetujuan DEMA?
                                        <span class="form-check-sign">
                                            <span class="check"></span>
                                        </span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <label class=" col-form-label">File</label>
                                <div class="input-group">
                                    <input id="thumbnail" class="form-control" type="email" name="file" readonly
                                        multiple>
                                    <span class="input-group-btn">
                                        <a id="lfm" data-input="thumbnail" data-preview="holder"
                                            class="btn btn-fab btn-round btn-primary">
                                            <i class="fa fa-file text-white"></i>
                                        </a>
                                    </span>
                                    @error('file')
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
                            <button type="submit" formnovalidate="formnovalidate" class="btn btn-rose">Tambah</button>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- end row -->
    <script>
        var route_prefix = "../../laravel-filemanager";
        $('#lfm').filemanager('files', {
            prefix: route_prefix
        });
    </script>
@endsection
