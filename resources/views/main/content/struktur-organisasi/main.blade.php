@extends('main.layouts.index')

@push('style')
	<link rel="stylesheet" type="text/css" href="{{asset('zoom/css/jquery.pan.css')}}"><!--zoomImage-->
@endpush

@section('content')
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header bg-main-website text-white">
					Struktur Organisasi
				</div>
				<div class="card-body">
					<form id="formStrukturOrganisasi">
						<div class="mb-3">
							<label for="struktur_organisasi" class="form-label">Upload Gambar *</label>
							<center class="mb-3">
								<a class="pan" id="btnOutPut" data-big="@isset($identitas){!! url('uploads/strukturorganisasi/'.$identitas->struktur_organisasi) !!}@endisset">
									<img id="outPut" @isset($identitas) src="{!! url('uploads/strukturorganisasi/'.$identitas->struktur_organisasi) !!}" @endisset class="rounded mx-auto d-block responsive @isset($identitas) img-thumbnail w-50 @endisset">
								</a>
							</center>
							<input type="file" class="form-control" name="struktur_organisasi" id="struktur_organisasi">
							<p class="text-muted fst-italic">
								* maks. ukuran file foto 2Mb, <br>* ukruan foto landscape
							</p>
						</div>
						<button class="btn btn-primary w-100 btnSimpan">SIMPAN</button>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection

@push('script')
	<script src="{{ asset('admin/assets/plugins/select2/js/select2.min.js') }}"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script src="{{asset('zoom/js/jquery.pan.js')}}"></script><!--zoomImage-->
	<script>
		$(document).ready(function () {
			$('.select2').select2({
				theme: 'bootstrap-5',
			});
			$('.pan').pan()
		})

		$('.btnSimpan').click((e) => {
			e.preventDefault()
			var data = new FormData($('#formStrukturOrganisasi')[0])
			$('.btnSimpan').attr('disabled',true).html('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>LOADING...')
			$.ajax({
                url: '{{route("main.profilSekolah.strukturOrganisasi.save")}}',
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
                            timer: 1200
                        })
                        setTimeout(()=>{
							location.reload()
                        }, 1100);
                        // location.reload()
                    }else{
                        Swal.fire({
                            icon: 'warning',
                            title: 'Whoops',
                            text: data.message,
                            showConfirmButton: false,
                            timer: 1300,
                        })
                    }
                    $('.btnSimpan').attr('disabled',false).html('SIMPAN')
                }
            }).fail(()=>{
                Swal.fire({
                    icon: 'error',
                    title: 'Whoops..',
                    text: 'Terjadi kesalahan silahkan ulangi kembali',
                    showConfirmButton: false,
                    timer: 1300,
                })
                $('.btnSimpan').attr('disabled',false).html('SIMPAN')
            })
		})

		function loadFilePhoto(event) {
			var btn = $('#btnOutPut')[0] // html DOM Object
			var outPut = $('#outPut')[0]
			outPut.src = URL.createObjectURL(event.target.files[0])
			outPut.onload = function(){
				URL.revokeObjectURL(outPut.src)
			}
			btn = $('#btnOutPut').attr('data-big',URL.createObjectURL(event.target.files[0]))
			$('#outPut').addClass('img-thumbnail w-50')
		};
	</script>
@endpush