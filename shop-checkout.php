<?php
session_start();


$item_quantity = array(); 
if (isset($_SESSION['cart_list'])){
	foreach ($_SESSION['cart_list'] as $key) {
		$item_quantity[] = $key['id'];
	}
}
	$id_list = array();
	$quantity = array_count_values ($item_quantity);

	if ( isset($_SESSION['cart_list']) && count($_SESSION['cart_list']) !=0) {
		$total = 0; 
		foreach ($_SESSION['cart_list'] as $value) {
			if (in_array($value['id'], $id_list)){
				continue;
			}
			else{
				$id_list[] = $value['id'];
			
			$total = $total + ($quantity[$value['id']] * $value['price']);	
			}
			
			}
		}
	else{
		$total = 0;
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
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/light.css">
	<link rel="stylesheet" href="css/responsive.css">

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
	<div class="close-btn fa fa-times"></div>

	
	<!-- SHOP CONTENT -->
	<section id="content">
		<div class="content-blog">
					<div class="page_header text-center">
						
					</div>

<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="billing-details">
						<h2 class="uppercase" align="center">Оформление заказа</h2>
						<div class="space30"></div>

						<!-- FORM -->
						<form id="check-out" method="post" action="shop-checkout.php">
							<div class="clearfix space20"></div>
							<div class="row">
								
									<label>Имя </label>
									<input class="form-control" name="name"  type="text" value="" required="required">
								
								
									<label>Фамилия </label>
									<input class="form-control" name="surname" type="text" value="" required="required">
								
							
							<div class="clearfix space20"></div>
							
							<div class="clearfix space20"></div>
							<label>Адресс </label>
							<input class="form-control" placeholder="" name="adress" value="" type="text" required="required">
							<div class="clearfix space20"></div>
						
							
								
								<label>Город </label>
								<input class="form-control" placeholder="" name="city" value="" type="text" required="required">
								
							<div class="clearfix space20"></div>
							<label>Электронный адресс </label>
							<input class="form-control" placeholder="" name="email" value="" type="text" required="required">
							<div class="clearfix space20"></div>
							<label>Номер телефона </label>
							<input class="form-control" id="billing_phone" name="phone" placeholder="" value="" type="text" required="required">
							</div>
						
					</div>
				</div>
				
			<div class="clearfix space20"></div>
			<h4 class="heading">Ваш заказ</h4>
			
			<table class="table table-bordered extra-padding">
				<tbody>
					<tr>
						<th>Сумма</th>
						<td><span class="amount"><?php echo number_format($total, 0);?> грн</span></td>
					</tr>
					<tr>
						<th>Доставка</th>
						<td>
							Бесплатно				
						</td>
					</tr>
					<tr>
						<th>Общая сумма</th>
						<td><strong><span class="amount"><?php echo number_format($total, 0);?> грн</span></strong> </td>
					</tr>
				</tbody>
			</table>
			
			<div class="clearfix space30"></div>
			
			<div class="clearfix space20"></div>
			<h4 class="heading">Способ доставки</h4>
			<div class="payment-method">
				<div class="row">
					<!-- <form id="delivery" method="post"> -->
						<div class="col-md-4">
							<input name="delivery" id="radio1" class="css-checkbox" value="newpost" type="radio" required><span>Новая почта </span>
							<div class="space20"></div>
							
						</div>
						<div class="col-md-4">
							<input name="delivery" id="radio2" class="css-checkbox" value="pickup" type="radio" ><span>Самовывоз из скалад</span>
							<div class="space20"></div>
							<p>г.Одесса ул.Пушкина 213</p>
						</div>
					
					<!-- </form> -->
				</div>
				<div class="space30"></div>
			</div>
			<h4 class="heading">Способ оплаты</h4>
			<div class="payment-method">
				<div class="row">
					<!-- <form id="pay" method="post"> -->
						<div class="col-md-4">
							<input name="payment" id="radio1" class="css-checkbox" value="card" type="radio" required><span>Картой Visa/Mastercard </span>
							<div class="space20"></div>
							<!-- <p>Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won't be shipped until the funds have cleared in our account.</p> -->
						</div>
						<div class="col-md-4">
							<input name="payment" id="radio2" class="css-checkbox" value="cash" type="radio"><span>Наличными при получении</span>
							<div class="space20"></div>
							
						</div>
					<!-- </form> -->
				</div>
				<div class="space30"></div>
				<div class="space30"></div>
				<button type="submit" form="check-out" name="checkout"><a class="button btn-lg">Подтвердить заказ</a></button>
						</form>
				<!-- FORM END -->


			
				
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

<?php
define( "RECIPIENT_NAME", "Fortua Trucks" );
define( "RECIPIENT_EMAIL", "support@fortuna-trucks.com.ua" );
define( "EMAIL_SUBJECT", "ORDER" );
// Read the form values
$success = false;



$Name = $_POST['name'];
$Surname = $_POST['surname'];
$Email = $_POST['email'];
$Phone = $_POST['phone'];
$name_surname = $_POST['name'] ." ". $_POST['surname'];

if ($_POST['delivery'] == 'newpost') {
	$Delivery = "Доставка: Новая почта";
}elseif ($_POST['delivery'] == 'pickup') {
	$Delivery = "Доставка: Самовывоз";
}



$message = $_POST['city']." ".$_POST['adress']."  | ".$Delivery."  | "."Оплата: ". $_POST['payment']."  | Сумма: ".$total."  грн | Заказ:  ";




$message .= '<!DOCTYPE html>
<html>
<head>
<style>
.cart-table thead tr th {
	background: #000;
	color: #fff;
	border: 1px solid #222;
	text-transform: uppercase;
	line-height: 40px;
}

.cart-table thead {
	border-top: 1px solid #000;
}

.cart-table tbody tr td  a {
	color: #000;
	font-weight: 600;
}

.cart-table tbody tr td  a:hover {
	color: #e81717;
}

.cart-table thead tr th  ,
.cart-table tbody tr td {
	vertical-align: middle;
	text-align: center;
}
.container{
	position:relative;
}
.content-blog {
	float:left;
	width:100%;
	padding:70px 0 90px 0; 
}

</style></head>
<body><div class="content-blog">
			 	<div class="container">
						<div class="row">
					<div class="col-md-12">
				
<table class="cart-table table table-bordered">
				<thead>
					<tr>
						<th>&nbsp;</th>
						<th>&nbsp;</th>
						<th>Название</th>
						<th>Цена</th>
						<th>Количество</th>
						<th>Сумма</th>
						<th>Внутренний код: </th>
					</tr>
				</thead>
				<tbody>';
				
$ids_list = array();				 
foreach ($_SESSION["cart_list"] as $key => $value) {
	if (in_array($value['id'], $ids_list)){
	continue;
}
else{
	$ids_list[] = $value['id'];
	$sum = 0;
	$sum = $sum + ($quantity[$value['id']] * $value["price"]);
					 
	$message .= '<tr>
		<td>
		</td>
		<td>
			<a href="#"><img src="http://fortuna-trucks.com.ua/images/shop/"'.$value["image"].'" alt="" height="90" width="90"></a>					
		</td>
		<td>
			<a href="#">'.$value["name"].'</a>					
		</td>
		<td>
			<span class="amount">'.$value["price"].' грн</span>					
		</td>
		<td>
			<div class="quantity">   '.$quantity[$value['id']].'</div>
		</td>
		<td>
			<span class="amount">'.$sum.' грн</span>					
		</td>
		<td>
			<span class="amount">    '.$value["internal_code"].'</span>					
		</td>
	</tr>';
	 }
}
		
					 
$message .=" 					 
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
</body>
</html>";




// $message = isset( $msg ) ? preg_replace( "/(From:|To:|Subject:|Content-Type:)/", "", $msg ) : "";
// $headers .= "MIME-Version: 1.0\r\n";
// $headers .= "Content-Type: text/html; charset=utf-8\r\n";
// $message = '<html><body>';
// $message = 

// $message .= '</body></html>';					
// $Name = isset( $_POST['name'] ) ? preg_replace( "/[^\.\-\' a-zA-Z0-9]/", "", $_POST['name'] ) : "";
// $Surname = isset( $_POST['surname'] ) ? preg_replace( "/[^\.\-\_\@a-zA-Z0-9]/", "", $_POST['surname'] ) : "";
// $Email = isset( $_POST['email'] ) ? preg_replace( "/[^\.\-\_\@a-zA-Z0-9]/", "", $_POST['email'] ) : "";
// $Phone = isset( $_POST['phone'] ) ? preg_replace( "/(From:|To:|BCC:|CC:|Subject:|Content-Type:)/", "", $_POST['phone'] ) : "";








$Subject = EMAIL_SUBJECT;
// If all values exist, send the email
if ( $name_surname && $Email && $Phone  && $message) {
  $recipient = RECIPIENT_NAME . " <" . RECIPIENT_EMAIL . ">";
  $headers = "From: " . $name_surname ." ".$Phone. " < " . $Email . " >\r\nContent-type: text/html; charset=utf-8\r\n";
  $success = mail( $recipient, $Subject, $message, $headers);
}


// Return an appropriate response to the browser
if($_POST['name'] != null){
	if ( isset($_GET["ajax"]) ) {
	  echo $success ? "success" : "error";
	} else {
	?>
	<html>
	  <head>
	    <title>Спасибо!</title>
	  </head>
	  <body>
	  <?php if ( $success ) echo '<script>alert("Заказ успешно отправлен.")</script>'?>
	  <?php if ( !$success ) echo '<script>alert("Ошибка отправки.")</script>' ?>
	  <?php echo '<script>window.location="http://fortuna-trucks.com.ua/shop.php"</script>';?>
	  </body>
	</html>
<?php
	}
}
?>