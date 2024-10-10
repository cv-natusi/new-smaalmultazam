<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header bg-main-website text-white">
				@if (isset($reels))
				Edit
				@else
				Tambah
				@endif
				REELS
			</div>
			<div class="card-body">
				<form id="formReels">
				    <input type="hidden" name="id" @isset($reels) value="{{$reels->id_reels}}" @endisset>
					<div class="mb-3">
						<label for="judul_reels" class="form-label">Judul *</label>
						<input type="text" class="form-control" name="judul_reels" id="judul_reels" placeholder="Judul" @isset($reels) value="{{$reels->judul_reels}}" @endisset>
					</div>
					<div class="row">
						<div class="col-8">
							<div class="mb-3">
								<label for="file" class="form-label">Link Video Reels*</label>
								<input type="text" class="form-control" name="file" id="file" placeholder="Link Reels" @isset($reels) value="{{$reels->file}}" @endisset>
							</div>
						</div>
						<div class="col-4">
							<div class="mb-3">
								<label for="status_reels" class="form-label">Status *</label>
								<select name="status_reels" id="status_reels" class="form-control selectpicker select2">
									<option value="">-PILIH-</option>
									<option value="1" @isset($reels) @if($reels->status_reels) selected @endif @endisset>AKTIF</option>
									<option value="0" @isset($reels) @if(!$reels->status_reels) selected @endif @endisset>TIDAK AKTIF</option>
								</select>
							</div>
						</div>
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
		var data = new FormData($('#formReels')[0])
		$('.btnSimpan').attr('disabled',true).html('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>LOADING...')
		$.ajax({
                url: '{{route("main.".\Str::camel($curNav).(isset($curMenu)?".".\Str::camel(\Str::lower($curMenu)):"").".save")}}',
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