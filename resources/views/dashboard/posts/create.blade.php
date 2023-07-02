@extends('dashboard.layouts.main')

@section('container')
    <div class="row">
        <div class="col-md-12" style="padding: 0px 0px !important">
            <div class="card ">
                <div class="card-header card-header-rose card-header-icon">
                    <div class="card-icon">
                        <i class="material-icons">contacts</i>
                    </div>
                    <h4 class="card-title">Form New Post</h4>
                </div>
                <div class="card-body ">
                    <form method="post" action="/dashboard/posts" enctype="multipart/form-data" class="form-horizontal">
                        @csrf
                        <div class="row ">
                            <div class="col-md-6 mb-4">
                                <label class=" col-form-label">Title</label>
                                <input type="text" name="title" id="title"class="form-control" required autofocus
                                    value="{{ old('title') }}">
                                @error('title')
                                    <div class="text-danger"> {{ $message }} </div>
                                @enderror

                            </div>
                            <div class="col-md-6 mb-4">

                                <label class=" col-form-label">Slug</label>
                                <input type="text" name="slug" id="slug" class="form-control"
                                    value="{{ old('slug') }}" required>
                                @error('slug')
                                    <div class="text-danger"> {{ $message }} </div>
                                @enderror

                            </div>
                            {{-- <div class="col-md-6 mb-4">
                                <img class="img-preview img-fluid col-sm-5" alt="">
                                <label class=" col-form-label">Image</label>
                  <div class="custom-file  ">
                    <input type="file" name="image" class=" custom-file-input" id="image" onchange="previewImage()">
                  </div>
                    @error('image')
                    <div class="text-danger"> {{ $message }} </div>
                   @enderror
                </div> --}}
                            <div class="col-md-6 mb-4">
                                <label class=" col-form-label">Foto</label>
                                <div class="input-group">
                                    <input id="thumbnail" class="form-control" type="text" name="image">
                                    <span class="input-group-btn">
                                        <a id="lfm" data-input="thumbnail" data-preview="holder"
                                            class="btn btn-fab btn-round btn-primary">
                                            <i class="fa fa-picture-o text-white"></i>
                                        </a>
                                    </span>
                                    @error('image')
                                        <div class="text-danger"> {{ $message }} </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">

                                <label class=" col-form-label">Category</label>
                                <select class="form-control selectpicker" name="category_id" data-style="btn btn-link"
                                    required>
                                    @foreach ($categories as $category)
                                        @if (old('category_id') == $category->id)
                                            <option value="{{ $category->id }}" selected>{{ $category->name }}
                                            </option>
                                        @else
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endif
                                    @endforeach
                                </select>

                            </div>
                        </div>
                        <div class="row ">
                            <div class="col-md-12">

                                <label class=" col-form-label">Content</label>
                                <textarea id="my-editor" rows="100" cols="100" name="body" class="form-control">{!! old('body', 'test editor content') !!}</textarea>

                            </div>
                        </div>

                </div>
                <div class="card-footer">
                    <div class="col-12">
                        <div class="text-right">
                            <button onclick="history.back()" class="btn btn-grey text-left">Kembali</button>
                            <button type="submit" class="btn btn-rose">Tambah</button>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- end row -->
    <script>
        var route_prefix = "../../laravel-filemanager";
        $('#lfm').filemanager('image', {
            prefix: route_prefix
        });
    </script>
    <script>
        const title = document.querySelector('#title');
        const slug = document.querySelector('#slug');

        title.addEventListener('change', function() {
            fetch('/dashboard/posts/checkSlug?title=' + title.value)
                .then(response => response.json())
                .then(data => slug.value = data.slug)
        });
    </script>

    <script>
        var options = {
            filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
            filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=123',
            filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
            filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token=123',
            resize_minHeight: 800

        };
    </script>
    <script>
        CKEDITOR.replace('my-editor', options);
    </script>
@endsection
