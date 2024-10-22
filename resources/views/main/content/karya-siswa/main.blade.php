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
						<button type="button" class="btn btn-primary" onclick="tambahKaryaSiswa()"><i class='bx bx-plus'></i>Tambah Baru</button>
					</div>
				</div>
				<div class="p-1">
					<table class="table-responsive table table-striped table-bordered stripe row-border order-column" style="width:100%" id="dataTable">
						<thead>
							<tr>
								<th>No</th>
								<th>Penerbitan</th>
								<th>Nama Siswa</th>
								<th>Judul / Keterangan Karya</th>
								<th>Status</th>
								<th>Aksi</th>
							</tr>
						</thead>
						{{-- <tbody>
							<tr>
								<td>1</td>
								<td>{{date('Y-m-d H:i:s')}}</td>
								<td>Ali Nur Muhammad, S.Pd</td>
								<td>Judul / Keteranganya</td>
								<td>Aktif</td>
								<td>
									<button class="btn btn-dark btn-purple p-2"><i class='bx bx-edit-alt mx-1'></i></button>
									<button class="btn btn-secondary p-2"><i class='bx bx-power-off mx-1'></i></button>
									<button class="btn btn-danger p-2"><i class='bx bx-trash mx-1'></i></button>
								</td>
							</tr>
						</tbody> --}}
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
	<script src="{{ asset('admin/assets/js/ckeditor1/ckeditor.js') }}"></script>
	<script src="{{ asset('admin/assets/js/ckeditor1/adapters/jquery.js') }}"></script>
	<script src="{{asset('admin/content/js/main-karya-siswa.js')}}"></script>
	{{-- <script src="{{asset('admin/content/js/main-agenda.js')}}"></script> --}}
    <!--Sweetalert -->
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script>
        var routeDatatable = "{{route('main.programSekolah.karyaSiswa.main')}}"
        var routeAddKarya = "{{route('main.programSekolah.karyaSiswa.add')}}"
        var routeKaryaAktif = "{{route('main.programSekolah.karyaSiswa.aktif')}}"
        var routeKaryaDelete = "{{route('main.programSekolah.karyaSiswa.delete')}}"
		// function tambahKaryaSiswa() {
		// 	window.location.href = "{{route('main.programSekolah.karyaSiswa.add')}}"
		// }
	</script>
@endpush
