@extends('landing-page.layouts.index')

@push('style')
	<style>
		.image-container {
			height: 200px;
			width: 100%;
		}
		.text-truncate-container {
			width: 80%;
		}
		.text-truncate-container p {
			-webkit-line-clamp: 3;
			display: -webkit-box;
			-webkit-box-orient: vertical;
			overflow: hidden;
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
						@foreach ($sim->items() as $item)
						<div class="col-12 col-md-6 mb-3" >
							<div class="row m-2 shadow">
								<div class="col-md-4 align-middle my-auto">
									<img src="{{asset('uploads/sim')}}/{{$item->foto}}" class="img-fluid" alt="...">
								</div>
								<div class="col-md-8">
									<div class="card-body">
										<h5 class="card-title">{{$item->nama}}</h5>
										<div class="text-truncate-container my-1">
											<p style="height:5.28rem">{{$item->keterangan}}</p>
										</div>
										<a class="btn rounded btn-success px-0" href="{{$item->link}}" target="_blank">Buka</a>
									</div>
								</div>
							</div>
						</div>
							{{-- <div class="col-12 col-md-4 mb-3">
								<div class="card">
									<div class="card-body p-0" style="line-height: 1.2em; font-size: 11pt; color:black">
										<div class="row">
											<div class="image-container col-12 d-block col-md-4">
												<img src="{{asset('assets/img/ibu.png')}}" class="img-fluid m-auto d-block" alt="..." style="height:auto;left:auto;right:auto">
											</div>
											<div class="col-12 col-md-8 d-flex flex-column">
												<span class="font-weight-bold">{{"Aula Serba Guna"}}</span>
												<div class="text-truncate-container">
													<span>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis repellendus quis expedita obcaecati enim, odio quidem voluptatem inventore cumque exercitationem, quas ad nulla hic impedit voluptate nemo veritatis consectetur maiores!</span>
												</div>
												<button class="btn rounded btn-success w-fit h-fit">Buka</button>
											</div>
										</div>
									</div>
								</div>
							</div> --}}
						@endforeach
					</div>
					<div id="container-area" class="container-area"></div>
					<ul class="pagination-area justify-content-center pt-2">
					</ul>
				</div>
			</div>
		</div>
	</div>
	@include('landing-page.include.hubungi-kami')
@endsection

@push('script')
@isset($sim)
<script>
	var pageUrl,prevUrl,nextUrl = '';
	var page,size = 0;
	$(document).ready( function () {
		page = parseInt(JSON.parse('{{$sim->currentPage()}}'))
		size = parseInt(JSON.parse('{{$sim->lastPage()}}'))
		prevUrl = '{{$sim->previousPageUrl()}}'
		nextUrl = '{{$sim->nextPageUrl()}}'
		pageUrl = '{{$sim->url(1)}}'
		pageUrl = pageUrl.slice(0,-1)
		
		console.log(page,size);
		console.log(page);
		PaginationInit(page, size, pageUrl);
		
		console.log($('.pageInput'));
		Array.from($('.pageInput')).forEach(element => {
			$(element).blur(
			function (event) {
				ToPage(this)
			}
			)
			$(element).keyup(
			function (event) {
				if(event.which === 13){ToPage(this)}
			}
			)
		});
	})
	
	const ToPage = (elem) => {
		var p = parseInt(elem.value);
		
		if (!isNaN(parseFloat(p)) && isFinite(p)) {
			if (p > size) {
				p = size;
			} else if (p < 1) {
				p = 1;
			}
		} else {
			p = page;
			return
		}
		
		window.location.href = pageUrl+p
	}
	const PaginationInit = (page,size,pageUrl) => {
		var step = 2;
		var innerHTML = '<li><a href="'+prevUrl+'" id="prevUrl">Prev</a></li>'
		
		if (size < step) {
			innerHTML += Add(1, size + 1);
		} else if (page <= step) {
			innerHTML += Add(1, step + 1);
			innerHTML += Last(size);
		} else if (page > size - step) {
			innerHTML += First();
			innerHTML += Add(
			size + 1 - step,
			size + 1
			);
		} else {
			innerHTML += First();
			innerHTML += Add(
			page - step + 1,
			page + step
			);
			innerHTML += Last(size);
		}
		innerHTML += '<li><a href="'+nextUrl+'" id="nextUrl">Next</a></li>'
		Finish(innerHTML);
	}
	
	const First = () => {
		return '<li><a href="'+pageUrl+1+'">1</a></li><input type="text" class="pageInput">';
	}
	
	const Add = (s, f) => {
		var addItem = '';
		for (var i = s; i < f; i++) {
			addItem += '<li><a href="'+pageUrl+i+'">' + i + "</a></li>";
		}
		return addItem
	}
	
	const Last = (size) => {
		return '<input type="text" class="pageInput"><li><a href="'+pageUrl+size+'">' + size + "</a></li>";
	}
	
	const Finish = (innerHTML) => {
		$('.pagination-area').html(innerHTML);
		Bind();
	}
	
	const Bind = () => {
		var pageList = $('.pagination-area').children('li')
		console.log(pageList.length);
		Array.from(pageList).forEach(element => {
			if($(element).children('a').html() == page) {
				$(element).children('a').addClass(' active')
			}
		});
		if(page>=size){
			$('#nextUrl').prop('disabled',true)
		}
		if(page<=size){
			$('#prevUrl').prop('disabled',true)
		}
	}
</script>
@endisset
@endpush