$(document).ready( async () => {
	await dataTable($('#status').val())
})

function filter() {
	dataTable($('#status').val())
}

async function dataTable(status='') {
	const loading = '<div class=spinner-grow text-primary" role="status"> <span class="visually-hidden">Loading...</span></div>'
	let sDom = `
		<'row mb-2'
			<'col-sm-2'l>
			<'col-sm-2 templateStatus'>
			<'col-sm-3'>
			<'col-sm-2'>
			<'col-sm-3'f>
		>
		<'row mt-2'<'col-sm-12'tr>>
		<'row mt-2'<'col-sm-5'i><'col-sm-7'p>>
	`

	await $('#dataTable').DataTable({
		sDom: sDom,
		stateSave: false,
		scrollX: true,
		serverSide: true,
		processing: true,
		destroy: true,
		language: {
			processing: loading+' '+loading+' '+loading,
			// lengthMenu: `
			// 	Display<br>
			// 	<select name="dataTable_length" aria-controls="dataTable" class="form-select form-select-sm">
			// 		<option value="10">10</option>
			// 		<option value="20">20</option>
			// 		<option value="30">30</option>
			// 		<option value="40">40</option>
			// 		<option value="50">50</option>
			// 	</select>
			// `,
			search: 'Cari',
			searchPlaceholder: 'Masukkan kata kunci',
		},
		ajax: {
			url: routeDatatable,
			data: {status: status},
		},
		columns: [
			{data:'DT_RowIndex', name:'DT_RowIndex', render: (data, type, row)=>{
				return `<p class="m-0 p-1">${data}</p>`
			}},
			{data:'penerbitan', name:'penerbitan'},
			{data:'judul', name:'judul'},
			{data:'status', name:'status'},
			{data:'status', name:'status'},
			{data:'actions', name:'actions'}
		],
	});

	const templateStatus = `
		<div class="d-flex">
			<label class="my-1 pe-1">Status</label>
			<select name="status" aria-controls="status" class="form-select form-select-sm" id="status" onchange="filter()">
				<option value="">Semua</option>
				<option value="1">Aktif</option>
				<option value="0">Tidak Aktif</option>
			</select>
		</div>
	`;

	$("div.templateStatus").html(templateStatus)
}

function tambahKaryaSiswa(id='') {
    console.log(id)
	$('.main-page').hide();
	var url = routeAddKarya
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
