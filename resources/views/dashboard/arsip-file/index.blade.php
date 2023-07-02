@extends('dashboard.layouts.main')

@section('container')
    <div class="row">

        <div class="col-md-12" style="padding: 0px 0px !important" id="ckfinder-widget">
            <iframe src="/laravel-filemanager?type=Files"
                style="width: 100%; height: 600px; overflow: hidden; border: none;"></iframe>
            <!--  end card  -->
        </div>
        <!-- end col-md-12 -->
    </div>
    <!-- end row -->
@endsection
