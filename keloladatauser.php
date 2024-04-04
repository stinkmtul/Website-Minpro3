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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pengguna</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .btn-custom {
            color: #fff;
            padding: 10px 20px;
            border-radius: 30px;
            transition: background-color 0.3s ease;
            text-align: center;
        }

        .btn-custom:hover {
            background-color: #526D82;
        }
        
        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }

        .btn-danger:hover {
            background-color: #c82333;
            border-color: #bd2130;
        }

        .container-top {
            width: 80%;
            margin: auto;
            padding: 30px;
            border-radius: 10px;
            margin-bottom: 10px;
        }
        
        .container {
            width: 80%;
            margin: auto;
            background-color: #fff;
            padding: 10px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .table-bordered th,
        .table-bordered td {
            border: 1px solid #dee2e6;
            padding: 12px;
            text-align: center;
            font-size: 14px;
        }

        .table-bordered thead th {
            background-color: #526D82;
            color: #fff;
        }

        .table-bordered tbody tr:hover {
            background-color: #f8f9fa;
        }
    </style>
</head>
<body>
<?php include 'navbar.php' ?>
<br><br><br><br>
<div class="container">
    <div class="row">
        <div class="col-md-11" style="margin: 0 auto;">
            <h3 class="text-center my-4">Data User</h3>
            <div class="dropdown mb-3">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                    Pilih Level
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <li><a class="dropdown-item" href="?level=admin">Admin</a></li>
                    <li><a class="dropdown-item" href="?level=user">User</a></li>
                </ul>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Username</th>
                        <th>Level</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $no = 1;
                    // Memeriksa jika level telah dipilih
                    if(isset($_GET['level'])) {
                        $level = $_GET['level'];
                        $sql = mysqli_query($koneksi, "SELECT id_user, nama, username, level  FROM user WHERE level='$level'");
                        while ($data = mysqli_fetch_array($sql)) {
                            ?>
                            <tr>
                                <td><?php echo $no ?></td>
                                <td><?php echo $data['id_user'] ?></td>
                                <td><?php echo $data['nama'] ?></td>
                                <td><?php echo $data['username'] ?></td>
                                <td><?php echo $data['level'] ?></td>
                                <td>
                                    <a href="hapusdatauser.php?id=<?php echo $data['id_user'] ?>" class="btn btn-danger bi bi-trash" onclick="return confirm('Anda tidak akan bisa melihat data ini lagi yakin ingin menghapus?');"></a>
                                </td>
                            </tr>
                            <?php
                            $no++;
                        }
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
