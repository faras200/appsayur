@extends('dashboard.layouts.main')

@section('container')
    <div class="row">

        <div class="col-md-12" style="padding: 0px 0px !important">
            <div class="card">
                <div class="card-header card-header-primary card-header-icon">
                    <div class="card-icon">
                        <i class="material-icons">
                            groups
                        </i>
                    </div>
                    <h4 class="card-title">Admin</h4>
                </div>
                <div class="card-body">
                    <div class="toolbar text-center">
                        <a href="/dashboard/admin/create" class="btn btn-primary px-3">Tambah Admin<i
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
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th class="disabled-sorting text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($admins as $admin)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $admin->name }}</td>
                                        <td>{{ $admin->email }}</td>
                                        <td>{{ $admin->role }}</td>
                                        <td class="text-right">

                                            <a href="/dashboard/admin/{{ $admin->id }}/edit"
                                                class="btn btn-link btn-warning btn-just-icon edit"><i
                                                    class="material-icons">edit</i></a>
                                            {{-- <form class="d-inline" action="/dashboard/admin-ormawa/{{ $admin->id }}"
                                                method="post">
                                                @method('delete')
                                                @csrf --}}
                                            <button class="btn btn-link btn-danger btn-just-icon remove"
                                                onclick="confirmationHapusData('/dashboard/admin/delete/{{ $admin->id }}')"><i
                                                    class="material-icons">close</i></button>

                                            {{-- </form> --}}

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
