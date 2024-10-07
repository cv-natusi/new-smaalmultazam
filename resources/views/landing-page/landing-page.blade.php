@extends('landing-page.layouts.index')

@push('style')
<style>
	#page-title {
		background-image: url('assets/img/web/Mask.png');
	}
	.text-xs {
		font-size: 10pt;
	}
	.carousel-position {
		height:calc(100vh + 3.526rem);
		filter: brightness(40%);
		widows: ;
	}
	@media only screen and (max-width: 600px) {
		.carousel-position {
			height:calc(50vh);
			filter: brightness(40%);
		}
	}
	.carousel {
		padding-top: 5rem !important;
	}
</style>
@endpush

@section('content')

<section id="page-title" class="block with-img with-service-items">
	<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
		<ol class="carousel-indicators">
			@foreach ($slider as $item)
			<li data-target="#carouselExampleIndicators" data-slide-to="{{$loop->index}}" class="@if($loop->first) active @endif"></li>
			@endforeach
		</ol>
		<div class="carousel-inner">
			@foreach ($slider as $item)
			<div class="carousel-item @if($loop->first) active @endif">
				<img class="d-block w-100 carousel-position" src="{{asset('uploads/slider/'.$item->gambar)}}" alt="slider-{{$loop->index}}">
			</div>
			@endforeach
		</div>
		<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
			<span class="carousel-control-prev-icon" aria-hidden="true"></span>
			<span class="sr-only">Previous</span>
		</a>
		<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
			<span class="carousel-control-next-icon" aria-hidden="true"></span>
			<span class="sr-only">Next</span>
		</a>
	</div>
	<div class="wrapper d-flex flex-column justify-content-center position-absolute" style="top:0;width:80%">
		<div class="page-title-body page-title-body-space-left">
			<div class="title">
				<h1 class="large">{{isset($identitas)?$identitas->nama_web:'SMAS AL MULTAZAM'}}</h1>
			</div>
			
			<div class="description spacer p-top-lg">
				<p>{{isset($identitas)?$identitas->meta:''}}</p>
			</div>
			
			<div class="spacer p-top-lg">
				<a href="{{route('profil.sejarahSingkat')}}" class="text-white btn btn-outline-light">Baca Selengkapnya</a>
			</div>
		</div>
	</div>
	
	{{-- <div class="page-title-bg-color"></div> --}}
</section><!-- #page-title -->

{{-- <div id="services" class="block">
	<div class="wrapper">
		<div class="row gutter-width-md with-pb-md service-items">
			<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
				<div class="service row">
					<div class="col-md-6 col-12">
						<h6 class="text-primary">SMA AL-MULTAZAM</h6>
						<h3>Sambutan Kepala Sekolah</h3>
						<div class="service-icon">
							<i class="malex-icon-strategy"></i>
						</div>
						
						<h5 class="service-t-head">Nama Kepala Sekolah</h5>
						
						<p class="service-description">Kepala Sekolah</p>
					</div>
					<div class="col-md-6 col-12">
						<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolores repellendus unde dolore, quasi debitis reiciendis incidunt dicta voluptate vitae vel sint saepe cum delectus sed corrupti, itaque ex obcaecati ullam.</p>
						<div class="service-btn">
							<a title="Read more" class="btn btn-sm btn-link btn-icon-hover p-0 border-0 min-w-auto link-no-space text-uppercase" href="service-inside.html">
								<i class="malex-icon-arrow-right i-large"></i>
								<span class="btn-text">Baca Selengkapnya</span>
							</a>
						</div>
					</div>
					
				</div>
			</div>
		</div>
	</div>
</div><!-- #services --> --}}

<div id="sambutan" class="container">
	<div class="row position-relative" style="min-height: 600px;margin-top:2rem">
		<!--Profile Card 5-->
		<div class="col-12 col-md-4 mt-4">
			<div class="card profile-card-5">
				<div class="card-img-block">
					<img class="card-img-top" src="{{asset('uploads/sambutan').'/'.$identitas->foto_sambutan}}" alt="Card image cap">
				</div>
				<div class="card-body pt-0">
					<h5 class="card-title">{{$identitas->nama_kepsek}} - Kepala Sekolah</h5>
					<div class="truncate-3-line">{!!$identitas->sambutan_kepsek!!}</div>
					<button id="btnSambutan" data-toggle="modal" data-target=".bd-example-modal-lg" class="btn btn-main-color-outline">SELENGKAPNYA</button>
				</div>
			</div>
		</div>
		
		<div class="col-12 col-md-8">
			<div class="w-100 mt-4 pt-5 main-text-green text-center">
				<h2>Prestasi</h2>
			</div>
			<div class="w-100 carousel-prestasi">
    			@foreach ($prestasi as $item)
    			<div class="carousel-prestasi-cell main-text-green">
    				<div class="card mx-auto card-prestasi-1 p-2 h-100">
    					<div class="card-prestasi-img">
    						<img class="img-prestasi" src="{{asset('uploads/berita/'.$item->gambar)}}" alt="">
    						<a href="{{route('menuUtama.prestasi')}}/{{$item->id_berita}}" class="btn-main-color btn-prestasi btn">SELENGKAPNYA</a>
    					</div>
    					<div class="w-50 overflow-hide pt-4 pb-2 pl-2 position-relative">
    						<p><strong>{{$item->judul}}</strong></p>
    						<div class="prestasi-text-desc">{!! $item->isi !!}</div>
    						<div class="position-absolute prestasi-text w-100 h-100" style="position: absolute;top:0"></div>
    					</div>
    				</div>
    			</div>
    			@endforeach
    		</div>
		</div>
	</div>
</div>

{{-- <div class="carouselContainer">
	<div class="carouselOfImages">
		@foreach ($berita as $item)
		<div class="card">
			<div class="card-body col-md-4">
				<p>wwww</p>
			</div>
		</div>
		@endforeach
	</div>
</div> --}}
<div class="gradient-left position-relative overflow-x-clip w-100">
	<div class="background-shape-1"></div>
</div>
<div class="gradient-right">
</div>
{{-- Start Berita Terbaru --}}
<section id="news" class="block spacer p-top-xl p-bottom-xl">
	<div class="wrapper">
		<div class="title text-right">
			<h2 class="text-white font-nunito font-weight-bold"><i class='bx bx-news' style="font-size: 26pt"></i> Berita Terbaru</h2>
		</div>
		
		<div class="blog-shortcode">
			<div class="row gutter-width-md with-pb-md spacer p-top-lg">
				<div class="w-100 position-relative carousel-berita">
					@foreach ($berita as $item)
					<div class="col-12 h-berita-card py-4 main-text-green">
						<div class="card h-100 shadow round-lg font-nunito">
							<div class="d-md-flex h-md-100">
								<div class="w-berita position-relative h-100">
									<img class="img h-100 w-100 img-responsive" src="{{asset('uploads/berita/'.$item->gambar)}}" alt="Card image cap">
								</div>
								<div class="card-body w-berita overflow-hide" style="background: transparent;line-height:1.8">
									<h4 class="truncate-2-line card-title font-nunito font-bolder">{{$item->judul}}</h4>
									<span><i class='bx bx-calendar'></i>{{date('d F Y',strtotime($item->tanggal))}}</span>
									<div class="truncate-3-line pb-2">
										<p class="card-text">{!! $item->isi !!}</p>
									</div>
									<a href="{{route('menuUtama.beritaSekolah')}}/{{$item->id_berita}}" class="btn-main-color-outline btn">Read More</a>
								</div>
							</div>
						</div>
					</div>
					{{-- <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12">
						<div class="card card-post border-0">
							<div class="card-top position-relative">
								<a title="5 Tips for Sustainable Business Success" href="news-single-post.html">
									<div class="img object-fit overflow-hidden">
										<div class="object-fit-cover transform-scale-h">
											<img class="card-top-img" src="{{asset('uploads/berita/'.$item->gambar)}}" alt="5 Tips for Sustainable Business Success">
										</div>
									</div>
								</a>
							</div>
							
							<div class="card-body">
								<h5 class="card-title">
									<a title="5 Tips for Sustainable Business Success" href="news-single-post.html">Judul Berita Sekolah</a>
								</h5>
								
								<p class="card-text">At vero eos et accusamus et iusto odio dignissimos ducims…</p>
								
								<div class="spacer">
									<a title="View all news" class="btn btn-outline-secondary btn" href="news.html">Selanjutnya</a>
								</div>
							</div>
						</div>
					</div> --}}
					@endforeach
				</div>
			</div>
		</div>
		<div class="w-100 text-center mt-5">
			<a href="{{route('menuUtama.beritaSekolah')}}" class="btn btn-main-color">Show More</a>
		</div>
	</div>
</section>
{{-- End Berita Terbaru --}}

{{-- Start Berita Sekolah --}}
<section id="berita-sekolah" class="block spacer p-top-sm">
	<div class="wrapper">
		<div class="title main-text-green d-flex w-full justify-content-between">
			<h2>Event Mendatang</h2>
			<a class="ms-auto me-0" href="{{route('menuUtama.event')}}">[SHOW MORE]</a>
		</div>
		
		<div class="blog-shortcode">
			<div class="row gutter-width-md with-pb-md spacer p-top-lg">
				<div class="w-100 position-relative carousel-event">
					@foreach ($event as $item)
					{{-- <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12"> --}}
					<div class="col-12 l-w-100 l-w-md-25">
						<div class="card card-post border-0">
							<div class="card-top position-relative">
								<a title="5 Tips for Sustainable Business Success" href="{{route('menuUtama.event')}}/{{$item->id_berita}}">
									<div class="img object-fit overflow-hidden">
										<div class="object-fit-cover transform-scale-h">
											<img class="card-top-img" src="{{asset('uploads/berita/'.$item->gambar)}}" alt="5 Tips for Sustainable Business Success">
										</div>
									</div>
								</a>
							</div>
							
							<div class="card-body font-nunito">
								<div class="card-title font-weight-bold main-text-green">
									<a title="5 Tips for Sustainable Business Success" href="{{route('menuUtama.event')}}/{{$item->id_berita}}">{{$item->judul}}</a>
								</div>
								<div class="truncate-2-line text-event">
									{!! $item->isi !!}
								</div>
								
								<div class="spacer pt-2">
									<a title="View all news" class="btn btn-main-color" href="{{route('menuUtama.event')}}/{{$item->id_berita}}">Selanjutnya</a>
								</div>
							</div>
						</div>
					</div>
					@endforeach
				</div>
				
			</div>
		</div>
	</div>
</section>
{{-- End Berita Sekolah --}}

{{-- Start Agenda Pengumuman Terbaru --}}
{{-- <section id="news" class="block spacer p-top-sm p-bottom-xl bg-light">
	<div class="wrapper">
		<div class="row">
			<div class="col-12 col-md-6">
				<div class="p-top-sm p-bottom-xl title">
					<h4>Agenda</h4>
				</div>
			</div>
			<div class="col-12 col-md-6">
				<div class="p-top-sm p-bottom-xl title">
					<h4>Pengumuman Terbaru</h4>
				</div>
				<div class="p-top-sm">
					<ul class="list-unstyled items">
						@php
						$pengumuman = [1,2,3,4];
						@endphp
						@foreach ($pengumuman as $item)
						<li class="item">
							<div class="row gutter-width-xs">
								<div class="col-3">
									<a href="news-single-post.html">
										<div class="img object-fit overflow-hidden">
											<div class="object-fit-cover transform-scale-h">
												<img src="assets/img/demo/20_img.jpg" alt="5 Tips for Sustainable Business Success">
											</div>
										</div>
									</a>
								</div>
								
								<div class="col-9 align-self-center">
									<h5 class="item-t-head"><a title="5 Tips for Sustainable Business Success" href="news-single-post.html">Judul Pengumuman</a></h5>
									<p class="item-t-body"><a href="#" class="text-secondary">01 Januari 2024</a></p>
									<p><a class="d-inline-block text-truncate" style="width: 80%" href="#">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quae, asperiores aspernatur. Dicta, voluptatum obcaecati. Quo delectus, quam saepe totam officiis obcaecati assumenda sint quas, ut culpa cupiditate! Facere, eum dolorem?</a></p>
								</div>
							</div>
						</li>
						@endforeach
					</ul>
				</div>
			</div>
		</div>
	</div>
</section> --}}
{{-- End Agenda Pengumuman Terbaru --}}

@include('landing-page.include.hubungi-kami')
{{-- Start Embed Map --}}
<div id="map" class="block spacer p-top-lg p-bottom-lg">
	<div class="wrapper">
		<div class="title pb-4">
			<h3 class="main-text-green font-nunito font-weight-bold">Visit Us</h3>
		</div>
		<div class="row">
			{{-- <div class="col-12 col-md-4">
				<a href="tel:{{$identitas->phone}}" class="icon-button phone"><i class="fas fa-phone"></i><span></span></a>
				<a href="mailto:{{$identitas->email}}" class="icon-button envelope"><i class="far fa-envelope"></i><span></span></a>
				<a href="{{$identitas->youtube}}" class="icon-button youtube"><i class="fab fa-youtube"></i><span></span></a>
				<a href="{{$identitas->fb}}" class="icon-button facebook"><i class="fab fa-facebook"></i><span></span></a>
				<a href="{{$identitas->instagram}}" class="icon-button instagram"><i class="fab fa-instagram"></i><span></span></a>
				<a href="{{$identitas->tiktok}}" class="icon-button tiktok"><i class="fab fa-tiktok"></i><span></span></a>
				<a href="{{$identitas->twitter}}" class="icon-button twitter"><i class="fab fa-twitter"></i><span></span></a>
				<a href="{{$identitas->googleplus}}" class="icon-button google-plus"><i class="fab fa-google-plus-g"></i><span></span></a>
			</div> --}}
			<div class="col-12 col-md-6">
				<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1663.3046759013614!2d112.47035837601443!3d-7.462208224075506!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e780dca0f87c053%3A0x72e433cdd524e032!2sMTS.%20Al%20Multazam!5e0!3m2!1sid!2sid!4v1705286600199!5m2!1sid!2sid" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
				<div class="card">
					<div class="card-body contacts-item d-flex flex-row" style="padding: 1rem">
						<div class="contacts-item-icon">
							<i class="malex-icon-location main-text-green" style="font-size: 2rem"></i>
						</div>
						<div class="pl-2 main-text-green" style="padding-top: 1rem">
							<p class="main-text-green"><strong>Alamat Putra</strong></p>
							<p style="font-size: 12pt">{{$identitas->alamat}}</p>
						</div>
					</div>
				</div>
			</div>
			<div class="col-12 col-md-6 pt-md-0 pt-4">
				<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1978.0086905198473!2d112.47004179599901!3d-7.463328140614738!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7813ea2d7fdb9b%3A0x570773862b5af0b8!2sPondok%20Pesantren%20Al-Multazam%20Putri%20Mojokerto!5e0!3m2!1sid!2sid!4v1705284593800!5m2!1sid!2sid" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
				<div class="card">
					<div class="card-body contacts-item d-flex flex-row" style="padding: 1rem">
						<div class="contacts-item-icon">
							<i class="malex-icon-location main-text-green" style="font-size: 2rem"></i>
						</div>
						<div class="pl-2 main-text-green" style="padding-top: 1rem">
							<p><strong>Alamat Putri</strong></p>
							<p style="font-size: 12pt">{{$identitas->alamat_1}}</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
{{-- End Embed Map --}}
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header font-nunito">
				<h5 class="modal-title text-center main-text-green font-weight-bold" id="exampleModalLabel">Sambutan Kepala Sekolah</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true" style="color: #000">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="row px-4 pb-4">
					<div class="col-md-3"></div>
					<div class="col-12 col-md-6">
						<img class="img-fluid" src="{{asset('uploads/sambutan').'/'.$identitas->foto_sambutan}}" alt="Card image cap">
					</div>
					<div class="col-md-3"></div>
					<div class="col-12 pt-4">
						<div style="color:#000">{!!$identitas->sambutan_kepsek!!}</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@push('script')
<script>
</script>
@endpush