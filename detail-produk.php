<?php
	error_reporting(0);
	include 'db.php';
	$kontak = mysqli_query($conn, "SELECT admin_telp, admin_email, admin_address FROM tb_admin WHERE admin_id = 1");
	$a = mysqli_fetch_object($kontak);

	$produk = mysqli_query($conn, "SELECT * FROM tb_product WHERE product_id = '".$_GET['id']."'");
	$p = mysqli_fetch_object($produk);
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
	.box:after {
		content: '';
		display: block;
		clear: both;
	}
	.search {
		padding: 15px 0;
		background-color: #fff;
		border: 1px solid #ccc;
		text-align: center;
	}
	.search input[type=text] {
		width: 60%;
		padding: 10px; 
	}
	.search input[type=submit] {
		padding: 12px 15px;
		background-color: #a33f79;
		color: #fff;
		border: none;
		cursor: pointer;
	}
	.col-5 {
		width: 20%;
		height: 100px;
		text-align: center;
		float: left;
		padding: 10px;
		box-sizing: border-box;
	}
	.col-4 {
		width: 25%;
		height: 320px;
		border: 1px solid #ccc;
		float: left;
		padding: 10px;
		box-sizing: border-box;
		margin-bottom: 10px;
	}
	.col-4:hover {
		box-shadow: 0 0 3px #999;
	}
	.col-4 img {
		width: 100%;
	}
	.col-4 .nama {
		color: #666;
		margin-bottom: 5px;
	}
	.col-4 .harga {
		font-weight: bold;
		color: #a33f79;
		float: right;
	}
	.footer {
		padding: 25px 0;
		background-color: #333;
		color: #fff; 
		text-align: center;
	}
	footer p {
		margin-bottom: 10px;
	}
	footer small {
		margin-top: 25px;
		display: inline-block;
	}
	.col-2 {
		width: 50%;
		min-height: 200px;
		padding: 10px;
		box-sizing: border-box;
		float: left;
	}
	.col-2 img {
		border: 1px solid #f9f9f9;
		padding: 5px;
		box-sizing: border-box;
	}
	.col-2 h3{
		margin-bottom: 10px;
	}
	.col-2 h4 {
		color: #a33f79;
	}
	.col-2 p{
		margin: 15px 0;
		text-align: justify;
		line-height: 25px;
		font-size: 14px;
	}
	@media screen and (max-width: 768px){
		.container {
			width: 90%;
		}
		.col-5 {
			width: 50%;
			margin-bottom: 50px;
		}
		.col-4 {
			width: 50%;
			height: 300px;
		}
		.col-2 {
			width: 100%;
		}
	}


</style>

<body>
	<!-- header -->
	<header>
		<div class="container">
			<h1><a href="index.php">Shelby & Co.</a></h1>
			<ul>
				<li><a href="produk.php">Produk</a></li>
				
			</ul>
		</div>
	</header>

	<!--search-->
	<div class="search">
		<div class="container">
			<form action="produk.php">
				<input type="text" name="search" placeholder="Cari Produk" value="<?php echo $_GET['search'] ?>">
				<input type="hidden" name="kat" value="<?php echo $_GET['kat'] ?>">
				<input type="submit" name="cari" value="Cari Produk">
			</form>
		</div>
	</div>

	<!--product detail-->
	<div class="section">
		<div class="container">
			<h3>Detail Produk</h3>
			<div class="box">
				<div class="col-2">
					<img src="produk/<?php echo $p->product_image ?>" width="100%">
				</div>
				<div class="col-2">
					<h3><?php echo $p->product_name ?></h3>
					<h4>Rp. <?php echo number_format($p->product_price) ?></h4>
					<p>Deskripsi :<br>
						<?php echo $p->product_description ?>
					</p>
					<p><a href="https://api.whatsapp.com/send?phone=<?php echo $a->admin_telp ?>&text=Hai, saya tertarik dengan produk Anda!" target="_blank">Hubungi via Whatsapp</a></p>
				</div>
			</div>
		</div>
	</div>


	<!--footer-->
	<div class="footer">
		<div class="container">
			<h4>Alamat</h4>
			<p><?php echo $a->admin_address ?></p>

			<h4>Email</h4>
			<p><?php echo $a->admin_email ?></p>

			<h4>No. Hp</h4>
			<p><?php echo $a->admin_telp ?></p>

			<small>Copyright &copy; 2023 - Shelby & Co.</small>
		</div>
	</div>
</body>
</html>