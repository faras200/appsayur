@extends('guests.layouts.main')

@section('container')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h2 class="title">Latest {{ request('category') ? Str::title(request('category')) : 'Posts' }}</h2>
            </div>
            <div class="col-md-6 mt-4">
                <form action="/posts">
                    @if (request('category'))
                        <input type="hidden" name="category" value="{{ request('category') }}">
                    @endif
                    @if (request('authors'))
                        <input type="hidden" name="authors" value="{{ request('authors') }}">
                    @endif
                    <label class="control-label">Search...</label>
                    <input type="text" name="search" value="{{ request('search') }}"
                        class="form-control form-inline ml-auto" style="display: inline !important">
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary " style="display: inline !important">cari <i
                                class="material-icons">search</i> </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 ml-auto mr-auto">

                @if ($post->count())
                    @foreach ($post as $pos)
                        <div class="card card-plain card-blog">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="card-header card-header-image">
                                        <img class="img img-raised"
                                            style="min-height: 220px !important; max-height:220px !important;"
                                            src="{{ $pos->image }}">
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="card-category text-info"><a
                                            href="/home?category={{ $pos->category->slug }}">{{ $pos->category->name }}
                                    </h6>
                                    <h3 class="card-title">
                                        <a href="/posts/{{ $pos->slug }}">{{ Str::title($pos->title) }}</a>
                                    </h3>
                                    <p class="card-description">
                                        {{ $pos->excerpt }}
                                        <a href="/posts/{{ $pos->slug }}"> Read More </a>
                                    </p>
                                    <p class="author">
                                        by
                                        <a href="/home?authors={{ $pos->user->username }}"><b>{{ $pos->user->username }}
                                            </b>
                                        </a>, {{ $pos->created_at->diffForHumans() }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="mt-5">
                            <h3> <a href="/home/{{ $pos->slug }}">{{ $pos['title'] }}</a></h3>

                            <small class="text-muted"> By <a
                                    href="/home?authors={{ $pos->user->username }}">{{ $pos->user->name }}
                                </a> in <a href="/home?category={{ $pos->category->slug }}">{{ $pos->category->name }}
                                </a>
                                {{ $pos->created_at->diffForHumans() }}</small>
                            <p>{{ $pos['excerpt'] }}</p>
                            <a class="btn btn-primary" href="/home/{{ $pos->slug }}">Read More</a>
                        </div> --}}
                    @endforeach
                @else
                    <h2 class="text-center mt-5">Post Not Found</h2>
                @endif
                {{ $post->links('guests.layouts.paginate') }}
            </div>
        </div>
    </div>
@endsection
