<?php  
	session_start();
	require "function.php";
	if (!isset($_SESSION['login'])) {
		header("location:login.php");
		exit;
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="style.css">
	<link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="font/css/all.css">
	<title> Hasil Forecasting </title>
</head>
<body>
	<!-- header -->
	<header>
		<div class="container">
			<h1><a href=""> Forecastings </h1>
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
			<h3>Hasil Forecasting</h3>
			<div class="box">
				<h4>Menghitung Nilai X, X^2, XY</h4><br>
				<table border="1" cellspacing="0" class="table">
					<thead>
						<tr>
							<th> No </th>
							<th> Tanggal </th>
							<th> Harga Emas (Y) </th>
							<th> X </th>
							<th> X^2 </th>
							<th> XY </th>
						</tr>
					</thead>
					<tbody style="text-align: center;">
					<?php
						$total_x = 0;
						$total_xx = 0;
						$total_xy = 0;
						$total_y = 0;
						$x = -1;
						$no = 0;
						$query = mysqli_query ($conn, "SELECT * FROM harga_emas");
						$n = mysqli_num_rows($query);
						while ($data = mysqli_fetch_array($query)) {
							$x++;							
							$no++;
							$tanggal = $data['tanggal'];
							$harga   = $data['harga'];
							$xx 	 = $x * $x;
							$xy  	 = $x * $harga;
							$total_x = $total_x + $x;
							$total_y = $total_y + $harga;
							$total_xx = $total_xx + $xx;
							$total_xy = $total_xy + $xy;
					?>

						<tr>
							<td><?php echo $no; ?></td>
							<td><?php echo $tanggal; ?></td>
							<td>Rp. <?php echo number_format($harga);?></td>
							<td><?php echo $x; ?></td>
							<td><?php echo $xx; ?></td>
							<td><?php echo $xy; ?></td>
					</tr>

					<?php
						}
					?>

						<tr>
							<td colspan="2">Jumlah</td>
							<td><?php echo $total_y; ?></td>
							<td><?php echo $total_x; ?></td>
							<td><?php echo $total_xx; ?></td>
							<td><?php echo $total_xy; ?></td>
						</tr>			        
					</tbody>
				</table>

				<br><hr><br>

				<h4> Menghitung Nilai A dan B </h4>

				<?php
					echo "Nilai A = (($total_y*$total_xx)-($total_x*$total_xy))/(($n*$total_xx)-($total_x**2)) <br>";
					$nilai_a = (($total_y*$total_xx)-($total_x*$total_xy))/(($n*$total_xx)-($total_x**2));
					echo "Nilai A = ".$nilai_a."<br><br>";

					echo "Nilai B = (($n*$total_xy)-($total_x*$total_y))/(($n*$total_xx)-($total_x**2)) <br>";
					$nilai_b = (($n*$total_xy)-($total_x*$total_y))/(($n*$total_xx)-($total_x**2));
					echo "Nilai B = ".$nilai_b."<br><br>";

					echo "Ŷ = A + BX <br>";
					echo "Ŷ = ".$nilai_a." + ".$nilai_b."*X <br>";
				?>

				<br><hr><br>

				<h4> Menghitung Nilai Forecasting, Error, MSE, dan MAPE </h4><br>
				<table border="1" cellspacing="0" class="table">
					<thead>
						<tr>
							<th> No </th>
							<th> Tanggal </th>
							<th> Harga Emas (Y) </th>
							<th> X </th>
							<th> Forecasting (Ŷ)</th>
							<th> Error </th>
							<th> MSE </th>
							<th> MAPE </th>
						</tr>
					</thead>
					<tbody style="text-align: center;">
					<?php
						$x = -1;
						$no = 0;
						$total_forecast = 0;
						$total_eror = 0;
						$total_mape = 0;
						$total_mse = 0;
						$query1 = mysqli_query ($conn, "SELECT * FROM harga_emas");
						$n = mysqli_num_rows($query1);
						while ($data1 = mysqli_fetch_array($query1)) {
							$x++;
							$no++;
							$tanggal = $data1['tanggal'];
							$harga   = $data1['harga'];
							$ttl_forecast = $nilai_a + ($x*$nilai_b);
							$total_forecast = $total_forecast + $ttl_forecast;
							$ttl_eror = $harga - $ttl_forecast;
							$total_eror = $total_eror + $ttl_eror;
							$ttl_mse = $ttl_eror**2;
							$total_mse = $total_mse + $ttl_mse;
							$ttl_mape = abs($harga-$ttl_forecast)/$harga;
							$total_mape = $total_mape + $ttl_mape;
							$array_perkiraan[] = $ttl_forecast;
					?>

						<tr>
							<td><?php echo $no; ?></td>
							<td><?php echo $tanggal; ?></td>
							<td>Rp. <?php echo number_format($harga);?></td>
							<td><?php echo $x; ?></td>
							<?php 
								$forecasting = $nilai_a + ($x*$nilai_b);
								$eror = $harga-$forecasting;
								$mse = $eror**2;
								$mape = abs($harga-$forecasting)/$harga;
								?>
							<td><?php echo round($forecasting,2); ?></td>
							<td><?php echo $eror; ?></td>
							<td><?php echo round($mse,4); ?></td>
							<td><?php echo round($mape,4); ?></td>
					</tr>

					<?php
						}
					?>

						<tr>
							<td colspan="2">Jumlah</td>
							<td><?php echo $total_y; ?></td>
							<td><?php echo $total_x; ?></td>
							<td></td>
							<td></td>
							<td><?=round($total_mse,4)?></td>
							<td><?=round($total_mape,4)?></td>
						</tr>			        
					</tbody>
				</table>

				<?php 
					$mse_akhir = $total_mse/$n;
					$mape_akhir = $total_mape*100/$n;
				?>
				Nilai MSE dari Forecasting data diatas adalah <?=round($mse_akhir,4)?> <br>
				Nilai MAPE dari Forecasting data diatas adalah <?=round($mape_akhir,4)?> <br>

				<br><hr><br>
				<h4> Grafik Data Aktual dan Forecasting </h4><br>
				<iframe src="linechart.php" width="100%" height="500"></iframe>

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