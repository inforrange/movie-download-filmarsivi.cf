<?php

include "database.php";


$yrm = $connect->prepare("SELECT * from comment ORDER BY comment_id DESC");
$yrm->execute(array());
$listyrm = $yrm->fetchAll(PDO::FETCH_ASSOC);


$dbusr = $connect->prepare("SELECT * from users ORDER BY users_id DESC");
$dbusr->execute(array());
$listusr = $dbusr->fetchAll(PDO::FETCH_ASSOC);


$dbmovi = $connect->prepare("SELECT * from movies ORDER BY movies_id DESC");
$dbmovi->execute(array());
$listmovi = $dbmovi->fetchAll(PDO::FETCH_ASSOC);

$dbctgr = $connect->prepare("SELECT * from categories ORDER BY categories_id DESC");
$dbctgr->execute(array());
$listctgr = $dbctgr->fetchAll(PDO::FETCH_ASSOC);




if($_POST){
$text = $_POST["comment_text"];
$id = $_GET["id"];
$movie_id = $_GET["movie"];
$st=0;
$cmt->execute(array($text,$id,$movie_id,$st));


}

$delcmnt = $connect->prepare("DELETE from comment where comment_id=? ");

$yrmban = $connect->prepare("UPDATE comment set comment_status_id=? where comment_id=?");

if(@$_GET["yrm"]=="dell"){

$delcmnt->execute(array(@$_GET["yrm_id"]));

}elseif(@$_GET["yrm"]=="ban"){
  
 $yrmban->execute(array(1,$_GET["yrm_id"]));


}elseif(@$_GET["yrm"]=="deban"){
  $yrmban->execute(array(0,$_GET["yrm_id"]));
  
}




?>

<!DOCTYPE html>
<html>
<head><meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
        crossorigin="anonymous">
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
	<title></title>
   <style>
  
   </style>
</head>
<body>
<div class="container">
    
  <div class="row-sm-2">


  <div class="w3-container" style="margin-top:10px;">
  <ul class="w3-ul w3-card-4 row"  style="margin-right: 5px;">
    
  <?php foreach($listyrm as $yrm){?>
  <li class="w3-bar col-sm-12" >
  
    <h6> <b> <?php foreach($listusr as $usr){ 
      if($yrm["comment_users_id"]==$usr["users_id"]){
        echo $usr["users_name"]," ",$usr["users_surname"];
        } 
      }?></b></h6>
    <?php echo $yrm["comment_text"];?> <br>
    <?php foreach($listmovi as $movi){
      if($yrm["comment_movies_id"]==$movi["movies_id"]){
      ?>
    <sub><b>Film Adı:</b> <?php echo $movi["movies_name"];?></sub><br>
    <?php
    foreach($listctgr as $ct){
      if($movi["movies_category_id"]==$ct["categories_id"]){
      ?>
      <sub><b>Film Kategori:</b> <?php echo $ct["categories_name"];?></sub>
    
  <?php }}?>
    <?php } }?>

    
    <sub class="w3-right" href=""><?php echo $yrm["comment_add_time"]?></sub><br>
    <a class=" w3-right" href="admin.php?id=<?php echo $_GET["id"]?>&yorum=list&yrm=dell&yrm_id=<?php echo $yrm["comment_id"]?>">
    <span title="Sil" class="w3-bar-item  btn btn-danger fa fa-trash w3-right"></span></a>

    <?php if($yrm["comment_status_id"]==0){?>
    <a class=" w3-right" href="admin.php?id=<?php echo $_GET["id"]?>&yorum=list&yrm=ban&yrm_id=<?php echo $yrm["comment_id"]?>">
    <span title="Engelle" class="w3-bar-item  btn btn-info fa fa-check w3-right" style="background-color: #06FF00;"></span></a>
    <?php }else{?>
        <a class="w3-right" href="admin.php?id=<?php echo $_GET["id"]?>&yorum=list&yrm=deban&yrm_id=<?php echo $yrm["comment_id"]?>">
      <span title="Engeli Kaldır"  class="w3-bar-item  btn btn-info fa fa-ban w3-right" style="background-color: #f44336;"></span></a>
      <?php }?>
        <div class="w3-bar-item">
          <span class="w3-large"></span><br>
        </div>
      </li>
      <?php }?>
      

    
  </ul>
</div>
</body>
</html>