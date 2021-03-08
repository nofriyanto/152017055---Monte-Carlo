<html>
	<head>
	<meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp"
    crossorigin="anonymous">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB"
    crossorigin="anonymous">
  <link rel="stylesheet" href="css/style.css">
  <title>SIMULASI | MC</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="css/style.css">
	  	<link rel="stylesheet" href="css/bootstrap.min.css">
	  	<link rel="stylesheet" href="css/font-awesome.min.css">
		<link rel="icon" href="img/favicon.ico">
	  	<script src="js/jquery.min.js"></script>
	  	<script src="js/bootstrap.min.js"></script>
	</head>
	<body>
	<nav class="navbar navbar-expand-sm navbar-dark bg-dark">
    <div class="container">
      <a href="index.html" class="navbar-brand">Tugas 3 Pemrograman Simulasi - Monte Carlo</a>
      <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav ml-auto">

          <li class="nav-item active">
            <a href="prediksi_permintaan.php" class="nav-link">Simulasi Monte Carlo</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
	<div class="container">

		<?php
			$jmlRandom = $_POST['jmlRandom'];
			$x0 = $_POST['x0'];
			$a = $_POST['a'];
			$c = $_POST['c'];
			$m = $_POST['m'];
			$biaya = $_POST['biaya'];
			$penjualan = $_POST['penjualan'];
			$angka_random = [];
			$hasil = [];
			$hasil[0] = $x0;
			$pangkat = $_POST['pangkat'];
			$amount = $_POST['amount'];
			$lowestInterval = $_POST['lowestInterval'];
			$dem = $_POST['demand'];
			$demand = unserialize(base64_decode($dem));
			$botInt = $_POST['botInterval'];
			$botInterval = unserialize(base64_decode($botInt));
			$topInt = $_POST['topInterval'];
			$topInterval = unserialize(base64_decode($topInt));
			$demandResult;
		?>
		<div class="panel panel-default">
			<div class="panel-heading">Hasil Perhitungan</div>
			<div class="panel-body">
				<div class="input-group">
				  <h1 class="font-weight-bold justify-content-center" style="font-size: 40px;">HASIL AKHIR</h1>
				  <!-- <p><center>Bilangan acak didapatkan dari metode RNG distribusi uniform</center></p> -->
				  <div class="table table-responsive">
					<table class="table table-hover custom-table-header">
						  <tr>
							  <th>Hari</th>
							  <th>Bilangan Acak</th>
							  <th>Permintaan</th>
						  </tr>
						<?php for($i=0; $i<$jmlRandom; $i++): ?>
						  <tr>
							  <td> <?php
									echo $i+1; ?>
							  </td>
							  <td>
								<?php
									//proses random dengan metode LCM
									$hasil[$i+1] = ($a*$hasil[$i] + $c) % $m;

									$angka_random[$i] = round($hasil[$i+1]/$m, 5);
									// $rBot[$i] = $lowestInterval * $pangkat;
									// $rTop[$i] = $topInterval[$amount-1] * $pangkat;
									//
									// $random[$i] = rand($rBot[$i], $rTop[$i]);
									//
									// $randomDec[$i] = $random[$i]/$pangkat;
									echo $angka_random[$i]."<br>";
									//echo $randomDec[$i] = 0.86;
								?>
							  </td>
							  <td>
								<?php
									for($j=0;$j<$amount;$j++){
										if($angka_random[$i] >= $botInterval[$j] && $angka_random[$i] <= $topInterval[$j]){
											$demandResult[$i] = $demand[$j];
											echo $demandResult[$i];
										}
									}
								?>
							  </td>
						  </tr>
						<?php endfor; ?>
					</table>
					<?php
						$total=0;
						for($i=0; $i<$jmlRandom; $i++):
							$total=$total+$demandResult[$i];
						endfor;

						$average = $total / $jmlRandom;
					?>
					<h4><center>Rata-rata jumlah permintaan: <b><?php echo $average; ?></b></center></h4><br/>
					<center>
					<form action="hitung_keuntungan.php" method="post">
						<table>
							<input type="hidden" value="<?php echo print base64_encode(serialize($demand)); ?>" name="demand">
							<input type="hidden" value="<?php echo print base64_encode(serialize($demandResult)); ?>" name="demandRes">
							<input type="hidden" value="<?php echo $amount; ?>" name="banyak">
							<input type="hidden" value="<?php echo $penjualan; ?>" name="penjualan">
							<input type="hidden" value="<?php echo $biaya; ?>" name="biaya">
							<input type="hidden" value="<?php echo $demandResult; ?>" name="demandResult">
							<input type="hidden" value="<?php echo $jmlRandom; ?>" name="jmlRandom">
							<tr>
								<td><input type="submit" class="btn btn-dark" value="Prediksi Keuntungan" style="padding-left: 30px; padding-right: 30px;"></td>
							</tr>
						</table>
					</form>
					</center><br/>
					<center><a href="prediksi_permintaan.php">Kembali Ke Awal</a></center>
				  </div>
				</div>
			</div>
		</div>
	</div>
	</body>
</html>