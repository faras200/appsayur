@extends('guests.layouts.main')

@section('container')
    <div class="main main-raised mt-4">
        <div class="container">
            <div class="card card-plain">
                <div class="card-body">
                    <h3 class="card-title">Keranjang Saya</h3>
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
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $jumlah = 0;
                                @endphp
                                @foreach ($keranjangs as $index => $keranjang)
                                    <tr>
                                        <td class="td-name card-avatar" colspan="6">
                                            <img class="img" width="30px" src="{{ asset('images/logo_lapak.png') }}" />
                                            Belanja di <a href="/lapak/{{ $index }}"> Lapak {{ $index }} </a>
                                        </td>
                                    </tr>
                                    @foreach ($keranjang as $item)
                                        <tr>
                                            <td>
                                                <div class="img-container">
                                                    <img src="{{ $item->post->image }}" alt="...">
                                                </div>
                                            </td>
                                            <td class="td-name">
                                                <a href="/posts/{{ $item->post->slug }}">{{ $item->post->title }}</a>
                                            </td>

                                            <td class="td-number text-right">
                                                <small>Rp. </small>{{ number_format($item->post->harga, 0, ',', '.') }}
                                            </td>
                                            <td class="td-number">
                                                {{ $item->qty }}
                                                <div class="btn-group btn-group-sm">
                                                    <button class="btn btn-sm btn-round btn-info "
                                                        {{ $item->qty == 1 ? 'disabled' : '' }}
                                                        style="padding: 6px 10px !important"
                                                        onclick="RemoveKeranjangQty({{ $item->post->id }})"> <i
                                                            class="material-icons">remove</i>
                                                    </button>
                                                    <button class="btn btn-sm btn-round btn-info"
                                                        style="padding: 6px 10px !important"
                                                        onclick="TambahKeranjang({{ $item->post->id }})"> <i
                                                            class="material-icons">add</i>
                                                    </button>
                                                </div>
                                            </td>
                                            <td class="td-number">
                                                <small>Rp.
                                                </small>{{ number_format($item->post->harga * $item->qty, 0, ',', '.') }}
                                                @php
                                                    $jumlah = $item->post->harga * $item->qty + $jumlah;
                                                @endphp
                                            </td>
                                            <td class="td-actions">
                                                <button type="button" onclick="RemoveKeranjang({{ $item->id }})"
                                                    rel="tooltip" data-placement="left" title="Remove item"
                                                    class="btn btn-link">
                                                    <i class="material-icons">close</i>
                                                </button>
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
                                    <td></td>
                                </tr>
                                <tr>
                                    <td colspan="4"></td>
                                    <td class="td-number" colspan="2"><button type="button" onclick="checkout()"
                                            class="btn btn-primary">Checkout
                                            Sekarang </button></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
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

        function checkout() {
            swal({
                    title: "Yakin ingin checkout?",
                    text: "Setelah checkout segera lakukan pembayaran!!",
                    icon: "warning",
                    buttons: ['Tidak', 'Yakin'],
                })
                .then((willDelete) => {
                    if (willDelete) {
                        window.location.href = '/checkout'
                    }
                });
        }
    </script>
@endsection
