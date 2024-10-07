<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>SMA S AL-MULTAZAM</title>
	<style>
		body{
			background-color: #34495e;
		}
		
		header{
			margin-top: 100px;
			h1, h3, a{
				text-align: center;
				font-family: 'Architects Daughter', cursive;
				color: #95a5a6;
			}
		}
		
	</style>
</head>
<body>
	<header>
		<h1>{ We're Coming }</h1>
		<h3>Menu ini masih dalam pengembangan, kami akan kembali secepat mungkin</h3>
		<h3><a id="btn-back" style="text-decoration:underline">BERANDA</a></h3>
	</header>
	<script>
	    document.getElementById('btn-back').addEventListener('click', function(e){
	        e.preventDefault();
	        window.location = "{{route('beranda')}}";
	    })
	</script>
	
</body>
</html>