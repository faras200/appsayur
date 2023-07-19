@extends('guests.layouts.main')

@section('container')
    <div class="container">
        <h3 class="title text-center pt-4" style="margin-top: 0px !important; margin-bottom: 0px !important; ">Sayuran</h3>
        <div class="row">
            @foreach ($beritas as $berita)
                <div class="col-md-4 col-xs-6">
                    <div class="card card-raised card-background"
                        style="background-image: url('{{ $berita->image }}'); height:280px;">
                        <div class="card-body">
                            <h6 class="card-category text-info">{{ $berita->category->slug }}</h6>
                            <a href="/posts/{{ $berita->slug }}">
                                <h3 class="card-title">{{ Str::title($berita->title) }}</h3>
                            </a>
                            <p class="card-description">
                                {{ $berita->excerpt }}
                            </p>
                            <h4 class="text-white">Rp. {{ number_format($berita->harga, 0, ',', '.') }}</h4>
                        </div>
                        <div class="card-footer justify-content-center"
                            style="z-index: 200; margin-top: -25px !important; ">
                            <a href="/keranjang/{{ $berita->id }}" class="btn btn-danger btn-round">
                                <i class="material-icons">shopping_cart</i> Order Now
                            </a>
                        </div>

                    </div>
                </div>
            @endforeach
            <div class="col-12 text-center mt-4">
                <a href="/posts?category=sayuran" class="btn btn-success btn-round">Lihat Semua Sayuran <i
                        class="material-icons">
                        double_arrow
                    </i></a>
            </div>
        </div>

        <h3 class="title text-center" style="margin-bottom: 0px !important; ">Buah-buahan</h3>

        <div class="row">
            @foreach ($kegiatans as $kegiatan)
                <div class="col-md-4 col-xs-6">
                    <div class="card card-raised card-background"
                        style="background-image: url('{{ $kegiatan->image }}'); height:280px;">
                        <div class="card-body">
                            <h6 class="card-category text-info">{{ $kegiatan->category->slug }}</h6>
                            <a href="/posts/{{ $kegiatan->slug }}">
                                <h3 class="card-title">{{ Str::title($kegiatan->title) }}</h3>
                            </a>
                            <p class="card-description">
                                {{ $kegiatan->excerpt }}
                            </p>
                            <h4 class="text-white">Rp. {{ number_format($kegiatan->harga, 0, ',', '.') }}</h4>
                        </div>
                        <div class="card-footer justify-content-center"
                            style="z-index: 200; margin-top: -25px !important; ">
                            <a href="/keranjang/{{ $kegiatan->id }}" class="btn btn-danger btn-round">
                                <i class="material-icons">shopping_cart</i> Order Now
                            </a>
                        </div>

                    </div>
                </div>
            @endforeach
            <div class="col-12 text-center mt-4">
                <a href="/posts?category=buah-buahan" class="btn btn-success btn-round">Lihat Semua Buah <i
                        class="material-icons">
                        double_arrow
                    </i></a>
            </div>
        </div>

        <h3 class="title text-center">Lapak pedagang</h3>
        <div class="row">
            @foreach ($ormawas as $author)
                <div class="col-md-4">
                    <div class="card card-profile card-plain">
                        <div class="card-header card-avatar">
                            <a href="lapak/{{ $author->username }}">
                                <img class="img"
                                    src="{{ is_null($author->lapak->logo) ? asset('images/logo_lapak.png') : $author->lapak->logo }}" />
                            </a>
                        </div>
                        <div class="card-body ">
                            <h4 class="card-title">{{ $author->lapak->nama }}</h4>
                            <p class="card-description">
                                {{ Str::limit(strip_tags($author->lapak->profil), 100) }}
                            </p>
                        </div>
                        <div class="card-footer justify-content-center">
                            <a href="lapak/{{ $author->username }}" class="btn  btn-link btn-twitter"><i
                                    class="material-icons">visibility</i> Read More..</a>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="col-12 text-center mb-5">
                <a href="/lapak" class="btn btn-success btn-round">Lihat Semua Lapak <i class="material-icons">
                        double_arrow
                    </i></a>
            </div>
        </div>
    </div>
@endsection
