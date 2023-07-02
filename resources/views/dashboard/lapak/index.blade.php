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
                    <h4 class="card-title">Lapak Pedagang</h4>
                </div>
                <div class="card-body">
                    <div class="toolbar text-center">
                        <a href="/dashboard/lapak/create" class="btn btn-primary px-3">Tambah Lapak<i
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
                        <table id="datatables" class="table table-striped " cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Lapak</th>
                                    <th>Email</th>
                                    <th class="disabled-sorting text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($lapaks as $lapak)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $lapak->nama }}</td>
                                        {{-- <td>{{ 0 }}</td> --}}
                                        <td>{{ $lapak->email }}</td>
                                        <td class="text-right">
                                            <a href="/dashboard/lapak/{{ $lapak->id }}/edit"
                                                class="btn btn-link btn-warning btn-just-icon edit"><i
                                                    class="material-icons">edit</i></a>
                                            <button class="btn btn-link btn-danger btn-just-icon remove"
                                                onclick="confirmationHapusData('/dashboard/lapak/delete/{{ $lapak->id }}')"><i
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
