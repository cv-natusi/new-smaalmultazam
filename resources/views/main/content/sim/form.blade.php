<link rel="stylesheet" type="text/css" href="{{asset('zoom/css/jquery.pan.css')}}"><!--zoomImage-->
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header bg-main-website text-white">
				@if (isset($sim))
				Edit
				@else
				Tambah
				@endif
				{{$title}}
			</div>
			<div class="card-body">
				<form id="formSim">
					<input type="hidden" name="id" @isset($sim) value="{{$sim->id_sim}}" @endisset>
					<div class="mb-3">
						<label for="nama" class="form-label">Nama Aplikasi *</label>
						<input type="text" class="form-control" name="nama" id="nama" placeholder="Nama Aplikasi" @isset ($sim) value="{{$sim->nama}}" @endisset>
					</div>
					<div class="row">
						<div class="col-12 col-md-8">
							<div class="mb-3">
								<label for="link" class="form-label">Link Aplikasi *</label>
								<input type="text" class="form-control" name="link" id="link" placeholder="www.aplikasi.com" @isset ($sim) value="{{$sim->link}}" @endisset>
							</div>
						</div>
						<div class="col-12 col-md-4">
							<div class="mb-3">
								<label for="status" class="form-label">Status SIM *</label>
								<select name="status" id="status" class="form-control selectpicker select2">
									<option value="">-PILIH-</option>
									<option value="1" @isset($sim) @if($sim->status) selected @endif @endisset>Aktif</option>
									<option value="0" @isset($sim) @if(!$sim->status) selected @endif @endisset>Tidak Aktif</option>
								</select>
							</div>
						</div>
					</div>
					<div class="mb-3">
						<label for="keterangan" class="form-label">Keterangan *</label>
						<textarea name="keterangan" id="keterangan" class="form-control" cols="30" rows="10">@isset ($sim) {{$sim->keterangan}} @endisset</textarea>
					</div>
					<div class="mb-3">
						<label for="foto" class="form-label">Gambar *</label>
						<center class="mb-3">
							<a class="pan" id="btnOutPut" data-big="@isset($sim){!! url('uploads/sim/'.$sim->foto) !!}@endisset">
								<img id="outPut" @isset($sim) src="{!! url('uploads/sim/'.$sim->foto) !!}" @endisset class="rounded mx-auto d-block responsive @isset($sim) img-thumbnail w-50 @endisset">
							</a>
							{{-- @if(!empty($sim->foto))
								<img id="preview-photo" src="{!! url('uploads/berita/'.$berita->foto) !!}" class="img-polaroid" width="100" height="101">
							@else
								<img id="preview-photo" src="{!! url('uploads/default.jpg') !!}" class="img-polaroid" width="100" height="101">
							@endif --}}
						</center>
						<input type="file" class="form-control" id="foto" name="foto" accept="image/*" onchange="loadFile(event)">
					</div>
					<hr>
					<div class="d-flex gap-2">
						<button class="btn btn-secondary px-4 btnKembali">KEMBALI</button>
						<button class="btn btn-primary px-4 btnSimpan">SIMPAN</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<script src="{{ asset('admin/assets/plugins/select2/js/select2.min.js') }}"></script>
<script src="{{asset('zoom/js/jquery.pan.js')}}"></script><!--zoomImage-->
<script>
	$(document).ready(function () {
		$('.select2').select2({
			theme: 'bootstrap-5',
		});
		$('.pan').pan()
	})

	$('.btnKembali').click((e) => {
		e.preventDefault()
		$('.other-page').fadeOut(()=>{
			$('.main-page').fadeIn()
			$('#dataTable').DataTable().ajax.reload()
		})
	})
	$('.btnSimpan').click((e) => {
		e.preventDefault()
		var data = new FormData($('#formSim')[0])
		$('.btnSimpan').attr('disabled',true).html('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>LOADING...')
		$.ajax({
				url: '{{route("main.sim.save")}}',
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
							$('.other-page').fadeOut(()=>{
								$('#datatabel').DataTable().ajax.reload()
								location.reload()
							})
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
	
	function loadFile(event) {
		var btn = $('#btnOutPut')[0] // html DOM Object
		var outPut = $('#outPut')[0]
		outPut.src = URL.createObjectURL(event.target.files[0])
		outPut.onload = function(){
			URL.revokeObjectURL(outPut.src)
		}
		btn = $('#btnOutPut').attr('data-big',URL.createObjectURL(event.target.files[0]))
		$('#outPut').addClass('img-thumbnail')
	};
</script>