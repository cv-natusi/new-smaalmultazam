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
	<div class="col-12">
		<div class="card main-page">
			<div class="card-body">
				<div class="p-1">
					<table class="table-responsive table table-striped table-bordered stripe row-border order-column" style="width:100%" id="dataTable">
						<thead>
							<tr>
								<th>No</th>
								<th>Judul Soal</th>
								<th>Nama Mata Pelajaran</th>
								<th>Guru Pengampu</th>
								<th>Tanggal Berlaku Soal</th>
								<th>Jumlah Soal</th>
								<th>Nilai KKM</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>1</td>
								<td>Soal Pendalaman Materi</td>
								<td>Nama Mata Pelajaran</td>
								<td>Yuli Isnaini, S.Pd</td>
								<td>22 Juli 2021 - 28 Juli 2021</td>
								<td>15</td>
								<td>65</td>
								<td>
                                    <button onclick='aktifMateri($row->id_materi)' class='btn btn-dark btn-purple p-2'><i class='bx bx-search-alt-2 mx-1'></i></button>
                                    <button onclick='tambahMateri($row->id_materi)' class='btn ms-1 btn-primary p-2'><i class='bx bx-edit-alt mx-1'></i></button>
                                    <button onclick='hapusMateri($row->id_materi)' class='btn ms-1 btn-danger p-2'><i class='bx bx-trash mx-1'></i></button>
                                </td>
							</tr>
						</tbody>
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
<!--Sweetalert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
	var routeKerjakan = "{{route('elearning.main.kerjakan')}}"
	var routeMateriAdd = "{{route('elearning.soalTulis.add')}}"
	
	$(document).ready(()=>{
        const loading = '<div class=spinner-grow text-primary" role="status"> <span class="visually-hidden">Loading...</span></div>'
		let sDom = `
		<'row mb-2'
		<'col-sm-2 templateTambah'>
		<'col-sm-2'l>
		<'col-sm-2 templateKelas'>
		<'col-sm-3 templateTahunAjaran'>
		<'col-sm-2 templateSemester'>
		<'col-sm-1'>
		>
		<'row mt-2'<'col-sm-12'tr>>
		<'row mt-2'<'col-sm-5'i><'col-sm-7'p>>
		`
		$('#dataTable').DataTable({
            sDom: sDom,
			scrollX:true,
		})
        const templateTambah = `
			<button onclick="tambahMateri()" class='btn btn-primary p-2 w-100'><i class='bx bx-plus' ></i>Tambah</button>
		`;
			
		const templateKelas = `
			<div class="d-inline">
				<label class="my-1 pe-1">Kelas</label>
				<select name="status" aria-controls="status" class="form-select form-select-sm" id="status" onchange="filter()">
					<option value="">Semua</option>
					<option value="1">Aktif</option>
					<option value="0">Tidak Aktif</option>
				</select>
			</div>
		`;
			
		const templateTahunAjaran = `
			<div class="d-inline">
				<label class="my-1 pe-1">Tahun Ajaran</label>
				<select name="status" aria-controls="status" class="form-select form-select-sm" id="status" onchange="filter()">
					<option value="">Semua</option>
					<option value="1">Aktif</option>
					<option value="0">Tidak Aktif</option>
				</select>
			</div>
		`;
			
		const templateSemester = `
			<div class="d-inline">
				<label class="my-1 pe-1">Semester</label>
				<select name="status" aria-controls="status" class="form-select form-select-sm" id="status" onchange="filter()">
					<option value="">Semua</option>
					<option value="1">Aktif</option>
					<option value="0">Tidak Aktif</option>
				</select>
			</div>
		`;
		
		$("div.templateKelas").html(templateKelas)
		$("div.templateTambah").html(templateTambah)
		$("div.templateTahunAjaran").html(templateTahunAjaran)
		$("div.templateSemester").html(templateSemester)
	})
	
	$('.btnKerjakan').click((e)=>{
		e.preventDefault()
	})
	
	$('.btnMulai').click((e)=>{
		e.preventDefault()
		window.location = routeKerjakan
		// console.log(routeKerjakan);
	})
    
	function tambahMateri(id='') {
		$('.main-page').hide();
		var url = routeMateriAdd
		$.post(url, {id:id})
		.done(function(data){
			if(data.status == 'success'){
				$('.other-page').html(data.content).fadeIn();
			} else {
				$('.main-page').show();
			}
		})
		.fail(() => {
			$('.other-page').empty();
			$('.main-page').show();
		})
	}

</script>
@endpush