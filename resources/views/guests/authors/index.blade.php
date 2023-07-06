@extends('guests.layouts.main')

@section('container')
    <div class="container">
        <div class="row ">
            <div class="col-12 text-center">
                <h2 class="h2 ">Lapak Pedagang</h2>
            </div>
        </div>
        <div class="row">
            @foreach ($authors as $author)
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
        </div>
    </div>
@endsection
