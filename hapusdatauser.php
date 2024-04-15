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

$id = $_GET['id'];
$sqlDelete = mysqli_query($koneksi, "DELETE FROM user WHERE id_user= '$id' ");

if ($sqlDelete) {
    echo "<script>alert('Berhasil menghapus data')</script>";
	header('location:keloladatauser.php');
}
else {
	echo "<script>alert('Gagal Menghapus data')</script>";
}
?>