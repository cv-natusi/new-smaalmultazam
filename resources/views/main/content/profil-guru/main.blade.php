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
				<div class="row mb-3">
					<div class="col-md-3">
						<button type="button" class="btn btn-primary" onclick="tambahGuru()"><i class='bx bx-plus'></i>Tambah Baru</button>
					</div>
				</div>
				<div class="p-1">
					<table class="table-responsive table table-striped table-bordered stripe row-border order-column" style="width:100%" id="dataTable">
						<thead>
							<tr>
								<th>No</th>
								<th>NUPTK</th>
								<th>Nama Guru</th>
								<th>Mata Pelajaran Diampu</th>
								<th>File Foto</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>1</td>
								<td>12345</td>
								<td>Hari Sumpah Pemuda</td>
								<td>mapel1,mapel2</td>
								<td>123.jpg</td>
								<td>
									<button class="btn btn-dark btn-purple p-2"><i class='bx bx-edit-alt mx-1'></i></button>
									<button class="btn btn-danger p-2"><i class='bx bx-trash mx-1'></i></button>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@push('script')
	<script src="{{ asset('admin/assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
	<script src="{{ asset('admin/assets/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
	<script src="{{ asset('admin/assets/plugins/select2/js/select2.min.js') }}"></script>
	<script src="{{asset('admin/content/js/main-agenda.js')}}"></script>
	<script>
		function tambahGuru() {
			window.location.href = "{{route('main.profilSekolah.profilGuru.main')}}"
		}
	</script>
@endpush