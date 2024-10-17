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
					<table class="table-responsive table table-striped table-bordered stripe row-border order-column" style="width:100%" id="dataTable">
						<thead>
							<tr>
								<th>No</th>
								<th>Tgl Post</th>
								<th>Nama</th>
								<th>Email</th>
								<th>Pesan dan Saran</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>1</td>
								<td>{{date('Y-m-d H:i:s')}}</td>
								<td>Andre Tampan</td>
								<td>andre@email.com</td>
								<td class="text-truncate" style="max-width: 150px">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Esse tempora debitis voluptas rem neque officia ut dolorum perferendis molestias. Repudiandae necessitatibus adipisci facilis culpa sint delectus, repellat quam ut earum?</td>
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
	<script src="{{asset('admin/content/js/main-pesan-dan-saran.js')}}"></script>
	<script>
	</script>
@endpush
