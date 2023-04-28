<?php 
require_once('../../lib/config.php');
session_start();


 ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Dashboard</title>
	<link rel="stylesheet" type="text/css" href="../../assets/css/main.css">
	<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body style="background-color: #f6f6f6;">
	<div class="sidebar">
		<i class='bx bxs-chevrons-left i-burger i-bgr-1' id="btn-burger"></i>
		<i class='bx bxs-chevrons-right i-burger i-bgr-2' id="btn-burger2"></i>
		<div class="logo_content">
			<img src="../../assets/img/logo.png" height="50" class="img_logo">
		</div>
		<div class="garis"></div>
		<ul class="nav">
		<li>
			<a href="index.php" class="linkNav act">
				<i class='bx bxs-dashboard'></i>
				<span class="link_name">Dashboard</span>
			</a>
			<span class="tooltip">Dashboard</span>
		</li>
		<li>
			<a href="?hal=pelanggan" class="linkNav">
				<i class='bx bxs-user-detail' ></i>
				<span class="link_name">Pelanggan</span>
			</a>
			<span class="tooltip">Pelanggan</span>
		</li>
		<!-- <li>
			<a href="?hal=pemesanankamar" class="linkNav" id="acts"> 
				<i class='bx bxs-cart-add' ></i>
				<span class="link_name">Pemesanan Kamar</span>
			</a>
			<span class="tooltip">Pemesanan Kamar</span>
		</li> -->
		<li>
			<a href="?hal=pembayaran" class="linkNav">
				<i class='bx bxl-paypal' ></i>
				<span class="link_name">Pembayaran</span>
			</a>
			<span class="tooltip">Pembayaran</span>
		</li>
	</ul>
	</div>

	<main class="main-content">
		<div class="fixed-header">
			<span>Halo, <?= $_SESSION['username']; ?>!</span>
			<div class="account">
				<div class="dropdown">
				  <a class="" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
				    <i class='bx bxs-user-circle' ></i>
				  </a>
				  <ul class="dropdown-menu mt-1 border-0 p-1">
				    <li><a class="dropdown-item" href="#">
				    	<i class='bx bxs-user-pin'></i>
				    	<span>Profil</span>
				    </a></li>
				    <li><a class="dropdown-item" href="../../lib/logout.php">
				    	<i class='bx bx-log-out' ></i>
				    	<span>Keluar</span>
				    </a></li>
				  </ul>
				</div>
			</div>
		</div>
		<div class="wrapper">
			<?php 
				if(isset($_GET["hal"])){
					if($_GET['hal'] == "pelanggan"){
							if(@$_GET["aksi"]=="input"){
								require_once "pelanggan_input.php";
							}else if(@$_GET["aksi"]=="edit"){
								require_once "pelanggan_edit.php";
							}else if(@$_GET["aksi"]=="delete"){
								require_once "pelanggan_delete.php";
							}else{
								require_once "pelanggan.php";
							}
						}else if($_GET["hal"] == "pemesanankamar"){
							if(@$_GET["aksi"]=="input"){
								require_once "pemesanankamar_input.php";
							}else if(@$_GET["aksi"]=="edit"){
								require_once "pemesanankamar_edit.php";
							}else if(@$_GET["aksi"]=="delete"){
								require_once "pemesanankamar_delete.php";
							}else{
								require_once "pemesanankamar.php";
							}
						}else if($_GET["hal"] == "pembayaran"){
							if(@$_GET["aksi"]=="input"){
								require_once "pembayaran_input.php";
							}else if(@$_GET["aksi"]=="edit"){
								require_once "pembayaran_edit.php";
							}else if(@$_GET["aksi"]=="delete"){
								require_once "pembayaran_delete.php";
							}else{
								require_once "pembayaran.php";
							}
						}else{
								require "dashboard.php";
							}
						}else{
							require "dashboard.php";
						}
					
						
			?>
		</div>
	</main>

<script type="text/javascript">
	let btn = document.querySelector('#btn-burger');
	let btn2 = document.querySelector('#btn-burger2');
	let sidebar = document.querySelector('.sidebar');
	let iNav = document.querySelectorAll('.linkNav');

	btn.onclick = function(){
		sidebar.classList.toggle('active');
		btn.style.display = 'none';
		btn2.style.display = 'block';
	}

	btn2.onclick = function(){
		sidebar.classList.remove('active');
		btn.style.display = 'block';
		btn2.style.display = 'none';
	}

	iNav.forEach(link => {
  		if(link.href === window.location.href){
    		link.setAttribute('aria-current', 'page');
  		}
	})

	acts = document.querySelector('#acts');

	btnPesen = document.querySelector('#linkTo');
	btnPesen.onclick = function() {
		if(btnPesen.href === window.location.href){
    		acts.setAttribute('aria-current','page');
  		}
		
	}


</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>