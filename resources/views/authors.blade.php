{{-- @dd($post) --}}

@extends('layouts.main')

@section('container')
<h1 class="mt-5">Semua Authors</h1>  
@foreach ($authors as $author)
<div class="mt-5">
<ul>
    <li>
        <h2>
            <a href="/home?authors={{ $author->username }}">{{ $author->name }}</a>
        </h2>
    </li>
</ul>

</div>
@endforeach
@endsection
