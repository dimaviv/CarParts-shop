<?php
include 'includes/db.php';

function get_course_by_id( $id ){
	global $connection;

	$query = "SELECT * FROM products WHERE id=" . $id;
	$req = mysqli_query($connection, $query);
	$resp = mysqli_fetch_assoc($req);

	return $resp;
}