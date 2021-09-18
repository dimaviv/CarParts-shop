<?php
session_start();

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
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/light.css">
	<link rel="stylesheet" href="css/responsive.css">

	<!-- JS Font Script -->
	<script src="http://use.edgefonts.net/bebas-neue.js"></script>

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

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
	<?php include "includes/header.php";
	$cl_url = $_SERVER['REQUEST_URI'];
	$cl_url = explode('?', $url);
	$cl_url = $url[0];
	// $qnt_change = $_POST[]
 ?>
	<!-- SHOP CONTENT -->
	<section id="content">
		<div class="content-blog">
			<div class="container">
				<div class="row">
					<div class="page_header text-center">
						<h1>Корзина </h1>
					</div>
					<div class="col-md-12">
						<div class="cart-list">
						<?php
session_start();

if (!empty($_SESSION["cart_list"])){
	?>
<table class="cart-table table table-bordered">
				<thead>
					<tr>
						<th>&nbsp;</th>
						<th>&nbsp;</th>
						<th>Название</th>
						<th>Цена</th>
						<th>Количество</th>
						<th>Сумма</th>
					</tr>
				</thead>
				<tbody>
				<?php
				
				$item_quantity = array(); 
				if (isset($_SESSION['cart_list'])){
					foreach ($_SESSION['cart_list'] as $key) {
						$item_quantity[] = $key['id'];
					}
				}

				$id_list = array();
				
				$quantity = array_count_values ($item_quantity);
				$summa = 0;
				?><form method="POST" name="quantity"><?php
			foreach ($_SESSION["cart_list"] as $key => $value) {
				if (in_array($value['id'], $id_list)){
					continue;
						}
					else{
					$q = $quantity[$value['id']];
					if (isset($_POST[$value['id']])) {
						$q = $_POST[$value['id']];
					}
					$id_list[] = $value['id'];
					$sum = 0;
					$sum = $sum + ($q * $value["price"]);
					$summa += $sum;
					$prod_qnt = $quantity[$value['id']];
					if(isset($_POST[$value['id']])){
						
						}
					?>					 
					<tr>
						<td>
							<a href="shop-cart.php?action=delete_all&id=<?php echo $value["id"]?>" class="remove"><i class="fa fa-times"></i></a>
						</td>
						<td>
							<a href="/shop-single.php?p_id=<?php echo $value["id"];?>"><img src="images/shop/<?php echo $value["image"];?>" alt="" height="90" width="90"></a>					
						</td>
						<td>
							<a href="/shop-single.php?p_id=<?php echo $value["id"];?>"><?php echo $value["name"];?></a>					
						</td>
						<td>
							<span class="amount"><?php echo number_format($value["price"], 0);?> грн</span>					
						</td>
						<td>	
							<div class="quantity"><input type="number" min="1" max="20" data_id="<?php echo $value['id'];?>" name="<?php echo $value['id'];?>" value="<?php
							if(isset($_POST[$value['id']])){
								echo($_POST[$value['id']]);
							}else{
								echo($quantity[$value['id']]);
							} 
							 

							 ?>"></div>
							<?php 
							
							$quantity[$value['id']] = $_POST[$value['id']];

							$temp = $value;
							$delete_list = array();

							if(isset($_POST[$value['id']])){
								$n = $_POST[$value['id']] - $prod_qnt;
								if ($n > 0) {
								  	for ($i=0; $i < $n; $i++) { 
										$_SESSION['cart_list'][] = $temp;
									}
								}elseif ($n < 0) {
									if (in_array($value['id'], $delete_list)){
										continue;
									}
									else{
										foreach ($_SESSION['cart_list'] as $k => $mass) {
							  				if ($mass == $value) {
							  					unset($_SESSION['cart_list'][$k]);
											}
										}
										for ($i=0; $i < $_POST[$value['id']]; $i++) { 
											$_SESSION['cart_list'][] = $value;
										}

									}
								}else{
									
								}
								  	
								  		
								  	 			
									
							}else{
								
							} 
							
							?>
						</td>
						<td>
							<span class="amount"><?php echo number_format($sum, 0);?> грн</span>					
						</td>
					</tr>
					<?php
					 }
				}
					

					?>
					<tr>
						<td colspan="6" class="actions">
							<div class="col-md-6">
								<div class="coupon">
									<label>Купон:</label><br>
									<input placeholder="Код" type="text"> <button type="submit">ОК</button>
								</div>
							</div>
							<div class="col-md-6">
								<div class="cart-btn">
														
									<button class="button btn-md" id="reload-cart" type="submit">Обновить</button>						
									<button class="button btn-md" onclick="window.location.href = './shop-checkout.php'" type="button">Заказать</button>
										
								</div>
							</div>
						</td>
					</tr>
				</tbody>

			

<?php

					 }
					else{
						?><h1>Корзина пуста</h1><br><br><br><br>
						<?php
						$total = 0;
					}
					// unset($delete_list);
					 ?>
					</div>

</table>		


			<div class="cart_totals">
				<div class="col-md-6 push-md-6 no-padding">
					<h4 class="heading">Итого</h4>
					<table class="table table-bordered col-md-6">

						<tbody>
							<tr>
								<th>Общая сумма</th>
								<td><span class="amount"><?php echo number_format($summa, 0);?> грн</span></td>
							</tr>
							<tr>
								<th>Доставка</th>
								<td>
									Бесплатно				
								</td>
							</tr>
							<tr>
								<th>Всего</th>
								<td><strong><span class="amount"><?php echo number_format($summa, 0);?> грн</span></strong> </td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>			
						</form>	
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
