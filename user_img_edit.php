<?php

include "database.php";
$dblist = $connect->prepare("SELECT * from users where users_id=?");
$dblist->execute(array($_GET["user"]));
$x = $dblist->fetchAll(PDO::FETCH_ASSOC);
$data = $dblist->rowCount();

 if($_POST){
	$db = $connect->prepare("UPDATE users set users_avatar=? where users_id=?");

	$img_del = unlink($_POST["users_avatar"]);

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
					$xx = move_uploaded_file($_FILES["users_img"]["tmp_name"],$dosyayolu);
					if($xx){
						/*
						echo "Yükleme başarılı..<br>";
						*/
						
						
						
        				$db->execute(array($dosyayolu,$_GET["user"]));
						
      					$user =$_SESSION["id"];
       					$user_id=$_GET["user"];
       					
						if(@$_GET["admn"]=="edt"){
							header("refresh: 1;url=admin.php?id=$user&users=settings&user=$user_id&admn=edt");
						}else{
							header("refresh: 1;url=admin.php?id=$user&users=settings&user=$user_id");
						}
					}
				}else{
					echo "Yüklenirken hata oluştu";
				}
		
			}
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
		  <?php foreach($x as $m){?>
		  <div class="fadeIn first">
			<br>
			<img src="<?php echo $m["users_avatar"]?>" alt="Admin" class="rounded-circle" width="150" style="padding: 10px;">

		  </div>
	  
		  <!-- Login Form -->
         
		  <form method="POST" enctype="multipart/form-data">

		    <?php if(@$_GET["usr"]!="img" && @$_GET["admn"]!="edt"){?>
			<input type="text" id="name" class="fadeIn second" name="users_name" placeholder="İsim" value="<?php echo $m["users_name"];?>"required>
			<input type="text" id="surname" class="fadeIn second" name="users_surname" placeholder="Soyisim" value="<?php echo $m["users_surname"];?>"required>
           
			<input type="text" id="name" class="fadeIn second" name="users_name" placeholder="İsim" value="<?php echo $m["users_name"];?>"required>
			<input type="text" id="surname" class="fadeIn second" name="users_surname" placeholder="Soyisim" value="<?php echo $m["users_surname"];?>"required>
            <input type="email" id="e-mail" class="fadeIn second" name="users_email" placeholder="E-mail" value="<?php echo $m["users_email"];?>">
            
			
			<input type="password" id="password" class="fadeIn second" name="users_password" placeholder="Şifre" required>
			<input type="password" id="password" class="fadeIn second" name="users_password_repeat" placeholder="Şifreniyi Tekrar Giriniz." required>
			<?php }?>
			
			<?php if(@$_GET["usr"]=="img" || @$_GET["users"]=="img"){?>
				<p>Profil Fotoğrafı Seçin</p>
				<input type="hidden"  id="name"  name="users_avatar"  value="<?php echo $m["users_avatar"];?>"required>
				
		<input   name="users_img" class="fadeIn second" style=" background-color: #f6f6f6; border: none; width: 85%; color:  #606060; padding: 1px 10px;  text-align: center; font-size: 16px; " type="file" >
	
	  <?php }?>
			
		
        <br>
		
		
		<p style="
	  color:  #606060;
	  padding: 1px 10px;
	  text-align: center;
	  text-decoration: none;
	  display: inline-block;
	  font-size: 16px;"><?php if(@$_GET["admn"]=="edt"){?><?php }?></p><br>
	  
      
		<div class="form-check form-check-inline" >
        
			</div><br>
			<br>
			<?php if(@$_GET["admn"]){?>
				<a class=" w3-right" href="admin.php?id=<?php echo $_SESSION["id"];?>&users=settings&user=<?php echo $m["users_id"];?>&admn=edt">
			<?php }else{?>
				<a class=" w3-right" href="admin.php?id=<?php echo $_SESSION["id"];?>&users=settings&user=<?php echo $_SESSION["id"];?>">
			<?php }?>
			<span class="w3-bar-item  btn btn-danger w3-right">Vazgeç </span></a>
			<input type="submit"  class="fadeIn fourth" value="Değiştir">
		  </form>
          <?php }?>
		</div>
	  </div>
</body>
</html>