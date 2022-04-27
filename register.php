<?php

include "database.php";

$db = $connect->prepare("INSERT into users set 
							users_name=?,
							users_surname=?,
							users_email=?,
							users_password=?,
							users_avatar=?,
							users_authority=?,
							users_ban=?
");

if($_POST){
	
					
					$Kullanici_Adi = $_POST["users_name"];
					$Kullanici_Soyadi = $_POST["users_surname"];
					$Kullanici_Eposta = $_POST["users_email"];
					$Kullanici_Sifre = $_POST["users_password"];
					$Kullanici_Foto = "test";
					$Kullanici_Yetki = 2;
					$Kullanici_Durum = 0;

					$kontrol = $db->execute(array($Kullanici_Adi,$Kullanici_Soyadi,$Kullanici_Eposta,$Kullanici_Sifre,$Kullanici_Foto,$Kullanici_Yetki,$Kullanici_Durum));

					if($kontrol){
						
  						header("refresh: 1;url=login.php");
					}else{
						echo "NO";
					}
				
}


?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link href="assets/style.css" rel="stylesheet">
<link href="assets/stl.css" rel="stylesheet">
<style>
	body{
		background:white;
	}
	</style>
</head>
<body>
	<div class="wrapper fadeInDown">
		<div id="formContent">
		  <!-- Tabs Titles -->
			
		  <!-- Icon -->
		  <div class="fadeIn first">
			<br>
		  </div>
	  
		  <!-- Login Form -->
		  <form method="POST" enctype="multipart/form-data">
	
			<input type="text" id="name" class="fadeIn second" name="users_name" placeholder="İsim" required>
			<input type="text" id="surname" class="fadeIn second" name="users_surname" placeholder="Soyisim" required>
            <input type="email" id="e-mail" class="fadeIn second" name="users_email" placeholder="E-mail" required>
			<input type="password" id="password" class="fadeIn second" name="users_password" placeholder="Şifre" required>
			<input type="password" id="password" class="fadeIn second" name="users_password_repeat" placeholder="Şifreniyi Tekrar Giriniz." required>
			
		
        <br>
		
			<br>
  <a class=" w3-right" href="index.php">
			<span class="w3-bar-item  btn btn-danger w3-right">Vazgeç </span></a>
			<input type="submit" class="fadeIn fourth" value="Kayıt Ol">
		  </form>
		</div>
	  </div>
</body>
</html>