<?php
session_start();

require_once 'includes/db.php';
require_once 'php/functions.php';

if(isset($_POST['course_id'])){

	$current_added_course = get_course_by_id($_POST['course_id']);
	$current_cart_value = 0;
	if ( !isset($_SESSION['cart_list'])) {
		$_SESSION['cart_list'][] = $current_added_course;
		$pass = 1;
		$current_cart_value = 1;
	}


$course_check = false;

if ( isset($_SESSION['cart_list']) and $pass != 1){
	$pass = 0;
	foreach ($_SESSION['cart_list'] as $value) {
		if (in_array($current_added_course, $_SESSION['cart_list'])){
				$course_check = true;
				$_SESSION['cart_list'][] = $current_added_course;
				break;
			}	
		 	
		// elseif ( $value['id'] == $current_added_course['id'] ) {
		// 	$_SESSION['cart_list'][] = $current_added_course;
		// 	$course_check = true;
		// }
	}
	if ( !$course_check ) {
		$_SESSION['cart_list'][] = $current_added_course;
		$current_cart_value = count($_SESSION['cart_list']);
	}
	$current_cart_value = count($_SESSION['cart_list']);

	}

	echo $current_cart_value;
	// print_r($_SESSION['cart_list'][1]['price']);
}