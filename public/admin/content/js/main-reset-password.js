function updatePassword() {
    // console.log();
	var url = routeUpdatePassword
	$.post(url)
	.done(function(data){
		console.log(data);
		if(data.code == 200){
			Swal.fire({
				icon: 'success',
				title: 'Berhasil',
				text: data.message,
				showConfirmButton: false,
				timer: 1200
			})
		} else {
			Swal.fire({
				icon: 'warning',
				title: 'Whoops',
				text: data.message,
				showConfirmButton: false,
				timer: 1300,
			})
		}
	})
	.fail(() => {
		Swal.fire({
			icon: 'error',
			title: 'Whoops..',
			text: 'Terjadi kesalahan silahkan ulangi kembali',
			showConfirmButton: false,
			timer: 1300,
		})
	})
}
