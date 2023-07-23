@extends('dashboard.layouts.main')

@section('container')
    <div class="row">
        <div class="col-md-12" style="padding: 0px 0px !important">
            <div class="card ">
                <div class="card-body ">
                    <div class="row">
                        <div class="{{ $snap_token ? 'col-md-8' : 'col-md-12' }} ">
                            <h3 class="card-title">Detail Transaksi</h3>
                            <br />
                            <div class="table-responsive">
                                <table class="table table-shopping">
                                    <thead>
                                        <tr>
                                            <th class="text-center"></th>
                                            <th>Product</th>
                                            <th class="text-right">Price</th>
                                            <th class="text-right">Qty</th>
                                            <th class="text-right">Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $jumlah = 0;
                                        @endphp
                                        @foreach ($keranjangs as $index => $keranjang)
                                            <tr>
                                                <td class=" card-avatar" colspan="6">
                                                    <img class="img" width="25px"
                                                        src="{{ asset('images/logo_lapak.png') }}" />
                                                    Belanja di <a href="/lapak/{{ $index }}"> Lapak
                                                        {{ $index }} </a>
                                                </td>
                                            </tr>
                                            @foreach ($keranjang as $item)
                                                <tr>
                                                    <td>
                                                        <div class="">
                                                            <img width="80px" src="{{ $item->image }}" alt="...">
                                                        </div>
                                                    </td>
                                                    <td class="" style="font-size:18px">
                                                        <a href="/posts/{{ $item->slug }}">{{ $item->title }}</a>
                                                    </td>

                                                    <td class="" tyle="font-size:18px">
                                                        Rp.
                                                        {{ number_format($item->harga, 0, ',', '.') }}
                                                    </td>
                                                    <td class="" tyle="font-size:18px">
                                                        {{ $item->qty }}

                                                    </td>
                                                    <td class="" style="font-size:18px">
                                                        Rp.
                                                        {{ number_format($item->harga * $item->qty, 0, ',', '.') }}
                                                        @php
                                                            $jumlah = $item->harga * $item->qty + $jumlah;
                                                        @endphp
                                                    </td>

                                                </tr>
                                            @endforeach
                                        @endforeach
                                        <tr>
                                            <td class="td-name" colspan="4">
                                                Total Harga
                                            </td>
                                            <td class="" style="font-size:18px">
                                                Rp. {{ number_format($jumlah, 0, ',', '.') }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @if ($snap_token != null)
                            <div class="col-md-3 mt-5">
                                <div id="snap-container"></div>
                            </div>
                        @endif
                    </div>

                    @can('role', ['pedagang'])
                        <div class="row d-flex justify-content-center">
                            <button class="btn btn-primary col-10">
                                Selesaikan Transaksi Ini
                            </button>
                        </div>
                    @endcan
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" value="{{ $snap_token }}" id="snap">

    <script>
        window.addEventListener("load", (event) => {
            window.snap.embed($('#snap').val(), {
                embedId: 'snap-container'
            });
        });
    </script>
@endsection
