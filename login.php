<?php
session_start();
include 'koneksi.php'; // Sertakan file koneksi ke database

if(isset($_SESSION['level'])) {
    header("Location: utama.php");
    exit; // Menghentikan eksekusi lebih lanjut jika pengguna sudah login
}
    
if(isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query untuk mengambil data pengguna berdasarkan username
    $query = "SELECT * FROM user WHERE username='$username'";
    $result = mysqli_query($koneksi, $query);

    if(mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        // Verifikasi password
        if($password == $row['password']) {
            $_SESSION['id_user'] = $row['id_user'];
            $_SESSION['level'] = $row['level'];
            $_SESSION['nama'] = $row['nama']; // Simpan nama pengguna ke dalam sesi
            $_SESSION['saldo'] = $row['saldo']; // Simpan saldo pengguna ke dalam sesi
            echo "<script>
            window.location.href = 'utama.php';
            alert('Berhasil login');
            </script>";
            exit; // Menghentikan eksekusi lebih lanjut setelah redirect
        } else {
            echo "<script>
            alert('Username atau password salah');
            </script>";
        }
    } else {
        echo "<script>
        alert('Username atau password salah');
        </script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            width: 20%; /* Mengurangi lebar kontainer */
            max-width: 600px;
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
        }
        .container h2 {
            text-align: center;
            color: #526D82;
            margin-bottom: 30px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-control { 
            width: calc(100% - 20px); /* Menyesuaikan lebar input field */
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ced4da;
            transition: border-color 0.3s;
        }
        .form-control:focus {
            outline: none;
            border-color: #526D82;
        }
        .btn {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #526D82;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s;
            font-size: 16px;
        }
        .btn:hover {
            background-color: #27374D;
        }
        .btn-link {
            display: block;
            text-align: center;
            margin-top: 10px;
            color: #526D82;
            text-decoration: none;
        }
        .btn-link:hover {
            text-decoration: underline;
        }
        .error-message {
            color: red;
            margin-top: -10px;
            margin-bottom: 10px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <center><img src="img/logokapal.png" alt="Kapal" width="100px"></center>
        <h2>Login</h2>
        <?php if(isset($error)) { ?>
            <p class="error-message"><?php echo $error; ?></p>
        <?php } ?>
        <form method="POST" action="">
            <div class="form-group">
                <input type="text" name="username" class="form-control" placeholder="Username" required>
            </div>
            <div class="form-group">
                <input type="password" name="password" class="form-control" placeholder="Password" required>
            </div>
            <button type="submit" name="submit" class="btn">Login</button>
            <a href="registrasi.php" class="btn-link">Belum punya akun?</a>
        </form>
    </div>
</body>
</html>
