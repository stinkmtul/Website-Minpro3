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

$id = $_GET['id'];
$sqlDelete = mysqli_query($koneksi, "DELETE FROM kapal WHERE id_kapal= '$id' ");

if ($sqlDelete) {
	header('location:keloladatakapal.php');
}
else {
	echo "<script>alert('Gagal Menghapus data')</script>";
}
?>