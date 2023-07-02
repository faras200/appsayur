@extends('dashboard.layouts.main')

@section('container')
    <div class="row">

        <div class="col-md-12" style="padding: 0px 0px !important">
            <div class="card">
                <div class="card-header card-header-primary card-header-icon">
                    <div class="card-icon">
                        <i class="material-icons">
                            post_add
                        </i>
                    </div>
                    <h4 class="card-title">Detail Pengajuan</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0"
                            width="100%" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Ormawa Pengaju</th>
                                    <th>Subjek</th>
                                    <th>Jenis</th>
                                    <th>Status</th>

                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $pengajuan->ormawa->nama }}</td>
                                    <td>{{ $pengajuan->subjek }}</td>
                                    <td>{{ $pengajuan->jenis }}</td>
                                    <td
                                        class="{{ Str::is($pengajuan->status, 'setuju') ? 'text-success' : (Str::is($pengajuan->status, 'revisi') ? 'text-warning' : (Str::is($pengajuan->status, 'tolak') ? 'text-danger' : 'text-primary')) }} text-capitalize">
                                        {{ Str::is($pengajuan->status, 'setuju')
                                            ? 'Di Setujui'
                                            : (Str::is($pengajuan->status, 'revisi') ? 'Di' : (Str::is($pengajuan->status, 'tolak') ? 'Di' : 'Sedang di ')) .
                                                ' ' .
                                                $pengajuan->status }}
                                    </td>
                                </tr>
                                {{-- @foreach ($admins as $admin)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $admin->username }}</td>
                                        <td>{{ $admin->email }}</td>
                                        <td>{{ $admin->role }}</td>
                                        <td class="text-right">
                                            <a href="/dashboard/admin-ormawa/{{ $admin->id }}/edit"
                                                class="btn btn-link btn-warning btn-just-icon edit"><i
                                                    class="material-icons">edit</i></a>
                                            <button class="btn btn-link btn-danger btn-just-icon remove"
                                                onclick="confirmationHapusData('/dashboard/admin-ormawa/delete/{{ $admin->id }}')"><i
                                                    class="material-icons">close</i></button>

                                        </td>
                                    </tr>
                                @endforeach --}}
                                @php
                                    $files = Str::of($pengajuan->file)->explode(',');
                                @endphp
                                @foreach ($files as $file)
                                    <tr>
                                        <td colspan="4">
                                            <div class="text-center">
                                                <h4>File {{ $loop->iteration }}</h4>
                                            </div>
                                            <iframe src="{{ $file }}" width="100%" height="600"></iframe>
                                        </td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <th colspan="4" class="text-center">
                                        Catatan Revisi
                                    </th>
                                </tr>
                                <form action="/dashboard/pengajuan/{{ $pengajuan->id }}" method="POST">
                                    @method('put')
                                    @csrf
                                    <input type="hidden" name="persetujuan_id" value="{{ $pengajuan->persetujuan_id }}">
                                    <tr>
                                        <td colspan="4">
                                            <div class="form-group">
                                                <textarea class="form-control" name="catatan_revisi" id="" cols="30" rows="10"
                                                    placeholder="Masukan catatan revisi disini.."></textarea>
                                            </div>
                                        </td>
                                    </tr>
                                    @canany('role', ['baak', 'bem', 'dema', 'warek'])
                                        <tr>
                                            <td colspan="4">
                                                <div class="text-right">
                                                    <button type="submit" name="revisi" value="true"
                                                        class="btn btn-warning text-left"><i class="material-icons"> edit
                                                        </i>Revisi</button>
                                                    <button type="submit" name="acc" value="true"
                                                        class="btn btn-success"><i class="material-icons">done</i>
                                                        Setujui</button>
                                                    <button type="submit" name="tolak" value="true"
                                                        class="btn btn-danger"><i class="material-icons">close</i>
                                                        Tolak</button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endcanany
                                </form>
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
