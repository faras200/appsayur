@extends('dashboard.layouts.main')

@section('container')
    @canany('role', ['administrator'])
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-warning card-header-icon">
                        <div class="card-icon" style="padding: 5px !important;">
                            <i class="material-icons">person</i>
                        </div>
                        <p class="card-category">Admins</p>
                        <h3 class="card-title">{{ $admin }}</h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="material-icons">person</i>
                            <a href="/dashboard/admin">Lihat semua..</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-success card-header-icon">
                        <div class="card-icon" style="padding: 5px !important;">
                            <i class="material-icons">storefront</i>
                        </div>
                        <p class="card-category">Lapak Penjual</p>
                        <h3 class="card-title">{{ $lapak }}</h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="material-icons">storefront</i>
                            <a href="/dashboard/lapak">Lihat semua..</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-rose card-header-icon">
                        <div class="card-icon" style="padding: 5px !important;">
                            <i class="material-icons">description</i>
                        </div>
                        <p class="card-category">Category</p>
                        <h3 class="card-title">{{ $category }}</h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="material-icons">description</i>
                            <a href="/dashboard/pengajuan">Lihat semua..</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-primary card-header-icon">
                        <div class="card-icon" style="padding: 5px !important;">
                            <i class="material-icons">request_quote</i>
                        </div>
                        <p class="card-category">Total Transaksi</p>
                        <h3 class="card-title">{{ $dana }}</h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="material-icons">request_quote</i>
                            <a href="/dashboard/ambil-dana">Lihat semua..</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endcanany

    <div class="row">
        <div class="col-md-6" style="padding: 0px 0px !important">
            <div class="card" style="min-height: 350px !important;">
                <div class="card-header card-header-success card-header-icon">
                    <div class="card-icon">
                        <i class="material-icons">post_add</i>
                    </div>
                    <h4 class="card-title">Pesanan Terbaru</h4>
                </div>
                <div class="card-body ">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table id="datatables" class="table table-striped table-no-bordered table-hover"
                                    cellspacing="0" width="100%" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Subjek</th>
                                            <th>Jenis</th>
                                            <th>Status</th>

                                        </tr>
                                    </thead>
                                    {{-- <tbody>
                                        @if (!is_null($pengajuans))
                                            @foreach ($pengajuans as $pengajuan1)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $pengajuan1->subjek }}</td>
                                                    <td class="text-capitalize">{{ $pengajuan1->jenis }}</td>
                                                    <td
                                                        class="{{ Str::is($pengajuan1->status, 'setuju') ? 'text-success' : (Str::is($pengajuan1->status, 'revisi') ? 'text-warning' : (Str::is($pengajuan1->status, 'tolak') ? 'text-danger' : 'text-primary')) }} text-capitalize">
                                                        {{ Str::is($pengajuan1->status, 'setuju')
                                                            ? 'Di Setujui'
                                                            : (Str::is($pengajuan1->status, 'revisi') ? 'Di' : (Str::is($pengajuan1->status, 'tolak') ? 'Di' : 'Sedang di ')) .
                                                                ' ' .
                                                                $pengajuan1->status }}
                                                    </td>
                                                    @php
                                                        $files = Str::of($pengajuan1->file)->explode(',');
                                                    @endphp

                                                </tr>
                                            @endforeach
                                        @else
                                            <td colspan="7" class="text-center">Data Not Found</td>
                                        @endif
                                    </tbody> --}}
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header card-header-rose card-header-icon">
                            <div class="card-icon" style="padding: 5px !important;">
                                <i class="material-icons">group</i>
                            </div>
                            <p class="card-category">Admin Lapak</p>
                            <h3 class="card-title">{{ $anggota }}</h3>
                        </div>
                        <div class="card-footer">
                            <div class="stats">
                                <i class="material-icons">group</i>
                                <a href="/dashboard/ormawa/anggota">Lihat semua..</a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header card-header-warning card-header-icon">
                            <div class="card-icon" style="padding: 5px !important;">
                                <i class="material-icons">dashboard_customize</i>
                            </div>
                            <p class="card-category">Total Konten</p>
                            <h3 class="card-title">{{ $post }}</h3>
                        </div>
                        <div class="card-footer">
                            <div class="stats">
                                <i class="material-icons">dashboard_customize</i>
                                <a href="/dashboard/pengajuan">Lihat semua..</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
