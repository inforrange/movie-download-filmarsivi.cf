<?php
include "database.php";
session_start();

$id = $_GET["id"];
$FilmEkle = @$_GET["film"];
$KateGoriListele = @$_GET["ctgry"];
$Uyeler = @$_GET["users"];
$yorum = @$_GET["yorum"];




$db = $connect->prepare("SELECT * from users where users_id=?");

$db->execute(array($id));
$sesion = $db->fetch(PDO::FETCH_ASSOC);

if($_SESSION["id"]==$id){
  $name = $sesion["users_name"]; 
  $surname = $sesion["users_surname"]; 
  $authority_id = $sesion["users_authority"];

  if($sesion["users_authority"]==1){
    $authority="Admin";
  }else{
    $authority="Yazar";
  }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Film Arşivi</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Responsive sidebar template with sliding effect and dropdown menu based on bootstrap 3">
    <title>Sidebar template</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
        crossorigin="anonymous">
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <link href="assets/style.css" rel="stylesheet">
    <link href="assets/stl.css" rel="stylesheet">

</head>
<body>
    <style>
      </style>
      <script>jQuery(function ($) {

        $(".sidebar-dropdown > a").click(function() {
      $(".sidebar-submenu").slideUp(200);
      if (
        $(this)
          .parent()
          .hasClass("active")
      ) {
        $(".sidebar-dropdown").removeClass("active");
        $(this)
          .parent()
          .removeClass("active");
      } else {
        $(".sidebar-dropdown").removeClass("active");
        $(this)
          .next(".sidebar-submenu")
          .slideDown(200);
        $(this)
          .parent()
          .addClass("active");
      }
    });
    
    $("#close-sidebar").click(function() {
      $(".page-wrapper").removeClass("toggled");
    });
    $("#show-sidebar").click(function() {
      $(".page-wrapper").addClass("toggled");
    });
    });</script>

<div class="page-wrapper chiller-theme toggled">
  <div style="height: 100%;  padding-left: 300px;">
    
      <?php
       if($FilmEkle == "list" || $FilmEkle == "del"){
        include "filmlist.php";
      }else if($FilmEkle == "add"){
        include "form.php";
      }else if($FilmEkle == "see"){
        include "wiev.php";
      }else if($FilmEkle == "settings"){
        include "movie_edit.php";
      }else if($KateGoriListele == "list" || $KateGoriListele == "del"){
        include "ctg-card.php";
      }else if($KateGoriListele == "add"){
        include "category.php";
      }else if($KateGoriListele == "edit"){
        include "orientation/ctgry_edit.php";
      }else if($Uyeler == "list" || $Uyeler == "del" || $Uyeler == "ban" || $Uyeler == "deban"){
        include "uyelist.php";
      }else if($Uyeler == "add"){
        include "yazarekle.php";
      }else if($Uyeler == "settings"){
        include "orientation/ayarlar.php";
      }else if($Uyeler == "edit"){
        include "orientation/user_edit.php";
      }else if($Uyeler == "img"){
        include "user_img_edit.php";
      }
      else if($yorum=="list")
      {
        include 'yorumlar.php';
      }
      else{
         //HATA POPAPI EKLE
         include "analytics.php";
         
      } 
   ?>

  <a id="show-sidebar" class="btn btn-sm btn-dark" href="#">
    <i class="fas fa-bars"></i>
  </a>
  <nav id="sidebar" class="sidebar-wrapper">
    <div class="sidebar-content">
      
      <div class="sidebar-header">
        <div class="user-pic">
          <img class="img-responsive img-rounded" src="<?php echo $sesion["users_avatar"]; ?>"alt="User picture">
        </div>
        <div class="user-info">
          <span class="user-name" style="color:white;"><?php echo "$name $surname";?>
          </span>
          <span class="user-role"><?php echo "$authority"; ?></span>
          
            
          </span>
        </div>
      </div>
      <div class="sidebar-menu">
        <ul><center>
            <a target="_blank" href ="index.php?id=<?php echo $_SESSION["id"];?>" title="Anasayfa" class="fa fa-home activei" style="color: white; margin-right: 15px; "></a>
            <a href="admin.php?id=<?php echo $_SESSION["id"];?>" title="Admin Paneli" class="fa fa-user activei" alt="Admin Paneli" style="color: white;margin-right: 15px;"></a>
            <a href="admin.php?id=<?php echo $_SESSION["id"];?>&users=settings&user=<?php echo $_SESSION["id"];?>" title="Ayarlar" class="fa fa-cog activei" alt="Ayarlar" style="color: white; "></a>
            
          </center>
         
          <li>
            <a href="admin.php?id=<?php echo $_SESSION["id"];?>&ctgry=list">
            <?php if(@$_GET["ctgry"]){ ?>
              <i class="fa fa-th-list activei"></i>
              <span class="active">Kategoriler</span>
            <?php }else{?>
              <i class="fa fa-th-list "></i>
              <span class="">Kategoriler</span>
            <?php }?>
            </a>
          </li>
          
          <li>
            <a href="admin.php?id=<?php echo $_SESSION["id"];?>&yorum=list">
              <i class="fa fa-book"></i>
              <span>Yorumlar</span>
              <span class="badge badge-pill badge-primary">Beta</span>
            </a>
          </li>

          <li>
            <a href="admin.php?id=<?php echo $_SESSION["id"];?>&film=list">
            <?php if(@$_GET["film"]){?>
              <i class="fa fa-film activei " ></i>
              <span class="active">Filmler</span>
            <?php }else{?>
              <i class="fa fa-film " ></i>
              <span >Filmler</span>
            <?php }?>
            </a>
          </li>

          <?php if($sesion["users_authority"]==1){?>
          <li >
            <a href="admin.php?id=<?php echo $_SESSION["id"];?>&users=list">
            <?php if(@$_GET["users"]){?>
              <i class="fa fa-user activei"></i>
              <span class="active">Kullanıcılar</span>
            <?php }else{?>
              <i class="fa fa-user"></i>
              <span>Kullanıcılar</span>
            <?php }?>
            </a>
          </li>
          <?php }?>

        </ul>
      </div>
      <!-- sidebar-menu  -->
    </div>
    <!-- sidebar-content  -->
    <div class="sidebar-footer">
     
      <a href="orientation/exit.php">
        <i class="fa fa-power-off" style="color:white;"></i>
      </a>
    </div>
  </nav>
  <!-- sidebar-wrapper  -->
    
  <!-- page-content" -->
</div>

</body>

</html>