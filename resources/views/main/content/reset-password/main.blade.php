@extends('main.layouts.index')

@push('style')
	<link href="{{ asset('admin/assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet">
	<style>
		.btn-purple {
			background-color: #9594C3;
			border-color: #9594C3;
		}
		.btn-purple:hover {
			background-color: #9594C3;
			border-color: #9594C3;
			filter:contrast(130%);
		}
	</style>
@endpush

@section('content')
<div class="row">
	<div class="col-sm-12">
		<div class="card">
			<div class="card-body">
				<div class="p-1">
                    <form id="formUpdatePassword">
                        <input type="hidden" name="id" @isset($reels) value="{{$reels->id_reels}}" @endisset>
                        <div class="row">
                            <div class="col-4">
                                <div class="mb-3">
                                    <label for="judul_reels" class="form-label">Username *</label>
                                    <input type="text" class="form-control" name="username" id="username" placeholder="Username" value="{{ Auth::user()->name_user }}" readonly>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="mb-3">
                                    <label for="file" class="form-label">Password Sekarang *</label>
                                    <input type="text" class="form-control" name="password_sekarang" id="password_sekarang" placeholder="Password Sekarang">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="mb-3">
                                    <div class="mb-3">
                                        <label for="status_reels" class="form-label">Password Baru *</label>
                                        <input type="text" class="form-control" name="password_baru" id="password_baru" placeholder="Password Baru">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="d-flex gap-2">
                            <button class="btn btn-primary px-4 btnSimpan">SIMPAN</button>
                        </div>
                    </form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@push('script')
    <!--Sweetalert -->
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script>
        var routeUpdatePassword = "{{route('main.resetPassword.store')}}"

        $('.btnSimpan').click((e) => {
            e.preventDefault()
            var data = new FormData($('#formUpdatePassword')[0])
            $('.btnSimpan').attr('disabled',true).html('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>LOADING...')
            $.ajax({
                    url: '{{route("main.resetPassword.store")}}',
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
@endpush
