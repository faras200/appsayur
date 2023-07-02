@extends('dashboard.layouts.main')

@section('container')
    @canany('role', ['upt_it', 'baak', 'warek'])
        <div class="row">

            <div class="col-md-12" style="padding: 0px 0px !important">
                <div class="card">
                    <div class="card-header card-header-primary card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons">
                                request_quote
                            </i>
                        </div>
                        <h4 class="card-title">Pengambilan Dana</h4>
                    </div>
                    <div class="card-body">
                        <div class="toolbar text-center">
                            <a href="/dashboard/ambil-dana/create" class="btn btn-primary px-3">Tambah Jadwal Pengambilan<i
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
                                        <th>Ormawa</th>
                                        <th>Pengajuan</th>
                                        <th>Jumlah Dana</th>
                                        <th>Jadwal Pengambilan</th>
                                        <th>Status</th>
                                        <th class="disabled-sorting text-right">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($danas as $dana)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $dana->ormawa->nama }}</td>
                                            <td>{{ $dana->pengajuan->subjek }}</td>
                                            <td>Rp.{{ number_format($dana->jumlah_dana, 0, ',', '.') }}</td>

                                            <td>{{ $dana->jadwal_pengambilan->isoFormat('dddd, D MMM Y') }}</td>
                                            <td class="{{ Str::is($dana->status, '0') ? 'text-warning' : 'text-success' }}">
                                                {{ Str::is($dana->status, '0') ? 'Belum diambil' : 'Sudah diambil' }}</td>
                                            <td class="text-right">
                                                @if ($dana->status == '0')
                                                    <a href="/dashboard/ambil-dana/{{ $dana->id }}"
                                                        class="btn btn-link btn-info btn-just-icon edit"><i
                                                            class="material-icons">visibility</i>
                                                    </a>
                                                @endif

                                                <button class="btn btn-link btn-danger btn-just-icon remove"
                                                    onclick="confirmationHapusData('/dashboard/ambil-dana/delete/{{ $dana->id }}')"><i
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
    @endcanany


    @canany('role', ['bem', 'dema', 'ormawa'])
        <div class="row">

            <div class="col-md-12" style="padding: 0px 0px !important">
                <div class="card">
                    <div class="card-header card-header-primary card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons">
                                request_quote
                            </i>
                        </div>
                        <h4 class="card-title">Pengambilan Dana</h4>
                    </div>
                    <div class="card-body">

                        <div class="table-responsive">
                            <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0"
                                width="100%" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Pengajuan</th>
                                        <th>Jumlah Dana</th>
                                        <th>Jadwal Pengambilan</th>
                                        <th>Status</th>
                                        <th class="disabled-sorting text-right">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($danas as $dana)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>

                                            <td>{{ $dana->pengajuan->subjek }}</td>
                                            <td>Rp.{{ number_format($dana->jumlah_dana, 0, ',', '.') }}</td>
                                            <td>{{ $dana->jadwal_pengambilan->isoFormat('dddd, D MMM Y') }}</td>

                                            <td class="{{ Str::is($dana->status, '0') ? 'text-warning' : 'text-success' }}">
                                                {{ Str::is($dana->status, '0') ? 'Belum diambil' : 'Sudah diambil' }}</td>
                                            <td class="text-right">

                                                <a href="/dashboard/ambil-dana/{{ $dana->id }}"
                                                    class="btn btn-link btn-info btn-just-icon edit"><i
                                                        class="material-icons">visibility</i>
                                                </a>

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
    @endcanany
@endsection
