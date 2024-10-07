@extends('main.layouts.index')

@php
	$card = [1,2,3,4];
@endphp


@push('style')
<link rel="stylesheet" type="text/css" href="{{asset('zoom/css/jquery.pan.css')}}"><!--zoomImage-->
@endpush

@section('content')
@include('main.include.breadcrumb')
<div class="row">
	<div class="col-12 col-md-6">
		<div class="card mb-3">
			<div class="card-header bg-main-website text-white">Data Umum</div>
			<div class="card-body">
				<form id="formDataUmum">
					<input type="hidden" name="id" @isset($identitas) value="{{$identitas->id_identitas}}" @endif>
					<div class="mb-3">
						<label for="nama_web" class="form-label">Nama Website *</label>
						<input type="text" class="form-control" id="nama_web" name="nama_web" placeholder="Nama Website" @isset($identitas) value="{{$identitas->nama_web}}" @endif>
					</div>
					<div class="mb-3">
						<label for="url" class="form-label">URL *</label>
						<input type="text" class="form-control" id="url" name="url" placeholder="www.nama-website.com" @isset($identitas) value="{{$identitas->url}}" @endif>
					</div>
					<div class="mb-3">
						<label for="meta" class="form-label">Meta *</label>
						<input type="text" class="form-control" id="meta" name="meta" placeholder="meta" @isset($identitas) value="{{$identitas->meta}}" @endif>
					</div>
					<div class="mb-3">
						<label for="alamat" class="form-label">Alamat SMA Putra *</label>
						<input type="text" class="form-control" id="alamat" name="alamat" placeholder="alamat" @isset($identitas) value="{{$identitas->alamat}}" @endif>
					</div>
					<div class="mb-3">
						<label for="alamat_1" class="form-label">Alamat SMA Putri *</label>
						<input type="text" class="form-control" id="alamat_1" name="alamat_1" placeholder="alamat" @isset($identitas) value="{{$identitas->alamat_1}}" @endif>
					</div>
					<div class="mb-3">
						<label for="logo_kiri" class="form-label">Logo *</label>
						<center class="mb-3">
							<a class="pan" id="btnOutPut" data-big="@isset($identitas){!! url('uploads/identitas/'.$identitas->logo_kiri) !!}@endisset">
								<img id="outPut" @isset($identitas) src="{!! url('uploads/identitas/'.$identitas->logo_kiri) !!}" @endisset class="rounded mx-auto d-block responsive @isset($identitas) img-thumbnail w-50 @endisset">
							</a>
						</center>
						<input type="file" class="form-control" id="logo_kiri" name="logo_kiri" onchange="loadFileLogo(event)">
					</div>
					<div class="mb-3">
						<label for="phone" class="form-label">No Telepon *</label>
						<input type="text" class="form-control" id="phone" name="phone" placeholder="089xxxxxxxx" @isset($identitas) value="{{$identitas->phone}}" @endif>
					</div>
					<div class="mb-3">
						<label for="email" class="form-label">Email *</label>
						<input type="email" class="form-control" id="email" name="email" placeholder="nama@email.com"@isset($identitas) value="{{$identitas->email}}" @endif>
					</div>
					<div class="mb-3">
						<label for="favicon" class="form-label">Icon Website *</label>
						<center class="mb-3">
							<a class="pan" id="btnOutPut2" data-big="@isset($identitas){!! url('uploads/identitas/'.$identitas->favicon) !!}@endisset">
								<img id="outPut2" @isset($identitas) src="{!! url('uploads/identitas/'.$identitas->favicon) !!}" @endisset class="rounded mx-auto d-block responsive @isset($identitas) img-thumbnail w-50 @endisset">
							</a>
						</center>
						<input type="file" class="form-control" id="favicon" name="favicon" onchange="loadFilePhoto(event)">
					</div>
					<div class="w-100">
						<button id="btnSimpanDataUmum" class="btn btn-primary w-100">SIMPAN</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="col-12 col-md-6">
		<div class="card mb-3">
			<div class="card-header bg-main-website text-white">Data Kontak</div>
			<div class="card-body">
				<form id="formDataKontak">
					<div class="mb-3">
						<label for="fans_page" class="form-label">Facebook Fans Page *</label>
						<input type="text" class="form-control" id="fans_page" name="fans_page" placeholder="www.facebook.com/fans-page" @isset($identitas) value="{{$identitas->fans_page}}" @endif>
					</div>
					<div class="mb-3">
						<label for="fb" class="form-label">Facebook *</label>
						<input type="text" class="form-control" id="fb" name="fb" placeholder="www.facebook.com" @isset($identitas) value="{{$identitas->fb}}" @endif>
					</div>
					<div class="mb-3">
						<label for="instagram" class="form-label">Instagram *</label>
						<input type="text" class="form-control" id="instagram" name="instagram" placeholder="www.instagram.com" @isset($identitas) value="{{$identitas->instagram}}" @endif>
					</div>
					<div class="mb-3">
						<label for="twitter" class="form-label">Twitter *</label>
						<input type="text" class="form-control" id="twitter" name="twitter" placeholder="www.twitter.com" @isset($identitas) value="{{$identitas->twitter}}" @endif>
					</div>
					<div class="mb-3">
						<label for="googleplus" class="form-label">Google+ *</label>
						<input type="text" class="form-control" id="googleplus" name="googleplus" placeholder="www.google.com" @isset($identitas) value="{{$identitas->googleplus}}" @endif>
					</div>
					<div class="mb-3">
						<label for="youtube" class="form-label">Youtube *</label>
						<input type="text" class="form-control" id="youtube" name="youtube" placeholder="www.youtube.com" @isset($identitas) value="{{$identitas->youtube}}" @endif>
					</div>
					<div class="mb-3">
						<label for="tiktok" class="form-label">TikTok *</label>
						<input type="text" class="form-control" id="tiktok" name="tiktok" placeholder="www.tiktok.com" @isset($identitas) value="{{$identitas->tiktok}}" @endif>
					</div>
					<div class="w-100">
						<button id="btnSimpanDataKontak" class="btn btn-primary w-100">Simpan</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection

@push('script')
<script src="{{asset('zoom/js/jquery.pan.js')}}"></script><!--zoomImage-->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
	$(document).ready(function () {
		$('.select2').select2({
			theme: 'bootstrap-5',
		});
		$('.pan').pan()
	})
	function loadFilePhoto(event) {
		var btn2 = $('#btnOutPut2')[0] // html DOM Object
		var outPut2 = $('#outPut2')[0]
		outPut2.src = URL.createObjectURL(event.target.files[0])
		outPut2.onload = function(){
			URL.revokeObjectURL(outPut2.src)
		}
		btn2 = $('#btnOutPut2').attr('data-big',URL.createObjectURL(event.target.files[0]))
		$('#outPut2').addClass('img-thumbnail w-50')
	};
	function loadFileLogo(event) {
		var btn = $('#btnOutPut')[0] // html DOM Object
		var outPut = $('#outPut')[0]
		outPut.src = URL.createObjectURL(event.target.files[0])
		outPut.onload = function(){
			URL.revokeObjectURL(outPut.src)
		}
		btn = $('#btnOutPut').attr('data-big',URL.createObjectURL(event.target.files[0]))
		$('#outPut').addClass('img-thumbnail w-50')
	};

	$('#btnSimpanDataUmum').click(function (e) {
		e.preventDefault()
		console.log('jancuk');
		var data = new FormData($('#formDataUmum')[0])
		$('.btnSimpanDataUmum').attr('disabled',true).html('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>LOADING...')
		$.ajax({
			url: '{{route("main.identitas.saveDataUmum")}}',
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
						// location.reload()
					}, 1100);
				}else{
					Swal.fire({
						icon: 'warning',
						title: 'Whoops',
						text: data.message,
						showConfirmButton: false,
						timer: 1300,
					})
				}
				$('.btnSimpanDataUmum').attr('disabled',false).html('SIMPAN')
			}
		}).fail(()=>{
			Swal.fire({
				icon: 'error',
				title: 'Whoops..',
				text: 'Terjadi kesalahan silahkan ulangi kembali',
				showConfirmButton: false,
				timer: 1300,
			})
			$('.btnSimpanDataUmum').attr('disabled',false).html('SIMPAN')
		})
	})

	$('#btnSimpanDataKontak').click(function (e) {
		e.preventDefault()
		var data = new FormData($('#formDataKontak')[0])
		$('.btnSimpanDataKontak').attr('disabled',true).html('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>LOADING...')
		$.ajax({
			url: '{{route("main.identitas.saveDataKontak")}}',
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
						// location.reload()
					}, 1100);
				}else{
					Swal.fire({
						icon: 'warning',
						title: 'Whoops',
						text: data.message,
						showConfirmButton: false,
						timer: 1300,
					})
				}
				$('.btnSimpanDataKontak').attr('disabled',false).html('SIMPAN')
			}
		}).fail(()=>{
			Swal.fire({
				icon: 'error',
				title: 'Whoops..',
				text: 'Terjadi kesalahan silahkan ulangi kembali',
				showConfirmButton: false,
				timer: 1300,
			})
			$('.btnSimpanDataKontak').attr('disabled',false).html('SIMPAN')
		})
	})
</script>
@endpush