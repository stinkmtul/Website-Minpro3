<?php 
include 'koneksi.php';
session_start();
if ($_SESSION['level'] == "") {
	header("location:login.php");
} 
elseif ($_SESSION['level'] != 'user'){
	echo "<script>
	window.location.href = 'login.php';
	alert('Anda tidak memiliki akses untuk masuk kehalaman ini');
	</script>";
}

if (isset($_POST['simpan'])) {
    $id_tiket = $_POST['id_tiket'];
    $id_user = $_SESSION['id_user'];
    $id_kapal = $_POST['id_kapal'];
    $jumlah = $_POST['jumlah'];
    $total_harga = $_POST['total_harga'];
    $status = $_POST['status'];
    $waktu_byr = $_POST['waktu_byr'];

    // Ambil kapasitas kapal
    $sql = mysqli_query($koneksi, "SELECT kapasitas FROM kapal WHERE id_kapal = '$id_kapal'");
    $data = mysqli_fetch_assoc($sql);

    if ($jumlah <= $data['kapasitas']) {
        // Ambil saldo user
        $query = mysqli_query($koneksi, "SELECT saldo FROM user WHERE id_user = '$id_user'");
        $saldo_data = mysqli_fetch_assoc($query);
        $saldo_user = $saldo_data['saldo'];

        if ($saldo_user >= $total_harga) {
            // Update tabel tiket
            $sqlInsert = mysqli_query($koneksi, "INSERT INTO tiket (id_tiket, id_user, id_kapal, jumlah, total_harga, status, waktu_byr) VALUES ('$id_tiket', '$id_user', '$id_kapal', '$jumlah', '$total_harga','$status', '$waktu_byr')");
            // Update kapasitas kapal
            $sqlUpdateKapal = mysqli_query($koneksi, "UPDATE kapal SET kapasitas = kapasitas - $jumlah WHERE id_kapal = '$id_kapal'");
            // Update saldo user
            $sqlUpdateUser = mysqli_query($koneksi, "UPDATE user SET saldo = saldo - $total_harga WHERE id_user = '$id_user'");

            if ($sqlInsert && $sqlUpdateKapal && $sqlUpdateUser) {
                echo "<script>
                window.location.href = 'riwayat.php';
                alert('Berhasil memesan tiket');
                </script>";
            } else {
                echo "<script>alert('Gagal memesan tiket')</script>";
            }
        } else {
            echo "<script>alert('Saldo anda tidak mencukupi, silahkan lakukan top up saldo terlebih dahulu')</script>";
        }
    } else {
        echo "<script>alert('Jumlah tiket yang anda masukkan melebihi stok yang tersedia')</script>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Pelayaran</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        .container {
            margin-top: 70px;
        }

        .card {
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            text-align: center;
            background-color: #526D82 !important;
            color: #fff;
            border-bottom: none;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }
        
        .card-body {
            background-color: #f8f9fa;
            border-radius: 0 0 10px 10px;
        }

        .card-footer {
            background-color: #f8f9fa;
            border-radius: 0 0 10px 10px;
        }

        .form-control {
            border-radius: 5px;
        }

        .btn-container {
            display: flex;
            justify-content: center;
        }

        .btn {
            border-radius: 20px;
            font-size: 16px;
            padding: 10px 20px;
            margin: 10px;
        }

        .card-body form {
            padding: 20px 40px;
        }

        .mb-3 {
            margin-bottom: 15px;
        }

        #btn-fix {
            text-align: center;
            margin-top: 20px;
        }

        #btn-fix .btn {
            border-radius: 30px; /* Make the buttons pill-shaped */
            font-size: 16px; /* Increase font size */
            padding: 10px 20px; /* Add padding to the buttons */
            margin-left: 5px; /* Add some space between buttons */
        }

    </style>
</head>
<body>
    <?php include 'navbaruser.php'; ?>
    <br>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <b>Pemesanan</b>
                    </div>
                    <?php
                    // Ambil ID kapal dari URL
                    $id_kapal = isset($_GET['id']) ? mysqli_real_escape_string($koneksi, $_GET['id']) : '';
                    $sqlTampil = mysqli_query($koneksi, "SELECT harga FROM kapal WHERE id_kapal = '$id_kapal'");
                    $dataTampil = mysqli_fetch_array($sqlTampil);

                    $id_user= $_SESSION['id_user'];
                    $sqlTampil2 =  mysqli_query($koneksi, "SELECT nama FROM user WHERE id_user= '$id_user'");
                    $dataTampil2 = mysqli_fetch_array($sqlTampil2);
                    ?>
                    <div class="card-body">
                        <form action="" method="post">
                            <div class="mb-3">
                                <?php 
                                $query = mysqli_query($koneksi, "SELECT max(id_tiket) as kodeTerbesar FROM tiket");
                                $data = mysqli_fetch_array($query);
                                $kode = $data['kodeTerbesar'];
                                $urutan = (int) substr($kode, 3, 3);
                                $urutan++;
                                $huruf = "TX";
                                $kode = $huruf . sprintf("%03s", $urutan);
                                ?>
                                <input type="text" hidden readonly class="form-control" name="id_tiket" autocomplete="off" placeholder="ID Tiket" value="<?php echo $kode; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label"><b>Nama Pemesan</b></label>
                                <input type="text" readonly value="<?php echo $dataTampil2['nama'] ?>" class="form-control" name="id_user" autocomplete="off" placeholder="ID User" required>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label"><b>ID Kapal</b></label>
                                    <input type="text" value="<?php echo $id_kapal ?>" readonly class="form-control" name="id_kapal" autocomplete="off" placeholder="ID Kapal" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label"><b>Harga Tiket</b></label>
                                    <input type="number" readonly value="<?php echo $dataTampil['harga'] ?>" class="form-control" id="harga" name="harga" autocomplete="off" placeholder="Harga Tiket" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label"><b>Jumlah Tiket</b></label>
                                <input type="number" class="form-control" id="jumlah" name="jumlah" autocomplete="off" placeholder="Jumlah Tiket" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label"><b>Total Harga</b></label>
                                <input type="number" readonly class="form-control" id="total_harga" name="total_harga" autocomplete="off" placeholder="Total Harga" required>
                            </div>
                            <?php 
                                if(isset($_SESSION['level']) && isset($_SESSION['id_user'])) {
                                // Lakukan query ke database untuk mengambil saldo pengguna
                                $id_user = $_SESSION['id_user'];
                                $query = "SELECT saldo FROM user WHERE id_user = '$id_user'";
                                $result = mysqli_query($koneksi, $query);
                                
                                // Ambil saldo dari hasil query
                                $row = mysqli_fetch_assoc($result);
                                $saldo = $row['saldo'];
                            }
                            ?>
                            <div class="mb-3">
                                <label class="form-label"><b>Metode Pembayaran</b></label>
                                <input type="text" readonly value="saldo - <?php echo $saldo ?>" class="form-control" name="metode_byr" autocomplete="off" placeholder="Metode Pembayaran" required>
                            </div>
                            <div class="mb-3">
                                <input type="hidden" value="Berhasil" class="form-control" name="status" autocomplete="off" placeholder="Status" required>
                            </div>
                            <div class="mb-3">
                                <input type="hidden" value="<?php echo date("Y-m-d"); ?>" class="form-control" name="waktu_byr" autocomplete="off" placeholder="Waktu Pembayaran" required>
                            </div>
                            <div id="btn-fix">
                                <center>
                                    <a href="lihatdetail.php?id=<?php echo $id_kapal; ?>" class="btn btn-danger">Kembali ke Detail Kapal</a>
                                    <button type="submit" class="btn btn-primary" name="simpan">Bayar</button>
                                </center>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="crossorigin="anonymous"></script>
    <script type="text/javascript">
        $("#harga, #jumlah").keyup(function() {
            var a = parseInt($("#harga").val());
            var b = parseInt($("#jumlah").val());
            var c = a * b;
            $("#total_harga").val(c);
        });
    </script>
</body>
</html>