@extends('landing-page.layouts.index')

@push('style')
	<style>
	</style>
@endpush

@section('content')
    @include('landing-page.include.page-title')
    <div class="row m-0 pb-5">
        <div class="col-12">
            <div class="spacer">
                <div class="wrapper">
                    <div class="p-top-sm spacer title">
                        <h4>{{$curMenu}}</h4>
                    </div>
                    <div class="row p-top-sm spacer">
                        <form id="formAlumni" class="col-12">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="nisn">NISN (Nomor Induk Siswa Nasional) *</label>
                                    <input type="text" class="form-control" id="nisn" name="nisn" placeholder="NISN">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="nama">Nama Lengkap *</label>
                                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Lengkap">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="no_hp">No. HP</label>
                                    <input type="text" class="form-control" id="no_hp" name="no_hp" placeholder="08xxxxxxxx">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="tahun_lulus">Tahun Lulus *</label>
                                    <input type="text" class="form-control" id="tahun_lulus" name="tahun_lulus">
                                    {{-- <select class="form-control" name="tahun_lulus" id="tahun_lulus">
                                        <option value="">-PILIH-</option>
                                    </select> --}}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="kondisi">Jelaskan kamu saat ini setelah lulus sekolah ya! *</label>
                                <textarea type="text" class="form-control" id="kondisi" name="kondisi" rows="4" placeholder="Saya sekarang sudah bekerja di ..."></textarea>
                            </div>
                            <button id="kirim" class="btn btn-success btn-kirim" type="button">Kirim</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('landing-page.include.hubungi-kami')
@endsection

@push('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $('.btn-kirim').click((e)=>{
        e.preventDefault()
        var data = new FormData($('#formAlumni')[0])
		$('.btn-save').attr('disabled',true).html('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>LOADING...')
		$.ajax({
                url: "{{route('sendAlumni')}}",
                type: 'POST',
                data: data,
                async: true,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data){
                    if(data.code==200){
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: data.message,
                            showConfirmButton: false,
                            timer: 1300,
                        })
                    }else{
                        Swal.fire({
                            icon: 'warning',
                            title: 'Whoops',
                            text: data.message,
                            showConfirmButton: false,
                        })
                    }
                    $('.btn-kirim').attr('disabled',false).html('Kirim')
                }
            }).fail(()=>{
                Swal.fire({
                    icon: 'error',
                    title: 'Whoops..',
                    text: 'Terjadi kesalahan silahkan ulangi kembali',
                    showConfirmButton: false,
                })
                $('.btn-kirim').attr('disabled',false).html('Kirim')
            })
    })
</script>
@endpush