
<?php
include "database.php";

$db = $connect->prepare("INSERT into movies set 
							movies_name=?,
							movies_text=?,
							movies_image=?,
							movies_url=?,
							movies_language=?,   
							movies_trailer_url=?,
							movies_category_id=?,
							movies_imdb=?,
							users_add_id=?,         
							movies_product_year=?,
							movies_broadcasting=?	
");

if($_POST){

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


					$Film_Adi = $_POST["movies_name"];
					$Film_Imdb = $_POST["movies_imdb"];
					$Film_Yili = $_POST["movies_product_year"];
					$Film_Indirme = $_POST["movies_url"];
					$Film_Fragman = $_POST["movies_trailer_url"];
					$Film_Konu = $_POST["movies_text"];
					$Film_Kategori = $_POST["movies_category_id"];
					$Film_Afis = $dosyayolu;
					$Film_Dili = $_POST["movies_language"];
					$Filmi_Ekleyen_Kullanici = $_SESSION["id"];
					$Film_Yayin_Durumu = 1;
	


					$kontrol = @$db->execute(array($Film_Adi,$Film_Konu,$Film_Afis,$Film_Indirme,$Film_Dili,$Film_Fragman,$Film_Kategori,$Film_Imdb,$Filmi_Ekleyen_Kullanici,$Film_Yili,$Film_Yayin_Durumu));
					$url= $_SESSION['id'];
					header("refresh: 1;url=admin.php?id=$url&film=list");
					/*
					if($kontrol){
						echo "OK";
					}else{
						echo "ERR";
					}
					*/
                	
            	}
        	}else{
            	echo "Yüklenirken hata oluştu";
        	}

    	}else{
			echo "tür ERR";
		}
	}


}


$dblist = $connect->prepare("SELECT * from categories ORDER BY `categories_id` DESC");

$dblist->execute(array());

$listele = $dblist->fetchAll(PDO::FETCH_ASSOC);
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
	  
		  <!-- Login Form -->
		  <form method="POST" enctype="multipart/form-data">
	
		  <input type="text" id="film-name" class="fadeIn second" name="movies_name" placeholder="Film İsmi" required>
      <input type="text" id="imbd-puan" class="fadeIn second" name="movies_imdb" placeholder="IMBD Puanı" required>
      <input type="text" id="product-year" class="fadeIn second" name="movies_product_year" placeholder="Yapım Yılı" required>
	  <input type="text" id="download-url" class="fadeIn second" name="movies_url" placeholder="İndirme Linki" required>
	  <input type="text" id="fragman-url" class="fadeIn second" name="movies_trailer_url" placeholder="Fragman Linki " required>

      <textarea class="description fadeIn second"  name="movies_text" placeholder="Film Açıklaması" required></textarea><br>
	 
      <select id="category" class="fadeIn second" name="movies_category_id" required>
	  <?php foreach($listele as $x){ ?>
            <option value='<?php echo $x["categories_id"];?>'><?php echo $x["categories_name"];?></option>
            <?php }?>
        </select>
		
		<p style="
	  color:  #606060;
	  padding: 1px 10px;
	  text-align: center;
	  text-decoration: none;
	  display: inline-block;
	  font-size: 16px;">Film Dili</p><br>
		<div class="form-check form-check-inline">
				<input class="form-check-input" type="radio" name="movies_language"  value="TR">
					<label class="form-check-label" for="inlineRadio1">Türkçe</label>
			</div>
			<div class="form-check form-check-inline">
				<input class="form-check-input" type="radio" name="movies_language"  value="ENG">
					<label class="form-check-label" for="inlineRadio2">İngilizce</label>
			</div><br>
		<p style="
	  color:  #606060;
	  padding: 15px 32px;
	  text-align: center;
	  text-decoration: none;
	  display: inline-block;
	  font-size: 16px;">Film Afişi</p>
<center>
<input name="movies_img" class="fadeIn second" style=" background-color: #f6f6f6; border: none; width: 85%; color:  #606060; padding: 1px 10px;  text-align: center; font-size: 16px; " type="file" placeholder="Film Afişi Seçiniz" required>
</center>
        <br>
		<a class=" w3-right" href="admin.php?id=<?php echo $_SESSION["id"];?>&film=list">
			<span class="w3-bar-item  btn btn-danger w3-right">Vazgeç </span></a>
			<input type="submit" class="fadeIn fourth" value="Ekle">
		  </form>
		</div>
	  </div>
</body>
</html>