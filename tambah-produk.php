<?php
	session_start();
	include 'db.php';
	if($_SESSION['status_login']!= true){
		echo '<script>window.location="login.php"</script>';
	}
?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width-device-width, initial-scale-1">
	<title>Shelby & Co.</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
</head>

<style type="text/css">
	* {
	padding:0;
	margin:0;
	font-family: 'Quicksand', sans-serif;
	}
	body {
		background-color: #f8f8f8;
	}
	* {
		color: inherit;
		text-decoration: none;
	}
	#bg-login {
		display: flex;
		height: 100vh;
		justify-content: center;
		align-items: center;
	}
	.box-login {
		width: 300px;
		min-height: 200px;
		border: 1px solid #ccc;
		background-color: #fff;
		padding: 15px;
		box-sizing: border-box
	}
	.box-login h2 {
		text-align: center;
		margin-bottom: 15px;
	}
	.input-control {
		width: 100%;
		padding: 10px;
		margin-bottom: 15px;
		box-sizing: border-box;
	}
	.btn {
		padding: 8px 15px;
		background-color: #a33f79;
		color: #fff;
		border: none;
		cursor: pointer;
	}
	header {
		background-color: #a33f79;
		color: #fff; 
	}
	header h1 {
		float: left;
		padding: 10px 0;
	}
	header ul {
		float: right;
	}
	header ul li {
		display: inline-block;
	}
	header ul li a {
		padding: 20px 0 20px 15px;
		display: inline-block;
	}
	.container {
		width: 80%;
		margin: 0 auto;
	}
	.container:after {
		content: '';
		display: block;
		clear: both;
	}
	.section {
		padding: 25px 0;
	}
	.box {
		background-color: #fff;
		border: 1px solid #ccc;
		padding: 15px;
		box-sizing: border-box;
		margin: 10px 0 25px 0; 
	}

</style>

<body>
	<!-- header -->
	<header>
		<div class="container">
			<h1><a href="dashboard.php">Shelby & Co.</a></h1>
			<ul>
				<li><a href="dashboard.php">Dashboard</a></li>
				<li><a href="profil.php">Profil</a></li>
				<li><a href="data-kategori.php">Data Kategori</a></li>
				<li><a href="data-produk.php">Data Produk</a></li>
				<li><a href="keluar.php">Keluar</a></li>
			</ul>
		</div>
	</header>

	<!--content-->
	<div class="section">
		<div class="container">
			<h3>Tambah Data Produk</h3>
			<div class="box">
				<form action="" method="POST" enctype="multipart/form-data">
					<select class="input-control" name="kategori" required>
						<option value="">--Pilih--</option>
						<?php
							$kategori = mysqli_query($conn, "SELECT * FROM tb_category ORDER BY category_id DESC");
							while($r = mysqli_fetch_array($kategori)){
						?>
						<option value="<?php echo $r['category_id'] ?>"><?php echo $r['category_name'] ?></option>
						<?php } ?>
					</select>
					<input type="text" name="nama" class="input-control" placeholder="Nama Produk" required>
					<input type="text" name="harga" class="input-control" placeholder="Harga" required>
					<input type="file" name="gambar" class="input-control" required>
					<textarea class="input-control" name="deskripsi" placeholder="Deskripsi"></textarea>
					<select class="input-control" name="status">
						<option value="">--Pilih--</option>
						<option value="1">Aktif</option>
						<option value="0">Tidak Aktif</option>
					</select>
					<input type="submit" name="submit" value="Submit" class="btn">
				</form>
				<?php 
					if(isset($_POST['submit'])){
						
						// print_r($_FILES['gambar']);
						// menampung inputan dari form
						$kategori = $_POST['kategori'];
						$nama = $_POST['nama'];
						$harga = $_POST['harga'];
						$deskripsi = $_POST['deskripsi'];
						$status = $_POST['status'];

						//menampung data file yang diupload
						$filename = $_FILES['gambar']['name'];
						$tmp_name = $_FILES['gambar']['tmp_name'];

						$type1 = explode('.', $filename);
						$type2 = $type1[1];

						$newname = 'produk' . time() . '.' . $type2;

						//menampung data format file yang diizinkan
						$tipe_diizinkan = array('jpg', 'JPG', 'jpeg', 'png', 'gif');

						//validasi format file
						if(!in_array($type2, $tipe_diizinkan)){

							echo 'Format file tidak diizinkan';

						}else{

							move_uploaded_file($tmp_name, './produk/'.$newname); 

							$insert = mysqli_query($conn, "INSERT INTO tb_product VALUES (
										null,
										'".$kategori."',
										'".$nama."',
										'".$harga."',
										'".$deskripsi."',
										'".$newname."',
										'".$status."',
										null

										)");
							if($insert){
								echo 'Simpan data berhasil';
								echo '<script>window.location="data-produk.php"</script>';
							}else{
								echo 'Simpan data gagal'.mysqli_error($conn);
							}



						}

						//proses upload file sekaligus insert ke database


					}
				 ?>
			</div>
		</div>
	</div>

	<!--footer-->
	<footer>
		<div class="container">
			<small>Copyright &copy; 2023 - Shelby & Co.</small>
		</div>
	</footer>

</body>
</html>