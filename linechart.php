<?php
require "function.php";
date_default_timezone_set('Asia/Jakarta');
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Chartjs, PHP dan MySQL Demo Grafik Garis</title>
    <script src="js/Chart.js"></script>
    <style type="text/css">
            .container {
                width: 40%;
                margin: 15px auto;
            }
    </style>
  </head>
  <body>
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
        $no    = $data['id'];
        $tanggal = $data['tanggal'];
        $harga   = $data['harga'];
        $xx    = $x * $x;
        $xy    = $x * $harga;
        $total_x = $total_x + $x;
        $total_y = $total_y + $harga;
        $total_xx = $total_xx + $xx;
        $total_xy = $total_xy + $xy;
      }

      $nilai_a = (($total_y*$total_xx)-($total_x*$total_xy))/(($n*$total_xx)-($total_x**2));
      $nilai_b = (($n*$total_xy)-($total_x*$total_y))/(($n*$total_xx)-($total_x**2));
      $x1 = -1;
            $query1 = mysqli_query ($conn, "SELECT * FROM harga_emas");
            $n = mysqli_num_rows($query1);
            while ($data1 = mysqli_fetch_array($query1)) {
              $x1++;
              $harga   = $data1['harga'];
              $ttl_forecast = $nilai_a + ($x1*$nilai_b);
              $array_perkiraan[] = $ttl_forecast;
            }

    ?>

    <div class="container">
        <canvas id="linechart" width="300" height="300"></canvas>
    </div>

  </body>
</html>

<script  type="text/javascript">
  var ctx = document.getElementById("linechart").getContext("2d");
  var data = {
            labels: [ <?php 
                        $query = mysqli_query($conn, "SELECT tanggal FROM harga_emas");
                        while($tgl = mysqli_fetch_array($query)){
                          echo "\"$tgl[tanggal]\", ";;
                        }
                      ?>
                    ],
            datasets: [
                  {
                    label: "Aktual",
                    fill: false,
                    lineTension: 0.1,
                    backgroundColor: "#29B0D0",
                    borderColor: "#29B0D0",
                    pointHoverBackgroundColor: "#29B0D0",
                    pointHoverBorderColor: "#29B0D0",
                    data: [<?php 
                      $aktual = mysqli_query($conn, "SELECT harga FROM harga_emas");
                      while ($data_aktual = mysqli_fetch_array($aktual)) {
                        $d_akt = $data_aktual['harga'];
                        echo $d_akt.',';
                      }
                          ?>]
                  },
                  {
                    label: "Forecasting",
                    fill: false,
                    lineTension: 0.1,
                    backgroundColor: "#2A516E",
                    borderColor: "#2A516E",
                    pointHoverBackgroundColor: "#2A516E",
                    pointHoverBorderColor: "#2A516E",
                    data: [<?php 
                      foreach ($array_perkiraan as $arper) {
                        echo "".$arper.", ";
                      }
                          ?>]
                  }
                  ]
          };

  var myBarChart = new Chart(ctx, {
            type: 'line',
            data: data,
            options: {
            legend: {
              display: true
            },
            barValueSpacing: 20,
            scales: {
              yAxes: [{
                  ticks: {
                      min: 0,
                  }
              }],
              xAxes: [{
                          gridLines: {
                              color: "rgba(0, 0, 0, 0)",
                          }
                      }]
              }
          }
        });
</script>