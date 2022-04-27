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
	if($_POST["users_password"]==$_POST["users_password_repeat"]){
	$maxboyut = 5000000;
	$dosyauzantisi = substr($_FILES["users_img"]["name"],-4,4);
	$dosyaadi = rand(0,99999).$dosyauzantisi;
	$dosyayolu = "users_img/".$dosyaadi;
	
	if($_FILES["users_img"]["size"]>$maxboyut){
		echo "Dosya boyutu 500kb den büyük olamaz";
	}else{
		$d=$_FILES["users_img"]["type"];
		if($d=="image/jpeg" || $d=="image/png" || $d=="image/gif"){
			if(is_uploaded_file($_FILES["users_img"]["tmp_name"])){
				$x = move_uploaded_file($_FILES["users_img"]["tmp_name"],$dosyayolu);
				if($x){
					/*
					echo "Yükleme başarılı..<br>";
					*/
					
					$Kullanici_Adi = $_POST["users_name"];
					$Kullanici_Soyadi = $_POST["users_surname"];
					$Kullanici_Eposta = $_POST["users_email"];
					$Kullanici_Sifre = $_POST["users_password"];
					$Kullanici_Foto = $dosyayolu;
					$Kullanici_Yetki = $_POST["users_authority"];
					$Kullanici_Durum = 0;

					$kontrol = $db->execute(array($Kullanici_Adi,$Kullanici_Soyadi,$Kullanici_Eposta,$Kullanici_Sifre,$Kullanici_Foto,$Kullanici_Yetki,$Kullanici_Durum));

					if($kontrol){
						$url= $_SESSION['id'];;
  						header("refresh: 1;url=admin.php?id=$url&users=list");
					}else{
						echo "NO";
					}
				}
			}else{
				echo "Yüklenirken hata oluştu";
			}
	
		}
	}
	}else{
		echo "Şifreler Eşleşmiyor";
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
			
		<p style="
	  color:  #606060;
	  padding: 15px 32px;
	  text-align: center;
	  text-decoration: none;
	  display: inline-block;
	  font-size: 16px;">Kullanıcı Foto</p>
<center>
<input  name="users_img" class="fadeIn second" style=" background-color: #f6f6f6; border: none; width: 85%; color:  #606060; padding: 1px 10px;  text-align: center; font-size: 16px; " type="file" required>
</center>
        <br>
		<p style="
	  color:  #606060;
	  padding: 1px 10px;
	  text-align: center;
	  text-decoration: none;
	  display: inline-block;
	  font-size: 16px;">Yetki Türü</p><br>
		<div class="form-check form-check-inline" >
				<input  class="form-check-input" type="radio" name="users_authority" id="inlineRadio1"  value="0" >
					<label class="form-check-label" for="inlineRadio1">Yazar </label>
			
				<input class="form-check-input" type="radio" name="users_authority" id="inlineRadio2" value="1">
					<label class="form-check-label" for="inlineRadio2">Admin</label>
			</div><br>
			<br>
  <a class=" w3-right" href="admin.php?id=<?php echo $_SESSION["id"];?>&users=list">
			<span class="w3-bar-item  btn btn-danger w3-right">Vazgeç </span></a>
			<input type="submit" class="fadeIn fourth" value="Ekle">
		  </form>
		</div>
	  </div>
</body>
</html>