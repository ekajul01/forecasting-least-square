<?php  
	session_start();
	require "function.php";
	if (!isset($_SESSION['login'])) {
		header("location:login.php");
		exit;
	}
	$data = mysqli_query($conn, "SELECT * FROM harga_emas");
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="style.css">
	<link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="font/css/all.css">
	<title> Edit Data Aktual </title>
</head>
<body>
	<!-- header -->
	<header>
		<div class="container">
			<h1><a href=""> Forecasting </h1>
			<ul>
				<li><a href="index.php"> Dashboard </a></li>
				<li><a href="data-aktual.php"> Data Aktual </a></li>								
				<li><a href="hasil-forecasting.php"> Hasil Forecasting </a></li>							
				<li><a href="forecasting.php"> Forecasting </a></li>				
				<li><a href="user-profil.php"> Profil </a></li>
				<li><a href="logout.php"> Logout </a></li>
			</ul>
		</div>
	</header>

	<!-- content -->
	<div class="section">
		<div class="container">
			<h3>Edit Data</h3>
			<div class="box">
				<?php
					$data_view= mysqli_query($conn, "SELECT * FROM harga_emas 
												WHERE id = '".$_GET['id']."' ");
					$row = mysqli_fetch_assoc($data_view);
				?>	
				<form method="post" action="">
				<p style="margin-bottom: 5px;">ID</p>
				<input type="text" name="id" class="input-control" value="<?php echo $row['id']?>" readonly>
				
				<p style="margin-bottom: 5px;">Tanggal</p>
				<input type="text" name="tgl" class="input-control" value="<?php echo $row['tanggal']?>" readonly>
				
				<p style="margin-bottom: 5px;">Harga</p>
				<input type="text" name="hrg" class="input-control" value="<?php echo $row['harga']?>" requaired>	<br>
				<button type="submit" name="edit" class="edit">Ubah Data</button>
				</form>
			</div>
		</div>
	</div>

	<!-- footer -->
	<footer>
		<div class="container">
			<small> Copyright &copy;2022 - Forecasting Least Square by Eka Juliyanti</small>
		</div>
	</footer>
</body>
</html>
		<?php 
			if(isset($_POST['edit'])){
				$update = mysqli_query($conn, "UPDATE harga_emas SET
						   	tanggal = '".$_POST['tgl']."', 
						   	harga = '".$_POST['hrg']."'
					    WHERE id = '".$_GET['id']."' ");
				if($update){
					echo "
					    <script>
					        alert('data berhasil diubah!');
					        document.location.href = 'data-aktual.php';
					    </script>
					";

				}else{
					echo "
					    <script>
					        alert('data gagal diubah!');
					        document.location.href = 'data-aktual.php';
					    </script>
					";
				}
			}
		?>