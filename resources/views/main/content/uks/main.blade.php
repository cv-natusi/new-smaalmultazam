@extends('main.layouts.index')

@php
	$tambah = true;
@endphp

@section('content')
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header bg-main-website text-white">
					UKS
				</div>
				<div class="card-body">
					<form id="formAmtv">
						<div class="mb-3">
							<label for="foto" class="form-label">Foto UKS *</label>
							<input type="file" class="form-control" name="foto" id="foto">
							<p class="text-muted fst-italic">
								* maks. ukuran file foto 2Mb, <br>* ukruan foto landscape
							</p>
						</div>
						<div class="row mb-3">
							<div class="col-md-12">
								<textarea id="isi" name="isi" rows="40" cols="100" class="form-control"></textarea>
							</div>
						</div>
						<button class="btn btn-primary w-100">SIMPAN</button>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection

@push('script')
	<script src="{{ asset('admin/assets/plugins/select2/js/select2.min.js') }}"></script>
	<script src="{{ asset('admin/content/js/include-berita.js') }}"></script>
	<script>
		$(document).ready(function () {
			$('.select2').select2({
				theme: 'bootstrap-5',
			});
		})
	</script>
@endpush