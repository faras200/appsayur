@extends('dashboard.layouts.main')

@section('container')
    <div class="row">

        <div class="col-md-12" style="padding: 0px 0px !important">
            <div class="card">
                <div class="card-header card-header-primary card-header-icon">
                    <div class="card-icon">
                        <i class="material-icons">assignment</i>
                    </div>
                    <h4 class="card-title">Laporan Transaksi</h4>
                </div>
                <div class="card-body">
                    <div class="toolbar text-center">
                        {{-- <a href="/dashboard/posts/create" class="btn btn-primary px-3">New Post<i
                                class="material-icons">add</i></a> --}}
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
                                    <th>Invoice</th>
                                    <th>Status</th>
                                    <th>Pembayaran</th>
                                    <th>Harga</th>
                                    <th>Author</th>
                                    <th>Tanggal</th>
                                    <th class="disabled-sorting text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transaksis as $transaksi)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $transaksi->uuid }}</td>
                                        <td>{{ $transaksi->status }}</td>
                                        <td>{{ $transaksi->qris == null ? 'COD' : 'Online' }}</td>
                                        <td>Rp. {{ number_format($transaksi->total_amount, 0, ',', '.') }}</td>
                                        <td>{{ $transaksi->user->name }}</td>
                                        <td>{{ date('d-m-Y', strtotime($transaksi->created_at)) }}</td>
                                        <td class="text-right">
                                            @can('role', 'pedagang')
                                                <a href="/dashboard/transaksi/{{ $transaksi->id }}"
                                                    class="btn btn-link btn-info btn-just-icon like"><i
                                                        class="material-icons">visibility</i></a>
                                            @endcan
                                            @can('role', 'pembeli')
                                                <a href="/dashboard/transaksi/{{ $transaksi->uuid }}"
                                                    class="btn btn-link btn-info btn-just-icon like"><i
                                                        class="material-icons">visibility</i></a>
                                            @endcan
                                            {{-- <a href="/dashboard/transaksi/{{ $transaksi->slug }}/edit"
                                                class="btn btn-link btn-warning btn-just-icon edit"><i
                                                    class="material-icons">dvr</i></a>
                                            <button class="btn btn-link btn-danger btn-just-icon remove"
                                                onclick="confirmationHapusData('/dashboard/transaksi/delete/{{ $transaksi->id }}')"><i
                                                    class="material-icons">close</i>
                                            </button> --}}
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
