@extends('dashboard.layouts.main')

@section('container')
    <div class="row">
        <div class="col-md-12" style="padding: 0px 0px !important">
            <div class="card ">
                <div class="card-header card-header-rose card-header-icon">
                    <div class="card-icon">
                        <i class="material-icons">
                            security
                        </i>
                    </div>
                    <h4 class="card-title">Tambah Pengambilan Dana</h4>
                </div>
                <div class="card-body mt-4">
                    <form method="post" action="/dashboard/ambil-dana" class="form-horizontal">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label class="">Ormawa</label>
                                <select id="ormawa" name="ormawa_id" class="form-control" aria-label="With textarea">
                                    <option hidden>pilih ormawa</option>
                                    @foreach ($ormawas as $ormawa)
                                        <option value="{{ $ormawa->id }}">{{ $ormawa->nama }}</option>
                                    @endforeach
                                </select>
                                @error('ormawa_id')
                                    <div class="text-danger"> {{ $message }} </div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-4">
                                <label class="">Pengajuan</label>
                                <select id="pengajuan" name="pengajuan_id" class="form-control">

                                </select>
                                @error('pengajuan_id')
                                    <div class="text-danger"> {{ $message }} </div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-4">
                                <label class="">Jadwal Pengambilan</label>
                                <input type="date" class="form-control" name="jadwal_pengambilan">
                                @error('jadwal_pengambilan')
                                    <div class="text-danger"> {{ $message }} </div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-4">
                                <label class="">Jumlah Dana</label>
                                <input type="text" class="form-control" id="dengan-rupiah" name="jumlah_dana">
                                @error('jadwal_pengambilan')
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

    <script>
        /* Dengan Rupiah */
        var dengan_rupiah = document.getElementById('dengan-rupiah');
        dengan_rupiah.addEventListener('keyup', function(e) {
            dengan_rupiah.value = formatRupiah(this.value, 'Rp. ');
        });

        /* Fungsi */
        function formatRupiah(angka, prefix) {
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
        }
    </script>
    <script>
        $(document).ready(function() {
            $('#ormawa').on('change', function() {
                var ormawaID = $(this).val();
                if (ormawaID) {
                    $.ajax({
                        url: '/getpengajuan/' + ormawaID,
                        type: "GET",
                        data: {
                            "_token": "{{ csrf_token() }}"
                        },
                        dataType: "json",
                        success: function(data) {
                            if (data != 0) {
                                $('#pengajuan').empty();
                                $('#pengajuan').append(
                                    '<option hidden>Pilih Pengajuan</option>');

                                $.each(data, function(key, course) {
                                    //console.log(course.subjek + "=" + course.id);
                                    $('#pengajuan').append(
                                        '<option value="' + course.id + '">' +
                                        course
                                        .subjek + '</option>');
                                });
                                // $.each(data, function() {
                                //     $.each(this, function(name, value) {
                                //         console.log(name + "=" + value);
                                //     });
                                // });
                            } else {
                                $('#pengajuan').empty();
                                $('#pengajuan').append('<option hidden>Data Kosong</option>');
                            }
                        }
                    });
                } else {
                    $('#pengajuan').empty();
                }
            });
        });
    </script>
    <!-- end row -->
@endsection
