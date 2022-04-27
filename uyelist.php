<?php
include "database.php";

$db = $connect->prepare("SELECT * from users ORDER BY 'users_id' DESC");
$ban = $connect->prepare("UPDATE users set users_ban=? where users_id=?");
$dbdel = $connect->prepare("DELETE from users where users_id=? ");
$db->execute(array());
$listele = $db->fetchAll(PDO::FETCH_ASSOC);


if($_GET["users"]=="del"){
  $img_del = unlink($_GET["users_img"]);
  $dbdel->execute(array($_GET["users_id"]));
  $url= $_SESSION['id'];;
  header("refresh: 1;url=admin.php?id=$url&users=list");

}else if($_GET["users"]=="ban"){  
  $ban->execute(array(1,$_GET["users_id"]));
  $url= $_SESSION['id'];;
  header("refresh: 1;url=admin.php?id=$url&users=list");
}else if($_GET["users"]=="deban"){
  $ban->execute(array(0,$_GET["users_id"]));
  $url= $_SESSION['id'];
  header("refresh: 1;url=admin.php?id=$url&users=list");
}

?>

<!DOCTYPE html>
<html>
<title></title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
        crossorigin="anonymous">
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
<style>
    
</style>
<body>

  <a class="w3-right" href="admin.php?id=<?php echo $_SESSION["id"];?>&users=add">
<span class="w3-bar-item  btn btn-success w3-right" style="margin: 20px;">Üye Ekle </span>
  </a>
  
<div class="w3-container">
  <ul class="w3-ul w3-card-4 row"  style="margin-right: 5px;">
  <?php foreach($listele as $m){ ?>
  <li class="w3-bar col-sm-4"  ><?php echo $m["users_name"]; echo " "; echo $m["users_surname"];?></li>
  <li class="w3-bar col-sm-8" ><?php echo $m["users_email"]; ?> 
  <a class=" w3-right" href="admin.php?id=<?php echo $_SESSION["id"];?>&users=del&users_id=<?php echo $m["users_id"];?>&users_img=<?php echo $m["users_avatar"];?>">
  <span title="Sil" class="w3-bar-item  btn btn-danger fa fa-trash w3-right"></span></a>
  <a class=" w3-right" href="admin.php?id=<?php echo $_SESSION["id"];?>&users=settings&user=<?php echo $m["users_id"];?>&admn=edt">
  <span title="Düzenle" class="w3-bar-item  btn btn-success fa fa-cog w3-right" style="background-color: #1C6DD0;"></span></a>
  <?php if($m["users_ban"]==0){ ?>
  <a class=" w3-right" href="admin.php?id=<?php echo $_SESSION["id"];?>&users=ban&users_id=<?php echo $m["users_id"];?>">
  <span title="Engelle" class="w3-bar-item  btn btn-info fa fa-check w3-right" style="background-color: #06FF00;"></span></a>
    <?php }else{?>
      <a class="w3-right" href="admin.php?id=<?php echo $_SESSION["id"];?>&users=deban&users_id=<?php echo $m["users_id"];?>">
    <span title="Engeli Kaldır"  class="w3-bar-item  btn btn-info fa fa-ban w3-right" style="background-color: #f44336;"></span></a>
    <?php }?>
      <div class="w3-bar-item">
        <span class="w3-large"></span><br>
      </div>
    </li>
    <?php } ?> 
  </ul>
</div>

</body>
</html>
