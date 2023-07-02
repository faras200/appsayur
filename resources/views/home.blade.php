{{-- @dd($post) --}}

@extends('layouts.main')


@if ($post->count())

    @section('container')

        <h2 class="mt-5">{{ $title }}</h2>
        <div class="row">
            <div class="col-md-6">
                <form action="/home">
                    <div class="form-group label-floating col-md-6">
                        @if (request('category'))
                            <input type="hidden" name="category" value="{{ request('category') }}">
                        @endif
                        @if (request('authors'))
                            <input type="hidden" name="authors" value="{{ request('authors') }}">
                        @endif
                        <label class="control-label">Search...</label>
                        <input type="text" name="search" value="{{ request('search') }}" class="form-control"
                            style="display: inline !important">
                    </div>
                    <div class="col-md-6 mb--2">
                        <button type="submit" class="btn btn-primary col-md-6"
                            style="display: inline !important">cari</button>
                    </div>
                </form>
            </div>
        </div>
        @foreach ($post as $pos)
            <div class="mt-5">
                <h3> <a href="/home/{{ $pos->slug }}">{{ $pos['title'] }}</a></h3>

                <small class="text-muted"> By <a href="/home?authors={{ $pos->user->username }}">{{ $pos->user->name }}
                    </a> in <a href="/home?category={{ $pos->category->slug }}">{{ $pos->category->name }} </a>
                    {{ $pos->created_at->diffForHumans() }}</small>
                <p>{{ $pos['excerpt'] }}</p>
                <a class="btn btn-primary" href="/home/{{ $pos->slug }}">Read More</a>
            </div>
        @endforeach
    @else
    @section('container')
        <h2 class="text-center mt-5">Post Not Found</h2>
    @endif
    {{ $post->links() }}
@endsection
