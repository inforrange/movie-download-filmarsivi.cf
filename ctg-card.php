<?php
include "database.php";

$db = $connect->prepare("SELECT * from categories ORDER BY `categories_id` DESC");

$db->execute(array());

$listele = $db->fetchAll(PDO::FETCH_ASSOC);


if($_GET["ctgry"]=="del"){
  $img_del = unlink($_GET["ctgry_img"]);
  $dbdel = $connect->prepare("DELETE from categories where categories_id=? ");
  $dbdel->execute(array($_GET["ctgry_id"]));
  $url= $_SESSION['id'];;
  header("refresh: 1;url=admin.php?id=$url&ctgry=list");

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
  <a class="w3-right" href="admin.php?id=<?php echo $_SESSION["id"];?>&ctgry=add">
<span class="w3-bar-item  btn btn-success w3-right" style="margin: 20px;">Kategori Ekle </span>
  </a>

<div class="w3-container">
  <ul class="w3-ul w3-card-4">
    <?php foreach($listele as $x){ ?>
  <li class="w3-bar">
  <a class=" w3-right" href="admin.php?id=<?php echo $_SESSION["id"];?>&ctgry=del&ctgry_id=<?php echo $x["categories_id"];?>&ctgry_img=<?php echo $x["categories_img"];?>">
  <span title="Sil" class="w3-bar-item  btn btn-danger fa fa-trash w3-right"></span></a>

  <a class=" w3-right" href="admin.php?id=<?php echo $_SESSION["id"];?>&ctgry=edit&select_ctgry=<?php echo $x["categories_id"]; ?>">
    <span title="Düzenle" class="w3-bar-item  btn btn-info fa fa-cog w3-right"></span></a>
      <div class="w3-bar-item">
        <span class="w3-large"><?php echo $x["categories_name"];?></span><br>
        
      </div>
    </li>
    <?php }?>

      
  

  </ul>
</div>

</body>
</html>
