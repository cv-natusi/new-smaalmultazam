<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header bg-main-website text-white">
				@if (isset($berita))
				Edit
				@else
				Tambah
				@endif
				Agenda / Event	
			</div>
			<div class="card-body">
				<form id="formAgenda">
					<input type="hidden" name="id" @isset($berita) value="{{$berita->id_berita}}" @endisset>
					<div class="mb-3">
						<label for="judul" class="form-label">Nama Agenda / Event *</label>
						<input type="text" class="form-control" name="judul" id="judul" placeholder="Nama Agenda / Event" @isset($berita) value="{{$berita->judul}}" @endisset>
					</div>
					<div class="row">
						<div class="col-4">
							<div class="mb-3">
								<label for="tanggal_acara" class="form-label">Tanggal Event *</label>
								<input type="date" class="form-control" name="tanggal_acara" id="tanggal_acara" @isset($berita) value="{{$berita->tanggal_acara}}" @endisset>
							</div>
						</div>
						<div class="col-4">
							<div class="mb-3">
								<label for="status" class="form-label">Status Event *</label>
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
							<a class="pan" id="btnOutPut" data-big="@isset($berita){!! url('uploads/berita/'.$berita->gambar) !!}@endisset">
								<img id="outPut" @isset($berita) src="{!! url('uploads/berita/'.$berita->gambar) !!}" @endisset class="rounded mx-auto d-block responsive @isset($berita) img-thumbnail w-50 @endisset">
							</a>
						</center>
						<input type="file" class="form-control" id="gambar" name="gambar" accept="image/*" onchange="loadFilePhoto(event)">
					</div>
					<hr>
					<div class="d-flex gap-2">
						<button class="btn btn-secondary px-4" onclick="(e)=>{e.preventDefault();window.location='{{route('main.menuUtama.agendaEvent.main')}}'}">KEMBALI</button>
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

	var berita = CKEDITOR.replace('berita', {
		// uiColor: '#CCEAEE'
		toolbarCanCollapse:false,
	});

	$('.btnSimpan').click((e) => {
		e.preventDefault()
		var data = new FormData($('#formAgenda')[0])
		var isi = CKEDITOR.instances.berita.getData();
        data.append('isi',isi);
		$('.btnSimpan').attr('disabled',true).html('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>LOADING...')
		$.ajax({
                url: '{{route("main.menuUtama.agendaEvent.save")}}',
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