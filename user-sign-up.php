<?php 
	require "function.php";
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="style.css">
	<link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
	<title> Daftar Akun </title>
</head>
<body>
	<!-- header -->
	<header>
		<div class="container">
			<h1><a href=""> Forecasting </h1>
			<ul>
				<li><a href="landing.php"> Halaman Depan </a></li>
				<li><a href="login.php"> Login </a></li>
			</ul>
		</div>
	</header>

	<!-- content -->
	<span id="signup">
		<div class="signup">
			<h2> Create Account </h2>
			<form method="post" action="">
				<p style="margin-bottom: 5px;">Nama</p>
				<input type="text" name="nama" placeholder="masukkan nama" class="input-control">

				<p style="margin-bottom: 5px;">Alamat</p>
				<input type="text" name="alamat" placeholder="masukkan alamat" class="input-control">

				<p style="margin-bottom: 5px;">No Telepon</p>
				<input type="text" name="notelp" placeholder="masukkan nomor telepon" class="input-control">

				<p style="margin-bottom: 5px;">Username</p>
				<input type="text" name="user" placeholder="masukkan username" class="input-control">

				<p style="margin-bottom: 5px;">Password</p>
				<input type="password" name="pass" placeholder="masukkan password" class="input-control">

				<button type="submit" name="daftar" class="btn"> Sign Up </button>
				<p style="margin-top: 10px; text-align: center;"> Sudah punya akun? <a href="login.php" style="color: #EA716D;"> Login </a></p>
			</form>
		</div>		
	</span>

	<!-- php -->
	<?php  
		if (isset($_POST['daftar'])) {
			$cekusername = mysqli_query($conn,"SELECT * FROM user
						WHERE username = '".$_POST['user']."'");

			$cek = mysqli_num_rows($cekusername);

			if($cek > 0){
				echo "
					    <script>
					    	alert('username sudah terdaftar!');
					        document.location.href = 'login.php';
					    </script>
					";
			}else{
				$daftar = mysqli_query($conn, "INSERT INTO user
								VALUES( '".$_POST['user']."',
										'".$_POST['pass']."',
										'".$_POST['nama']."', 
										'".$_POST['alamat']."',
										'".$_POST['notelp']."') ");
				if($daftar){
					echo "
					    <script>
					    	alert('daftar akun telah berhasil!');
					        document.location.href = 'login.php';
					    </script>
					";

				}else{
					echo "
					    <script>
					        alert('daftar akun gagal!');
					        document.location.href = 'user-sign-up.php';
					    </script>
					";
				}
			}
		}
	?>

	<!-- footer -->
	<footer>
		<div class="container">
			<small> Copyright &copy;2022 - Forecasting Least Square by Eka Juliyanti</small>
		</div>
	</footer>
</body>
</html>