{{-- @dd($post) --}}

@extends('layouts.main')

@section('container')
<h1 class="mt-5">Semua Kategori</h1>  
@foreach ($categories as $category)
<div class="mt-5">
<ul>
    <li>
        <h2>
            <a href="home?category={{ $category->slug }}">{{ $category->name }}</a>
        </h2>
    </li>
</ul>

</div>
@endforeach
@endsection
