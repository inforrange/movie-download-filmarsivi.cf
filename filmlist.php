<?php 
include "database.php";

$db = $connect->prepare("SELECT * from movies ORDER BY 'movies_id' DESC");
$db_del = $connect->prepare("DELETE from movies where movies_id=?");
$yayin = $connect->prepare("UPDATE movies set movies_broadcasting=? where movies_id=?");


$db->execute(array());

$listele = $db->fetchAll(PDO::FETCH_ASSOC);


if($_GET["film"]=="del"){
  
  $img_del = unlink($_GET["film_img"]);
  $db_del->execute(array($_GET["film_id"]));
  $url= $_SESSION['id'];
  header("refresh: 1;url=admin.php?id=$url&film=list");
}else if(@$_GET["movie"]=="add"){
  $yayin->execute(array(0,$_GET["movie_id"]));
  $url= $_SESSION['id'];
  header("refresh: 1;url=admin.php?id=$url&film=list");
}else if(@$_GET["movie"]=="notadd"){
  $yayin->execute(array(1,$_GET["movie_id"]));
  $url= $_SESSION['id'];
  header("refresh: 1;url=admin.php?id=$url&film=list");
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

  <a class="w3-right" href="admin.php?id=<?php echo $_SESSION["id"];?>&film=add">
<span class="w3-bar-item  btn btn-success w3-right" style="margin: 20px;">Film Ekle </span>
  </a>

<div class="w3-container">
  <ul class="w3-ul w3-card-4">
    <?php foreach($listele as $m){ ?>
  <li class="w3-bar">
  <a class=" w3-right" href="admin.php?id=<?php echo $_SESSION["id"];?>&film=del&film_id=<?php echo $m["movies_id"];?>&film_img=<?php echo $m["movies_image"];?>">
  <span title="Sil" class="w3-bar-item  btn btn-danger fa fa-trash w3-right"></span></a>
  <a class=" w3-right" href="admin.php?id=<?php echo $_SESSION["id"];?>&film=settings&movies_id=<?php echo $m["movies_id"];?>">
  <span title="Düzenle" class="w3-bar-item  btn btn-success fa fa-cog w3-right"></span></a>
  <a class=" w3-right" target="_blank" href="wiev.php?id=<?php echo $_SESSION["id"];?>&movie=<?php echo $m["movies_id"];?>">
    <span title="Önizle" class="w3-bar-item  btn btn-info fa fa-eye w3-right" ></span></a>
    <?php if($m["movies_broadcasting"]==1){ ?>
  <a class=" w3-right" href="admin.php?id=<?php echo $_SESSION["id"];?>&film=list&movie=add&movie_id=<?php echo $m["movies_id"];?>">
  <span title="Yayınla" class="w3-bar-item  btn btn-info fa fa-check w3-right" style="background-color: #06FF00;"></span></a>
    <?php }else{?>
      <a class="w3-right" href="admin.php?id=<?php echo $_SESSION["id"];?>&film=list&movie=notadd&movie_id=<?php echo $m["movies_id"];?>">
    <span title="Yayından Kaldır"  class="w3-bar-item  btn btn-info fa fa-ban w3-right" style="background-color: #f44336;"></span></a>
    <?php }?>
      <div class="w3-bar-item">
        <span class="w3-large"><?php echo $m["movies_name"]; ?></span><br>
      </div>
    </li>
    <?php }?>

  </ul>
</div>

</body>
</html>
