
<div class="row m-0">
	<div class="col-md-12 spacer">
		<div class="p-top-sm spacer title">
			<h4>{{$curMenu}}</h4>
		</div>
		<div class="row p-top-sm spacer">
			@foreach ($guru->items() as $item)
			<div class="col-6 col-md-4 mb-3">
				<div class="card" style="height: 350px">
				<!--<div class="card">-->
				    @if(in_array($item->foto,['ukhti.png','akhi.png']))
					<div class="image-blurred" style="--bg-image:url('{{asset('uploads/guru')}}/{{$item->foto}}')">
					@else
					<div class="image-blurred" style="--bg-image:url('https://learning.smaalmultazam-mjk.sch.id/uploads/guru/{{$item->foto}}')">
					@endif
					</div>
					<div class="position-absolute w-100">
					    @if(in_array($item->foto,['ukhti.png','akhi.png']))
						<img src="{{asset('uploads/guru')}}/{{$item->foto}}" class="img-fluid mx-auto d-block" alt="..." style="height:200px;left:auto;right:auto">
						@else
						<img src="https://learning.smaalmultazam-mjk.sch.id/uploads/guru/{{$item->foto}}" class="img-fluid mx-auto d-block" alt="..." style="height:200px;left:auto;right:auto">
						@endif
					</div>
					{{-- <img src="{{asset('uploads/guru')}}/{{$item->foto}}" class="card-img-top" alt="..." height="200"> --}}
					<div class="card-body d-flex flex-column p-3 font-nunito main-text-green" style="line-height: 1.2em; font-size: 11pt; color:black">
						<table border="0" class="no-border" style="border: 0">
							<tr>
								<td colspan="3" style="padding: 0">
									<span class="font-weight-bold">{{$item->nama}}</span>
								</td>
							</tr>
							<tr>
								<td style="vertical-align: baseline;padding:0"><span style="font-size: 9pt; line-height:0.7rem">NIP </span></td>
								<td style="vertical-align: baseline;padding:0; white-space:nowrap"><span>:</span></td>
								<td style="padding: 0; width:100%"><span style="font-size: 9pt; line-height:0.7rem">{{$item->nip?$item->nip:''}}</span></td>
							</tr>
							<tr>
								<td style="vertical-align: baseline;padding:0"><span style="font-size: 9pt; line-height:0.7rem">Mapel </span></td>
								<td style="vertical-align: baseline;padding:0; white-space:nowrap"><span>:</span></td>
								<td style="padding: 0; width:100%;">
								    <div style="height:80px;overflow-y:scroll">
    									<span style="font-size: 9pt; line-height:0.7rem">
    										@foreach ($item->kelas_mapel as $kelas)
    											@if($kelas->mata_pelajaran&&$kelas->kelas)
    												{{$kelas->mata_pelajaran->nama_mapel}} ({{$kelas->kelas->nama_kelas}})<br>
    											@endif
    										@endforeach
    									</span>
									</div>
								</td>
							</tr>
						</table>
					</div>
				</div>
			</div>
			@endforeach
		</div>
		<div id="container-area" class="container-area"></div>
		<ul class="pagination-area justify-content-center pt-2">
		</ul>
	</div>
</div>
@isset($guru)
<script>
	var pageUrl,prevUrl,nextUrl = '';
	var page,size = 0;
	$(document).ready( function () {
		page = parseInt(JSON.parse('{{$guru->currentPage()}}'))
		size = parseInt(JSON.parse('{{$guru->lastPage()}}'))
		prevUrl = '{{$guru->previousPageUrl()}}'
		nextUrl = '{{$guru->nextPageUrl()}}'
		pageUrl = '{{$guru->url(1)}}'
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