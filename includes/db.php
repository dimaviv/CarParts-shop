<?php
require "config.php";
// $connection = mysqli_connect('localhost', 'fortuna2_fortuna2', 'dimafatum1812', 'fortuna2_db');

$connection = mysqli_connect('localhost', 'root', '', 'fortuna_db');
mysqli_set_charset($connection, 'utf8');
/*
$connection = mysqli_connect(
	$config['db']['server'],
	$config['db']['username'],
	$config['db']['password'],
	$config['db']['database']
	
);
*/

if($connection == false)
{
	echo 'Не удалось подключиться к базе данных!<br>';
	echo mysqli_connect_error();
	exit();
}
?>