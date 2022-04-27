<?php

include "database.php";

$db = $connect->prepare("INSERT into categories set categories_name=?,categories_img=?");

if($_POST){
	
$maxboyut = 5000000;
$dosyauzantisi = substr($_FILES["categories_img"]["name"],-4,4);
$dosyaadi = rand(0,99999).$dosyauzantisi;
$dosyayolu = "categories_img/".$dosyaadi;

if($_FILES["categories_img"]["size"]>$maxboyut){
    echo "Dosya boyutu 500kb den büyük olamaz";
}else{
    $d=$_FILES["categories_img"]["type"];
    if($d=="image/jpeg" || $d=="image/png" || $d=="image/gif"){
        if(is_uploaded_file($_FILES["categories_img"]["tmp_name"])){
            $x = move_uploaded_file($_FILES["categories_img"]["tmp_name"],$dosyayolu);
            if($x){
				/*
                echo "Yükleme başarılı..<br>";
                */
            }
        }else{
            echo "Yüklenirken hata oluştu";
        }

    }
}

$KategoriAdi = $_POST["categories_name"];
$KategoriResmi = $dosyayolu;

$kontrol = $db->execute(array($KategoriAdi,$KategoriResmi));

$url= $_SESSION['id'];;
header("refresh: 1;url=admin.php?id=$url&ctgry=list");


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
		  <div class="fadeIn first" style="padding-left:350px;">
			<br>
			
		  </div>
	  
		  <!-- Login Form -->
		  <form method="POST" enctype="multipart/form-data">
			<input type="text" id="categories_name" class="fadeIn second" name="categories_name" placeholder="Kategori İsmi" required>
			<p style="
	  color:  #606060;
	  padding: 15px 32px;
	  text-align: center;
	  text-decoration: none;
	  display: inline-block;
	  font-size: 16px;">Kategori Bannerı Yükleyiniz</p>
		<center>
		<input name="categories_img" class="fadeIn second" style=" background-color: #f6f6f6; border: none; width: 85%; color:  #606060; padding: 15px 32px;  text-align: center; font-size: 16px; " type="file" placeholder="Film Afişi Seçiniz" required>
		</center>

			<br>
  <a class=" w3-right" href="admin.php?id=<?php echo $_SESSION["id"];?>&ctgry=list">
			<span class="w3-bar-item  btn btn-danger w3-right">Vazgeç </span></a>

			<input type="submit" class="fadeIn fourth" value="Ekle">
		  </form>
		</div>
	  </div>
</body>
</html>