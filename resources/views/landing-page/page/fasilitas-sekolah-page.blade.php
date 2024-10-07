@push('style')
	<style>
		.image-blurred {
			background-image: var(--bg-image);
			background-repeat: no-repeat;
			background-position-x: 50%;
			background-position-y: center;
			background-size: cover;
			filter: blur(2px) grayscale(0.5);
			-webkit-filter: blur(2px) grayscale(0.9) contrast(0.9);
			height: 200px;
		}
	</style>
@endpush
<div class="row m-0">
	<div class="col-md-12 spacer">
		<div class="p-top-sm spacer title">
			<h4>{{$curMenu}}</h4>
		</div>
		<div class="row p-top-sm spacer">
			@foreach ($fasilitas->items() as $item)
			<div class="col-12 col-md-6 mb-3">
				<div class="card">
					<div class="image-blurred" style="--bg-image:url('{{asset($pathGambar.$item->foto)}}')">
					</div>
					<img src="{{asset($pathGambar.$item->foto)}}" class="position-absolute img-fluid mx-auto d-block" alt="{{$item->nama_exkul}}" style="height:200px;left:auto;right:auto">
					<div class="card-body d-flex flex-column p-3" style="line-height: 1.2em; font-size: 11pt; color:black">
						<span class="font-weight-bold">{{$item->nama_exkul}}</span>
					</div>
				</div>
			</div>
			@endforeach
		</div>
	</div>
	<ul class="pagination-area justify-content-center pt-2">
</div>
<script src="{{asset('assets/js/pagination.js')}}"></script>
<script>
	// var pageUrl, prevUrl, nextUrl = '';
	// var page, size = 0;
	var page = parseInt(JSON.parse('{{$fasilitas->currentPage()}}'))
	var size = parseInt(JSON.parse('{{$fasilitas->lastPage()}}'))
	var prevUrl = '{{$fasilitas->previousPageUrl()}}'
	var nextUrl = '{{$fasilitas->nextPageUrl()}}'
	var pageUrl = '{{$fasilitas->url(1)}}'
	$(document).ready(function () {
	})
</script>