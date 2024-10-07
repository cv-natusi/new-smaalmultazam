<header id="header" class="site-header shadow">
	<div class="wrapper" style="padding-top: 0.5rem;padding-bottom:0.5rem;">
		<div class="header-content d-flex justify-content-between">
			<div class="header-left align-self-center">
				<div class="header-logo font-nunito">
					<a class="adv-light logo logo-secondary" title="Logo" href="#">
						<div class="d-flex flex-row">
							<img src="{{isset($identitas)?asset('uploads/identitas/'.$identitas->logo_kiri):asset('assets/img/logo/logo.png')}}" alt="Logo" style="height: 80px;width: 80px">
							<div class="d-flex flex-column ml-1 mt-auto mb-auto adv-dark">
								<h5 class="text-white mb-0">{{isset($identitas)?$identitas->nama_web:'SMAS AL MULTAZAM'}}</h5>
								<span style="font-size:10pt">Kab. Mojokerto - Jawa Timur</span>
							</div>
						</div>
					</a>
					
					<a class="adv-dark logo logo-primary" title="Logo" href="#">
						<div class="d-flex flex-row">
							<img src="{{isset($identitas)?asset('uploads/identitas/'.$identitas->logo_kiri):asset('assets/img/logo/logo.png')}}" alt="Logo" style="height: 80px;width: 80px">
							<div class="d-flex flex-column ml-1 mt-auto mb-auto adv-dark">
								<h5 class="mb-0 main-text-green">{{isset($identitas)?$identitas->nama_web:'SMAS AL MULTAZAM'}}</h5>
								<span class="text-dark" style="font-size:10pt">Kab. Mojokerto - Jawa Timur</span>
							</div>
						</div>
					</a>
				</div>
			</div>
			
			<div class="header-right d-flex justify-content-end">
				<div class="d-flex align-items-center">
					<input type="checkbox" name="check" id="check">
					{{-- <div class="menu">
						<nav class="menu-primary">
							<ul class="nav">
								<li class="nav-item">
									<a title="Beranda" href="{{route('landingPage')}}">BERANDA</a>
								</li>
								
								<li class="nav-item">
									<a title="Menu Utama" href="{{route('menuUtama')}}">MENU UTAMA</a>
								</li>
								
								<li class="nav-item">
									<a title="Profil" href="{{route('profil')}}">PROFIL</a>
								</li>
								
								<li class="nav-item">
									<a title="Program" href="{{route('program')}}">PROGRAM</a>
								</li>
								
								<li class="nav-item">
									<a title="Galeri" href="{{route('galeri')}}">GALERI</a>
								</li>
								
								<li class="nav-item">
									<a title="Sim" href="{{route('sim')}}">SIM</a>
								</li>
								
								<li class="nav-item">
									<a title="Alumni" href="{{route('alumni')}}">ALUMNI</a>
								</li>
							</ul>
						</nav>
					</div> --}}
					
					<div class="l-nav-btn">
						<div class="l-nav-links">
						<ul>
							@foreach ($menu as $item)
							<li class="l-nav-link" style="--i: .85s">
								@if ($childMenu->contains('parent_id',$item->id_menu))
								<a title="{{$item->nama_menu}}" href="#">{{Str::upper($item->nama_menu)}}
									<i class="fas fa-caret-down"></i>
								</a>
								@else
								<a title="{{$item->nama_menu}}" href="{{route(Str::camel(Str::lower($item->nama_menu)))}}">{{Str::upper($item->nama_menu)}}
								</a>
								@endif
								@if ($childMenu->contains('parent_id',$item->id_menu))
								<div class="l-dropdown shadow-lg">
									<ul>
									@foreach ($childMenu as $child)
									@if ($child->parent_id == $item->id_menu)
									<li class="l-dropdown-link">
										<a title="{{$child->nama_menu}}" href="{{route(Str::camel(Str::lower($item->nama_menu)).'.'.Str::camel(Str::lower($child->nama_menu)))}}">{{$child->nama_menu}}</a>
									</li>
									@endif
									@endforeach
									</ul>
								</div>
								@endif
							</li>
							@endforeach
								{{-- <li class="l-nav-link" style="--i: .6s">
									<a title="Beranda" href="{{route('landingPage')}}">BERANDA</a>
								</li>
								<li class="l-nav-link" style="--i: .85s">
									<a title="Menu Utama" href="{{route('menuUtama')}}">MENU UTAMA<i class="fas fa-caret-down"></i></a>
									<div class="l-dropdown">
										<ul>
											<li class="l-dropdown-link">
												<a href="#">Berita Sekolah</a>
											</li>
											<li class="l-dropdown-link">
												<a href="#">Link 2</a>
											</li>
											<li class="l-dropdown-link">
												<a href="#">Link 3</a>
											</li>
											<li class="l-dropdown-link">
												<a href="#">Link 4</a>
											</li>
											<div class="arrow"></div>
										</ul>
									</div>
								</li>
								<li class="l-nav-link" style="--i: 1.1s">
									<a title="Profil" href="{{route('profil')}}">PROFIL<i class="fas fa-caret-down"></i></a>
									<div class="l-dropdown">
										<ul>
											<li class="l-dropdown-link">
												<a href="#">Link 1</a>
											</li>
											<li class="l-dropdown-link">
												<a href="#">Link 2</a>
											</li>
											<li class="l-dropdown-link">
												<a href="#">Link 3</a>
											</li>
											<li class="l-dropdown-link">
												<a href="#">Link 4</a>
											</li>
											<div class="arrow"></div>
										</ul>
									</div>
								</li>
								<li class="l-nav-link" style="--i: 1.1s">
									<a title="Program" href="{{route('program')}}">PROGRAM<i class="fas fa-caret-down"></i></a>
									<div class="l-dropdown">
										<ul>
											<li class="l-dropdown-link">
												<a href="#">Link 1</a>
											</li>
											<li class="l-dropdown-link">
												<a href="#">Link 2</a>
											</li>
											<li class="l-dropdown-link">
												<a href="#">Link 3</a>
											</li>
											<li class="l-dropdown-link">
												<a href="#">Link 4</a>
											</li>
											<div class="arrow"></div>
										</ul>
									</div>
								</li>
								<li class="l-nav-link" style="--i: 1.35s">
									<a title="Galeri" href="{{route('galeri')}}">GALERI</a>
								</li>
								<li class="l-nav-link" style="--i: 1.35s">
									<a title="Sim" href="{{route('sim')}}">SIM</a>
								</li>
								<li class="l-nav-link" style="--i: 1.35s">
									<a title="Alumni" href="{{route('alumni')}}">ALUMNI</a>
								</li> --}}
							</ul>
						</div>
					</div>
					
					<div class="hamburger-menu-container">
						<div class="hamburger-menu">
							<div></div>
						</div>
					</div>
					<div class=""></div>
					
					{{-- <div class="search-toggle adv-light">
						<button type="button" class="btn btn-lg btn-outline-light btn-round p-0 min-w-auto" data-toggle="modal" data-target="#search-modal"><i class="fas fa-search"></i></button>
					</div>
					
					<div class="menu-toggle adv-light mr-0">
						<button type="button" class="btn btn-lg btn-outline-tertiary btn-round p-0 min-w-auto" data-toggle="modal" data-target="#menu-modal"><i class="fas fa-bars"></i></button>
					</div>
					
					<div class="menu-toggle adv-dark">
						<button type="button" class="btn btn-lg btn-secondary btn-hover-main-secondary btn-round p-0 min-w-auto" data-toggle="modal" data-target="#menu-modal"><i class="fas fa-bars"></i></button>
					</div> --}}
				</div>
			</div>
		</div>
	</div>
</header><!-- .site-header -->