@extends('landing-page.layouts.index')

@push('style')
<style>
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
	@include('landing-page.include.page-title', array('title'=>'Menu Utama'))

	<div class="row m-0 pb-5">
		<div class="col-md-4">
			<div class="spacer">
				@include('landing-page.include.menu-list')
			</div>
		</div>
		<div class="col-md-8">
			@if($curMenu == 'Berita Sekolah')
				@if(isset($detail))
					@include('landing-page.page.berita-page')
				@else
					@include('landing-page.page.berita-list')
				@endif
			@elseif($curMenu == 'Prestasi')
				@if(isset($detail))
					@include('landing-page.page.berita-page')
				@else
					@include('landing-page.page.berita-list')
				@endif
			@elseif($curMenu == 'Pengumuman')
				@if(isset($detail))
					@include('landing-page.page.berita-page')
				@else
					@include('landing-page.page.berita-list')
				@endif
			@elseif($curMenu == 'Event')
				@if(isset($detail))
					@include('landing-page.page.berita-page')
				@else
					@include('landing-page.page.berita-list')
				@endif
			@elseif($curMenu == 'AMTV')
				@include('landing-page.page.amtv-page')
			
			@elseif($curMenu == 'Sejarah Singkat')
				@include('landing-page.page.berita-page')
			@elseif($curMenu == 'Sambutan Kepala Sekolah')
				@include('landing-page.page.berita-page')
			@elseif($curMenu == 'Visi dan Misi')
				@include('landing-page.page.berita-page')
			@elseif($curMenu == 'Struktur Organisasi')
				@include('landing-page.page.berita-page')
			@elseif($curMenu == 'Profil Guru dan Tenaga Pendidik')
				@include('landing-page.page.card-profil-page')
			@elseif($curMenu == 'Fasilitas Sekolah')
				@include('landing-page.page.fasilitas-sekolah-page')

			@elseif($curMenu == 'Program Unggulan')
				@if(isset($detail))
					@include('landing-page.page.berita-page')
				@else
					@include('landing-page.page.berita-list')
				@endif
			@elseif($curMenu == 'Ekstrakurikuler')
				@if(isset($detail))
					@include('landing-page.page.berita-page')
				@else
					@include('landing-page.page.berita-list')
				@endif
			@elseif($curMenu == 'Praktek Baik Guru')
				@if(isset($detail))
					@include('landing-page.page.berita-page')
				@else
					@include('landing-page.page.praktek-list')
				@endif
			@elseif($curMenu == 'Karya Siswa')
				@include('landing-page.page.berita-list')
			@else($curMenu == 'UKS')
				@include('landing-page.page.berita-page')
			@endif
		</div>
	</div>
	@include('landing-page.include.hubungi-kami')
@endsection

@push('script')
	<script>
		var routeAsset = "{{asset('uploads/berita/')}}"
		var routeBeritaDetail = "{{ route(Str::camel($curNav)) }}/{{strtolower(str_replace(' ','-',$curMenu))}}"
	</script>
@endpush