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
					Sejarah Singkat
				</div>
				<div class="card-body">
					<form id="formSejarah">
						<input type="hidden" name="foto" @isset($sejarah) value="ada" @endisset>
						<div class="mb-3">
							<label for="foto_sejarah" class="form-label">Foto Sekolah *</label>
							<center class="mb-3">
								<a class="pan" id="btnOutPut" data-big="@isset($sejarah){!! url('uploads/sejarah/'.$sejarah->foto_sejarah) !!}@endisset">
									<img id="outPut" @isset($sejarah) src="{!! url('uploads/sejarah/'.$sejarah->foto_sejarah) !!}" @endisset class="rounded mx-auto d-block responsive @isset($sejarah) img-thumbnail w-50 @endisset">
								</a>
							</center>
							<input type="file" class="form-control" name="foto_sejarah" id="foto_sejarah" accept="image/*" onchange="loadFile(event)">
							<p class="text-muted fst-italic">
								* maks. ukuran file foto 2Mb, <br>* ukuran foto landscape
							</p>
							
						</div>
						<div class="row mb-3">
							<div class="col-md-12">
								<textarea id="sejarah" name="sejarah" rows="40" cols="100" class="form-control">@isset($sejarah) {{$sejarah->sejarah}} @endisset</textarea>
							</div>
						</div>
						<button class="btn btn-primary w-100 btnSimpan">SIMPAN</button>
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
		var sejarah = CKEDITOR.replace('sejarah', {
			// uiColor: '#CCEAEE'
			toolbarCanCollapse:false,
		});
		$('.btnSimpan').click(function (e) {
			e.preventDefault()
			var data = new FormData($('#formSejarah')[0])
			var sejarah = CKEDITOR.instances.sejarah.getData();
			data.append('sejarah',sejarah);
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