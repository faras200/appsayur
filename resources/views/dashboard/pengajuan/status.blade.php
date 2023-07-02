@extends('dashboard.layouts.main')

@section('container')
    <div class="row">
        <style>
            body {
                background: #fff;
            }

            h1 {
                text-align: center;
                text-transform: uppercase;
            }

            .container {
                width: 1200px;
                margin: auto;
            }

            .timeline {
                counter-reset: test 0;
                position: relative;
            }

            .timeline li {
                list-style: none;
                float: left;
                width: 16.666%;
                position: relative;
                text-align: center;
                text-transform: uppercase;
            }

            ul:nth-child(1) {
                color: #4caf50;
            }

            .timeline li:before {
                counter-increment: test;
                content: counter(test);
                width: 50px;
                height: 50px;
                border: 3px solid #4caf50;
                border-radius: 50%;
                display: block;
                text-align: center;
                line-height: 50px;
                margin: 0 auto 10px auto;
                background: #fff;
                color: #000;
                transition: all ease-in-out .3s;
                cursor: pointer;
            }

            .timeline li:after {
                content: "";
                position: absolute;
                width: 100%;
                height: 1px;
                background-color: grey;
                top: 25px;
                left: -50%;
                z-index: -999;
                transition: all ease-in-out .3s;
            }

            .timeline li:first-child:after {
                content: none;
            }

            .timeline li.active-tl {
                color: #555555;
            }

            .timeline li.active-tl:before {
                background: #4caf50;
                color: #F1F1F1;
            }

            .timeline li.active-tl+li:after {
                background: #4caf50;
            }

            timeline li.active-er {
                color: #555555;
            }

            .timeline li.active-er:before {
                background: #ff0000c5;
                color: #F1F1F1;
            }

            .timeline li.active-er+li:after {
                background: #ff0000c5;
            }
        </style>
        <div class="container text-center">
            <h4>Status Proses Persetujuan Pengajuan</h4>
            @if ($pengajuan->status == 'tolak')
            <style>
                body {
                    background: #fff;
                }
    
                h1 {
                    text-align: center;
                    text-transform: uppercase;
                }
    
                .container {
                    width: 1200px;
                    margin: auto;
                }
    
                .timeline {
                    counter-reset: test 0;
                    position: relative;
                }
    
                .timeline li {
                    list-style: none;
                    float: left;
                    width: 16.666%;
                    position: relative;
                    text-align: center;
                    text-transform: uppercase;
                }
    
                ul:nth-child(1) {
                    color: #4caf50;
                }
    
                .timeline li:before {
                    counter-increment: test;
                    content: counter(test);
                    width: 50px;
                    height: 50px;
                    border: 3px solid #ff0000c5;
                    border-radius: 50%;
                    display: block;
                    text-align: center;
                    line-height: 50px;
                    margin: 0 auto 10px auto;
                    background: #fff;
                    color: #000;
                    transition: all ease-in-out .3s;
                    cursor: pointer;
                }
    
                .timeline li:after {
                    content: "";
                    position: absolute;
                    width: 100%;
                    height: 1px;
                    background-color: grey;
                    top: 25px;
                    left: -50%;
                    z-index: -999;
                    transition: all ease-in-out .3s;
                }
    
                .timeline li:first-child:after {
                    content: none;
                }
    
                .timeline li.active-er {
                    color: #555555;
                }
    
                .timeline li.active-er:before {
                    background: #ff0000c5;
                    color: #F1F1F1;
                }
    
                .timeline li.active-er+li:after {
                    background: #ff0000c5;
                }
            </style>
            <ul class="timeline">
                <li class="active-er">
                    Pengajuan</li>
                <li
                    class="active-er">
                    DEMA</li>
                <li
                    class="active-er">
                    " BEM</li>
                <li
                    class="active-er">
                    WAREK 3</li>
                <li
                    class="active-er">
                    BAAK</li>
                <li class="active-er">Selesai</li>
            </ul>
            @else
            <ul class="timeline">
                <li class="active-tl">
                    Pengajuan</li>
                <li
                    class="{{ (Str::is($pengajuan->persetujuan->dema, '2') ? 'active-tl' : Str::is($pengajuan->persetujuan->dema, '0')) ? 'active-tl' : '' }}">
                    DEMA</li>
                <li
                    class="{{ (Str::is($pengajuan->persetujuan->bem, '2') ? 'active-tl' : Str::is($pengajuan->persetujuan->bem, '0')) ? 'active-tl' : '' }}">
                    " BEM</li>
                <li
                    class="{{ (Str::is($pengajuan->persetujuan->warek, '2') ? 'active-tl' : Str::is($pengajuan->persetujuan->warek, '0')) ? 'active-tl' : '' }}">
                    WAREK 3</li>
                <li
                    class="{{ (Str::is($pengajuan->persetujuan->baak, '2') ? 'active-tl' : Str::is($pengajuan->persetujuan->baak, '0')) ? 'active-tl' : '' }}">
                    BAAK</li>
                <li class="{{ Str::is($pengajuan->status, 'setuju') ? 'active-tl' : '' }}">Selesai</li>
            </ul>
            @endif
            
        </div>
    </div>
    <div class="row">
        <div class="col-md-12" style="padding: 0px 0px !important">
            <div class="card">
                <div class="card-header card-header-primary card-header-icon">
                    <h4 class="card-title">Detail Pengajuan</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0"
                            width="100%" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Ormawa Pengaju</th>
                                    <th>Subjek</th>
                                    <th>Jenis</th>
                                    <th>Status</th>

                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $pengajuan->ormawa->nama }}</td>
                                    <td>{{ $pengajuan->subjek }}</td>
                                    <td>{{ $pengajuan->jenis }}</td>
                                    <td
                                    class="{{ (Str::is($pengajuan->status, 'setuju')) ? 'text-success' : ((Str::is($pengajuan->status, 'revisi') ? 'text-warning' : ((Str::is($pengajuan->status, 'tolak') ? 'text-danger' : 'text-primary')))) }} text-capitalize">
                                    {{ 
                                    (Str::is($pengajuan->status, 'setuju')) ? 'Di Setujui' : ((Str::is($pengajuan->status, 'revisi') ? 'Di' : ((Str::is($pengajuan->status, 'tolak') ? 'Di' : 'Sedang di ')))) .   
                                    ' '. $pengajuan->status }}</td>
                                </tr>

                                @php
                                    $files = Str::of($pengajuan->file)->explode(',');
                                @endphp
                                @foreach ($files as $file)
                                    <tr>
                                        <td colspan="4">
                                            <div class="text-center">
                                                <h4>File {{ $loop->iteration }}</h4>
                                            </div>
                                            <iframe src="{{ $file }}" width="100%" height="600"></iframe>
                                        </td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <th colspan="4" class="text-center">
                                        Catatan Revisi
                                    </th>
                                </tr>
                                <tr>
                                    <td colspan="4">
                                        <div class="form-group">
                                            <textarea class="form-control" readonly name="catatan_revisi" id="" cols="30" rows="10">{{ $pengajuan->catatan_revisi }}</textarea>
                                        </div>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- end content-->
            </div>
            <!--  end card  -->
        </div>
        <!-- end col-md-12 -->
    </div>
    <!-- end row -->
@endsection
