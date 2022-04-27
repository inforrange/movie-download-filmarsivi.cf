<?php

include "database.php";

 $yrm = $connect->prepare("SELECT * from comment where comment_movies_id=? ORDER BY comment_id DESC");
  $yrm->execute(array(@$_GET["movie"]));
  $listyrm = $yrm->fetchAll(PDO::FETCH_ASSOC);

  $yrmdzn = $connect->prepare("UPDATE comment set comment_text=? where comment_id=?");
  
  $dbusr = $connect->prepare("SELECT * from users ORDER BY users_id DESC");
  $dbusr->execute(array());
  $listusr = $dbusr->fetchAll(PDO::FETCH_ASSOC);

  
$cmt = $connect->prepare("INSERT into comment set 
                                    comment_text=?,
                                    comment_users_id=?,
                                    comment_movies_id=?,
                                    comment_status_id=?
                
");

if($_POST){
  $text = $_POST["comment_text"];
  $id = $_GET["id"];
  $movie_id = $_GET["movie"];
  $st=0;
  $cmt->execute(array($text,$id,$movie_id,$st));
  

}

$delcmnt = $connect->prepare("DELETE from comment where comment_id=? ");

if(@$_GET["yrm"]=="dell"){

  $delcmnt->execute(array(@$_GET["yrm_id"]));
  
}

if(@$_GET["yrm"]=="edt"){

  $yrmdzn->execute(array(@$_POST["comment_edt_text"],@$_GET["yrm_id"]));

}



?>
<!DOCTYPE html>
<html>
<head><meta name="viewport" content="width=device-width, initial-scale=1">

	<title></title>
   <style>
       * {
  box-sizing: border-box;
}
textarea {
  margin:10px;
  height: 150px;
  -moz-border-bottom-colors: none;
  -moz-border-left-colors: none;
  -moz-border-right-colors: none;
  -moz-border-top-colors: none;
  background: none repeat scroll 0 0 rgba(0, 0, 0, 0.07);
  border-image: none;
  border-radius: 6px 6px 6px 6px;
  border-style: none;
  color: #555555;
  font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
  font-size: 1em;
  line-height: 1.4em;
  padding: 5px 8px;
  transition: background-color 0.2s ease 0s;
}


textarea:focus {
    background: none repeat scroll 0 0 #FFFFFF;
    outline-width: 0;
}
/* Create two equal columns that floats next to each other */
.column {
  float: left;
  width: 100%;
  padding: 10px;
  margin:10px;
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}
.button {
  background-color: DodgerBlue; /* Green */
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
  -webkit-transition-duration: 0.4s; /* Safari */
  transition-duration: 0.4s;
}



.button2:hover {
  box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24),0 17px 50px 0 rgba(0,0,0,0.19);
}
   </style>
</head>
<body>






<div class="row">
  <?php if(@$_GET["yrm"]=="edt"){
     foreach($listyrm as $y){
      if($y["comment_id"]==@$_GET["yrm_id"]){
    ?>
<form method="POST">
  <textarea required name="comment_text"  placeholder="Film ile ilgili yorumlarınızı yazınız..." style="box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);" rows="20" cols="88" class="ui-autocomplete-input" autocomplete="off" role="textbox" aria-autocomplete="list" aria-haspopup="true"> <?php echo $y["comment_text"];?> </textarea>
  <button style="margin-bottom:10px; float:right;  box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);" class="w3-bar-item btn btn-info ">Yorum Düzenle</button>
  </form>
  <?php }
  }
}else{?>
    <form method="POST">
  <textarea required name="comment_text"  placeholder="Film ile ilgili yorumlarınızı yazınız..." style="box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);" rows="20" cols="88" class="ui-autocomplete-input" autocomplete="off" role="textbox" aria-autocomplete="list" aria-haspopup="true"> </textarea>
  <button style="margin-bottom:10px; float:right;  box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);" class="w3-bar-item btn btn-info ">Yorum Yap</button>
  </form>
  <?php }?>



<?php foreach($listyrm as $m){
  if($m["comment_status_id"]==1){?>
<div class="column" style="box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);">

    <h4 style="margin-bottom:5px; margin-top:5px;"><?php foreach($listusr as $usr){ 
      if($m["comment_users_id"]==$usr["users_id"]){
         echo $usr["users_name"]," ",$usr["users_surname"];
         
        } 
      }?></h4> 
      <?php echo $m["comment_text"];?> <br>
    <sub style="float:right; font-size:12px; "><?php echo $m["comment_add_time"];?></sub><br>

    <?php if($m["comment_users_id"]==$_GET["id"]){?>
    <a class=" w3-right" href="wiev.php?id=<?php echo $_GET["id"];?>&movie=<?php echo $_GET["movie"];?>&yrm=dell&yrm_id=<?php echo $m["comment_id"];?>">
    <span title="Sil" class="w3-bar-item  btn btn-danger fa fa-trash w3-right" style="float:right; margin-top:5px;"></span></a>
    <a class=" w3-right" href="wiev.php?id=<?php echo $_GET["id"];?>&movie=<?php echo $_GET["movie"];?>&yrm=edt&yrm_id=<?php echo $m["comment_id"];?>">
    <span title="Düzenle" class="w3-bar-item  btn btn-success fa fa-edit w3-right" style="background-color: #1C6DD0; float:right; margin-top:5px;"></span></a>
  <?php }?>
  </div>
  <?php }}?>
</div>


<br>
 
   
        

</body>
</html>