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
				?><form method="GET" name="quantity"><?php
			foreach ($_SESSION["cart_list"] as $key => $value) {
				if (in_array($value['id'], $id_list)){
					continue;
						}
					else{

					$id_list[] = $value['id'];
					$sum = 0;
					$sum = $sum + ($quantity[$value['id']] * $value["price"]);
					$summa += $sum;
					$prod_qnt = $quantity[$value['id']];
					if(isset($_GET[$value['id']])){
						
						}
					
					?>					 
					<tr>
						<td>
							<a href="shop-cart.php?action=delete&id=<?php echo $value["id"]?>" class="remove"><i class="fa fa-times"></i></a>
						</td>
						<td>
							<a href="#"><img src="images/shop/<?php echo $value["image"];?>" alt="" height="90" width="90"></a>					
						</td>
						<td>
							<a href="#"><?php echo $value["name"];?></a>					
						</td>
						<td>
							<span class="amount"><?php echo number_format($value["price"], 0);?> грн</span>					
						</td>
						<td>
							
							
							<div class="quantity"><input type="number" data_id="<?php echo $value['id'];?>" name="<?php echo $value['id'];?>" value="<?php
							if(isset($_GET[$value['id']])){
								echo($_GET[$value['id']]);
							}else{
								echo($quantity[$value['id']]);
							} 
							 

							 ?>"></div>
							<?php 
						
							$quantity[$value['id']] = $_GET[$value['id']];
						
							$temp = $value;
							print_r($_GET[$value['id']]);
							print_r($prod_qnt);

							if(isset($_GET[$value['id']])){

							$n = $_GET[$value['id']] - $prod_qnt;
						
							if ($n > 0) {
							  	for ($i=0; $i < $n; $i++) { 
									$_SESSION['cart_list'][] = $temp;
								}
							}elseif ($n < 0) {
							  	for ($i=0; $i > $n; $i--) {	
								  	unset($_SESSION['cart_list'][$key]);
								  	continue;	  	 	
							  	 } 
									
									}
								else{
									
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
									
																	
									<button class="button btn-md" onclick="window.location.href = './shop-checkout.php';"type="submit">Заказать</button>
										
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
					 ?>