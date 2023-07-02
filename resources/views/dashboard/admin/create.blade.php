@extends('dashboard.layouts.main')

@section('container')
    <div class="row">
        <div class="col-md-12" style="padding: 0px 0px !important">
            <div class="card ">
                <div class="card-header card-header-rose card-header-icon">
                    <div class="card-icon">
                        <i class="material-icons">person_add_alt_1</i>
                    </div>
                    <h4 class="card-title">Tambah Admin</h4>
                </div>
                <div class="card-body mt-4">
                    <form method="post" action="/dashboard/admin" class="form-horizontal">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label class="">Nama Admin</label>
                                <input type="text" name="name" id="name"class="form-control" required autofocus
                                    value="{{ old('name') }}">
                                @error('name')
                                    <div class="text-danger"> {{ $message }} </div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-4">

                                <label class="">Email</label>
                                <input type="email" name="email" id="email"class="form-control" required autofocus
                                    value="{{ old('email') }}">
                                @error('email')
                                    <div class="text-danger"> {{ $message }} </div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="form-group ">
                                    <label for="role">Pilih peran</label>
                                    <select id="role" name="role" class="form-control mt-4"
                                        aria-label="With textarea" title="Role" value="">
                                        <option value="" disabled selected></option>
                                        <option value="upt_it">UPT IT</option>
                                        <option value="baak">BAAK</option>
                                        <option value="warek">Warek3</option>
                                    </select>
                                    @error('role')
                                        <div class="text-danger"> {{ $message }} </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <label class="">Password</label>
                                <input type="password" name="password" id="password"class="form-control" required autofocus
                                    value="{{ old('password', 'password') }}">
                                <p>default password adalah "password"</p>
                                @error('password')
                                    <div class="text-danger"> {{ $message }} </div>
                                @enderror
                            </div>
                        </div>

                </div>
                <div class="card-footer ">
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
        const name = document.querySelector('#name');
        const slug = document.querySelector('#slug');

        name.addEventListener('change', function() {
            fetch('/dashboard/categories/checkSlug?name=' + name.value)
                .then(response => response.json())
                .then(data => slug.value = data.slug)
        });
    </script>
@endsection
