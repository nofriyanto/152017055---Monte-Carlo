<?php
	
	$biaya = $_POST['biaya'];
	$penjualan = $_POST['penjualan'];
	$banyak = $_POST['banyak'];
	$jmlRandom = $_POST['jmlRandom'];
	$res = $_POST['demandRes'];
	$demandRes = unserialize(base64_decode($res));
	$dem = $_POST['demand'];
	$demand = unserialize(base64_decode($dem));
	$hasilTotal = [];
	
	for($i=0; $i<$banyak; $i++) {
		$hasilTotal[$i] = 0;
	}
?>

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
		<title>Program Simulasi Monte Carlo - Kelompok 2</title>
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
	
	<div class="panel panel-default">
			<div class="panel-heading font-weight-bold">Hasil Prediksi Keuntungan</div>
			<div class="panel-body">
				<div class="input-group">
				  
				  
				  <div class="table table-responsive">
					<table class="table table-hover custom-table-header" border="0">
						  <tr>
							  <th rowspan="2">Hari</th>
							  <th>Quantity Order</th>
							<?php 
								for($i=0; $i<$banyak; $i++) {
							?><th><?php echo $demand[$i]; ?></th>
							<?php } ?>
						  </tr>
						  <tr>
							  <th>Permintaan</th>
							  <?php 
								for($i=0; $i<$banyak; $i++) {
							?><th></th>
							<?php } ?>
						  </tr>
						<?php for($i=0; $i<$jmlRandom; $i++): ?>
						  <tr>
							  <td> <?php
									echo $i+1; ?>
							  </td>
							  <td>
								<?php
									echo $demandRes[$i];
								?>
							  </td>
							  <?php
							  for($j=0; $j<$banyak; $j++){ ?>
								  <td>
									<?php 
										$result = ($demandRes[$i]*$penjualan)-($demand[$j]*$biaya);
										echo $result;
									?>
								  </td>
					   <?php } ?>
						  </tr>
						  <?php
								for($j=0; $j<$banyak; $j++) {
									for($k=0; $k<$jmlRandom; $k++):
										$hasil = ($demandRes[$k]*$penjualan)-($demand[$j]*$biaya);
										$hasilTotal[$j] += $hasil;
									endfor;
								}
							endfor; ?>
						<tr>
							<th colspan="2"><strong>Rata-rata profit</strong></th>
							<?php 
								for($i=0; $i<$banyak; $i++) {
									$avg = $hasilTotal[$i]/$jmlRandom;
							?>
									<th>
										<strong><?php echo round($avg/$jmlRandom, 2);// $hasilTotal[$i]; ?></strong>
									</th>
							<?php } ?>
						</tr>
					</table>
					<br/>
					<br/>
					<br/>
					<center><a href="prediksi_permintaan.php">Kembali Ke Awal</a></center>
				  </div>
				</div>
			</div>
		</div>
	</div>
	</body>
</html>
