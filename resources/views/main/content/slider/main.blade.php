@extends('main.layouts.index')

@push('style')
	<link href="{{ asset('admin/assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet">
	{{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css"> --}}
	{{-- <link href="{{ asset('admin/assets/plugins/datatable/css/select.dataTables.min.css') }}" rel="stylesheet"> --}}
	{{-- <link href="{{ asset('admin/assets/plugins/datatable/css/rowReorder.dataTables.min.css') }}" rel="stylesheet"> --}}
	<link href="{{ asset('admin/assets/plugins/datatable/css/rowReorder.bootstrap5.min.css') }}" rel="stylesheet">
	{{-- <link href="{{ asset('admin/assets/plugins/datatable/css/editor.dataTables.min.css') }}" rel="stylesheet"> --}}
	<link rel="stylesheet" type="text/css" href="{{asset('zoom/css/jquery.pan.css')}}"><!--zoomImage-->
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
						<button type="button" class="btn btn-primary" onclick="tambahSliderGambar()"><i class='bx bx-plus'></i>Tambah Baru</button>
					</div>
				</div>
				<div class="p-1">
					<table class="table-responsive table table-striped table-bordered stripe row-border order-column" style="width:100%" id="dataTable">
					{{-- <table class="display" style="width:100%" id="dataTable"> --}}
						<thead>
							<tr>
								<th></th>
								<th>ID</th>
								<th>Gambar</th>
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
	{{-- <script src="{{ asset('admin/assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script> --}}
	<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
	<script src="{{ asset('admin/assets/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
	{{-- <script src="{{ asset('admin/assets/plugins/datatable/js/dataTables.select.min.js') }}"></script> --}}
	<script src="{{ asset('admin/assets/plugins/datatable/js/dataTables.rowReorder.min.js') }}"></script>
	{{-- <script src="{{ asset('admin/assets/plugins/datatable/js/dataTables.editor.min.js') }}"></script> --}}
	<script src="{{ asset('admin/assets/plugins/select2/js/select2.min.js') }}"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script src="{{asset('zoom/js/jquery.pan.js')}}"></script><!--zoomImage-->
	<script src="{{asset('admin/content/js/main-slider.js')}}"></script>
	<script>
		var routeDatatable = "{{route('main.sliderGambar.main')}}"
		var routeBeritaAdd = "{{route('main.sliderGambar.add')}}"
		var routeUpdatePosition = "{{route('main.sliderGambar.updatePosition')}}"
		var routeBeritaDelete = "{{route('main.sliderGambar.delete')}}"
	</script>
@endpush