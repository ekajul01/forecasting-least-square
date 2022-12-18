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
	<title> Forecasting </title>
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
	<?php
		$total_x = 0;
		$total_xx = 0;
		$total_xy = 0;
		$total_y = 0;
		$x = -1;
		$query = mysqli_query ($conn, "SELECT * FROM harga_emas");
		$n = mysqli_num_rows($query);
		while ($data = mysqli_fetch_array($query)) {
			$x++;
			$no 	 = $data['id'];
			$tanggal = $data['tanggal'];
			$harga   = $data['harga'];
			$xx 	 = $x * $x;
			$xy  	 = $x * $harga;
			$total_x = $total_x + $x;
			$total_y = $total_y + $harga;
			$total_xx = $total_xx + $xx;
			$total_xy = $total_xy + $xy;
		}

		$nilai_a = (($total_y*$total_xx)-($total_x*$total_xy))/(($n*$total_xx)-($total_x**2));
		$nilai_b = (($n*$total_xy)-($total_x*$total_y))/(($n*$total_xx)-($total_x**2));

	?>

	<!-- content -->
	<div class="section">
		<div class="container">
			<h3>Forecasting Harga Emas 10 Hari Ke Depan</h3>
			<div class="box">
				<table border="1" cellspacing="0" class="table">
					<thead>
						<tr>
							<th> No </th>
							<th> Tanggal </th>
							<th> X </th>
							<th> Forecasting (Ŷ)</th>
						</tr>
					</thead>
					<tbody style="text-align: center;">
					<?php
						$x = -1;
						$tgl = 1;
						$no = 0;
						$query0 = mysqli_query ($conn, "SELECT * FROM harga_emas ORDER BY id DESC LIMIT 1");
						$tampil = mysqli_fetch_array($query0);
						$simpan1 = $tampil['tanggal'];

						$tanggal1 = substr($simpan1,0,2);	                
		                $bln = substr($simpan1,3,3);
						$tahun = substr($simpan1,7,4);

						if ($bln == 'Jan') {
							$bulan = 01;
						}elseif ($bln == 'Feb') {
							$bulan = 02;
						}elseif ($bln == 'Mar') {
							$bulan = 03;
						}elseif ($bln == 'Apr') {
							$bulan = 04;
						}elseif ($bln == 'Mei') {
							$bulan = 05;
						}elseif ($bln == 'Jun') {
							$bulan = 06;
						}elseif ($bln == 'Jul') {
							$bulan = 07;
						}elseif ($bln == 'Ags') {
							$bulan = 8;
						}elseif ($bln == 'Sep') {
							$bulan = 9;
						}elseif ($bln == 'Okt') {
							$bulan = 10;
						}elseif ($bln == 'Nov') {
							$bulan = 11;
						}else {
							$bulan = 12;
						}

						$tampiltgl = $tahun."-".$bulan."-".$tanggal1;

						$tgl2 = date('Y-m-d', strtotime('+1 days', strtotime($tampiltgl))); 
						$query1 = mysqli_query ($conn, "SELECT * FROM harga_emas");
						$n = mysqli_num_rows($query1);
						while ($no < 10) {
							$no++;
							$x++;
							$xbaru = $n - 1 + $no;
							$forecast= $nilai_a + ($xbaru*$nilai_b);
					?>

						<tr>
							<td><?php echo $no; ?></td>

							<?php
								$tahunx = substr($tgl2,0,4);
								$blnx = substr($tgl2,5,2);
								$tanggalx = substr($tgl2,8,2);

								if ($blnx == 01) {
									$bulanx = 'Jan';
								}elseif ($blnx == 02) {
									$bulanx = 'Feb';
								}elseif ($blnx == 03) {
									$bulanx = 'Mar';
								}elseif ($blnx == 04) {
									$bulanx = 'Apr';
								}elseif ($blnx == 05) {
									$bulanx = 'Mei';
								}elseif ($blnx == 06) {
									$bulanx = 'Jun';
								}elseif ($blnx == 07) {
									$bulanx = 'Jul';
								}elseif ($blnx == 8) {
									$bulanx = 'Ags';
								}elseif ($blnx == 9) {
									$bulanx = 'Sep';
								}elseif ($blnx == 10) {
									$bulanx = 'Okt';
								}elseif ($blnx == 11) {
									$bulanx = 'Nov';
								}else {
									$bulanx = 'Des';
								}

								$tgl2x = $tanggalx." ".$bulanx." ".$tahunx;
							?>

							<td><?php echo $tgl2x; ?></td>
							<td><?php echo $xbaru; ?></td>
							<td><?php echo $forecast; ?></td>
					</tr>

					<?php
						$tgl2++;
						}
					?>		        
					</tbody>
				</table>

				<hr><br>

				<form method="post" action="">
					Peramalan <input type="number" name="hari" min="1" class="input-control-2"> hari ke depan
				<button type="submit" name="hitung" class="hitung"> Hitung </button>	
				</form>

				<?php 
					if(isset($_POST['hitung'])){
						$hari = $_POST['hari'];
						$xbaru = $n - 1 + $hari;
						$forecastbaru = $nilai_a + ($xbaru*$nilai_b);
						echo "forecasting $hari hari ke depan adalah Rp.".number_format($forecastbaru);
					}
				?>
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