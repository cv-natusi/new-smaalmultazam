@extends('main.layouts.index')

@php
	$tambah = true;
@endphp

@push('style')
<link rel="stylesheet" type="text/css" href="{{asset('zoom/css/jquery.pan.css')}}"><!--zoomImage-->
@endpush

@section('content')
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header bg-main-website text-white">
					Sambutan Kepala Sekolah
				</div>
				<div class="card-body">
					<form id="formSambutan">
						<div class="row">
							<div class="col-12">
								<div class="mb-3">
									<label for="foto_sambutan" class="form-label">Foto Kepala Sekolah *</label>
									<center class="mb-3">
										<a class="pan" id="btnOutPut" data-big="@isset($sambutan){!! url('uploads/sambutan/'.$sambutan->foto_sambutan) !!}@endisset">
											<img id="outPut" @isset($sambutan) src="{!! url('uploads/sambutan/'.$sambutan->foto_sambutan) !!}" @endisset class="rounded mx-auto d-block responsive @isset($sambutan) img-thumbnail w-50 @endisset">
										</a>
									</center>
									<input type="file" class="form-control" name="foto_sambutan" id="foto_sambutan" onchange="loadFile(event)">
								</div>
							</div>
						</div>
						<div class="row mb-3">
							<div class="col-md-12">
								<textarea id="sambutan" name="sambutan" rows="40" cols="100" class="form-control">@isset($sambutan) {{$sambutan->sambutan_kepsek}} @endisset</textarea>
							</div>
						</div>
						<button class="btn btn-primary w-100 btnSimpan" >SIMPAN</button>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection

@push('script')
	<script src="{{asset('zoom/js/jquery.pan.js')}}"></script><!--zoomImage-->
	<script src="{{ asset('admin/assets/plugins/select2/js/select2.min.js') }}"></script>
	<script src="{{ asset('admin/assets/js/ckeditor1/ckeditor.js') }}"></script>
	<script src="{{ asset('admin/assets/js/ckeditor1/adapters/jquery.js') }}"></script>
	<!--Sweetalert -->
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script>
		$(document).ready(function () {
			$('.select2').select2({
				theme: 'bootstrap-5',
			});
			$('.pan').pan()
		})
		var loadFile = function(event){
			// var btn = $('#btnOutPut') // jQuery Object
			// var btn = document.getElementById('btnOutPut') // html DOM Object
			var btn = $('#btnOutPut')[0] // html DOM Object
			var outPut = $('#outPut')[0]
			outPut.src = URL.createObjectURL(event.target.files[0])
			outPut.onload = function(){
				URL.revokeObjectURL(outPut.src)
			}
			btn = $('#btnOutPut').attr('data-big',URL.createObjectURL(event.target.files[0]))
			$('#outPut').addClass('img-thumbnail w-50')
		}
		var sambutan = CKEDITOR.replace('sambutan', {
			// uiColor: '#CCEAEE'
			toolbarCanCollapse:false,
		});
		$('.btnSimpan').click(function (e) {
			e.preventDefault()
			var data = new FormData($('#formSambutan')[0])
			var sambutan_kepsek = CKEDITOR.instances.sambutan.getData();
			data.append('sambutan_kepsek',sambutan_kepsek);
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