<?php include 'koneksi.php';
session_start();
if ($_SESSION['level'] == "") {
	header("location:index.php");
} 
elseif ($_SESSION['level'] != 'user'){
	echo "<script>
	window.location.href = 'index.php';
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
        .container {
            width: 80%;
            margin: auto;
            background-color: #fff;
            padding: 20px;
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
<?php include 'navbaruser.php' ?>
<br><br><br>
<div class="container">
    <div class="row">
        <div class="col-md-11" style="margin: 0 auto;">
            <h3 class="text-center my-4">Riwayat Pemesanan Tiket Kapal</h3>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Id Tiket</th>
                        <th>Nama Pemesan</th>
                        <th>Id Kapal</th>
                        <th>Jumlah Tiket</th>
                        <th>Total Harga</th>
                        <th>Status Pembayaran</th>
                        <th>Waktu Pembayaran</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $id_user = $_SESSION['id_user'];
                    $no = 1;
                    $sql = mysqli_query($koneksi, "SELECT * FROM tiket JOIN user ON user.id_user = tiket.id_user WHERE user.id_user = '$id_user'");
                    while ($data = mysqli_fetch_array($sql)) {
                        ?>
                        <tr>
                            <td><?php echo $no ?></td>
                            <td><?php echo $data['id_tiket'] ?></td>
                            <td><?php echo $data['id_user'] ?> - <?php echo $data['nama'] ?></td>
                            <td><?php echo $data['id_kapal'] ?></td>
                            <td><?php echo $data['jumlah'] ?></td>
                            <td><?php echo $data['total_harga'] ?></td>
                            <td><?php echo $data['status'] ?></td>
                            <td><?php echo date('d-m-Y', strtotime($data['waktu_byr'])); ?></td>
                        </tr>
                        <?php
                        $no++;
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
