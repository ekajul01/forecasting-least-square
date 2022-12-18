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
	<title> Tambah Data Aktual </title>
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
			<h3>Tambah Data</h3>
			<div class="box">
				<form method="post" action="">
					<p style="margin-bottom: 5px;">Tanggal</p>
					<input type="date" name="tgl" class="input-control" required>
					
					<p style="margin-bottom: 5px;">Harga</p>
					<input type="text" name="harga" class="input-control" requaired><br>

					<button type="submit" name="tambah" class="tambah">Tambah Data</button>
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
			if(isset($_POST['tambah'])){
				$tgl = $_POST['tgl'];
				$hrg = $_POST['harga'];

				$tahun = substr($tgl,0,4);
				$bln = substr($tgl,5,2);
				$tanggal = substr($tgl,8,2);

				if ($bln == 01) {
					$bulan = 'Jan';
				}elseif ($bln == 02) {
					$bulan = 'Feb';
				}elseif ($bln == 03) {
					$bulan = 'Mar';
				}elseif ($bln == 04) {
					$bulan = 'Apr';
				}elseif ($bln == 05) {
					$bulan = 'Mei';
				}elseif ($bln == 06) {
					$bulan = 'Jun';
				}elseif ($bln == 07) {
					$bulan = 'Jul';
				}elseif ($bln == 8) {
					$bulan = 'Ags';
				}elseif ($bln == 9) {
					$bulan = 'Sep';
				}elseif ($bln == 10) {
					$bulan = 'Okt';
				}elseif ($bln == 11) {
					$bulan = 'Nov';
				}else {
					$bulan = 'Des';
				}

				$inptgl = $tanggal." ".$bulan." ".$tahun;

				$tambah = mysqli_query($conn, "INSERT INTO harga_emas
                            VALUES('', '$inptgl', '$hrg')");

                if($tambah){
                    echo "
                        <script>
                            alert('data berhasil ditambahkan!');
                            document.location.href = 'data-aktual.php';
                        </script>
                    ";

                }else{
                    echo "
                        <script>
                            alert('data gagal ditambahkan!');
                            document.location.href = 'data-aktual.php';
                        </script>
                    ";
                }

			}
		?>