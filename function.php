<?php  
	$conn = mysqli_connect("localhost","root","","forecasting_least_square");

	if (mysqli_connect_errno()){
		echo "Koneksi database gagal : " . mysqli_connect_error();
	}
?>
