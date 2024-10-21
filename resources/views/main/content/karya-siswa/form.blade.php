<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header bg-main-website text-white">
				@if (isset($data))
				Edit
				@else
				Tambah
				@endif
                Karya Siswa
				{{-- {{$title}} --}}
			</div>
			<div class="card-body">
				<form id="formBerita">
					<div class="row">
						<div class="col-8">
							<div class="mb-3">
								<label for="judul" class="form-label">Judul Berita *</label>
								<input type="text" class="form-control" name="judul" id="judul" placeholder="Judul Berita">
							</div>
						</div>
						<div class="col-4">
							<div class="mb-3">
								<label for="status" class="form-label">Status *</label>
								<select name="status" id="status" class="form-control selectpicker select2">
									<option value="">-PILIH-</option>
								</select>
							</div>
						</div>
					</div>
					<div class="mb-3">
						<label for="siswa" class="form-label">Nama Siswa *</label>
						<select name="siswa" id="siswa" class="form-control selectpicker select2">
							<option value="">-PILIH-</option>
						</select>
					</div>
					<div class="row mb-3">
						<div class="col-md-12">
							<label for="isi">Berita</label>
							<textarea id="isi" name="isi" rows="40" cols="100" class="form-control"></textarea>
						</div>
					</div>
                    <div class="mb-3">
						<label for="file" class="form-label">Tambah File Gambar</label>
						<input type="file" class="form-control" id="file" name="file_gambar" accept=".jpg,.jpeg,.png" multiple>
					</div>
                    <div class="mb-3">
						{{-- <label for="gambar" class="form-label">Gambar *</label> --}}
						<label for="file" class="form-label">Tambah File</label>
						<input type="file" class="form-control" id="file" name="file[]" accept="*" multiple>
					</div>
					<hr>
					<div class="d-flex gap-2">
						<button class="btn btn-secondary px-4 btnKembali">KEMBALI</button>
						<button type="button" class="btn btn-primary px-4 btnSimpan">SIMPAN</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

@push('script')
	{{-- <script src="{{asset('admin/content/js/include-berita.js')}}"></script> --}}
@endpush
<script>
    var berita = CKEDITOR.replace('isi', {
        // uiColor: '#CCEAEE'
        toolbarCanCollapse:false,
    });
    $(document).ready(async function () {
		$('.select2').select2({
			theme: 'bootstrap-5',
		});
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
		var data = new FormData($('#formBerita')[0])
		var isi = CKEDITOR.instances.berita.getData();
        data.append('isi',isi);
		$('.btnSimpan').attr('disabled',true).html('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>LOADING...')
		$.ajax({
                url: '{{route("main.programSekolah.karyaSiswa.store")}}',
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

