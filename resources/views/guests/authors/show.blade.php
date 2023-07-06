@extends('guests.layouts.main')

@section('container')
    <div class="container">
        <div class="row">
            <div class="col-md-6 ml-auto mr-auto">
                <div class="profile mt-4 text-center">
                    <div class="avatar">
                        <img src="{{ is_null($author->lapak->logo) ? asset('images/logo_lapak.png') : $author->lapak->logo }}"
                            alt="Circle Image" style="max-height: 250px !important"
                            class="img-raised rounded-circle img-fluid">
                    </div>
                    <div class="name">
                        <h3 class="title">{{ $author->lapak->nama }}</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="description col-md-10 ml-auto mr-auto text-center">
            <p>{{ $author->lapak->profil }}</p>
        </div>

        <div class="tab-content tab-space">
            <div class="tab-pane active work" id="work">
                <div class="row">
                    <div class="col-md-12 ml-auto mr-auto ">
                        <h3 class="title">Latest Product</h3>
                        <div class="row collections">
                            @if ($posts->count())
                                @foreach ($posts as $post)
                                    <div class="col-md-4">
                                        <a href="/posts/{{ $post->slug }}">
                                            <div class="card card-background"
                                                style="background-image: url('{{ $post->image }}')">

                                                <div class="card-body">
                                                    <label
                                                        class="badge {{ Str::is($post->category->name, 'Sayuran')
                                                            ? 'badge-success'
                                                            : (Str::is($post->category->name, 'Buah-buahan')
                                                                ? 'badge-warning'
                                                                : 'badge-info') }}  ">{{ $post->category->name }}</label>
                                                    <a href="/posts/{{ $post->slug }}">
                                                        <h3 class="card-title">{{ Str::title($post->title) }}</h3>
                                                    </a>
                                                    <p class="card-description">
                                                        {{ $post->excerpt }}
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            @else
                                <h4>Post Not Found</h4>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
