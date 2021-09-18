<?php
session_start();
include 'includes/db.php';
include 'includes/config.php';
require_once 'php/functions.php';

error_reporting(0);


// $url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
if ( isset($_GET['delete_id']) && isset($_SESSION['cart_list']) ) {
	foreach ($_SESSION['cart_list'] as $key => $value) {
		if ( $value['id'] == $_GET['delete_id'] ) {
			unset($_SESSION['cart_list'][$key]);
		}		
	}
}


if ( isset($_GET['course_id']) && !empty($_GET['course_id']) ) {

	$current_added_course = get_course_by_id($_GET['course_id']);

	// ...
	if ( !empty($current_added_course) ) {

		if ( !isset($_SESSION['cart_list'])) {
			$_SESSION['cart_list'][] = $current_added_course;
		}


		$course_check = false;

		if ( isset($_SESSION['cart_list']) ) {
			foreach ($_SESSION['cart_list'] as $value) {
				if ( $value['id'] == $current_added_course['id'] ) {
					$course_check = true;
				}
			}
		}


		if ( !$course_check ) {
			$_SESSION['cart_list'][] = $current_added_course;
		}

	} else {
		header("Location: 404.php");
	}
	
}


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

$f_cat = $_GET['category'];

$needs_cat = array();
// print_r($categories[$f_cat]);
$k = 3;
if ($f_cat) {
	while ($cat = $categories) {
		if($cat['id']=$f_cat){
			if($cat['parent_id'] == 0){
				foreach ($categories as $ct){
					if ($ct['parent_id'] == $f_cat){
						$needs_cat[] = $ct;
					}	
				}
				if ($needs_cat === Array()) {
					$k=0;
					break;
				}else{
					$categories = $needs_cat;
					$k=1;
					break;	
				}
						
				}
				else{
					break;
				}
			}
			else{
				break;
				}	
	}
}



$get_sort = $_GET['sort'];
$sorting = $_GET['sort'];

switch ($sorting) {
 	case 'price-asc':
 	$sort = 'price-asc';
 	$sorting = 'price ASC';
 	$sort_name = 'По цене, сначала дешевые';
 		break;
 	
 	case 'price-desc':
 	$sort = 'price-desc';
 	$sorting = 'price DESC';
 	$sort_name = 'По цене, сначала дорогие';
 		break;

 	case 'raiting-desc':
 	$sort = 'raiting-desc';
 	$sorting = 'raiting DESC';
 	$sort_name = 'По популярности';
 		break;

 	default:
 	$sorting = 'raiting DESC';
 		break;	
 }


$get_cat = $_GET['category'];


$sub_category = mysqli_query($connection, "SELECT * FROM `categories` WHERE `id`= $get_cat");
$sub_category = mysqli_fetch_assoc($sub_category);


if ($sub_category['parent_id'] == 0) {
	$main_category = $sub_category['name'];
	$main_cat_id = $sub_category['id'];
	unset($sub_category);
}
else{
	$parent_id = $sub_category['parent_id'];
	$main_category = mysqli_query($connection, "SELECT * FROM `categories` WHERE `id`= $parent_id");
	$main_category_asc = mysqli_fetch_assoc($main_category);
	$sub_category = $sub_category['name'];
	$main_category = $main_category_asc['name'];
	$main_cat_id = $main_category_asc['id'];
	
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
	<!-- <meta http-equiv="Cache-Control" content="private"> -->
	<title>Fortuna Trucks</title>

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
	<div id="reload">
	<?php include "includes/header.php"; ?>
	</div>

	<div class="close-btn fa fa-times"></div>
	
	<!-- SHOP CONTENT -->
	<section id="content">
		<div class="content-blog">
			<div class="container">
				<div class="row">
					<div class="page_header text-center">
						<?php if(isset($_GET['category'])){
	
						?>
						<div class="category-tree">
								<ul><a href="shop.php?category=<?php echo($main_cat_id); ?>"><?php echo($main_category);?></a></ul><?php
								if (isset($sub_category)) {
								 	?><li class="separation">/</li><ul><?php echo($sub_category);
								 } ?> 
								</ul>
						</div>
							<?php
						}
							?>
						<div class="col-md-4">
							
                           <form action="" method="get">
                    <select id="select-sort" name="sort" class="form-control" onchange="location = this.value;">

                    	<option value="shop.php?category=<?php echo $f_cat;?>&sort=raiting-desc" <?php if ($sorting == 'raiting DESC') echo 'selected'?>>По популярности</option>
                        <option value="shop.php?category=<?php echo $f_cat;?>&sort=price-asc" <?php if ($sorting == 'price ASC') echo 'selected'?>>По цене, сначала дешевые</option>
                        <option value="shop.php?category=<?php echo $f_cat;?>&sort=price-desc" <?php if ($sorting == 'price DESC') echo 'selected'?>>По цене, сначала дорогие</option>

                    </select>
                    </form>
               		 </div>
						</div>
					<div class="col-md-3">
						<form action="" method="post">
						<div class="side-widget">
							<script type="text/javascript">
								function moreBr() {
									var more = document.getElementById("more");
									var btn = document.getElementById("btnMore");

									if (more.style.display === "inline") {
										btn.innerHTML="Больше";
										more.style.display="none";
										
									}else {
										btn.innerHTML="Скрыть";
										more.style.display="inline";
										
										
									}
								}
								function moreCnt() {
									var more = document.getElementById("moreC");
									var btn = document.getElementById("btnMoreC");

									if (more.style.display === "inline") {
										btn.innerHTML="Больше";
										more.style.display="none";
										
									}else {
										btn.innerHTML="Скрыть";
										more.style.display="inline";
										
										
									}
								}
							</script>
                   			 <h5>Производитель</h5>


                   	 <div id="brands">
                   	 	<?php
                   	 	$b_qnt = 0;
                   	 	 foreach ($brands as $br) {	
                   	 	 $b_qnt++;				
							?>
                  		
                        <div class="checkbox"><label><input type="checkbox"  name="brands[]" value="<?php echo $br['id']?>"><?php echo $br['name']?></label></div> 
                  
                    <?php
                    if ($b_qnt == 10) {
                    	?><span id="more">

                    		<?php
                    }
                     }
                     if ($b_qnt > 10) {
                     	?> </span>
                     	<button class="moreBtn" type="button" id="btnMore" onclick="moreBr()">Больше</button>
                     	<?php
                     }
                     ?>
                    </div>
                    	<br>
                    	<br>

                    	<h5>Страна производителя</h5>
					<div id="countries">
						<?php 
						$c_qnt = 0;
						foreach ($countries as $cnt) {
						$c_qnt++;					
							?>
						
                        <div class="checkbox"><label><input type="checkbox" name="countries[]" value="<?php echo $cnt['id'];?>"> <?php echo $cnt['name'];?></label></div>
                    <?php
                    	if ($c_qnt == 10) {
                    	?><span id="moreC">
                    		<?php
                    	}
                    }
                    if ($c_qnt > 10) {
                    	?> </span>
                     	<button class="moreBtn" type="button" id="btnMoreC" onclick="moreCnt()">Больше</button>
                     	<?php
                    	
                    }
                    $fil_count = array();
                    $fil_brand = array();
                    if ($_POST['countries']) {
                    	foreach ($_POST['countries'] as $con) {
                    	$fil_count[] = $con;
                    	}
               		 }
                    if ($_POST['brands']) {
                    	foreach ($_POST['brands'] as $br) {
                    	$fil_brand[] = $br;
                   		}
                    }
                     ?>
             
                 </div>
						</div>
						<div class="clearfix space30"></div>
						<div class="side-widget">
							<h5>Цена</h5>
					<div id="slider-container"></div>
					<br>
					<p>
						<input type="submit" class="button btn-xs pull-left" value="Фильтр">
						<span class="pull-right sc-range">
							<label class="range-label" for="amount">Цена:</label>
							<input type="text" name="range" id="amount" style="border: 0; color: #333333; font-weight: bold;" />
						<?php 

							$range = $_POST['range'];
							$n=0;
							for ($i=0; $i < strlen($range); $i++) { 
								if ($range[$i] != " "  && $range[$i] != "-" && $n<3){
									$min .= $range[$i]; 
								}
								elseif ($range[$i] != " " && $range[$i] != "-" && $n>=3){
									$max .= $range[$i]; 
								}
								else{
									$n++;
								}
							}
							if ($min == nul or $max == null) {
								$min = 0;
								$max = 50000;
							}

						?>
						</span>
						</form>
					</p>
						</div>
						<div class="clearfix space30"></div>

					<!-- 	<div class="side-widget widget_popular_products">
							<h5>Popular Items</h5>

						<ul>
							<li>
								<div class="product-thumbs">
									<img src="images/shop/1.jpg" alt="">
								</div>
								<div class="product-post-info">
									<h4><a href="#">Shave Knives</a></h4>
									<p>$ 69.99</p>
								</div>
							</li>
						</ul>
						</div> -->

					</div>

					<div class="col-md-9">
						<div class="row">
							<div id="shop-mason" class="shop-mason-3col">
								
								<!-- Prod template -->
								<?php
								include 'includes/template.php';
								?>
							</div>	
							</div>
						</div>
						<div class="clearfix"></div>
						<!-- Pagination -->
						<?php 

						$count_it = mysqli_fetch_assoc($count_it);
						
						foreach ($count_it as $key) {
							
							$count_it = $key;
						}
						$pages = $count_it/$limit;
						$ceil = ceil($pages);
						
						
						if ($ceil < 2) {
								
						}
						else{
							?>
							<div class="page_nav">
								<a href="shop.php?category=<?php echo $f_cat;?>&sort=<?php echo $sort; if(isset($search)){echo('&sort='.$search);} ?><?php echo($search)?>&page=<?php
								if($page < 2){echo(1);}else{ echo($page-1);}?>"><i class="fa fa-angle-left"></i></a>
							<?php
							for ($i=0; $i < $pages; $i++) { 
							?>						
								<a href="shop.php?category=<?php echo $f_cat;?>&sort=<?php echo $sort; if(isset($search)){echo('&sort='.$search);}?>&page=<?php echo($i+1)?>"><?php echo($i+1); ?></a>
					
							<?php 
							if ($i==4) {
								break;
							}
							}
							if ($pages<8) {
								
							}
							else{
								
								?>

								<a class="no-active">...</a>
								<a href="shop.php?category=<?php echo $f_cat;?>&sort=<?php echo $sort ?>&search=<?php echo($search)?>&page=<?php echo($ceil)?>"><?php echo($ceil) ?></a>
							 <?php }?>

							<a href="shop.php?category=<?php echo $f_cat;?>&sort=<?php echo $sort; 
							if(isset($search)){echo('&sort='.$search);} ?>&page=<?php
							 if($page > $ceil-1){echo($ceil);}else{ echo($page+1);}?>"><i class="fa fa-angle-right"></i></a>
						</div>
					<?php } ?>
						<!-- End Pagination -->
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