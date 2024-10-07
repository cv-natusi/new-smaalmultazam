@extends('main.layouts.index')

@php
	$tambah = true;
	$title = 'AMTV';
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
					{{$title}}
				</div>
				<div class="card-body">
					<form id="formAmtv">
						<div class="row">
							<div class="col-12 col-md-4">
								<div class="mb-3">
									<label for="nama" class="form-label">Nama Dokumen *</label>
									<input type="text" name="nama" id="nama" class="form-control" placeholder="Keterangan">
								</div>
							</div>
							<div class="col-12 col-md-4">
								<div class="mb-3">
									<label for="status" class="form-label">Status *</label>
									<select name="status" id="status" class="form-control selectpicker select2">
										<option value="">-PILIH-</option>
									</select>
								</div>
							</div>
							<div class="col-12 col-md-4">
								<div class="mb-3">
									<label for="dokumen" class="form-label">Upload Dokumen *</label>
									<input type="file" name="dokumen" id="dokumen" class="form-control" placeholder="Keterangan">
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