
{{-- Start Hubungi Kami --}}
<section id="contacts" class="block bg-white-before spacer m-top-lg">
	{{-- <div class="wrapper">
		<div class="title">
			<h6 class="text-primary text-uppercase">Hubungi Kami</h6>
		</div>

		<div class="title-opacity">
			<div class="title-opacity-text">Contacts</div>
		</div>

		<div class="description-lg">
			<h3>Ada pertanyaan? Hubungi kami dengan bebas dan kami akan segera merespon Anda</h3>
		</div>

		<div class="spacer p-top-lg">
			<div class="row gutter-width-md with-pb-md">
				<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
					<div class="contacts-item d-flex flex-row">
						<div class="d-block">
						<div class="contacts-item-icon">
							<i class="malex-icon-location"></i>
						</div>

						<h5 class="contacts-item-t-head">Alamat</h5>
						</div>

						<span class="d-block text-xs pl-3" style="font-size: 10pt; line-height: 1.2em">
							<div class="mb-2">
								<strong>Sekolah Putra:</strong>
								<br>
								<br> Jalan Raya Pertanian No.1 
								<br>Samboroto Sooko Mojokerto
								<br>
							</div>
							<div>
								<br><strong>Sekolah Putri:</strong>
								<br>
								<br>Jalan Raya Kepuhanyar No. 24
								<br>Mojoanyar Mojokerto
							</div>
						</span>
					</div>
				</div>

				<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
					<div class="contacts-item">
						<div class="contacts-item-icon">
							<i class="malex-icon-phone"></i>
						</div>

						<h5 class="contacts-item-t-head">Telepon</h5>

						<p class="contacts-item-description" style="font-size: 10pt">
							Mobile: <a href="tel:+43253312523">+432 533 12 523</a><br>
							Fax: <a href="tel:+53222212523">+532 222 12 523</a>
						</p>
					</div>
				</div>

				<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
					<div class="contacts-item">
						<div class="contacts-item-icon">
							<i class="malex-icon-email"></i>
						</div>

						<h5 class="contacts-item-t-head">E-mail</h5>

						<p class="contacts-item-description" style="font-size: 10pt">
							Info: <a href="mailto:info@domain.com">info@domain.com</a><br>
							CEO: <a href="mailto:ceo@domain.com">ceo@domain.com</a>
						</p>
					</div>
				</div>
			</div>
		</div>
	</div> --}}
	
	<div class="wrapper bg-main-color-light">
		<div class="row py-5">
			<div class="text-center w-100 pb-5">
				<h3 class="main-text-green font-nunito font-weight-bold">Contact Us</h3>
				<div class="w-25 m-auto">
					<hr>
				</div>
			</div>
			<div class="col-12 col-md-2"></div>
			<div class="col-12 col-md-8">
				<div class="row">
					<div class="col-12 col-md-6 d-flex justify-content-around pr-md-0 pb-5 pb-md-0">
						<a href="tel:{{$identitas->phone}}" class="icon-button phone"><i class="fas fa-phone"></i><span></span></a>
						<a href="mailto:{{$identitas->email}}" class="icon-button envelope"><i class="far fa-envelope"></i><span></span></a>
						<a target="_blank" href="{{$identitas->youtube}}" class="icon-button youtube"><i class="fab fa-youtube"></i><span></span></a>
						<a target="_blank" href="{{$identitas->fb}}" class="icon-button facebook"><i class="fab fa-facebook"></i><span></span></a>
					</div>
					<div class="col-12 col-md-6 d-flex justify-content-around pl-md-0">
						<a target="_blank" href="{{$identitas->instagram}}" class="icon-button instagram"><i class="fab fa-instagram"></i><span></span></a>
						<a target="_blank" href="{{$identitas->tiktok}}" class="icon-button tiktok"><i class="fab fa-tiktok"></i><span></span></a>
						<a target="_blank" href="{{$identitas->twitter}}" class="icon-button twitter"><i class="fab fa-twitter"></i><span></span></a>
						<a target="_blank" href="{{$identitas->googleplus}}" class="icon-button google-plus"><i class="fab fa-google-plus-g"></i><span></span></a>
					</div>
				</div>
			</div>
			<div class="col-12 col-md-2"></div>
		</div>
	</div>
	

	{{-- <div class="width-img spacer p-top-xl p-bottom-xl">
		<div class="wrapper">
			<div>
				<div class="title">
					<h3 class="pb-0">Pesan dan Saran untuk Kami</h3>
				</div>

				<div class="description-lg spacer p-top-lg">
					<p>Sampaikan pesan & Saran Anda untuk kami dengan isi form berikut ini</p>
				</div>

				<div class="spacer p-top-lg">
					<form method="post" action="form.php" id="cf-1" class="contact-form">
						<div class="row mb-4">
							<div class="col-12 col-md-6">
								<div class="form-group form-group-xs">
									<label for="name">Nama *</label>
									<input name="name" type="text" class="form-control form-control-lg bg-gray-light" placeholder="Nama" required="required">
								</div>
							</div>

							<div class="col-12 col-md-6">
								<div class="form-group form-group-xs">
									<label for="email">Email *</label>
									<input name="email" type="email" class="form-control form-control-lg bg-gray-light" placeholder="Email" required="required">
								</div>
							</div>
						</div>


						<div class="form-group form-group-xs">
							<label for="pesan">Pesan dan Saran *</label>
							<textarea name="pesan" class="form-control form-control-lg bg-gray-light" placeholder="Isi Pesan dan Saran" required="required"></textarea>
						</div>

						<div class="form-group form-group-xs mb-0">
							<button type="submit" class="btn btn-outline-secondary">Send Message</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div> --}}
</section>
{{-- End Hubungi Kami --}}