<?php
include "database.php";

if($_GET["user"]){
  $db = $connect->prepare("SELECT * from users where users_id=?");

  $db->execute(array($_GET["user"]));

  $listele = $db->fetchAll(PDO::FETCH_ASSOC);
  $data = $db->rowCount();

}
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

<link href="assets/style.css" rel="stylesheet">
<link href="assets/stl.css" rel="stylesheet">
    <style>
	</style>
</head>
<body>
  <?php if($data){
            foreach($listele as $m){
    ?>
<div class="container" style=" padding: 40px; ";>
    <div class="main-body">
          <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex flex-column align-items-center text-center">
                    <img src="<?php echo $m["users_avatar"]?>" alt="Admin" class="rounded-circle" width="150" style="padding: 10px;">
                    <?php if(@$_GET["admn"]=="edt"){?>
                      <a href="admin.php?id=<?php echo $_SESSION["id"];?>&users=img&user=<?php echo $_GET["user"];?>&admn=edt"> 
                    <?php }else{?>
                      <a href="admin.php?id=<?php echo $_SESSION["id"];?>&users=img&user=<?php echo $_GET["user"];?>&usr=img"> 
                    <?php }?>
                    <button class="btn btn-outline-primary"  >Değiştir</button></a>
                  </div>
                </div>
              </div>
              <div class="mt-3">
              </div>
            </div>
            <div class="col-md-8">
              <div class="card mb-3">
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Ad Soyad</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <?php echo $m["users_name"];echo" ";echo $m["users_surname"];?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">E-mail</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <?php echo $m["users_email"];?>
                    </div>
                  </div>
                  <hr>
                  
                  
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Yetki</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <?php
                     if($m["users_authority"]==1){
                       echo "Admin";
                     }else{
                       echo "Yazar";
                     }
                    
                    ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-12">
                      <?php if(@$_GET["admn"]=="edt"){?>
                    <a class="btn btn-info " target="" href="admin.php?id=<?php echo $_SESSION["id"];?>&users=edit&user=<?php echo $m["users_id"];?>&admn=edt">Düzenle</a>
                    <?php }else{?>
                      <a class="btn btn-info " target="" href="admin.php?id=<?php echo $_SESSION["id"];?>&users=edit&user=<?php echo $m["users_id"];?>">Düzenle</a>
                      <?php }if(@$_GET["admn"]){?>
                    <a class="btn btn-danger w3-right "   target="" href="admin.php?id=<?php echo $_SESSION["id"];?>&users=edit&user=<?php echo $m["users_id"];?>&admn=pass">Şifreyi Değiştir</a>
                    <?php }else{?>
                      <a class="btn btn-danger w3-right "   target="" href="admin.php?id=<?php echo $_SESSION["id"];?>&users=edit&user=<?php echo $m["users_id"];?>&usr=pass">Şifreyi Değiştir</a>
                    <?php }?>
                    
                </div>
                    
                  </div>
                </div>
              </div>

              <div class="row gutters-sm">
                <div class="col-sm-6 mb-3">
                  
                  </div>
                </div>
                <div class="col-sm-6 mb-3">
                  <div class=" h-100">
                  </div>
                </div>
              </div>
<?php }}?>
</body>
</html>