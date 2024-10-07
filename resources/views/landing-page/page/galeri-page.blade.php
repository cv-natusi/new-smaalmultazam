@extends('landing-page.layouts.index')

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

@section('content')
    @include('landing-page.include.page-title')
    <div class="row m-0 pb-5">
        <div class="col-12">
            <div class="spacer">
                <div class="wrapper">
                    <div class="p-top-sm spacer title">
                        <h4>{{$curMenu}}</h4>
                    </div>
                    <div class="row p-top-sm spacer">
                        @foreach ($galeri->items() as $item)
                            <div class="col-12 col-md-4 mb-3">
                                <div class="card">
                                    <div class="image-blurred" style="--bg-image:url('{{asset($pathGambar.$item->file_galeri)}}')">
                                    </div>
                                    <div class="position-absolute w-100">
                                        <img src="{{asset($pathGambar.$item->file_galeri)}}" class="img-fluid mx-auto d-block" alt="..." style="height:200px;left:auto;right:auto">
                                    </div>
                                    <div class="card-body d-flex flex-column p-3" style="line-height: 1.2em; font-size: 11pt; color:black">
                                        <span class="font-weight-bold text-center">{{$item->deskripsi_galeri}}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <ul class="pagination-area justify-content-center pt-2">
                </div>
            </div>
        </div>
    </div>
    @include('landing-page.include.hubungi-kami')
@endsection

@push('script')
<script src="{{asset('assets/js/pagination.js')}}"></script>
<script>
	// var pageUrl, prevUrl, nextUrl = '';
	// var page, size = 0;
	var page = parseInt(JSON.parse('{{$galeri->currentPage()}}'))
	var size = parseInt(JSON.parse('{{$galeri->lastPage()}}'))
	var prevUrl = '{{$galeri->previousPageUrl()}}'
	var nextUrl = '{{$galeri->nextPageUrl()}}'
	var pageUrl = '{{$galeri->url(1)}}'
	$(document).ready(function () {
	})
</script>
@endpush