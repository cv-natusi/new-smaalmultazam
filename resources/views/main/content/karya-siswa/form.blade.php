@extends('main.layouts.index')

@section('content')
@php
$title = 'Berita';
@endphp
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header bg-main-website text-white">
				@if (isset($data))
				Edit 
				@else
				Tambah 
				@endif
				{{$title}}
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
	<script src="{{asset('admin/content/js/include-berita.js')}}"></script>
@endpush