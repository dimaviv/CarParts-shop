<?php
session_start();

include 'includes/db.php';
include 'includes/config.php';

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
	<?php include "includes/header.php"; ?>
	
	<div class="close-btn fa fa-times"></div>
	
	<div class="close-btn fa fa-times"></div>
	
	<!-- GOOGLE MAP -->
	<div class="page_header text-center">
						<h1></h1>						
	</div>
	
	<!-- INNER CONTENT -->
	<section id="content">
		<div class="content-blog">
			<div class="container">
				<div class="row">
					<div class="col-md-8 margin30">
						<div class="form-contact">
							<form id="contactForm" action="php/contact.php" method="post">
								<div class="row">
									<div class="col-md-6">
										<div class="row control-group">
											<div class="form-group col-xs-12 controls">
												<input class="form-control" name="senderName" id="senderName" type="text" placeholder="Имя" required="required" />                       
												<p class="help-block"></p>
											</div>
										</div>
										<div class="row control-group">
											<div class="form-group col-xs-12 controls">
												<input class="form-control" type="email" name="senderEmail" id="senderEmail" placeholder="Электронный адрес" required="required"/>
												<p class="help-block"></p>
											</div>
										</div>
										<div class="row control-group">
											<div class="form-group col-xs-12  controls">
												<input class="form-control" placeholder="Номер телефона" name="senderPhone" id="senderPhone" type="text">
												<p class="help-block"></p>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="row control-group">
											<div class="form-group col-xs-12 controls">
												<textarea rows="7" class="form-control" name="message" id="message" placeholder="Сообщение"></textarea>
												<p class="help-block"></p>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="form-group col-xs-12">
										<button type="submit" class="button btn-full btn-lg">Отправить сообщение</button>
									</div>
								</div>
							</form>
							<div id="sendingMessage" class="statusMessage">
								<p><i class="fa fa-spin fa-spinner"></i> Sending your message. Please wait...</p>
							</div>
							<div id="successMessage" class="successmessage">
								<p><i class="fa fa-check"></i> Спасибо за сообщение.</p>
							</div>
							<div id="failureMessage" class="errormessage">
								<p><i class="fa fa-close"></i> Произошла ошибка. Повторите снова.</p>
							</div>
							<div id="incompleteMessage" class="statusMessage">
								<p><i class="fa fa-warning"></i> Пожалуйста, заполинте все поля!</p>
							</div>
						</div>
						<!--contact form-->
					</div>
					<div class="col-md-4">
						<h3 class="no-margin">Контактная информация</h3>
						<div class="space20"></div>
						<ul class="contact-info">
							<li>
								<p><strong><i class="fa fa-map-marker"></i> Address:</strong> <span>No 123 , Wallstreet, Newyork NY123456</span></p>
							</li>
							<li>
								<p><strong><i class="fa fa-envelope"></i> Mail Us:</strong> <span><a href="#">Support@website.com</a></span></p>
							</li>
							<li>
								<p><strong><i class="fa fa-phone"></i> Phone:</strong> <span>+91 1800 2345 2132</span></p>
							</li>
						</ul>
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
