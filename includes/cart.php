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
		 ?>
		 <img src="images/shop/<?php echo $value['image'];?>" href="./shop-single.php?p_id=<?php echo $value['id']?>" width="60" alt=""/>
	<div class="ci-item-info">
			<h5><a href="./shop-single.php?p_id=<?php echo $value['id']?>"><?php echo $value['name'];?></a></h5>
			<p><?php echo($quantity[$value['id']]);
			?> x <?php echo $value['price'];?> грн</p>
		<div class="ci-edit">
			<a href="/shop-cart.php" class="edit fa fa-edit"></a>
			<a id="reload-cart" href="<?php echo $script;?>?<?php if(isset($f_cat)){ echo '&category='.$f_cat;}?><?php if(isset($get_sort)){ echo '&sort='.$get_sort;}?><?php if(isset($ID)){ echo '&p_id='.$ID;}?>&action=delete&id=<?php echo $value['id'];?>" class="edit fa fa-trash"></a>
		</div>
	</div>
			<?php
			
			$total = $total + ($quantity[$value['id']] * $value['price']);
			// $total = $total + $values['price'];		
			}
			
			}
		}
	else{
		?><h4>Корзина пуста</h4><?php
	}

	?>

</div>
<div class="ci-total"><?php echo number_format($total, 0);?> грн</div>
<div class="cart-btn">
	<a href="./shop-cart.php">Просмотреть</a>
	<a href="./shop-checkout.php">Заказать</a>
</div>
