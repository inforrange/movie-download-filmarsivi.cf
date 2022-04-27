<?php 
include "database.php";

$db = $connect->prepare("SELECT * from movies ORDER BY 'movies_id' DESC");

$db->execute(array());

$listele = $db->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" id="wp-block-library-css" href="https://saglamindir.net/wp-includes/css/dist/block-library/style.min.css?ver=5.7.4" type="text/css" media="all">

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
	<meta name="google-site-verification" content="s-uCAAiuJPmNyqOd2CmCp360y-l4m8_yysnMpD64Uf8">
	<meta name="robots" content="index, follow">

	<meta name="description" content="Saglamindir.net, Microsoft Windows işletim sistemine sahip bilgisayarınız için, ücretsiz oyun ve program indirebileceğiniz sade bir indirme sitesidir.">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link rel="pingback" href="https://saglamindir.net/xmlrpc.php">
	<link rel="shortcut icon" type="image/x-icon" href="/favicon.ico">
	<link rel="alternate" href="https://saglamindir.net/" hreflang="tr">
	<link rel="canonical" href="https://saglamindir.net/">
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="https://saglamindir.net/wp-content/themes/saglamindir/css/main.css">
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css"><!--[if lt IE 9]> <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script> <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
	<meta name="robots" content="max-image-preview:large">
	<link rel="dns-prefetch" href="//s.w.org">
	<link rel="stylesheet" id="wp-block-library-css" href="https://saglamindir.net/wp-includes/css/dist/block-library/style.min.css?ver=5.7.4" type="text/css" media="all">
	<link rel="https://api.w.org/" href="https://saglamindir.net/wp-json/">

</head>
<body>
<div class="main">
	<div class="row">
		<div class="col-md-12">
			<?php foreach($listele as $m){?>
			<div class="row">
					<article class="software-primary">
						<a rel="bookmark" title="<?php echo $m["movies_name"];?> İndir" href="wiev.php?movie_id=<?php echo $m["movies_id"];?>">
								<img width="70%" height="100%" src="<?php echo $m["movies_image"];?>" class=" wp-post-image" alt="pes 2021" loading="lazy">
							<div class="meta">
								<h4><?php echo $m["movies_name"];?></h4> 
								<p><?php echo $m["movies_text"];?></p> 
							</div>
						</a>
					</article>
			</div>
			<?php }?>
			
		
	
				
			</div>
			
		</div>
	</div>
</div>
	</body>
</html>