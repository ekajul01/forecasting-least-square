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
	<title> Data Aktual </title>
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
			<h3>Data Harga Emas Antam per Gram </h3>
			<div class="box">
				<table border="1" cellspacing="0" class="table">
					<thead>
						<tr>
							<th> No </th>
							<th> Tanggal </th>
							<th> Harga </th>
							<th> Aksi </th>
						</tr>
					</thead>
					<tbody style="text-align: center;">
						<?php $i=1; ?>
				        <?php while ($row = mysqli_fetch_assoc($data)) : ?>
						<tr>
							<td style="width: 100px"> <?php echo $i;?> </td>
							<td style="width: 275px"> <?php echo $row['tanggal'];?> </td>
							<td style="width: 275px"> Rp. <?php echo number_format($row['harga']);?> </td>
							<td> 
								<a href="data-aktual-edit.php?id=<?= $row["id"];?>"><span id="edit"><i class="fa-solid fa-pen-to-square"></i> Edit  </span></a>
								<a href="data-aktual-hapus.php?id=<?= $row["id"];?>"><span id="hapus"><i class="fa-solid fa-trash"></i> Hapus </span></a>
							</td>
						</tr>
				        <?php $i++; ?>
				        <?php endwhile; ?>				        
					</tbody>
					<p><a href="data-aktual-tambah.php"><span id="tambah"> <i class="fa-solid fa-plus"></i>  Tambah Data </span></a></p><br>
				</table>	
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