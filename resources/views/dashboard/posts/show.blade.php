@extends('dashboard.layouts.main')

@section('container')
    <div class="row">
        <div class="col-md-12" style="padding: 0px 0px !important">
            <div class="card ">
                <div class="card-body ">
                    <h2>{{ $post['title'] }}</h2>
                    <h5>By <a href="/home?authors={{ $post->user->username }}">{{ $post->user->name }} </a> in <a
                            href="/home?category={{ $post->category->slug }}">{{ $post->category->name }} </a> </h5>
                    <div style="max-height: 400px; overflow:hidden">
                        <img src="{{ $post->image }}" alt="photo" class="img-fluid mt-3">
                    </div>
                    <p>{!! $post->body !!}</p>
                    <a class="btn" href="./">Kembali</a>
                </div>
            </div>
        </div>
    </div>
@endsection
