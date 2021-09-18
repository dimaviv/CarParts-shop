<?php
session_start();

include 'includes/db.php';
include 'includes/config.php';
require_once 'php/functions.php';

$ID = $_GET['p_id'];
$p = mysqli_query($connection, "SELECT * FROM `products` WHERE `id` = $ID");
$s_prod = mysqli_fetch_assoc($p);

$prod_cat_id = $s_prod['cat_id'];
$prod_brand = $s_prod['brand_id'];
$prod_country = $s_prod['country'];
$c = mysqli_query($connection, "SELECT * FROM `categories` WHERE `id` = $prod_cat_id");

$ct = mysqli_query($connection, "SELECT * FROM `countries` WHERE `id` = $prod_country");
$b = mysqli_query($connection, "SELECT * FROM `brands` WHERE `id` = $prod_brand");
$p_cat = mysqli_fetch_assoc($c);
$p_brand = mysqli_fetch_assoc($b);
$p_country = mysqli_fetch_assoc($ct);
$prod_cat_main = $p_cat['parent_id'];
$mc = mysqli_query($connection, "SELECT * FROM `categories` WHERE `id` = $prod_cat_main");

$p_main_cat = mysqli_fetch_assoc($mc);


$qnt = $_POST['hidden_quantity'];
if ( isset($_GET['id']) &&  $_GET['action'] == 'add' ) {
	$current_added_item = get_course_by_id($_GET['id']);
	for ($i=0; $i < $qnt; $i++) { 
		$_SESSION['cart_list'][] = $current_added_item;
	}
	// echo '<script>window.location="'.$url_return.'"</script>';
	
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
	<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/themes/ui-lightness/jquery-ui.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/light.css">
	<link rel="stylesheet" href="css/responsive.css">

	<!-- JS Font Script -->
	<script src="http://use.edgefonts.net/bebas-neue.js"></script>

	<!-- Modernizer -->
	<script src="js/modernizr.custom.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

</head>
<body class="multi-page">

<div id="wrapper" class="wrapper">
	<!-- HEADER -->
	<?php include "includes/header.php"; ?>
	<div class="close-btn fa fa-times"></div>
	
	<!-- SHOP CONTENT -->
	<section id="content">
		<div class="content-blog">
			<div class="container">
				<div class="row">
					<div class="page_header text-center">
						<h1><?php echo $s_prod['name']?></h1>						
					</div>
					<div class="col-md-10 col-md-offset-1">

					<div class="row">
						<div class="col-md-5">
							<div class="gal-wrap">
								<!-- <div id="gal-slider" class="flexslider"> -->
									<ul class="slides">
										<img src="images/shop/<?php echo $s_prod['image']?>" class="img-responsive" alt=""/></li>
									</ul>
								</div>

								<!-- <ul class="gal-nav">
									<li>
										<div>
											<img src="images/shop/pump2.jpg" class="img-responsive" alt=""/>
										</div>
									</li>
								</ul> -->
								<div class="clearfix"></div>
							<!-- </div> -->
						</div>
						<div class="col-md-7 product-single">
							<h2 class="product-single-title no-margin"><?php echo $p_brand['name'];?></h2>
							<div class="space10"></div>
							<div class="p-price"><?php echo $s_prod['price']?> грн</div>
							<p>Артикул: <?php echo $s_prod['article']?></p>
							<div class="product-quantity">
								<span>Кол-во:</span>
							 	 <!-- <form id="cart_form" action="shop-single.php?<?php echo $_SERVER['QUERY_STRING'];?>&action=add&id=<?php echo $ID?>" method="post">	 -->
							 	   <input type="text" id="qnt" min="1" max="20" name="hidden_quantity" value="1" readonly/>

							</div>
							<div class="shop-btn-wrap">
								<button type="submit" id="" form="cart_form" name="addto_cart"><a id="ShowCart1" class="button btn-small product_link_id" data-id="<?php echo $s_prod['id']?>">В корзину</a></button>
								
							</div>
							</form>
							<div class="product-meta">
								<span>Категория: <a href="#"><?php echo $p_main_cat['name'];?></a></span><br>
								<span><p><?php if ($s_prod['available'] == 1){
									echo "Есть в наличии";
								}else{
									echo "Нет в наличии";

								}



								?></p></span><br>
							
							</div>
						</div>
					</div>
					<div class="clearfix space30"></div>
					<div class="tab-style3">
						<!-- Nav Tabs -->
						<div class="align-center mb-40 mb-xs-30">
							<ul class="nav nav-tabs tpl-minimal-tabs animate">
								<li class="active col-md-4">
									<a aria-expanded="true" href="#mini-one" data-toggle="tab">Описание</a>
								</li>
								<!-- <li class="col-md-4">
									<a aria-expanded="false" href="#mini-two" data-toggle="tab">Product Info</a>
								</li> -->
								<!-- <li class="col-md-4">
									<a aria-expanded="false" href="#mini-three" data-toggle="tab">Reviews</a>
								</li> -->
							</ul>
						</div>
						<!-- End Nav Tabs -->
						<!-- Tab panes -->
						<div style="height: auto;" class="tab-content tpl-minimal-tabs-cont align-center section-text">
							<div style="" class="tab-pane fade active in" id="mini-one">
								<p><?php echo $s_prod['description'];?></p>
								<table class="table tba2">
									<tbody>
										<tr>
											<!-- <td>Применение:</td>
											<td></td> -->
										</tr>
										<tr>
											<td>Бренд</td>
											<td><?php echo $p_brand['name']?></td>
										</tr>
										<tr>
											<td>Страна производителя:</td>
											<td><?php echo $p_country['name']?></td>
										</tr>
										<tr>
											<td>Артикул:</td>
											<td><?php echo $s_prod['article']?></td>
										</tr>
										<tr>
											<td>Оригинальный номер:</td>
											<td><?php echo $s_prod['original_num']?></td>
										</tr>
									</tbody>
								</table>
							</div>
							<!-- <div style="" class="tab-pane fade" id="mini-two">
								<table class="table tba2">
									<tbody>
										<tr>
											<td>Sizes</td>
											<td>M, L, XL, XXL</td>
										</tr>
										<tr>
											<td>Prodused in</td>
											<td>USA</td>
										</tr>
										<tr>
											<td>Material</td>
											<td>plastic, textile</td>
										</tr>
										<tr>
											<td>Colors</td>
											<td>red, black, grey</td>
										</tr>
										<tr>
											<td>Dimension</td>
											<td>20x40x33</td>
										</tr>
										<tr>
											<td>Type</td>
											<td>bag</td>
										</tr>
										<tr>
											<td>Weight</td>
											<td>0.35kg</td>
										</tr>
									</tbody>
								</table>
							</div> -->
							<!-- <div style="" class="tab-pane fade" id="mini-three">
								<div class="col-md-12">
									<h4 class="uppercase space35">3 Reviews for Shaving Knives</h4>
									<ul class="comment-list">
										<li>
											<a class="pull-left" href="#"><img class="comment-avatar" src="images/quote/1.jpg" alt="" height="50" width="50"></a>
											<div class="comment-meta">
												<a href="#">John Doe</a>
												<span>
												<em>Feb 17, 2015, at 11:34</em>
												</span>
											</div>
											<div class="rating2">
												<span>&#9733;</span><span>&#9733;</span><span>&#9733;</span><span>&#9733;</span><span>&#9733;</span>
											</div>
											<p>
												Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed auctor sit amet urna nec tempor. Nullam pellentesque in orci in luctus. Sed convallis tempor tellus a faucibus. Suspendisse et quam eu velit commodo tempus.
											</p>
										</li>
										<li>
											<a class="pull-left" href="#"><img class="comment-avatar" src="images/quote/2.jpg" alt="" height="50" width="50"></a>
											<div class="comment-meta">
												<a href="#">Rebecca</a>
												<span>
												<em>March 08, 2015, at 03:34</em>
												</span>
											</div>
											<div class="rating2">
												<span>&#9733;</span><span>&#9733;</span><span>&#9733;</span><span>&#9733;</span><span>&#9734;</span>
											</div>
											<p>
												Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed auctor sit amet urna nec tempor. Nullam pellentesque in orci in luctus. Sed convallis tempor tellus a faucibus. Suspendisse et quam eu velit commodo tempus.
											</p>
										</li>
										<li>
											<a class="pull-left" href="#"><img class="comment-avatar" src="images/quote/1.jpg" alt="" height="50" width="50"></a>
											<div class="comment-meta">
												<a href="#">Antony Doe</a>
												<span>
												<em>June 11, 2015, at 07:34</em>
												</span>
											</div>
											<div class="rating2">
												<span>&#9733;</span><span>&#9733;</span><span>&#9733;</span><span>&#9733;</span><span>&#9734;</span>
											</div>
											<p>
												Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed auctor sit amet urna nec tempor. Nullam pellentesque in orci in luctus. Sed convallis tempor tellus a faucibus. Suspendisse et quam eu velit commodo tempus.
											</p>
										</li>
									</ul>
									<h4 class="uppercase space20">Add a review</h4>
									<form id="form" class="review-form">
										<div class="row">
											<div class="col-md-6 space20">
												<input name="name" class="input-md form-control" placeholder="Name *" maxlength="100" required="" type="text">
											</div>
											<div class="col-md-6 space20">
												<input name="email" class="input-md form-control" placeholder="Email *" maxlength="100" required="" type="email">
											</div>
										</div>
										<div class="space20">
											<span>Your Ratings</span>
											<div class="clearfix"></div>
											<div class="rating3">
												<span>&#9734;</span><span>&#9734;</span><span>&#9734;</span><span>&#9734;</span><span>&#9734;</span>
											</div>
											<div class="clearfix space20"></div>
										</div>
										<div class="space20">
											<textarea name="text" id="text" class="input-md form-control" rows="6" placeholder="Add review.." maxlength="400"></textarea>
										</div>
										<button type="submit" class="button btn-small">
										Submit Review
										</button>
									</form>
								</div>
								<div class="clearfix space30"></div>
							</div> -->
						</div>
					</div>
					<div class="space30"></div>
<!-- 					<div class="related-products">
						<h4 class="heading">Related Products</h4>
						<hr>
						<div class="row">
													<div id="shop-mason" class="shop-mason-3col">
								<div class="sm-item isotope-item">
									<div class="product">
										<div class="product-thumb">
											<img src="images/shop/1.jpg" class="img-responsive" alt="">
											<div class="product-overlay">
												<span>
												<a href="./shop-single-full.html" class="fa fa-link"></a>
												<a href="./shop-single-full.html" class="fa fa-shopping-cart"></a>
												</span>					
											</div>
										</div>
										<div class="rating">
											<span class="fa fa-star act"></span>
											<span class="fa fa-star act"></span>
											<span class="fa fa-star act"></span>
											<span class="fa fa-star act"></span>
											<span class="fa fa-star act"></span>
										</div>
										<h2 class="product-title"><a href="#">Shave Knives</a></h2>
										<div class="product-price">$79.00<span>$200.00</span></div>
									</div>
								</div>
								<div class="sm-item isotope-item">
									<div class="product">
										<div class="product-thumb">
											<img src="images/shop/2.jpg" class="img-responsive" alt="">
											<div class="product-overlay">
												<span>
												<a href="./shop-single-full.html" class="fa fa-link"></a>
												<a href="./shop-single-full.html" class="fa fa-shopping-cart"></a>
												</span>					
											</div>
										</div>
										<div class="rating">
											<span class="fa fa-star act"></span>
											<span class="fa fa-star act"></span>
											<span class="fa fa-star act"></span>
											<span class="fa fa-star act"></span>
											<span class="fa fa-star"></span>
										</div>
										<h2 class="product-title"><a href="#">Comb Scissors</a></h2>
										<div class="product-price">$79.00<span>$200.00</span></div>
									</div>
								</div>
								<div class="sm-item isotope-item">
									<div class="product">
										<div class="product-thumb">
											<img src="images/shop/3.jpg" class="img-responsive" alt="">
											<div class="product-overlay">
												<span>
												<a href="./shop-single-full.html" class="fa fa-link"></a>
												<a href="./shop-single-full.html" class="fa fa-shopping-cart"></a>
												</span>					
											</div>
										</div>
										<div class="rating">
											<span class="fa fa-star act"></span>
											<span class="fa fa-star act"></span>
											<span class="fa fa-star act"></span>
											<span class="fa fa-star act"></span>
											<span class="fa fa-star act"></span>
										</div>
										<h2 class="product-title"><a href="#">Water Spray</a></h2>
										<div class="product-price">$79.00<span>$200.00</span></div>
									</div>
								</div>
							</div>
					
						</div>
					</div> -->
					
					
					</div>
				</div>
			</div>
		</div>
	</section>

	<div class="clearfix space70"></div>

<!-- FOOTER_TOP -->
<?php include "includes/footerTop.php"?>

<!-- FOOTER_BOTTOM -->
<?php include "includes/footerBot.php"?>

<!-- Javascript -->
<?php include "includes/javascript.php"?>


</body>
</html>
