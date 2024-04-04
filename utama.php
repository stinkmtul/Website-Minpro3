<?php include 'koneksi.php';
session_start();
if ($_SESSION['level'] == "") {
	header("location:login.php");
} 
elseif ($_SESSION['level'] != 'user' && $_SESSION['level'] != 'admin'){
	echo "<script>
	window.location.href = 'login.php';
	alert('Anda tidak memiliki akses untuk masuk kehalaman ini');
	</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <title>Pelayaran</title>
    <?php 
      if ($_SESSION['level'] == 'admin') {
        include 'navbar.php'; // Menggunakan navbar untuk admin
      } else {
        include 'navbaruser.php'; // Menggunakan navbar untuk pengguna biasa
      }
    ?>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }
        .btn-custom {
            background-color: #27374D;
            color: #fff;
            padding: 10px 20px;
            border-radius: 30px;
            transition: background-color 0.3s ease;
        }

        .btn-custom:hover {
            background-color: #526D82;
            color: #fff;
        }

        .hero {
            padding: 100px 0;
            text-align: center;
        }

        .hero-content {
            color: #343a40;
        }

        .jumbotron {
            background-color: #fff;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        .user-info {
            position: absolute;
            top: 20px;
            right: 20px; /* Dipindahkan ke pojok kanan atas */
            background-color: rgba(255, 255, 255, 0.9);
            padding: 15px 20px;
            border-radius: 15px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
            text-align: center; /* Teks diatur ke kanan */
        }

        .user-info p {
            margin: 5px 0;
            font-size: 16px;
            color: #343a40;
        }

        .jumbotron h1 {
            color: #526D82;
            margin-bottom: 20px;
        }

        .jumbotron p {
            color: #6c757d;
            margin-bottom: 20px;
        }

        .jumbotron hr {
            background-color: #007bff;
            height: 2px;
            margin: 20px auto;
            width: 50px;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
    </style>
</head>
<body>
<section class="hero" id="hero">
    <div class="hero-content">
        <div class="container mt-5">
            <div class="jumbotron">
                <div class="user-info">
                <?php
                    if(isset($_SESSION['nama'])) {
                        echo "<p><span class='fas fa-id-card'></span> : " . $_SESSION['id_user'] . "</p>";
                        echo "<p><span class='fas fa-user'></span> : " . $_SESSION['nama'] . "</p>";
                        
                        if(isset($_SESSION['level']) && isset($_SESSION['id_user'])) {
                            // Lakukan query ke database untuk mengambil saldo pengguna
                            $id_user = $_SESSION['id_user'];
                            $query = "SELECT saldo FROM user WHERE id_user = '$id_user'";
                            $result = mysqli_query($koneksi, $query);
                            
                            // Ambil saldo dari hasil query
                            $saldo = "";
                            if ($result && $_SESSION['level'] == 'user') {
                                $row = mysqli_fetch_assoc($result);
                                $saldo = $row['saldo'];
                            }
                            
                            // Tampilkan saldo hanya jika level adalah user
                            if ($_SESSION['level'] == 'user') {
                                echo "<p><span class='fas fa-money'></span>Saldo : " . $saldo . "</p>";
                            }
                        }
                    }
                    ?>
                </div>
                <div>
                    <br><br>
                    <h1 class="display-4">Selamat Datang di Pemesanan Kapal</h1>
                    <p class="lead">Pesan kapal Anda sekarang dan nikmati perjalanan Anda!</p>
                    <hr class="my-4">
                    <br><br>
                    <p>Kami menyediakan berbagai jenis kapal untuk kebutuhan perjalanan Anda.</p>
                    <?php 
                        if ($_SESSION['level'] == 'user') {
                            echo '<a class="btn btn-custom" href="datatiket.php" role="button">Pesan Sekarang</a>';
                        } else {
                            echo '<a class="btn btn-custom" href="keloladatakapal.php" role="button">Kelola Data Kapal</a>';
                        }
                    ?>
                    <br><br>
                </div>

            </div>
        </div>
    </div>
</section>
</body>
</html>
