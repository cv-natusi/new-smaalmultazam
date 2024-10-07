@extends('main.layouts.index')

@php
	$tambah = true;
@endphp

@section('content')
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header bg-main-website text-white">
					@if ($tambah)
						Tambah
					@else
						Edit
					@endif
					Profil Guru
				</div>
				<div class="card-body">
					<form id="formAgenda">
						<div class="row">
							<div class="col-4">
								<div class="mb-3">
									<label for="nama" class="form-label">Nama Lengkap *</label>
									<input type="text" class="form-control" name="nama" id="nama" placeholder="Nama Lengkap">
								</div>
							</div>
							<div class="col-4">
								<div class="mb-3">
									<label for="nip" class="form-label">NIP</label>
									<input type="text" class="form-control" name="nip" id="nip" placeholder="123xxxxx">
								</div>
							</div>
							<div class="col-4">
								<div class="mb-3">
									<label for="foto" class="form-label">Foto Guru *</label>
									<input type="file" class="form-control" name="foto" id="foto">
								</div>
							</div>
							<div class="col-4">
								<div class="mb-3">
									<label for="mapel" class="form-label">Mengampu Mata Pelajaran (Multiple) *</label>
									<select name="mapel[]" id="mapel" class="form-control selectpicker select2 multi-select" multiple>
										<option value="">-PILIH-</option>
									</select>
								</div>
							</div>
						</div>
						<hr>
						<div class="d-flex gap-2">
							<button class="btn btn-secondary px-4">KEMBALI</button>
							<button class="btn btn-primary px-4">SIMPAN</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection

@push('script')
	<script src="{{ asset('admin/assets/plugins/select2/js/select2.min.js') }}"></script>
	<script>
		$(document).ready(function () {
			$('.select2').select2({
				theme: 'bootstrap-5',
			});
		})
	</script>
@endpush