<?php

if ( isset($_GET['search']) ) {
	$search = $_GET['search'];
	$need_data = 1;
}

if (isset($_GET['page'])) {
	$page = $_GET['page'];
	
} else{
	$page = 1;
}


$limit = 30;
$number = ($page * $limit) - $limit;
$no_photo = 'no_photo.jpg';


if($k == 0){
	$products = mysqli_query($connection, "SELECT * FROM `products` WHERE `cat_id` = $f_cat AND `price` BETWEEN $min AND $max ORDER BY $sorting LIMIT $number, $limit");
	$count_it = mysqli_query($connection, "SELECT COUNT(*) FROM `products` WHERE `cat_id` = '$f_cat' AND `price` BETWEEN '$min' AND '$max'");
	
	$count_it = mysqli_query($connection, "SELECT COUNT(*) FROM products WHERE `cat_id` = $f_cat");
}
elseif (isset($need_data) and isset($_GET['search'])) {

	$products1 = mysqli_query($connection, "SELECT * FROM `products` WHERE `name` = '$search' LIMIT $number, $limit");
	$products2 = mysqli_query($connection, "SELECT * FROM `products` WHERE `original_num` = '$search'");
	$products3 = mysqli_query($connection, "SELECT * FROM `products` WHERE `article` = '$search'");

	if (isset($products1)) {
		$count_it = mysqli_query($connection, "SELECT COUNT(*) FROM products WHERE `name` = '$search'");
	}
}
else{

	$products = mysqli_query($connection, "SELECT * FROM `products` WHERE `price` BETWEEN $min AND $max ORDER BY $sorting LIMIT $number, $limit");
	$count_it = mysqli_query($connection, "SELECT COUNT(*) FROM products");

}
$prod_qnt = 0;


while ($prod = mysqli_fetch_assoc($products) or
 $prod = mysqli_fetch_assoc($products1) or
  $prod = mysqli_fetch_assoc($products2) or
   $prod = mysqli_fetch_assoc($products3)  ) {
   		
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
			if ($br['id'] == $prod['brand_id'])
			{
			 	if ($fil_brand !== Array()) {
			 	if (in_array($prod['brand_id'], $fil_brand) == false) {
			 		unset($prod);
			 		break;	 		
			 		}
			 	}
			$prod_br = $br;
			break;	
			}		 		
		}
		$prod_count = false;
		foreach ($countries as $count)
		 {
			if ($count['id'] == $prod['country'])
			{
			 if ($fil_count !== Array()) {
			 	if (in_array($prod['country'], $fil_count) == false) {
			 		unset($prod);
			 		break;	 		
			 		}
			 	}			
			$prod_count = $count;
			break;
			}
		}
		if ($prod_count['id'] == null or $prod_br['name'] == null or $prod_cat == false){

		}
		else{

		?>

<div class="sm-item isotope-item">
	<div class="product">
		<div class="product-thumb">
			<a href="./shop-single.php?p_id=<?php echo $prod['id']?>"><img src="images/shop/<?php
			if($prod['image'] != ''){
			 echo $prod['image'];}else{echo($no_photo);} ?>" href="/shop-single.php?p_id=<?php echo $value["id"];?>" class="img-responsive" alt=""></a>
			
		</div>
		<div class="rating">
			<?php
			$k = $prod['raiting']/2;
			for ($i=0; $i < $k; $i++) {
			?> 
			  	<span class="fa fa-star act"></span>
			  <?php
			}
			$r = 5 - $k;
			if ($r < 1) {
			}else{
				for ($i=0.5; $i < $r; $i++) {
			?> 
			  	<span class="fa fa-star"></span>
			  <?php
				}
			} 
			
		?>
		</div>
<div class="product-info">
			<span class="product-title"><a href="./shop-single.php?p_id=<?php echo $prod['id']?>"><?php echo $prod['name'];?></a></span>
			<span class="product-brand"><a href="#"><?php echo $prod_br['name'];?></a></span>
			<span class="product-article"><a href="#">Артикул: <?php echo $prod['article'];?></a></span>
			<span class="product-available"><a href="#">Есть в наличии</a></span>
		</div>									
			<span class="product-price"><?php echo $prod['price'];?> грн</span>
	</div>
</div>
<?php
	$prod_qnt++;	
	}
}
if ($prod_qnt == 0) {
	if (isset($_GET['search'])) {
		?>
		<h2>По запросу "<?php echo $search ?>" ничего не найдено</br></h2>
		</br>
		<h3>Попробуйте изменить запрос</h3>
		<?php

	}
	else{
	?>

	<h2>Нет товаров соответствующих критериям поиска</h2>
	<?php
	}
}
?>