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

if (isset($_POST['tambah'])) {
    $saldo_tambahan = $_POST['saldo_tambahan'];
    $id = $_SESSION['id_user']; 

    // Memeriksa apakah saldo tambahan yang dimasukkan lebih dari 0
    if ($saldo_tambahan > 0) {
        $queryTambahSaldo = "UPDATE user SET saldo = saldo + '$saldo_tambahan' WHERE id_user = '$id'";
        $resultTambahSaldo = mysqli_query($koneksi, $queryTambahSaldo);

        // Memeriksa apakah query berhasil dieksekusi
        if ($resultTambahSaldo) {
            echo "<script>alert('Berhasil topup saldo')</script>";
            // header("Location: saldo.php");
        } else {
            echo "Gagal menambahkan saldo: " . mysqli_error($koneksi);
        }
    } else {
        echo "<script>alert('Masukkan saldo dengan benar')</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pelayaran</title>
    <?php include 'navbaruser.php'; ?>
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
            max-width: 800px; /* Sesuaikan lebar card sesuai kebutuhan */
            margin: auto; /* Memastikan card berada di tengah halaman */
        }

        .card-header {
            background-color: #526D82;
            color: #fff;
            border-bottom: none;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            text-align: center;
            padding: 15px 0;
        }

        .card-body {
            background-color: #f8f9fa;
            border-radius: 0 0 10px 10px;
            padding: 20px;
        }

        .form-control {
            border-radius: 5px;
        }

        .btn {
            border-radius: 20px;
            font-size: 16px;
            padding: 10px 20px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <br><br><br>
    <section class="hero" id="hero">
        <div class="hero-content">
            <div class="container mt-5">
                <div class="card">
                    <div class="card-header">
                        <h3>Informasi Saldo</h3>
                    </div>
                    <div class="card-body">
                        <div class="user-info">
                            <?php
                            // Ambil informasi user
                            $id = $_SESSION['id_user'];
                            $queryInfoUser = "SELECT saldo FROM user WHERE id_user = '$id'";
                            $resultInfoUser = mysqli_query($koneksi, $queryInfoUser);
                            $dataUser = mysqli_fetch_assoc($resultInfoUser);
                            ?>
                            <h5 class="card-title">Saldo anda: <?php echo $dataUser['saldo']; ?></h5>
                            <form method="POST">
                                <div class="mb-3">
                                    <br>
                                    <label for="saldo_tambahan" class="form-label">Tambah Saldo</label>
                                    <input type="number" class="form-control" id="saldo_tambahan" name="saldo_tambahan" placeholder="Masukkan saldo yang ingin ditambahkan" required>
                                </div>
                                <a href="utama.php" type="submit" class="btn btn-danger">Kembali</a>
                                <button type="submit" class="btn btn-success" name="tambah">Tambah saldo</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>
