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
		<div class="card main-page">
			<div class="card-body">
				<div class="row mb-3">
					<div class="col-md-3">
						<button type="button" class="btn btn-primary" onclick="tambahSim()"><i class='bx bx-plus'></i>Tambah Baru</button>
					</div>
				</div>
				<div class="p-1">
					<table class="table-responsive table table-striped table-bordered stripe row-border order-column" style="width:100%" id="dataTable">
						<thead>
							<tr>
								<th>No</th>
								<th>Penerbitan</th>
								<th>Nama Sistem / Aplikasi</th>
								<th>Link SIM</th>
								<th>Status</th>
								<th>Aksi</th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>
		<div class="other-page"></div>
	</div>
</div>
@endsection

@push('script')
	<script src="{{ asset('admin/assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
	<script src="{{ asset('admin/assets/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
	<script src="{{ asset('admin/assets/plugins/select2/js/select2.min.js') }}"></script>
	<script src="{{asset('admin/content/js/main-sim.js')}}"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script>
		var routeDatatable = "{{route('main.sim.main')}}"
		var routeSimAdd = "{{route('main.sim.add')}}"
		var routeSimDelete = "{{route('main.sim.delete')}}"
		var routeSimAktif = "{{route('main.sim.aktif')}}"
	</script>
@endpush