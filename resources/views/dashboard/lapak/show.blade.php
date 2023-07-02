@extends('dashboard.layouts.main')

@section('container')
    <div class="row">

        <div class="col-md-12" style="padding: 0px 0px !important">
            <div class="card">
                <div class="card-header card-header-primary card-header-icon">
                    <div class="card-icon">
                        <i class="material-icons">
                            security
                        </i>
                    </div>
                    <h4 class="card-title">Organisasi {{ $ormawa->nama }}</h4>
                </div>
                <div class="card-body">
                    <div class="toolbar text-center">
                        <button onclick="history.back()" class="btn btn-grey text-left">Kembali</button>
                        <a href="/dashboard/ormawa/anggota/create?ormawa_id={{ $ormawa->id }}"
                            class="btn btn-primary px-3">Tambah Anggota<i class="material-icons">add</i></a>
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
                                    <th>Nama Anggota</th>
                                    <th>Email</th>
                                    <th>NIM</th>
                                    <th>No hp</th>
                                    <th>Jabatan</th>
                                    <th>Alamat</th>
                                    <th class="disabled-sorting text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($anggotas as $anggota)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $anggota->nama }}</td>
                                        <td>{{ $anggota->email }}</td>
                                        <td>{{ $anggota->nim }}</td>
                                        <td>{{ $anggota->no_hp }}</td>
                                        <td>{{ $anggota->jabatan }}</td>
                                        <td>{{ $anggota->alamat }}</td>
                                        <td class="text-right">

                                            <a href="/dashboard/ormawa/anggota/{{ $anggota->id }}/edit?ormawa_id={{ $ormawa->id }}"
                                                class="btn btn-link btn-warning btn-just-icon edit"><i
                                                    class="material-icons">edit</i></a>
                                            <button class="btn btn-link btn-danger btn-just-icon remove"
                                                onclick="confirmationHapusData('/dashboard/ormawa/anggota/delete/{{ $anggota->id }}?ormawa={{ $anggota->ormawa_id }}')"><i
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
    <!-- end row -->
@endsection
