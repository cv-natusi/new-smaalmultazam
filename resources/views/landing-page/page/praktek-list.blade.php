<div class="p-top-sm spacer title font-nunito ">
	<h4 class="font-weight-bold">{{$curMenu}}</h4>
</div>
<div class="p-top-sm spacer">
	<ul class="list-unstyled items berita-area">
		@php
		$pengumuman = [1,2,3,4];
		@endphp
		@foreach ($berita->data as $item)
		<li class="item mb-5">
			<div class="row gutter-width-xs">
				<div class="col-12 align-self-center font-rubik">
					<h5 class="item-t-head font-weight-bold main-text-green"><a title="" href="{{ route(Str::camel($curNav).'.'.Str::camel($curMenu)) }}/{{$item->id_berita}}">{{$item->judul}}</a></h5>
					<a style="font-size: 10pt" href="#" class="text-secondary"> {{ $guru->nama }} -  {{isset($item->tanggal)?date('d F Y',strtotime($item->tanggal)):'-'}}</a>
					<div class="truncate-2-line fs-12">{!!$item->isi!!}</div>
					<a class="main-text-green" href="{{ route(Str::camel($curNav).'.'.Str::camel($curMenu)) }}/{{$item->id_berita}}">[Read More]</a>
				</div>
			</div>
		</li>
		@endforeach
	</ul>
	<div id="container-area" class="container-area"></div>
	<ul class="pagination-area justify-content-center pt-2">
	</ul>
	{{-- <nav aria-label="Page navigation example">
		<ul class="pagination d-flex justify-content-center">
			<li class="page-item"><a class="page-link" href="#">Previous</a></li>
			<li class="page-item"><a class="page-link" href="#">1</a></li>
			<li class="page-item"><a class="page-link" href="#">2</a></li>
			<li class="page-item"><a class="page-link" href="#">3</a></li>
			<li class="page-item"><a class="page-link" href="#">Next</a></li>
		</ul>
	</nav> --}}
</div>
@isset($berita)
<script>
	var pageUrl,prevUrl,nextUrl = '';
	var page,size = 0;
	$(document).ready( function () {
		page = parseInt(JSON.parse('{{$berita->current_page}}'))
		size = parseInt(JSON.parse('{{$berita->last_page}}'))
		prevUrl = "{{url('program/praktek-baik-guru?'.($berita->prev_page_url!=null?explode('?', $berita->prev_page_url)[1]:null))}}"
		nextUrl = "{{url('program/praktek-baik-guru?'.($berita->next_page_url!=null?explode('?', $berita->next_page_url)[1]:null))}}"
		pageUrl = "{{url('program/praktek-baik-guru?page=1')}}"
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
