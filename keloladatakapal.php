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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Kapal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
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
            <h3 class="text-center my-1">Data Tiket Kapal</h3>
            <div class="col-sm-10">
                <a class="btn btn-custom bi bi-plus-circle" href="tambahdatakapal.php"><b> Tambah</b></a>
            </div>
            <br>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID</th>
                            <th>Rute</th>
                            <th>Pelabuhan Asal</th>
                            <th>Pelabuhan Tujuan</th>
                            <th>Tanggal Keberangkatan</th>
                            <th>Jam Berangkat</th>
                            <th>Estimasi Perjalanan</th>
                            <th>Kapasistas</th>
                            <th>Harga</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $sql = mysqli_query($koneksi, "SELECT * FROM kapal");
                        while ($data = mysqli_fetch_array($sql)) {
                            ?>
                            <tr>
                                <td><?php echo $no ?></td>
                                <td><?php echo $data['id_kapal'] ?></td>
                                <td><?php echo $data['rute'] ?></td>
                                <td><?php echo $data['plb_asal'] ?></td>
                                <td><?php echo $data['plb_tujuan'] ?></td>
                                <td><?php echo date('d-m-Y', strtotime($data['tgl_brgkt'])); ?></td>
                                <td><?php echo date('H:i', strtotime($data['waktu_brgkt'])); ?></td>
                                <td><?php echo $data['estimasi'] ?></td>
                                <td><?php echo $data['kapasitas'] ?></td>
                                <td><?php echo $data['harga'] ?></td>
                                <td>
                                    <a href="editdatakapal.php?id=<?php echo $data['id_kapal'] ?>" class="btn btn-success bi bi-pencil-square"></a>
                                    <a href="hapusdatakapal.php?id=<?php echo $data['id_kapal'] ?>" class="btn btn-danger bi bi-trash" onclick="return confirm('Anda tidak akan bisa melihat data ini lagi yakin ingin menghapus?');"></a>
                                </td>
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
