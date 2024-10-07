@extends('main.layouts.index')

@php
	$tambah = true;
@endphp

@section('content')
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header bg-main-website text-white">
					Visi dan Misi
				</div>
				<div class="card-body">
					<form id="formVm">
					    <div class="row mb-3">
							<div class="col-md-12">
								<textarea id="vm" name="vm" rows="40" cols="100" class="form-control">@isset($identitas) {{$identitas->vm}} @endisset</textarea>
							</div>
						</div>
						{{--<div class="mb-3">
							<label for="foto" class="form-label">Foto Sekolah *</label>
							<input type="file" class="form-control" name="foto" id="foto">
							<p class="text-muted fst-italic">
								* maks. ukuran file foto 2Mb, <br>* ukruan foto landscape
							</p>
						</div>
						<div class="mb-3">
							<label for="judul_konten" class="form-label">Judul Konten Visi dan Misi *</label>
							<input type="text" class="form-control" name="judul_konten" id="judul_konten" placeholder="Judul konten visi dan misi">
						</div>
						<div class="row">
							<div class="col-12 col-md-6">
								<div class="mb-3">
									<label for="judul_visi" class="form-label">Judul Visi *</label>
									<input type="text" class="form-control" name="judul_visi" id="judul_visi" placeholder="Judul visi">
								</div>
							</div>
							<div class="col-12 col-md-6">
								<div class="mb-3">
									<label for="judul_misi" class="form-label">Judul Misi *</label>
									<input type="text" class="form-control" name="judul_misi" id="judul_misi" placeholder="Judul misi">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-12 col-md-6">
								<div class="mb-3">
									<label for="visi" class="form-label">Visi *</label>
									<textarea type="text" class="form-control" name="visi" id="visi" placeholder="Visi" rows="10"></textarea>
								</div>
							</div>
							<div class="col-12 col-md-6">
								<div class="mb-3">
									<label for="misi" class="form-label">Misi *</label>
									<textarea type="text" class="form-control" name="misi" id="misi" placeholder="misi" rows="10"></textarea>
								</div>
							</div>
						</div>--}}
						<button class="btn btn-primary w-100 btnSimpan">SIMPAN</button>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection

@push('script')
	<script src="{{ asset('admin/assets/plugins/select2/js/select2.min.js') }}"></script>
	<script src="{{ asset('admin/assets/js/ckeditor1/ckeditor.js') }}"></script>
	<script src="{{ asset('admin/assets/js/ckeditor1/adapters/jquery.js') }}"></script>
	<script>
		$(document).ready(function () {
			$('.select2').select2({
				theme: 'bootstrap-5',
			});
		})
		var vm = CKEDITOR.replace('vm', {
			// uiColor: '#CCEAEE'
			toolbarCanCollapse:false,
		});
		$('.btnSimpan').click(function (e) {
			e.preventDefault()
			var data = new FormData($('#formVm')[0])
			var sejarah = CKEDITOR.instances.vm.getData();
			data.append('vm',vm);
			$('.btnSimpan').attr('disabled',true).html('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>LOADING...')
			$.ajax({
				url: '{{route("main.".\Str::camel($curNav).(isset($curMenu)?".".\Str::camel($curMenu):"").".save")}}',
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
	</script>
@endpush