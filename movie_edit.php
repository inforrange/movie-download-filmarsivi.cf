
<?php
include "database.php";


$dblist = $connect->prepare("SELECT * from movies where movies_id=?");

$dblist->execute(array($_GET["movies_id"]));

$listele = $dblist->fetchAll(PDO::FETCH_ASSOC);
$data = $dblist->rowCount();

if($_POST){

    
                        
    if(@$_GET["afs"]=="edt"){   
        $db = $connect->prepare("UPDATE movies set 
        movies_name=?, 
        movies_text=?, 
        movies_image=?, 
        movies_url=?, 
        movies_language=?, 
        movies_trailer_url=?, 
        movies_category_id=?, 
        movies_imdb=?,
        movies_product_year=?  where movies_id=?");
        foreach($listele as $m){
            $img_del = unlink($m["movies_image"]);
        }
        

	    $maxboyut = 5000000;
	    $dosyauzantisi = substr($_FILES["movies_img"]["name"],-4,4);
	    $dosyaadi = rand(0,99999).$dosyauzantisi;
	    $dosyayolu = "movies_img/".$dosyaadi;

	    if($_FILES["movies_img"]["size"]>$maxboyut){
        	echo "Dosya boyutu 500kb den büyük olamaz";
    	}else{
        	$d=$_FILES["movies_img"]["type"];
    	    if($d=="image/jpeg" || $d=="image/png" || $d=="image/gif"){
            	if(is_uploaded_file($_FILES["movies_img"]["tmp_name"])){
                	$x = move_uploaded_file($_FILES["movies_img"]["tmp_name"],$dosyayolu);
                	if($x){
					
                    	/*
				    	echo "Yükleme başarılı..<br>";
					    $dosyayolu;
					    */
                        $db->execute(array($_POST["movies_name"],$_POST["movies_text"],$dosyayolu,$_POST["movies_url"],$_POST["movies_language"],$_POST["movies_trailer_url"],$_POST["movies_category_id"],$_POST["movies_imdb"],$_POST["movies_product_year"],$_GET["movies_id"]));
                        $url= $_SESSION['id'];
  header("refresh: 1;url=admin.php?id=$url&film=list");

                	
            	    }
        	    }else{
                	echo "Yüklenirken hata oluştu";
            	}

    	    }else{
			    echo "tür ERR";
		    }
	    }                 
	
    }else{
        $db2 = $connect->prepare("UPDATE movies set 
                     movies_name=?, 
                     movies_text=?,  
                     movies_url=?, 
                     movies_language=?, 
                     movies_trailer_url=?, 
                     movies_category_id=?, 
                     movies_imdb=?,
                     movies_product_year=?  where movies_id=?");
        $db2->execute(array($_POST["movies_name"],$_POST["movies_text"],$_POST["movies_url"],$_POST["movies_language"],$_POST["movies_trailer_url"],$_POST["movies_category_id"],$_POST["movies_imdb"],$_POST["movies_product_year"],$_GET["movies_id"]));
        $url= $_SESSION['id'];
        header("refresh: 1;url=admin.php?id=$url&film=list");
    }

}

$db3 = $connect->prepare("SELECT * from categories ORDER BY `categories_id` DESC");

$db3->execute(array());

$ctgry = $db3->fetchAll(PDO::FETCH_ASSOC);

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
		  <div class="fadeIn first">
			<br>
		  </div>
	  
          <?php foreach($listele as $m){?>
		  <form method="POST" enctype="multipart/form-data">
	  <!-- Login Form -->
      <p style="
	  color:  #606060;
	  padding: 1px 1px;
	  text-align: center;
	  text-decoration: none;
	  display: inline-block;
	  font-size: 1px;"><img src="<?php echo $m["movies_image"]?>" alt="Admin" class="rounded" width="150" style="padding: 5px;"> </p>
      
      
      <?php if(@$_GET["afs"]=="edt"){?>
        <p><a href="admin.php?id=<?php echo $_SESSION["id"];?>&film=settings&movies_id=<?php echo $m["movies_id"];?>">İptal</a></p>
        <center>
            <input value="<?php echo $m["movies_image"];?>" name="movies_img" class="fadeIn second" style=" background-color: #f6f6f6; border: none; width: 85%; color:  #606060; padding: 1px 10px;  text-align: center; font-size: 16px; " type="file" placeholder="Film Afişi Seçiniz" required>
        </center>
        <?php }else{?>
            <p><a href="admin.php?id=<?php echo $_SESSION["id"];?>&film=settings&movies_id=<?php echo $m["movies_id"];?>&afs=edt">Afişi Düzenle</a></p>
            <?php }?>

		  <input type="text" id="film-name" class="fadeIn second" value="<?php echo $m["movies_name"];?>"  name="movies_name" placeholder="Film İsmi" required>
          <input type="text" id="imbd-puan" class="fadeIn second" value="<?php echo $m["movies_imdb"];?>" name="movies_imdb" placeholder="IMBD Puanı" required>
          <input type="text" id="product-year" class="fadeIn second" value="<?php echo $m["movies_product_year"];?>" name="movies_product_year" placeholder="Yapım Yılı" required>
	      <input type="text" id="download-url" class="fadeIn second" value="<?php echo $m["movies_url"];?>" name="movies_url" placeholder="İndirme Linki" required>
	      <input type="text" id="fragman-url" class="fadeIn second" value="<?php echo $m["movies_trailer_url"];?>" name="movies_trailer_url" placeholder="Fragman Linki " required>

      <textarea class="description fadeIn second" value=""  name="movies_text" placeholder="Film Açıklaması" required><?php echo $m["movies_text"];?></textarea><br>
	 
      <select id="category" class="fadeIn second" name="movies_category_id" required>
      <?php foreach($ctgry as $x){ ?>
            <option value='<?php echo $x["categories_id"];?>'<?php if($x["categories_id"]==$m["movies_category_id"]){?> selected <?php }?>><?php echo $x["categories_name"];?></option>
            <?php }?>
          
        </select>
		
		<p style="
	  color:  #606060;
	  padding: 1px 10px;
	  text-align: center;
	  text-decoration: none;
	  display: inline-block;
	  font-size: 16px;">Film Dili</p><br>
      <?php if($m["movies_language"]=="TR"){?>
		<div class="form-check form-check-inline">   
				<input class="form-check-input" type="radio" name="movies_language"  value="TR" checked>
                <label class="form-check-label" for="inlineRadio1">Türkçe</label>		
			</div>
			<div class="form-check form-check-inline">
				<input class="form-check-input" type="radio" name="movies_language"  value="ENG">
				<label class="form-check-label" for="inlineRadio2">İngilizce</label>
			</div>
            <?php }else{?>
                <div class="form-check form-check-inline">   
				<input class="form-check-input" type="radio" name="movies_language"  value="TR" >
                <label class="form-check-label" for="inlineRadio1">Türkçe</label>		
			</div>
			<div class="form-check form-check-inline">
				<input class="form-check-input" type="radio" name="movies_language"  value="ENG" checked>
				<label class="form-check-label" for="inlineRadio2">İngilizce</label>
			</div>
                <?php }?>
            <br>
	
        <br>
      
		<a class=" w3-right" href="admin.php?id=<?php echo $_SESSION["id"];?>&film=list">
			<span class="w3-bar-item  btn btn-danger w3-right">Vazgeç </span></a>
			<input type="submit" class="fadeIn fourth" value="Ekle">
		  </form>
          <?php }?>
		</div>
	  </div>
</body>
</html>