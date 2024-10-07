<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header bg-main-website text-white">
				@if (isset($berita))
				Edit
				@else
				Tambah
				@endif
				Berita Sekolah
			</div>
			<div class="card-body">
				<form id="formBerita">
					<div class="row">
						<input type="hidden" name="id" @isset($berita) value="{{$berita->id_berita}}" @endisset>
						<div class="col-8">
							<div class="mb-3">
								<label for="judul" class="form-label">Judul Berita *</label>
								<input type="text" class="form-control" name="judul" id="judul" placeholder="Judul Berita" @isset($berita) value="{{$berita->judul}}" @endisset>
							</div>
						</div>
						<div class="col-4">
							<div class="mb-3">
								<label for="status" class="form-label">Status *</label>
								<select name="status" id="status" class="form-control selectpicker select2">
									<option value="">-PILIH-</option>
									<option value="1" @isset($berita) @if($berita->status) selected @endif @endisset>AKTIF</option>
									<option value="0" @isset($berita) @if(!$berita->status) selected @endif @endisset>TIDAK AKTIF</option>
								</select>
							</div>
						</div>
					</div>
					<div class="row mb-3">
						<div class="col-md-12">
							<label for="berita">Berita</label>
							<textarea id="berita" name="berita" rows="40" cols="100" class="form-control">@isset($berita) {{$berita->isi}} @endisset</textarea>
						</div>
					</div>
					<div class="mb-3">
						<label for="gambar" class="form-label">Gambar *</label>
						<center class="mb-3">
							@if(!empty($berita->gambar))
								<img id="preview-photo" src="{!! url('uploads/berita/'.$berita->gambar) !!}" class="img-polaroid" width="100" height="101">
							@else
								<img id="preview-photo" src="{!! url('uploads/default.jpg') !!}" class="img-polaroid" width="100" height="101">
							@endif
						</center>
						<input type="file" class="form-control" id="gambar" name="gambar" accept="image/*" onchange="loadFilePhoto(event)">
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

<script>
	$(document).ready(function () {
		$('.select2').select2({
			theme: 'bootstrap-5',
		});
	})
	
	var berita = CKEDITOR.replace('berita', {
		// uiColor: '#CCEAEE'
		toolbarCanCollapse:false,
	});

	$('.btnKembali').click((e) => {
		e.preventDefault()
		$('.other-page').fadeOut(()=>{
			$('.main-page').fadeIn()
			$('#dataTable').DataTable().ajax.reload()
		})
	})
	
	$('.btnSimpan').click((e) => {
		e.preventDefault()
		var data = new FormData($('#formBerita')[0])
		var isi = CKEDITOR.instances.berita.getData();
        data.append('isi',isi);
		$('.btnSimpan').attr('disabled',true).html('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>LOADING...')
		$.ajax({
                url: '{{route("main.menuUtama.beritaSekolah.save")}}',
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

	function loadFilePhoto(event) {
		var image = URL.createObjectURL(event.target.files[0]);
		$('#preview-photo').fadeOut(function(){
			$(this).attr('src', image).fadeIn().css({
				'-webkit-animation' : 'showSlowlyElement 700ms',
				'animation'         : 'showSlowlyElement 700ms'
			});
		});
	};
</script>