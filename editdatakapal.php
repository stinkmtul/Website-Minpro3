<?php include 'koneksi.php';

session_start();

if ($_SESSION['level'] == "") {
	header("location:index.php");
} 
elseif ($_SESSION['level'] != 'admin'){
	echo "<script>
	window.location.href = 'index.php';
	alert('Anda tidak memiliki akses untuk masuk kehalaman ini');
	</script>";
}

if (isset($_POST['ubah'])) {
	$id_kapal = $_POST['id_kapal'];
	$rute= $_POST['rute'];
	$plb_asal = $_POST['plb_asal'];
	$plb_tujuan= $_POST['plb_tujuan'];
	$tgl_brgkt= $_POST['tgl_brgkt'];
	$waktu_brgkt = $_POST['waktu_brgkt'];
	$estimasi = $_POST['estimasi'];
	$kapasitas = $_POST['kapasitas'];
	$harga = $_POST['harga'];

	$sqlUpdate = mysqli_query($koneksi, "UPDATE kapal SET rute = '$rute',  plb_asal = '$plb_asal', plb_tujuan = '$plb_tujuan', tgl_brgkt = '$tgl_brgkt', waktu_brgkt = '$waktu_brgkt', estimasi = '$estimasi', kapasitas = '$kapasitas', harga = '$harga' WHERE id_kapal = '$id_kapal'");

	if($sqlUpdate) {
		echo "<script>
		window.location.href = 'keloladatakapal.php';
		alert('Data berhasil diubah');
		</script>";
	} 
	else {
		echo "<script>alert('Ubah data gagal!')</script>";
	}
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Pelayaran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
	<style>
        .container {
            margin-top: 50px;
        }
        h3 {
            margin-bottom: 20px;
            text-align: center;
        }
        form {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
        }
        .btn-container {
            display: flex;
            justify-content: center;
        }
        .btn-container button {
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <?php include 'navbar.php' ?>
	<br><br>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <b>Data Kapal</b>
                    </div>
                    <?php
                    $id = $_GET['id'];
                    $sqlTampil = mysqli_query($koneksi, "SELECT * FROM kapal WHERE id_kapal = '$id'");
                    $dataTampil = mysqli_fetch_array($sqlTampil);
                    ?>
                    <div class="card-body">
					<form action="" method="post">
							<div class="row mb-3">
								<label class="form-label"><b>ID Kapal</b></label>
								<input type="text" value="<?php echo $dataTampil['id_kapal'] ?>" readonly class="form-control" name="id_kapal" autocomplete="off" placeholder="ID Kapal" required>
							</div>
						<div class="row mb-3">
							<div class="col-md-6">
								<label class="form-label"><b>Rute Kapal</b></label>
								<input type="text" value="<?php echo $dataTampil['rute'] ?>" class="form-control" name="rute" autocomplete="off" placeholder="Rute Kapal" required>
							</div>
							<div class="col-md-6">
								<label class="form-label"><b>Pelabuhan Asal</b></label>
								<input type="text" value="<?php echo $dataTampil['plb_asal'] ?>" class="form-control" name="plb_asal" autocomplete="off" placeholder="Pelabuhan Asal" required>
							</div>
						</div>
						<div class="row mb-3">
							<div class="col-md-6">
								<label class="form-label"><b>Pelabuhan Tujuan</b></label>
								<input type="text" value="<?php echo $dataTampil['plb_tujuan'] ?>" class="form-control"  name="plb_tujuan" autocomplete="off" placeholder="Pelabuhan Tujuan" required>
							</div>
							<div class="col-md-6">
								<label class="form-label"><b>Tanggal Keberangkatan</b></label>
								<input type="date" value="<?php echo $dataTampil['tgl_brgkt'] ?>" class="form-control"  name="tgl_brgkt" autocomplete="off" placeholder="Tanggal Keberangkatan" required>
							</div>
						</div>
						<div class="row mb-3">
							<div class="col-md-6">
								<label class="form-label"><b>Waktu Keberangkatan</b></label>
								<input type="time" value="<?php echo $dataTampil['waktu_brgkt'] ?>" class="form-control"  name="waktu_brgkt" autocomplete="off" placeholder="Waktu Keberangkatan" required>
							</div>
							<div class="col-md-6">
								<label class="form-label"><b>Estimasi</b></label>
								<input type="text" value="<?php echo $dataTampil['estimasi'] ?>" class="form-control"  name="estimasi" autocomplete="off" placeholder="Estimasi Perjalanan" required>
							</div>
						</div>
						<div class="row mb-3">
							<div class="col-md-6">
								<label class="form-label"><b>Kapasitas Penumpang</b></label>
								<input type="text" value="<?php echo $dataTampil['kapasitas'] ?>" class="form-control"  name="kapasitas" autocomplete="off" placeholder="Kapasitas Penumpang" required>
							</div>
							<div class="col-md-6">
								<label class="form-label"><b>Harga</b></label>
								<input type="int" value="<?php echo $dataTampil['harga'] ?>" class="form-control"  name="harga" autocomplete="off" placeholder="Harga Tiket" required>
							</div>
						</div>
						<div class="row mb-3">
							<div class="col-md-12 text-center">
								<button type="submit" class="btn btn-success" name="ubah">Ubah</button>
								<a href="keloladatakapal.php" class="btn btn-danger">Batal</a>
							</div>
						</div>
					</form>

                    </div>
                    <div class="card-footer">
                        <center>
                            <p class="card-text">
                                <small class="text-muted">@<?php echo date("Y"); ?></small>
                            </p>
                        </center>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
