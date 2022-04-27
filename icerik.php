
<?php
include "database.php";

$dbfilm = $connect->prepare("SELECT * from movies ORDER BY  movies_id desc");

$dbfilm->execute(array());

$filmlistele = $dbfilm->fetchAll(PDO::FETCH_ASSOC);

foreach($filmlistele as $film){
	if($film["movies_broadcasting"]==0){

?>

						<div class="row">
							<div class="col-xs-12">
								<article class="software-primary">
									<a rel="bookmark"  href="wiev.php?id=<?php echo @$_GET["id"];?>&movie=<?php echo $film["movies_id"];?>">
										<figure>
											<img width="100" height="100" src="<?php echo $film["movies_image"];?>" class="img-responsive center-block wp-post-image"  loading="lazy">
										</figure>
										<div class="meta">
											<h4><?php echo $film["movies_name"];?></h4> 
											<p><?php echo substr($film["movies_text"],0,199);?>...</p> 
										</div> 
									</a> 
								</article>
							</div>
						</div>
<?php }}?>