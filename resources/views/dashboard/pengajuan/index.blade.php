@extends('dashboard.layouts.main')

@section('container')
    @can('role', ['ormawa'])
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
                                            <td class="text-capitalize">{{ $pengajuan->jenis }}</td>
                                            <td
                                                class="{{ Str::is($pengajuan->status, 'setuju') ? 'text-success' : (Str::is($pengajuan->status, 'revisi') ? 'text-warning' : (Str::is($pengajuan->status, 'tolak') ? 'text-danger' : 'text-primary')) }} text-capitalize">
                                                {{ Str::is($pengajuan->status, 'setuju')
                                                    ? 'Di Setujui'
                                                    : (Str::is($pengajuan->status, 'revisi') ? 'Di' : (Str::is($pengajuan->status, 'tolak') ? 'Di' : 'Sedang di ')) .
                                                        ' ' .
                                                        $pengajuan->status }}
                                            </td>
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
                                                <a href="/dashboard/pengajuan/{{ $pengajuan->id }}/status"
                                                    class="btn btn-link btn-info btn-just-icon edit"><i
                                                        class="material-icons">visibility</i></a>
                                                <a href="/dashboard/pengajuan/{{ $pengajuan->id }}/edit"
                                                    class="btn btn-link btn-warning btn-just-icon edit"><i
                                                        class="material-icons">edit</i></a>
                                                @if ($pengajuan->status == 'tolak')
                                                    <button class="btn btn-link btn-danger btn-just-icon remove"
                                                        onclick="confirmationHapusData('/dashboard/pengajuan/delete/{{ $pengajuan->id }}?psj={{ $pengajuan->persetujuan->id }}')"><i
                                                            class="material-icons">close</i></button>
                                                @endif
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

    @can('role', ['bem', 'dema'])
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
                                    @if (!is_null($ajuan))
                                        @foreach ($ajuan as $pengajuan)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $pengajuan->subjek }}</td>
                                                <td class="text-capitalize">{{ $pengajuan->jenis }}</td>
                                                <td
                                                    class="{{ Str::is($pengajuan->status, 'setuju') ? 'text-success' : (Str::is($pengajuan->status, 'revisi') ? 'text-warning' : (Str::is($pengajuan->status, 'tolak') ? 'text-danger' : 'text-primary')) }} text-capitalize">
                                                    {{ Str::is($pengajuan->status, 'setuju')
                                                        ? 'Di Setujui'
                                                        : (Str::is($pengajuan->status, 'revisi') ? 'Di' : (Str::is($pengajuan->status, 'tolak') ? 'Di' : 'Sedang di ')) .
                                                            ' ' .
                                                            $pengajuan->status }}
                                                </td>
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
                                                    <a href="/dashboard/pengajuan/{{ $pengajuan->id }}/status"
                                                        class="btn btn-link btn-info btn-just-icon edit"><i
                                                            class="material-icons">visibility</i></a>
                                                    <a href="/dashboard/pengajuan/{{ $pengajuan->id }}/edit"
                                                        class="btn btn-link btn-warning btn-just-icon edit"><i
                                                            class="material-icons">edit</i></a>
                                                    @if ($pengajuan->status == 'tolak')
                                                        <button class="btn btn-link btn-danger btn-just-icon remove"
                                                            onclick="confirmationHapusData('/dashboard/pengajuan/delete/{{ $pengajuan->id }}?psj={{ $pengajuan->persetujuan->id }}')"><i
                                                                class="material-icons">close</i></button>
                                                    @endif

                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <td colspan="7" class="text-center">Data Not Found</td>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <h4 class="text-center">Meminta persetujuan</h4>
                        <div class="table-responsive">
                            <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0"
                                width="100%" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Subjek</th>
                                        <th>Ormawa pengaju</th>
                                        <th>Jenis</th>
                                        <th>Catatan Revisi</th>
                                        <th>File</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!is_null($pengajuans))
                                        @foreach ($pengajuans as $pengajuan)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $pengajuan->subjek }}</td>
                                                <td>{{ $pengajuan->ormawa->nama }}</td>
                                                <td>{{ $pengajuan->jenis }}</td>
                                                <td>{{ is_null($pengajuan->catatan_revisi) ? 'Kosong' : $pengajuan->catatan_revisi }}
                                                </td>
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
                                                    <a href="/dashboard/pengajuan/{{ $pengajuan->id }}"
                                                        class="btn btn-link btn-info ">
                                                        <i class="material-icons">
                                                            visibility
                                                        </i>
                                                        Lihat
                                                    </a>
                                                    {{-- <a href="/dashboard/pengajuan/{{ $pengajuan->id }}/edit"
                                                    class="btn btn-link btn-success edit">
                                                    <i class="material-icons">
                                                        check
                                                    </i>
                                                    Setujui
                                                </a>
                                                <button class="btn btn-link btn-danger "
                                                    onclick="confirmationHapusData('/dashboard/pengajuan/delete/{{ $pengajuan->id }}?psj={{ $pengajuan->persetujuan->id }}')"><i
                                                        class="material-icons">close</i>Tolak
                                                </button> --}}
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
    <!-- end row -->
    @can('role', ['baak', 'upt_it', 'warek'])
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
                                        <th>Catatan Revisi</th>
                                        <th>File</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!is_null($pengajuans))
                                        @foreach ($pengajuans as $pengajuan)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ @$pengajuan->subjek }}</td>
                                                <td>{{ @$pengajuan->ormawa->nama }}</td>
                                                <td>{{ @$pengajuan->jenis }}</td>
                                                <td>{{ is_null(@$pengajuan->catatan_revisi) ? 'Kosong' : @$pengajuan->catatan_revisi }}
                                                </td>
                                                @php
                                                    $files = Str::of(@$pengajuan->file)->explode(',');
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
                                                    <a href="/dashboard/pengajuan/{{ @$pengajuan->id }}"
                                                        class="btn btn-link btn-info ">
                                                        <i class="material-icons">
                                                            visibility
                                                        </i>
                                                        Lihat
                                                    </a>
                                                    {{-- <a href="/dashboard/pengajuan/{{ @$pengajuan->id }}/edit"
                                                    class="btn btn-link btn-success edit">
                                                    <i class="material-icons">
                                                        check
                                                    </i>
                                                    Setujui
                                                </a>
                                                <button class="btn btn-link btn-danger "
                                                    onclick="confirmationHapusData('/dashboard/pengajuan/delete/{{ $pengajuan->id }}?psj={{ $pengajuan->persetujuan->id }}')"><i
                                                        class="material-icons">close</i>Tolak
                                                </button> --}}
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
