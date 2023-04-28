<?php 

require("lib/config.php");
if(isset($_POST['login'])){
	$user = $_POST['username'];
	$pass = $_POST['password'];

	$sql = mysqli_query($config, "SELECT * FROM user WHERE username = '$user' AND password = '$pass'");
	$cek = mysqli_num_rows($sql);

  $row = $sql->fetch_assoc();

	if($cek > 0){
		session_start();
		if($row['id_level'] == 1){
			header('location:page/owner/index.php');
		}
		else if($row['id_level'] == 2 ){
			header('location:page/admin/index.php');
		}
		else{
			header('location:index.php?error');
		}
		$_SESSION['username'] = $row['username'];
		$_SESSION['password'] = $row['password'];
	} 
	else{
		header('location:index.php?error');
	}
}

 ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>LOGIN</title>
	<link rel="stylesheet" type="text/css" href="assets/css/login.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<body>
	<div class="wrapper d-flex justify-content-center align-items-center">
		<div class="wrapp-login rounded-3 d-flex flex-column justify-content-between">
			<div class="top">
				
			</div>
			<div class="bott">
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#ffffff" fill-opacity="1" d="M0,224L48,218.7C96,213,192,203,288,218.7C384,235,480,277,576,288C672,299,768,277,864,229.3C960,181,1056,107,1152,85.3C1248,64,1344,96,1392,112L1440,128L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>
				<form method="post" class="p-5">
					<div class="mb-2">
						<label class="form-label">Username</label>
						<input type="text" name="username" class="form-control">
					</div>
					<div class="mb-5">
						<label class="form-label">Password</label>
						<input type="password" name="password" class="form-control">
					</div>
					<div class="text-center">
						<input type="submit" name="login" value="LOGIN" class="btn b-log rounded-3">
					</div>
				</form>
			</div>
		</div>
	</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>