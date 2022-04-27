<?php

include "database.php";
$dblist = $connect->prepare("SELECT * from users where users_id=?");
$dblist->execute(array($_GET["user"]));
$x = $dblist->fetchAll(PDO::FETCH_ASSOC);
$data = $dblist->rowCount();

if(@$_GET["admn"]=="edt"){
    
    $db = $connect->prepare("UPDATE users set users_name=?, users_surname=?, users_email=?, users_authority=? where users_id=?");
    if( @$_POST["users_name"] || @$_POST["users_surname"] || @$_POST["users_email"] || @$_POST["users_authority"]){
       
        $db->execute(array($_POST["users_name"],$_POST["users_surname"],$_POST["users_email"],$_POST["users_authority"],$_GET["user"]));
        $user =$_SESSION["id"];
        $user_id=$_GET["user"];
        
       header("refresh: 1;url=admin.php?id=$user&users=settings&user=$user_id&admn=edt");
    }else if(@$_POST["users_img"]){
		echo "İMG";
	}
}else if(@$_GET["admn"]=="pass"){
	$db = $connect->prepare("UPDATE users set users_password=? where users_id=?");

    if(@$_POST["users_password"]){
       
        $db->execute(array($_POST["users_password"],$_GET["user"]));
        $user =$_SESSION["id"];
        $user_id=$_GET["user"];
        
       header("refresh: 1;url=admin.php?id=$user&users=settings&user=$user_id&admn=edt");
    }
}else{
    $db = $connect->prepare("UPDATE users set users_name=?, users_surname=? where users_id=?");

    if(@$_POST["users_name"] || @$_POST["users_surname"]){
        $db->execute(array($_POST["users_name"],$_POST["users_surname"],$_GET["user"]));
        $user =$_SESSION["id"];
        header("refresh: 1;url=admin.php?id=$user&users=settings&user=$user");
    }else if(@$_POST["users_img"]){
		echo "İMG";
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
		  <?php foreach($x as $m){?>
		  <div class="fadeIn first">
			<br>
			<img src="<?php echo $m["users_avatar"]?>" alt="Admin" class="rounded-circle" width="150" style="padding: 10px;">

		  </div>
	  
		  <!-- Login Form -->
         
		  <form method="POST" enctype="multipart/form-data">

		    <?php if(@$_GET["admn"]!="edt" && @$_GET["admn"]!="pass" && @$_GET["usr"]!="pass"){?>
			<input type="text" id="name" class="fadeIn second" name="users_name" placeholder="İsim" value="<?php echo $m["users_name"];?>"required>
			<input type="text" id="surname" class="fadeIn second" name="users_surname" placeholder="Soyisim" value="<?php echo $m["users_surname"];?>"required>
            <?php }if(@$_GET["admn"]=="edt"){?>
			<input type="text" id="name" class="fadeIn second" name="users_name" placeholder="İsim" value="<?php echo $m["users_name"];?>"required>
			<input type="text" id="surname" class="fadeIn second" name="users_surname" placeholder="Soyisim" value="<?php echo $m["users_surname"];?>"required>
            <input type="email" id="e-mail" class="fadeIn second" name="users_email" placeholder="E-mail" value="<?php echo $m["users_email"];?>">
            
			<?php }if(@$_GET["admn"]=="pass" || @$_GET["usr"]=="pass"){?>
			<input type="password" id="password" class="fadeIn second" name="users_password" placeholder="Şifre" required>
			<input type="password" id="password" class="fadeIn second" name="users_password_repeat" placeholder="Şifreniyi Tekrar Giriniz." required>
			<?php }?>
			
		
        <br>
		
		
		<p style="
	  color:  #606060;
	  padding: 1px 10px;
	  text-align: center;
	  text-decoration: none;
	  display: inline-block;
	  font-size: 16px;"><?php if(@$_GET["admn"]=="edt"){?>Yetki Türü<?php }?></p><br>
	  
      
		<div class="form-check form-check-inline" >
        <?php if(@$_GET["admn"]=="edt"){ ?>
            
          <?php  if($m["users_authority"]==1){?>
				<input  class="form-check-input" type="radio" name="users_authority" id="inlineRadio1"  value="0" >
					<label class="form-check-label" for="inlineRadio1">Yazar </label>
				<input class="form-check-input" type="radio" name="users_authority" id="inlineRadio2" value="1" checked>
					<label class="form-check-label" for="inlineRadio2">Admin</label>
            <?php }else{?>
                <input  class="form-check-input" type="radio" name="users_authority" id="inlineRadio1"  value="0" checked>
					<label class="form-check-label" for="inlineRadio1">Yazar </label>
				<input class="form-check-input" type="radio" name="users_authority" id="inlineRadio2" value="1" >
					<label class="form-check-label" for="inlineRadio2">Admin</label>
            <?php }}?>
			</div><br>
			<br>
			<?php if(@$_GET["admn"]){?>
				<a class=" w3-right" href="admin.php?id=<?php echo $_SESSION["id"];?>&users=settings&user=<?php echo $m["users_id"];?>&admn=edt">
			<?php }else{?>
				<a class=" w3-right" href="admin.php?id=<?php echo $_SESSION["id"];?>&users=settings&user=<?php echo $_SESSION["id"];?>">
			<?php }?>
			<span class="w3-bar-item  btn btn-danger w3-right">Vazgeç </span></a>
			<input type="submit" class="fadeIn fourth" value="Düzenle">
		  </form>
          <?php }?>
		</div>
	  </div>
</body>
</html>