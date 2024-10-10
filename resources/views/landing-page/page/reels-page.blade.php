<div class="p-top-sm spacer title">
	<h4>{{$curMenu}}</h4>
</div>
<div class="row spacer p-top-sm">
	@foreach ($amtv->items() as $item)
		<div class="col-12 col-md-6 spacer p-bottom-sm">
			<div class="card">
				<div class="card-body">
					<iframe width="560" height="315" src="{{$item->file}}" title="YouTube video player" frameborder="0"></iframe>
					<div class="text-center p-3">
						<h5>{{$item->judul_amtv}}</h5>
					</div>
				</div>
			</div>
		</div>
	@endforeach
	<ul class="pagination-area justify-content-center pt-2">
</div>
<script src="{{asset('assets/js/pagination.js')}}"></script>
<script>
	// var pageUrl, prevUrl, nextUrl = '';
	// var page, size = 0;
	var page = parseInt(JSON.parse('{{$amtv->currentPage()}}'))
	var size = parseInt(JSON.parse('{{$amtv->lastPage()}}'))
	var prevUrl = '{{$amtv->previousPageUrl()}}'
	var nextUrl = '{{$amtv->nextPageUrl()}}'
	var pageUrl = '{{$amtv->url(1)}}'
	$(document).ready(function () {
	})
</script>
