
<?php

include "database.php";

$dbctgry = $connect->prepare("SELECT * from categories ORDER BY categories_name ASC");

$dbctgry->execute(array());

$ctgrylistele = $dbctgry->fetchAll(PDO::FETCH_ASSOC);


?>
<aside>
							<div class="row">
								<div class="col-sm-4 col-md-12">
									<div class="widget-box">
										<h3 class="widget-title text-center">Kategoriler</h3>
										<div class="widget-body">
											<ul class="nav">
												<?php foreach($ctgrylistele as $m){?>
												<li>
													<a href="categorylist.php?id=<?php echo @$_GET["id"];?>&ctgry_id=<?php echo $m["categories_id"];?>" ><?php echo $m["categories_name"];?></a>
												</li>
												<?php }?>
												
											</ul>
										</div>
									</div>
								</div>
							</div>
						</aside>