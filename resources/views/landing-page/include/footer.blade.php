<footer id="footer" class="site-footer bg-main-color font-nunito">
	<div class="wrapper" style="padding-bottom: 1rem">
		<div id="back-to-top">
			<a class="scroll-to-id" href="#"><i class="malex-icon-arrow-up"></i></a>
		</div><!-- #back-to-top -->
		
		<div class="footer">
			<div class="row text-white">
				<div class="col-12 col-md-4">
					<div class="logo logo-secondary">
						<h3>{{isset($identitas)?$identitas->nama_web:'SMAS AL MULTAZAM'}}</h3>
						<p>{{isset($identitas)?$identitas->meta:''}}</p>
					</div>
				</div>
				
				<div class="col-12 col-md-4">
					<h5>INFORMASI</h5>
					<hr class="hr-sparate">
					<ul class="list-unstyled">
						<li><span><i class='bx bxs-phone'></i></i> {{$identitas->phone}}</span></li>
						<li><span><i class='bx bx-envelope' ></i> {{$identitas->email}}</span></li>
						<li><span><i class='bx bx-globe'></i> {{$identitas->url}}</span></li>
					</ul>
				</div>
				
				<div class="col-12 col-md-4">
					<h5>LINK / SITE MAP</h5>
					<hr class="hr-sparate">
					<ul class="list-unstyled">
						<li><a href="{{route('profil.visiDanMisi')}}"><i class='bx bx-chevron-right'></i> Visi dan Misi</a></li>
						<li><a href="{{route('profil.sejarahSingkat')}}"><i class='bx bx-chevron-right'></i> Sejarah</a></li>
						<li><a href="{{route('profil.sambutanKepalaSekolah')}}"><i class='bx bx-chevron-right'></i> Sambutan Kepala Sekolah</a></li>
						<li><a href="{{route('profil.strukturOrganisasi')}}"><i class='bx bx-chevron-right'></i> Struktur Organisasi</a></li>
						<li><a href="{{route('program.programUnggulan')}}"><i class='bx bx-chevron-right'></i> Program Sekolah</a></li>
					</ul>
				</div>
			</div>
			<div class="row">
				<div class="col-12 pt-5">
					<div class="copyright text-center w-100">
						<p>© 2024 | {{isset($identitas)?$identitas->nama_web:'SMAS AL MULTAZAM'}}</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</footer><!-- .site-footer -->