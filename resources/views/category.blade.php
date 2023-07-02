{{-- @dd($post) --}}

@extends('layouts.main')

@section('container')
<h1 class="mt-5">Post Kategori : {{ $category }}</h1>  
<div class="mt-5">
@foreach ($posts as $pos)
<h2>
    <a href="/home/{{ $pos->slug }}">{{ $pos["title"] }}</a></h2>
<h5>By :{{ $pos["author"] }}</h5>
<p>{{ $pos["excerpt"] }}</p>
</div>
@endforeach
@endsection
