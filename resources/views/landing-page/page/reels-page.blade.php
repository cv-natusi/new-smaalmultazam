<div class="p-top-sm spacer title">
	<h4>{{$curMenu}}</h4>
</div>
<div class="row spacer p-top-sm">
	@foreach ($reels->items() as $item)
		<div class="col-12 col-md-6 spacer p-bottom-sm">
			<div class="card">
				<div class="card-body">
					<div class="text-center p-3">
                        <blockquote class="instagram-media" data-instgrm-permalink="{{ $item->file }}" data-instgrm-version="14" style="background:#FFF; border:0; border-radius:3px; box-shadow:0 0 1px 0 rgba(0,0,0,0.5),0 1px 10px 0 rgba(0,0,0,0.15); margin: 1px; max-width:540px; min-width:326px; padding:0; width:99.375%; width:-webkit-calc(100% - 2px); width:calc(100% - 2px);">
                            <div style="padding:16px;">
                                <a href="{{ $item->file }}" target="_blank" style="background:#FFF; text-decoration:none;">
                                    View this post on Instagram
                                </a>
                            </div>
                            </blockquote>
                            <script async src="//www.instagram.com/embed.js"></script>
						<h5>{{$item->judul_reels}}</h5>
					</div>
				</div>
			</div>
		</div>
	@endforeach
</div>
<ul class="paginatioxn-area justify-content-center pt-2">
<script src="{{asset('assets/js/pagination.js')}}"></script>
<script>
	// var pageUrl, prevUrl, nextUrl = '';
	// var page, size = 0;
	var page = parseInt(JSON.parse('{{$reels->currentPage()}}'))
	var size = parseInt(JSON.parse('{{$reels->lastPage()}}'))
	var prevUrl = '{{$reels->previousPageUrl()}}'
	var nextUrl = '{{$reels->nextPageUrl()}}'
	var pageUrl = '{{$reels->url(1)}}'
	$(document).ready(function () {
	})
</script>
