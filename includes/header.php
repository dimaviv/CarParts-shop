<?php
include 'includes/db.php';
include 'includes/config.php';
error_reporting(0);
function get_JsonStr($str){
    $str = preg_replace_callback('/\\\\u([a-f0-9]{4})/i', create_function('$m', 'return chr(hexdec($m[1])-1072+224);'), $str);
    return iconv('cp1251', 'utf-8', $str);
}



$myProd = mysqli_query($connection, "SELECT * FROM `products`");

$search_list = array();

while ( $prod = mysqli_fetch_assoc($myProd) ){
	$search_list_names[] = $prod['name'];
	$search_list_codes[] = $prod['article'];
	$search_list_codes[] = $prod['original_num'];
}

$search_list_names = array_unique($search_list_names);	

$search_list = array_merge($search_list_codes, $search_list_names);

$json = json_encode($search_list);




$script = $_SERVER['SCRIPT_NAME'];
$url_return = $_SERVER['HTTP_REFERER'];

if ( isset($_GET['id']) && isset($_SESSION['cart_list']) && $_GET['action'] == 'delete' ) {
	foreach ($_SESSION['cart_list'] as $key => $value) {
		if ( $value['id'] == $_GET['id'] ) {
			unset($_SESSION['cart_list'][$key]);
			break;
		}		
	}
	echo '<script>window.location="'.$url_return.'"</script>';
	// echo '<script>alert("Товар удалён")</script>';
}
if ( isset($_GET['id']) && isset($_SESSION['cart_list']) && $_GET['action'] == 'delete_all' ) {
	foreach ($_SESSION['cart_list'] as $key => $value) {
		if ( $value['id'] == $_GET['id'] ) {
			unset($_SESSION['cart_list'][$key]);
		}		
	}
	echo '<script>window.location="'.$url_return.'"</script>';
}
if ( isset($_GET['course_id']) && !empty($_GET['course_id']) ) {

	$current_added_course = get_course_by_id($_GET['course_id']);

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
?>
<script type="text/javascript">
	var data = <?php echo $json; ?>;
	var base = Object.values(data);
</script>
<header id="header2">
		<div class="container">
			<div class="row">
				<div class="col-md-3 col-xs-5 logo">
					<a href="/"><img src="images/logo2.png" class="img-responsive" alt=""/></a>
				</div>
				<div class="col-md-9 col-xs-7">
					<div class="top-bar">
						<ul>
							<li class="tb-info">
								<a data-dialog2="somedialog2" class="trigger">
								<i class="fa fa-map-marker"></i>
								<span>Найти нас<br><em>Google Maps</em></span>
								</a>				
							</li>
							<li class="tb-info">
								<a data-dialog1="somedialog1" class="trigger">
								<i class="fa fa-clock-o"></i>
								<span class="hidden-xs">Время работы<br><em>Мы работаем каждый день</em></span>
								<span class="visible-xs hidden-sm hidden-md hidden-lg">Open Timings</span>
								</a>				
							</li>
							<li>
								<a data-dialog="somedialog" class="trigger button btn-xs color">Book Online</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="menu-wrap">
				<div id="mobnav-btn">Меню <i class="fa fa-bars"></i></div>
				<ul class="sf-menu">
					<li>
						<a href="/">Главная</a>
					</li>
					<li>
						<a href="./shop.php">Каталог</a>
						<div class="mobnav-subarrow"><i class="fa fa-plus"></i></div>
						<ul>
							<?php
								$main_cat = mysqli_query($connection, "SELECT * FROM `categories` WHERE `parent_id`= 0");
								while ( $cat = mysqli_fetch_assoc($main_cat) )
								 {
									?>
									<li><a href="./shop.php?category=<?php echo $cat['id'];?>"><?php echo $cat['name'];?></a>
										<ul>
											<div class="sub-cat">

							<?php
								$ct = $cat['id'];
								$sec_cat = mysqli_query($connection, "SELECT * FROM `categories` WHERE `parent_id`= '$ct'");

								while ( $scat = mysqli_fetch_assoc($sec_cat) )
								 {
								 	?>
									<li><a href="./shop.php?category=<?php echo $scat['id'];?>"><?php echo $scat['name'];?></a></li>													
								<?php 
							}
							?>
							</div>
							</ul>
							<?php
						}
							?>
							</li>
						</ul>
					</li>
					<li class="sf-mmenu">
						<a href="#">Бренды</a>	
					<li>
						<a href="./feedback.php">Обратная связь</a>
					</li>
				</ul>

				<div class="header-xtra">
				
				<div class="s-search">
						<div class="ss-ico"><i class="fa fa-search"></i></div>
						<div class="search-block">
							<div class="ssc-inner">
								<form action="./shop.php">
									<input type="text" class="ui-autocomplete-input" id="search" name="search" placeholder="Номер, название, категория">
									<button type="submit" value="Update" onclick="redirect()"><i class="fa fa-search"></i></button>
								</form>
							</div>
						</div>
					</div>
				
				<div class="s-cart">
						<div class="sc-ico"><i class="fa fa-shopping-cart"></i><em id="cartCntItems"><span id="cart_count"><?php
						 if(isset($_SESSION['cart_list'])){
		 					echo count ($_SESSION['cart_list']);

						 }
						 	else{
						 		echo "0";
						 	}?>
						 		
						 	</span></em></div>

						<div class="cart-info" id="cart-info-s">
							<!-- <small>У вас <em class="highlight">2 прдмета</em> в корзине</small> -->
							<br>
							<br>

							<!-- ТОВАРЫ КОРЗИНЫ -->
							<div class="ci-item">
								
							<div id="cart-items">
	
							</div>
						</div>
					</div>	

		</div>

	</header>
	
