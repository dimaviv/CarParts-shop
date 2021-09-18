<?php
session_start();
include 'includes/db.php';
include 'includes/config.php';


$brands_q = mysqli_query($connection, "SELECT * FROM `brands`");
$count_q = mysqli_query($connection, "SELECT * FROM `countries`");
$cat_q = mysqli_query($connection, "SELECT * FROM `categories`");
$countries = array();
$brands = array();
$categories = array();

while ($count = mysqli_fetch_assoc($count_q)){
	$countries[] = $count;
}
while ($br = mysqli_fetch_assoc($brands_q)){
	$brands[] = $br;
}
while ($cat = mysqli_fetch_assoc($cat_q)){
	$categories[] = $cat;
}

 ?>
<!DOCTYPE html>
<!--[if IE 8]>			<html class="ie ie8"> <![endif]-->
<!--[if IE 9]>			<html class="ie ie9"> <![endif]-->
<!--[if gt IE 9]><!-->	<html> <!--<![endif]-->
<head>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-174949550-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-174949550-1');
</script>

<!-- Meta -->
<meta charset="utf-8">
<meta name="keywords" content="HTML5 Template" />
<meta name="description" content="">
<meta name="author" content="">

<title>Fortuna Trucks - best parts!</title>
<meta name="google-site-verification" content="eWceqiaTCP8_xh4zzsqNjLWK7SnxxMUYp6MrdNzEBzc" />
<!-- Mobile Metas -->
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- Favicon -->
<link rel="shortcut icon" href="images/favicon.png">

<!-- CSS -->
<link rel="stylesheet" href="css/bootstrap.css">
<link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
<link rel="stylesheet" href="js/isotope/isotope.css">
<link rel="stylesheet" href="js/flexslider/flexslider.css">
<link rel="stylesheet" href="js/owl-carousel/owl.carousel.css">
<link rel="stylesheet" href="js/owl-carousel/owl.theme.css">
<link rel="stylesheet" href="js/owl-carousel/owl.transitions.css">
<link rel="stylesheet" href="js/superfish/css/megafish.css" media="screen">
<link rel="stylesheet" href="js/superfish/css/superfish.css" media="screen">
<link rel="stylesheet" href="js/pikaday/pikaday.css">
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/dark.css">
<link rel="stylesheet" href="css/responsive.css">
<link rel="stylesheet" href="ui/jquery-ui.css">

<!-- JS Font Script -->
<script src="http://use.edgefonts.net/bebas-neue.js"></script>

<!-- Modernizer -->
<script src="js/modernizr.custom.js"></script>
<!-- AJAX -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="ui/jquery-ui.js"></script>

</head>
<body class="multi-page">

<div id="wrapper" class="wrapper">
<!-- HEADER -->
<?php include "includes/header.php"; ?>
<!-- SLIDER -->
<div class="container-fluid no-padding">
	<div id="home-slider2" class="owl-carousel owl-theme">
		<div class="item">
			<img src="images/slider/2/111.jpg" class="img-responsive" alt=""/>
			<div class="container no-padding">
				<div class="hs-caption">
					<div class="caption-inner">
						<h4>Welcome to <br><span>Fortuna Trucks</span></h4>
						<p>"Fortuna Trucks" is donec malesuada convallis neque eget varius erat faucibus quis lacus enim scelerisque vel hendrerit eget pulvinar quis.</p>
						<br>
						<a href="/shop.php" class="button btn-xs btn-center color">Каталог товаров</a>
					</div>
				</div>
			</div>
		</div>
		<div class="item">
			<img src="images/slider/2/222.jpg" class="img-responsive" alt=""/>
			<div class="container no-padding">
				<div class="hs-caption">
					<div class="caption-inner">
						<h4>Welcome to <br><span>Fortuna Trucks</span></h4>
						<p>"Fortuna Trucks" is donec malesuada convallis neque eget varius erat faucibus quis lacus enim scelerisque vel hendrerit eget pulvinar quis.</p>
						<br>
						<a href="/shop.php" class="button btn-xs btn-center color">Каталог товаров</a>
					</div>
				</div>
			</div>
		</div>
		<div class="item">
			<img src="images/slider/2/333.jpg" class="img-responsive" alt=""/>
			<div class="container no-padding">
				<div class="hs-caption">
					<div class="caption-inner">
						<h4>Welcome to <br><span>Fortuna Trucks</span></h4>
						<p>"Fortuna Trucks" is donec malesuada convallis neque eget varius erat faucibus quis lacus enim scelerisque vel hendrerit eget pulvinar quis.</p>
						<br>
						<a href="/shop.php" class="button btn-xs btn-center color">Каталог товаров</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Special offer -->
<section id="home-shop">
	<div class="container">
		<div class="col-md-12">
			<div class="h-page-title">
				<h1>Специальное предложение</h1>
			</div>
			<div class="clearfix space35"></div>

				<div id="home-shop-carousel" class="owl-carousel owl-theme">

		<?php 
		$offer = mysqli_query($connection, "SELECT * FROM `products` WHERE `raiting` BETWEEN 5 AND 10");

		while ($prod = mysqli_fetch_assoc($offer)) {
		$prod_cat = false;
		foreach ($categories as $cat)
		 {
			if ($cat['id'] == $prod['cat_id']){		
				$prod_cat = $cat;
				break;
			}
		}
		$prod_br = false;
		foreach ($brands as $br)
		 {
			if ($br['id'] == $prod['brand_id']){
				$prod_br = $br;
				break;	
			}		 		
		}
		$prod_count = false;
		foreach ($countries as $count)
		 {
			if ($count['id'] == $prod['country']){
				$prod_count = $count;
				break;
			}
		}
		if ($prod_count['id'] == null or $prod_br['name'] == null or $prod_cat == false){

		}
	

		?>
				<div class="sm-item text-center">
					<div class="product">	
						<div class="product-thumb">
							<img href="./shop-single.php?p_id=<?php echo $prod['id']?>" src="images/shop/<?php echo $prod['image']?>" class="img-responsive" alt="">
					<!-- 		<div class="product-overlay">
								<span>
									<a href="./shop-single.php?p_id=<?php echo $prod['id']?>" class="fa fa-link"></a>
									<a href="./shop-single.php?p_id=<?php echo $prod['id']?>" class="fa fa-shopping-cart"></a>
								</span>					
							</div>
 -->						</div>
						<div class="rating">
							<span class="fa fa-star act"></span>
							<span class="fa fa-star act"></span>
							<span class="fa fa-star act"></span>
							<span class="fa fa-star act"></span>
							<span class="fa fa-star act"></span>
						</div>
						<h2 class="product-title"><a href="./shop-single.php?p_id=<?php echo $prod['id']?>"><?php echo $prod_cat['name'];?></a></h2>
						<div class="product-price"><?php echo $prod['price']?> грн</div>
					</div>
				</div>
			<?php } ?>


			</div>
		</div>
	</div>
</section>

<!-- Stats -->
<!-- <section id="stats">
	<div class="stats">
		<div class="container">
			<div class="col-xs-12 col-sm-3 col-md-3">
				<h1>1500</h1>
				<img src="images/users32.png" alt="">
				<h6>Клиентов</h6>
			</div>
			<div class="col-xs-12 col-sm-3 col-md-3">
				<h1>490</h1>
				<img src="images/gear32.png" alt="">
				<h6>Проданых деталей</h6>
			</div>
			<div class="col-xs-12 col-sm-3 col-md-3">
				<h1>10</h1>
				<img src="images/bag32.png" alt="">
				<h6>Брендов</h6>
			</div>
			<div class="col-xs-12 col-sm-3 col-md-3">
				<h1>5</h1>
				<img src="images/clock32.png" alt="">
				<h6>Лет работы</h6>
			</div>
		</div>
	</div>
</section> -->

<!-- FOOTER_TOP -->
<?php include "includes/footerTop.php"?>

<!-- FOOTER_BOTTOM -->
<?php include "includes/footerBot.php"?>

<!-- Javascript -->
<?php include "includes/javascript.php"?>

</body>
</html>