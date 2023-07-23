@extends('guests.layouts.main')

@section('container')
    <div class="main main-raised mt-4">
        <div class="container-fluid">
            <div class="card card-plain">
                <div class="card-body">
                    <div class="row">
                        <div class=" {{ $snaptoken ? 'col-md-9' : 'col-md-12' }} ">
                            <h3 class="card-title">Checkout Barang</h3>
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
                                                <td class="td-name card-avatar" colspan="6">
                                                    <img class="img" width="30px"
                                                        src="{{ asset('images/logo_lapak.png') }}" />
                                                    Belanja di <a href="/lapak/{{ $index }}"> Lapak
                                                        {{ $index }} </a>
                                                </td>
                                            </tr>
                                            @foreach ($keranjang as $item)
                                                <tr>
                                                    <td>
                                                        <div class="img-container">
                                                            <img src="{{ $item->image }}" alt="...">
                                                        </div>
                                                    </td>
                                                    <td class="td-name">
                                                        <a href="/posts/{{ $item->slug }}">{{ $item->title }}</a>
                                                    </td>

                                                    <td class="td-number text-right">
                                                        <small>Rp.
                                                        </small>{{ number_format($item->harga, 0, ',', '.') }}
                                                    </td>
                                                    <td class="td-number">
                                                        {{ $item->qty }}

                                                    </td>
                                                    <td class="td-number">
                                                        <small>Rp.
                                                        </small>{{ number_format($item->harga * $item->qty, 0, ',', '.') }}
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
                                            <td class="td-number">
                                                Rp. {{ number_format($jumlah, 0, ',', '.') }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        @if ($snaptoken != null)
                            <div class="col-md-3">
                                <div id="snap-container"></div>
                            </div>
                        @endif
                    </div>
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

        function RemoveKeranjang(id) {
            const csrf = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                type: 'POST',
                url: "{{ route('delete.keranjang') }}",
                data: {
                    '_token': csrf,
                    'id': id,
                },

                success: function(data) {
                    if (data.success) {
                        location.reload();
                    }
                }

            });
        }

        function TambahKeranjang(id) {
            const csrf = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                type: 'GET',
                url: "keranjang/" + id + "?action=add",

                success: function(data) {

                    location.reload();

                }

            });
        }

        function RemoveKeranjangQty(id) {
            const csrf = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                type: 'GET',
                url: "keranjang/" + id + "?action=remove",

                success: function(data) {

                    location.reload();

                }

            });
        }
    </script>
@endsection
