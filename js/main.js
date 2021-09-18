$(function() {
	const links_id = $('.product_link_id');
	const cart_value  = $("#cart_count");



$.each(links_id, function(){
	$(this).bind('click', function(){
		let cur_id = $(this).attr('data-id');

		$.post("api.php", {"course_id": cur_id })
		.done(function(data){
			cart_value.html(data);
		
		});
	});
});

  

$("#cart-items").load("includes/cart.php");	
$(document).ready("#reload-cart").click(function() {
      $("#cart-items").load("includes/cart.php");

});

function HideCart() {
	document.getElementById("cart-info-s").style.visibility = "";
	document.getElementById("cart-info-s").style.opacity = "";
}
	
ShowCart1.onclick = function() {
	document.getElementById("cart-info-s").style.visibility = "visible";
	document.getElementById("cart-info-s").style.opacity = "1";
	setTimeout(HideCart, 1500);

};







});