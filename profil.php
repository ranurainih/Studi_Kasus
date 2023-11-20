<?php
	session_start();
	include 'db.php';
	if($_SESSION['status_login']!= true){
		echo '<script>window.location="login.php"</script>';
	}

	$query = mysqli_query($conn, "SELECT * FROM tb_admin WHERE admin_id = '".$_SESSION['id']."' ");
	$d = mysqli_fetch_object($query);

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
			<h3>Profil</h3>
			<div class="box">
				<form action="" method="POST">
					<input type="text" name="nama" placeholder="Nama Lengkap" class="input-control" value="<?php echo $d->admin_name ?>" required>
					<input type="text" name="user" placeholder="Username" class="input-control" value="<?php echo $d->username ?>" required>
					<input type="text" name="hp" placeholder="No Hp" class="input-control" value="<?php echo $d->admin_telp ?>" required>
					<input type="email" name="email" placeholder="Email" class="input-control" value="<?php echo $d->admin_email ?>" required>
					<input type="text" name="alamat" placeholder="Alamat" class="input-control" value="<?php echo $d->admin_address ?>" required>
					<input type="submit" name="submit" value="Ubah Profil" class="btn">
				</form>
				<?php
					if(isset($_POST['submit'])){

						$nama 	= ucwords($_POST['nama']);
						$user 	= $_POST['user'];
						$hp 	= $_POST['hp'];
						$email 	= $_POST['email'];
						$alamat = $_POST['alamat'];

						$update = mysqli_query($conn, "UPDATE tb_admin SET admin_name = '".$nama."',
							username = '".$user."',
							admin_telp = '".$hp."',
							admin_email = '".$email."',
							admin_address = '".$alamat."'
							WHERE admin_id = '".$d->admin_id."'
							");
					if($update){
						echo '<script>alert("Ubah data berhasil")</script>';
						echo '<script>window.location="profil.php"</script>';
					}else{
						echo 'gagal' . mysqli_error($conn);
					}
					}
				?>
			</div>

			<h3>Ubah Password</h3>
			<div class="box">
				<form action="" method="POST">
					<input type="password" name="pass1" placeholder="Password Baru" class="input-control" required>
					<input type="password" name="pass2" placeholder="Konfirmasi Password" class="input-control" required>
					<input type="submit" name="ubah_password" value="Ubah Password" class="btn">
				</form>
				<?php
					if(isset($_POST['ubah_password'])){

						$pass1 	= $_POST['pass1'];
						$pass2 	= $_POST['pass2'];

						if($pass2 != $pass1){
							echo '<script>alert("Konfirmasi Password Baru tidak sesuai")</script>';
						}else {
							$u_pass = mysqli_query($conn, "UPDATE tb_admin SET password = '".MD5($pass1)."'
								WHERE admin_id = '".$d->admin_id."'
							");
							if($u_pass){
								echo '<script>alert("Ubah data berhasil")</script>';
								echo '<script>window.location="profil.php"</script>';
							}else{
								echo 'gagal' . mysqli_error($conn);
							}
						}
						
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