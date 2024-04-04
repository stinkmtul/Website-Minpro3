<?php include 'koneksi.php';
session_start();
if ($_SESSION['level'] == "") {
	header("location:login.php");
} 
elseif ($_SESSION['level'] != 'admin'){
	echo "<script>
	window.location.href = 'login.php';
	alert('Anda tidak memiliki akses untuk masuk kehalaman ini');
	</script>";
}

if (isset($_POST['simpan'])) {
	$id_kapal = $_POST['id_kapal'];
	$rute= $_POST['rute'];
	$plb_asal = $_POST['plb_asal'];
	$plb_tujuan= $_POST['plb_tujuan'];
	$tgl_brgkt= $_POST['tgl_brgkt'];
	$waktu_brgkt = $_POST['waktu_brgkt'];
	$estimasi = $_POST['estimasi'];
	$kapasitas = $_POST['kapasitas'];
	$harga = $_POST['harga'];

	$sqlInsert = mysqli_query($koneksi, "INSERT INTO kapal (id_kapal, rute, plb_asal, plb_tujuan, tgl_brgkt, waktu_brgkt, estimasi, kapasitas, harga) VALUES ('$id_kapal', '$rute', '$plb_asal', '$plb_tujuan', '$tgl_brgkt', '$waktu_brgkt', '$estimasi', '$kapasitas', '$harga')");

	if ($sqlInsert) {
		echo "<script>
		window.location.href = 'keloladatakapal.php';
		alert('Berhasil menambahkan data');
		</script>";
	}
	else {
		echo "<script>alert('Gagal Menambahkan data')</script>";
	}
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Pelayaran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
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
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <b>Data Kapal</b>
                    </div>
                    <div class="card-body">
                        <form action="" method="post">
                            <div class="mb-3">
                                <?php 

                                $query = mysqli_query($koneksi, "SELECT max(id_kapal) as kodeTerbesar FROM kapal");
                                $data = mysqli_fetch_array($query);
                                $kode = $data['kodeTerbesar'];

                                $urutan = (int) substr($kode, 3, 3);
                                $urutan++;

                                $huruf = "KP";
                                $kode = $huruf . sprintf("%03s", $urutan);
                                ?>
                                <label class="form-label"><b>ID Kapal</b></label>
                                <input type="text" readonly class="form-control" name="id_kapal" autocomplete="off" placeholder="id kapal" value="<?php echo $kode; ?>" required>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label"><b>Rute Kapal</b></label>
                                    <input type="text" class="form-control" name="rute" autocomplete="off" placeholder="rute" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label"><b>Pelabuhan Asal</b></label>
                                    <input type="text" class="form-control" name="plb_asal" autocomplete="off" placeholder="masukan pelabuhan asal" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label"><b>Pelabuhan Tujuan</b></label>
                                    <input type="text" class="form-control" name="plb_tujuan" autocomplete="off" placeholder="masukan Pelabuhan tujuan" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label"><b>Tanggal Keberangkatan</b></label>
                                    <input type="date" class="form-control" name="tgl_brgkt" autocomplete="off" placeholder="masukan tgl" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label"><b>Waktu Keberangkatan</b></label>
                                    <input type="time" class="form-control" name="waktu_brgkt" autocomplete="off" placeholder="masukan waktu keberangkatan" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label"><b>Estimasi</b></label>
                                    <input type="text" class="form-control" name="estimasi" autocomplete="off" placeholder="masukan estimasi perjalanan" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label"><b>Kapasitas Penumpang</b></label>
                                    <input type="number" class="form-control" name="kapasitas" autocomplete="off" placeholder="masukan batas kapasitas penumpang" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label"><b>Harga</b></label>
                                    <input type="number" class="form-control" name="harga" autocomplete="off" placeholder="masukan harga tiket" required>
                                </div>
                            </div>
                            <div class="btn-container">
                                <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
                                <a href="keloladatakapal.php" class="btn btn-danger">Batal</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
