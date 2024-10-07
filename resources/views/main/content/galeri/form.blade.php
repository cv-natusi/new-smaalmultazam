
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header bg-main-website text-white">
				@if (!isset($galeri))
					Tambah
				@else
					Edit
				@endif
				Galeri
			</div>
			<div class="card-body">
				<form id="formGaleri">
					<input type="hidden" name="id" @isset($galeri) value="{{$galeri->id_galeri}}" @endisset>
					<div class="row">
						<div class="col-12">
							<center class="mb-3">
								<a class="pan" id="btnOutPut" data-big="@isset($galeri){!! url('uploads/galeri/'.$galeri->file_galeri) !!}@endisset">
									<img id="outPut" @isset($galeri) src="{!! url('uploads/galeri/'.$galeri->file_galeri) !!}" @endisset class="rounded mx-auto d-block responsive @isset($galeri) img-thumbnail w-50 @endisset">
								</a>
							</center>
						</div>
						<div class="col-12 col-md-6">
							<div class="mb-3">
								<label for="file_galeri" class="form-label">Upload Gambar *</label>
								<input type="file" class="form-control" name="file_galeri" id="file_galeri" onchange="loadFile(event)">
							</div>
						</div>
						<div class="col-12 col-md-6">
							<div class="mb-3">
								<label for="status_galeri" class="form-label">Status *</label>
								<select name="status_galeri" id="status_galeri" class="form-control selectpicker select2">
									<option value="">-PILIH-</option>
									<option value="1" @isset($galeri) @if($galeri->status_galeri) selected @endif @endisset>AKTIF</option>
									<option value="0" @isset($galeri) @if(!$galeri->status_galeri) selected @endif @endisset>TIDAK AKTIF</option>
								</select>
							</div>
						</div>
					</div>
					<div class="mb-3">
						<label for="deskripsi_galeri" class="form-label">Keterangan *</label>
						<textarea name="deskripsi_galeri" id="deskripsi_galeri" class="form-control" cols="30" rows="10">@isset($galeri) {{$galeri->deskripsi_galeri}} @endisset</textarea>
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
		$('#outPut').addClass('img-thumbnail')
	}

	$('.btnSimpan').click((e) => {
		e.preventDefault()
		var data = new FormData($('#formGaleri')[0])
		$('.btnSimpan').attr('disabled',true).html('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>LOADING...')
		$.ajax({
                url: '{{route("main.galeri.save")}}',
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
</script>