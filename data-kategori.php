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
		margin: 10px 0; 
	}
	.table {
		width: 100%;
		border-collapse: collapse;
	}
	.table tr {
		height: 30px;
	}
	.table tr td {
		padding: 5px 10px;
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
			<h3>Data Kategori</h3>
			<div class="box">
				<p><a href="tambah-kategori.php">Tambah Data</a></p>
				<table border="1" cellspacing="0" class="table">
					<thead>
						<tr>
							<th width="60px">No</th>
							<th>Kategori</th>
							<th width="150px">Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php  
							$no = 1;
							$kategori = mysqli_query($conn, "SELECT * FROM tb_category ORDER BY category_id DESC");	
							while($row = mysqli_fetch_array($kategori)){
						?>
						<tr>
							<td><?php echo $no++ ?></td>
							<td><?php echo $row['category_name'] ?></td>
							<td>
								<a href="edit-kategori.php?id=<?php echo $row['category_id'] ?>">Edit</a> || <a href="proses-hapus.php?idk=<?php echo $row['category_id'] ?>" onclick="return confirm('Yakin ingin hapus?')">Hapus</a>
							</td>
						</tr>
					<?php } ?>
					</tbody>
				</table>
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