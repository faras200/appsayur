@extends('dashboard.layouts.main')

@section('container')

<div class="row">
  
    <div class="col-md-12">
        @include('ckfinder::setup')

        <script>
            CKFinder.start();
        </script>
      <!--  end card  -->
    </div>
    <!-- end col-md-12 -->
  </div>
  <!-- end row -->
@endsection