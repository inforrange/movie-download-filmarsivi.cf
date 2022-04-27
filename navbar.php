
<?php

include "database.php";

$ytk = $connect->prepare("SELECT * from users where users_id=?");
$ytk->execute(array(@$_GET["id"]));
$ytklist = $ytk->fetchAll(PDO::FETCH_ASSOC);




?>

<nav class="navbar navbar-main">
				<div class="navbar-header">
					<a class="navbar-brand"  href="index.php">
						<img width="180" height="80" class="img-responsive" src="assets/img/logo1.png" alt="İndir"></a>
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#saglamindir-navbar"><span class="sr-only">Toggle navigation</span>MENÜ</button>
					</div>
					<div class="collapse navbar-collapse" id="saglamindir-navbar">
						<ul class="nav navbar-nav main-ul">
							<li>
								<a class="primary" href="index.php?id=<?php echo @$_GET["id"];?>">Anasayfa</a>
							</li>
							
							
							<li class="hidden-xs">
								<h2>
									<a class="primary" href="index.php?id=<?php echo @$_GET["id"];?>">Film</a>
								</h2>
							</li>
							<li class="hidden-xs">
								<h2>
									<a class="primary" href="#">Dizi</a>
								</h2>
							</li>
							
						</ul>
						
						<ul class="nav navbar-nav main-ul" style="float:right;">
							
						<?php if(@$_GET["id"]){?>
							
							<?php foreach($ytklist as $y){ if($y["users_authority"]!=2 ){?>
								<li>
								<a title="Panele Git" class="primary" href="admin.php?id=<?php echo $_GET['id'];?>"><i class="glyphicon glyphicon-user"></i></a>
								</li>
							<?php }}?>
							<li>
							<a class="primary" href="orientation/exit.php"><i class="glyphicon glyphicon-off"></i></a>
							</li>
							
						<?php }else{?>
							<li>
							<a title="Kaydol/Giriş Yap" class="primary" href="login.php"><i class="glyphicon glyphicon-log-in"></i></a>
							</li>
						<?php }?>
						
							
							
						</ul>
					</div>
				</nav>