<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
	<meta name="google-site-verification" content="s-uCAAiuJPmNyqOd2CmCp360y-l4m8_yysnMpD64Uf8">
	<meta name="robots" content="index, follow">
	<title>Film Arşivi</title>
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link rel="pingback" href="https://saglamindir.net/xmlrpc.php">
	<link rel="shortcut icon" type="image/x-icon" href="/favicon.ico">
	<link rel="alternate" href="https://saglamindir.net/" hreflang="tr">
	<link rel="canonical" href="https://saglamindir.net/">
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="https://saglamindir.net/wp-content/themes/saglamindir/css/main.css">
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css"
><!--[if lt IE 9]> <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script> 
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
<meta name="robots" content="max-image-preview:large">
<link rel="dns-prefetch" href="//s.w.org">
<link rel="stylesheet" id="wp-block-library-css" href="https://saglamindir.net/wp-includes/css/dist/block-library/style.min.css?ver=5.7.5" type="text/css" media="all">
<link rel="https://api.w.org/" href="https://saglamindir.net/wp-json/">
<link rel="stylesheet" href="dist/css/swiffy-slider.min.css" />
<script src="dist/js/swiffy-slider.min.js"></script>
<style>
   body{
  background-color:#FCBF49;
}
.wrapper{margin:10vh}

.card{
  border: none;
  transition: all 500ms cubic-bezier(0.19, 1, 0.22, 1);
 overflow:hidden;
 border-radius:20px;
 min-height:450px;
   box-shadow: 0 0 12px 0 rgba(0,0,0,0.2);
   
   @media (max-width: 768px) {
  min-height:350px;
}

@media (max-width: 420px) {
  min-height:300px;
}

&.card-has-bg{
  transition: all 500ms cubic-bezier(0.19, 1, 0.22, 1);
   background-size:120%;
   background-repeat:no-repeat;
   background-position: center center;
   &:before {
     content: '';
     position: absolute;
     top: 0;
     right: 0;
     bottom: 0;
     left: 0;
     background: inherit;
     -webkit-filter: grayscale(1);
   -moz-filter: grayscale(100%);
   -ms-filter: grayscale(100%);
   -o-filter: grayscale(100%);
   filter: grayscale(100%);}
 
   &:hover {
     transform: scale(0.98);
      box-shadow: 0 0 5px -2px rgba(0,0,0,0.3);
     background-size:130%;
      transition: all 500ms cubic-bezier(0.19, 1, 0.22, 1);
 
     .card-img-overlay {
       transition: all 800ms cubic-bezier(0.19, 1, 0.22, 1);
       background: rgb(35,79,109);
      background: linear-gradient(0deg, rgba(4,69,114,0.5) 0%, rgba(4,69,114,1) 100%);
      }
   }
 }
  .card-footer{
   background: none;
    border-top: none;
     .media{
      img{
        border:solid 3px rgba(234,95,0,0.3);
      }
    }
  }
  .card-meta{color:orange}
  .card-body{ 
    transition: all 500ms cubic-bezier(0.19, 1, 0.22, 1);
 }
  &:hover {
    .card-body{
      margin-top:30px;
      transition: all 800ms cubic-bezier(0.19, 1, 0.22, 1);
    }
  cursor: pointer;
  transition: all 800ms cubic-bezier(0.19, 1, 0.22, 1);
 }
  .card-img-overlay {
   transition: all 800ms cubic-bezier(0.19, 1, 0.22, 1);
  background: rgb(35,79,109);
 background: linear-gradient(0deg, rgba(35,79,109,0.3785889355742297) 0%, rgba(69,95,113,1) 100%);
 }
}

main#carousel {
  grid-row: 1 / 2;
  grid-column: 1 / 8;
  width: 100vw;
  height: 500px;
  display: flex;
  align-items: center;
  justify-content: center;
  overflow: hidden;
  transform-style: preserve-3d;
  perspective: 600px;
  --items: 5;
  --middle: 3;
  --position: 1;
  pointer-events: none;
}

div.item {
  position: absolute;
  width: 300px;
  height: 400px;
  background-color: coral;
  --r: calc(var(--position) - var(--offset));
  --abs: max(calc(var(--r) * -1), var(--r));
  transition: all 0.25s linear;
  transform: rotateY(calc(-10deg * var(--r)))
    translateX(calc(-300px * var(--r)));
  z-index: calc((var(--position) - var(--abs)));
}

div.item:nth-of-type(1) {
  --offset: 1;
  background-color: #90f1ef;
}
div.item:nth-of-type(2) {
  --offset: 2;
  background-color: #ff70a6;
}
div.item:nth-of-type(3) {
  --offset: 3;
  background-color: #ff9770;
}
div.item:nth-of-type(4) {
  --offset: 4;
  background-color: #ffd670;
}
div.item:nth-of-type(5) {
  --offset: 5;
  background-color: #e9ff70;
}

input:nth-of-type(1) {
  grid-column: 2 / 3;
  grid-row: 2 / 3;
}
input:nth-of-type(1):checked ~ main#carousel {
  --position: 1;
}

input:nth-of-type(2) {
  grid-column: 3 / 4;
  grid-row: 2 / 3;
}
input:nth-of-type(2):checked ~ main#carousel {
  --position: 2;
}

input:nth-of-type(3) {
  grid-column: 4 /5;
  grid-row: 2 / 3;
}
input:nth-of-type(3):checked ~ main#carousel {
  --position: 3;
}

input:nth-of-type(4) {
  grid-column: 5 / 6;
  grid-row: 2 / 3;
}
input:nth-of-type(4):checked ~ main#carousel {
  --position: 4;
}

input:nth-of-type(5) {
  grid-column: 6 / 7;
  grid-row: 2 / 3;
}
input:nth-of-type(5):checked ~ main#carousel {
  --position: 5;
}
.slider{
    height: 600px;
  margin: 0;
  display: grid;
  grid-template-rows: 500px 100px;
  grid-template-columns: 1fr 30px 30px 30px 30px 30px 1fr;
  align-items: center;
  justify-items: center;
}

</style>
</head>

<body>



	<div class="container">
		<header>
			<?php include 'navbar.php' ?>
			</header>
		</div>
    <div class="slider">
       <?php  include 'slider.php'?>
                        </div>
		<div class="container">
        <div class="main">
				<div class="row">
					<div class="col-md-8">
			<?php include 'icerik.php' ?>
					</div>
					<div class="col-md-4 hidden-xs">
						<?php include 'sag-icerik.php' ?>
					</div>
				</div>
			</div>
		</div>
		<div class="container">
			<script type="text/javascript" async="" src="https://www.google-analytics.com/analytics.js"></script>
			<script async="" data-cfasync="false" src="https://www.bildirnet.com/js/saglam.js"></script>
			<footer> 
				<div class="copyright"> © Film <h1>Arşivi</h1>
				</div> 
				<a href="#" title="Hak İhlali Bildirimi">Hak İhlali Bildirimi</a>
			</footer>
		</div>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" type="text/javascript"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" type="text/javascript"></script>
		<script async="" src="https://www.googletagmanager.com/gtag/js?id=UA-46755518-1" type="text/javascript"></script>
		<script type="text/javascript">window.dataLayer = window.dataLayer || [];function gtag(){dataLayer.push(arguments);}gtag('js', new Date());gtag('config', 'UA-46755518-1');</script>
	</body>
	</html>
