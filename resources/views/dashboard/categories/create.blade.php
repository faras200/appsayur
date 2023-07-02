@extends('dashboard.layouts.main')

@section('container')
    <div class="row">
        <div class="col-md-12" style="padding: 0px 0px !important">
            <div class="card ">
                <div class="card-header card-header-rose card-header-icon">
                    <div class="card-icon">
                        <i class="material-icons">contacts</i>
                    </div>
                    <h4 class="card-title">Form New Category</h4>
                </div>
                <div class="card-body ">
                    <form method="post" action="/dashboard/categories" class="form-horizontal">
                        @csrf
                        <div class="row justify-content-center">
                            <label class="col-md-1 col-form-label">Nama Category</label>
                            <div class="col-md-9">
                                <div class="form-group has-default">
                                    <input type="text" name="name" id="name"class="form-control" required
                                        autofocus value="{{ old('name') }}">
                                    @error('name')
                                        <div class="text-danger"> {{ $message }} </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <label class="col-md-1 col-form-label">Slug</label>
                            <div class="col-md-9">
                                <div class="form-group has-default">
                                    <input type="text" name="slug" id="slug" class="form-control"
                                        value="{{ old('slug') }}" required>
                                    @error('slug')
                                        <div class="text-danger"> {{ $message }} </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                </div>
                <div class="card-footer justify-content-center">
                    <div class="row ">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-fill btn-rose">Create Category</button>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- end row -->

    <script>
        const name = document.querySelector('#name');
        const slug = document.querySelector('#slug');

        name.addEventListener('change', function() {
            fetch('/dashboard/categories/checkSlug?name=' + name.value)
                .then(response => response.json())
                .then(data => slug.value = data.slug)
        });
    </script>
@endsection
