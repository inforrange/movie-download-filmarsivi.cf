<?php

include "database.php";
$KategoriDuzenle = $_GET["select_ctgry"];
if($KategoriDuzenle){

    $db = $connect->prepare("SELECT * from categories where categories_id=?");
    $db->execute(array($KategoriDuzenle));

    $x = $db->fetchAll(PDO::FETCH_ASSOC);
    $data = $db->rowCount();



}


if($_POST){
	if($_GET["bnr"]=="edt"){
		$db = $connect->prepare("UPDATE categories set categories_img=?,categories_name=? where categories_id=?");

		foreach($x as $del){
			$img_del = unlink($del["categories_img"]);
		}
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
						$xx = move_uploaded_file($_FILES["categories_img"]["tmp_name"],$dosyayolu);
						if($xx){
							/*
							echo "Yükleme başarılı..<br>";
							*/
						
						
						
        					$db->execute(array($dosyayolu,$_POST["categories_name"],$_GET["select_ctgry"]));

      						
							    $id = $_SESSION["id"];
								header("refresh: 1;url=admin.php?id=$id&ctgry=list");
							
						}
					}else{
						echo "Yüklenirken hata oluştu";
					}
				
				}
			}
	}else{
		$db2 = $connect->prepare("UPDATE categories set categories_name=? where categories_id=?");
		$db2->execute(array($_POST["categories_name"],$_GET["select_ctgry"]));
		$id = $_SESSION["id"];
		header("refresh: 1;url=admin.php?id=$id&ctgry=list");
	}
	
		
   
}else{
	//echo "PASS";
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
		  <?php if($data){
                  foreach($x as $m){ ?>
		  <!-- Login Form -->
		  <form method="POST" enctype="multipart/form-data">
		  <img src="<?php echo $m["categories_img"]?>"  class="rounded" width="250" height="100" style="padding: 10px;">
			<input type="text" id="categories_name" class="fadeIn second" name="categories_name" placeholder="Kategori İsmi" value="<?php echo $m["categories_name"]; ?>">
			<?php if(@$_GET["bnr"]){?>
			<p style="
	  color:  #606060;
	  padding: 15px 32px;
	  text-align: center;
	  text-decoration: none;
	  display: inline-block;
	  font-size: 16px;"><a href="admin.php?id=<?php echo $_SESSION["id"];?>&ctgry=edit&select_ctgry=<?php echo $m["categories_id"]; ?>">İptal Et</a></p>
		<center>
		<input name="categories_img" class="fadeIn second" style=" background-color: #f6f6f6; border: none; width: 85%; color:  #606060; padding: 15px 32px;  text-align: center; font-size: 16px; " type="file" placeholder="Film Afişi Seçiniz" required>
		</center>
		<?php }else{?>
			<p style="
	  color:  #606060;
	  padding: 15px 32px;
	  text-align: center;
	  text-decoration: none;
	  display: inline-block;
	  font-size: 16px;"><a href="admin.php?id=<?php echo $_SESSION["id"];?>&ctgry=edit&select_ctgry=<?php echo $m["categories_id"]; ?>&bnr=edt">Afişi Düzenle</a></p>
			<?php }?>
        
			<br>
  <a class=" w3-right" href="admin.php?id=<?php echo $_SESSION["id"];?>&ctgry=list">
			<span class="w3-bar-item  btn btn-danger w3-right">Vazgeç </span></a>

			<input type="submit" class="fadeIn fourth" value="Ekle">
			<?php }}?>
		  </form>
		</div>
	  </div>
</body>
</html>