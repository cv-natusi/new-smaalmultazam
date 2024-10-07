<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header bg-main-website text-white">
				@if (isset($amtv))
				Edit
				@else
				Tambah
				@endif
				AMTV
			</div>
			<div class="card-body">
				<form id="formAmtv">
				    <input type="hidden" name="id" @isset($amtv) value="{{$amtv->id_amtv}}" @endisset>
					<div class="mb-3">
						<label for="judul_amtv" class="form-label">Judul *</label>
						<input type="text" class="form-control" name="judul_amtv" id="judul_amtv" placeholder="Judul" @isset($amtv) value="{{$amtv->judul_amtv}}" @endisset>
					</div>
					<div class="row">
						<div class="col-8">
							<div class="mb-3">
								<label for="file" class="form-label">Link Video *</label>
								<input type="text" class="form-control" name="file" id="file" placeholder="Link Youtube" @isset($amtv) value="{{$amtv->file}}" @endisset>
							</div>
						</div>
						<div class="col-4">
							<div class="mb-3">
								<label for="status_amtv" class="form-label">Status *</label>
								<select name="status_amtv" id="status_amtv" class="form-control selectpicker select2">
									<option value="">-PILIH-</option>
									<option value="1" @isset($amtv) @if($amtv->status_amtv) selected @endif @endisset>AKTIF</option>
									<option value="0" @isset($amtv) @if(!$amtv->status_amtv) selected @endif @endisset>TIDAK AKTIF</option>
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
		var data = new FormData($('#formAmtv')[0])
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