<?php include 'koneksi.php';
session_start();
if ($_SESSION['level'] == "") {
	header("location:index.php");
} 
elseif ($_SESSION['level'] != 'superadmin'){
	echo "<script>
	window.location.href = 'index.php';
	alert('Anda tidak memiliki akses untuk masuk kehalaman ini');
	</script>";
}

if (isset($_POST['simpan'])) {
    $id_user = $_POST['id_user'];
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $level = $_POST['level'];

    // Cek apakah username sudah ada dalam database
    $cek_username = mysqli_query($koneksi, "SELECT * FROM user WHERE username = '$username'");
    if (mysqli_num_rows($cek_username) > 0) {
        echo "<script>alert('Username sudah digunakan. Silakan gunakan username lain.')</script>";
    } else {
        // Jika username belum ada dalam database, lanjutkan proses penyimpanan
        $sqlInsert = mysqli_query($koneksi, "INSERT INTO user (id_user, nama, username, password, level) VALUES ('$id_user', '$nama', '$username', '$password', '$level')");

        if ($sqlInsert) {
            echo "<script>
            window.location.href = 'login.php';
            alert('Berhasil membuat akun');
            </script>";
        } else {
            echo "<script>alert('Gagal membuat akun')</script>";
        }
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
        .btn-container button,
        .btn-container .btn {
            border-radius: 30px; /* Membuat tombol berbentuk pill */
            font-size: 16px; /* Menambahkan ukuran font */
            padding: 10px 20px; /* Menambahkan padding pada tombol */
            margin: 5px; /* Menambahkan jarak di sekitar tombol */
        }

    </style>
</head>
<body>
    <?php include 'navbarsuper.php' ?>
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

                                $query = mysqli_query($koneksi, "SELECT max(id_user) as kodeTerbesar FROM user");
                                $data = mysqli_fetch_array($query);
                                $kode = $data['kodeTerbesar'];

                                $urutan = (int) substr($kode, 3, 3);
                                $urutan++;

                                $huruf = "US";
                                $kode = $huruf . sprintf("%03s", $urutan);
                                ?>
                                <label class="form-label"><b>ID User</b></label>
                                <input type="text" readonly class="form-control" name="id_user" autocomplete="off" placeholder="id kapal" value="<?php echo $kode; ?>" required>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label"><b>Nama Lengkap</b></label>
                                    <input type="text" class="form-control" name="nama" autocomplete="off" placeholder="Masukkan Nama" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label"><b>Username</b></label>
                                    <input type="text" class="form-control" name="username" autocomplete="off" placeholder="Masukkan Username" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label"><b>Password</b></label>
                                    <input type="text" class="form-control" name="password" autocomplete="off" placeholder="Masukkan Password" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label"><b>Level</b></label>
                                    <select class="form-control" name="level" required>
                                        <option value="">Pilih Level</option>
                                        <option value="user">User</option>
                                        <option value="admin">Admin</option>
                                        <option value="superadmin">Superadmin</option>
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class="btn-container">
                                <a href="keloladatauser.php" class="btn btn-danger">Batal</a>
                                <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
