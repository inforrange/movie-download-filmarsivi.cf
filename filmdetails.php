<head>

</head>
<?php 
$id = $_GET["movie"];
include "database.php";
if($id){
	$db = $connect->prepare("SELECT * from movies where movies_id=?");
	$db->execute(array($id));
	$listele = $db->fetchAll(PDO::FETCH_ASSOC);
	$data = $db->rowCount();

	foreach($listele as $ctgry){
		
		$dbct = $connect->prepare("SELECT * from categories where categories_id=?");
		$dbct->execute(array($ctgry["movies_category_id"]));
	    $list_ctgry = $dbct->fetchAll(PDO::FETCH_ASSOC);

	}

	
	


}
if($data){
	foreach($listele as $m){
		
?>

<center>
<img src="<?php echo $m["movies_image"];?>" style="margin-bottom: 20px; width: 50%; height: 75% ;" alt=""> </center>
<b> <center> Genel Bakış </center></b> <br>
<p><?php echo $m["movies_text"];?></p>
<hr><center>
<p><b>Film Türü:</b> <?php foreach($list_ctgry as $ctg){if($ctg["categories_id"]==$m["movies_category_id"]){echo $ctg["categories_name"];}} ?></p><hr>
<p><b>IMDB Puanı:</b> <?php echo $m["movies_imdb"]; ?>  </p><hr>
<p><b>Yapım Yılı:</b> <?php echo $m["movies_product_year"]; ?> </p><hr>
<p> <b>FRAGMAN</b></center><hr>
						<iframe width="1309" height="500" src="<?php echo $m["movies_trailer_url"]; ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
						
						<br>
						<hr></p>
                        <a target="_blank" href="<?php echo $m["movies_url"];?>">
						<center><span style="margin-bottom:10px;" class="w3-bar-item btn btn-info  w3-right">Filmi İndir</span></center>
						</a><hr>
						<br>
						<?php include 'filmyorums.php' ?>

<?php }}?>