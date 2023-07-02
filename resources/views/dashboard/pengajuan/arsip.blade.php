@extends('dashboard.layouts.main')

@section('container')
    @can('role', ['ormawa', 'bem', 'dema'])
        <div class="row">

            <div class="col-md-12" style="padding: 0px 0px !important">
                <div class="card">
                    <div class="card-header card-header-primary card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons">
                                post_add
                            </i>
                        </div>
                        <h4 class="card-title">Pengajuan</h4>
                    </div>
                    <div class="card-body">
                        <div class="toolbar text-center">
                            <a href="/dashboard/pengajuan/create" class="btn btn-primary px-3">Tambah pengajuan<i
                                    class="material-icons">add</i></a>
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
                        </div>
                        <div class="table-responsive">
                            <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0"
                                width="100%" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Subjek</th>
                                        <th>Jenis</th>
                                        <th>Status</th>
                                        <th>File</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pengajuans as $pengajuan)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $pengajuan->subjek }}</td>
                                            <td>{{ $pengajuan->jenis }}</td>
                                            <td>{{ $pengajuan->status }}</td>
                                            @php
                                                $files = Str::of($pengajuan->file)->explode(',');
                                            @endphp
                                            <td>
                                                @foreach ($files as $file)
                                                    <a target="_blank" href="{{ $file }}"><span class="material-icons">
                                                            description
                                                        </span></a>
                                                @endforeach
                                            </td>
                                            <td class="text-right">
                                                <a href="/dashboard/pengajuan/{{ $pengajuan->id }}/edit"
                                                    class="btn btn-link btn-warning btn-just-icon edit"><i
                                                        class="material-icons">edit</i></a>
                                                <button class="btn btn-link btn-danger btn-just-icon remove"
                                                    onclick="confirmationHapusData('/dashboard/pengajuan/delete/{{ $pengajuan->id }}?psj={{ $pengajuan->persetujuan->id }}')"><i
                                                        class="material-icons">close</i></button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- end content-->
                </div>
                <!--  end card  -->
            </div>
            <!-- end col-md-12 -->
        </div>
    @endcan
    <!-- end row -->
    @can('role', ['baak', 'upt_it', 'warek', 'bem', 'dema'])
        <div class="row">

            <div class="col-md-12" style="padding: 0px 0px !important">
                <div class="card">
                    <div class="card-header card-header-primary card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons">
                                post_add
                            </i>
                        </div>
                        <h4 class="card-title">Arsip Pengajuan</h4>
                    </div>
                    <div class="card-body">
                        <div class="toolbar text-center">
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
                        </div>
                        <div class="table-responsive">
                            <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0"
                                width="100%" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Subjek</th>
                                        <th>Ormawa pengaju</th>
                                        <th>Jenis</th>
                                        <th>Anggaran</th>
                                        <th>File</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!is_null($pengajuans))
                                        @foreach ($pengajuans as $pengajuan)
                                            @php
                                                //echo @$pengajuan->dana->jumlah_dana;
                                            @endphp

                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $pengajuan->subjek }}</td>
                                                <td>{{ $pengajuan->ormawa->nama }}</td>
                                                <td>{{ $pengajuan->jenis }}</td>
                                                <td>Rp. {{ number_format(@$pengajuan->dana->jumlah_dana, 0, ',', '.') }}</td>
                                                @php
                                                    $files = Str::of($pengajuan->file)->explode(',');
                                                @endphp
                                                <td>
                                                    @foreach ($files as $file)
                                                        <a target="_blank" href="{{ $file }}"><span
                                                                class="material-icons">
                                                                description
                                                            </span></a>
                                                    @endforeach
                                                </td>
                                                <td class="text-right">
                                                    <a href="/dashboard/arsip-pengajuan/{{ $pengajuan->id }}"
                                                        class="btn btn-link btn-info ">
                                                        <i class="material-icons">
                                                            visibility
                                                        </i>
                                                        Lihat
                                                    </a>

                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <td colspan="7" class="text-center">Data Not Found</td>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- end content-->
                </div>
                <!--  end card  -->
            </div>
            <!-- end col-md-12 -->
        </div>
    @endcan
@endsection
