<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SMAS AL-MULTAZAM</title>
    @include('landing-page.include.style')
    <style>
        .site-header:not(.animated){
            /* background-color: #AEA4A4 !important; */
            /* background-color: #999999 !important; */
            background-color: #4E5E30 !important;
        }
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
    <link rel="shortcut icon" href="{{isset($identitas)?asset('uploads/identitas/'.$identitas->favicon):asset('assets/img/logo/logo.png')}}" type="image/x-icon">
</head>
<body class="home header-absolute-true header-fixed-true">
    @include('landing-page.include.navbar')
    <main id="main" class="site-main content-no-spacing">
        <div class="content">
            <div class="clearfix">
                @yield('content')
            </div>
        </div>
    </main>
    @include('landing-page.include.footer')
    @include('landing-page.include.script')
</body>
</html>