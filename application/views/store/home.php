<div class="container-fluid">
	<div class="row">
		<div class="col-lg-3">
			<div id="compact_cart" class="well">
				<div class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#"> <i
						class="icon-shopping-cart"></i> <?php echo $this->cart->total_items()?> item - $<?php echo $this->cart->total()?> <b
						class="caret"></b></a> </a>
					<div class="dropdown-menu well" role="menu"
						aria-labelledby="dLabel">
						<?php foreach ($this->cart->contents() as $items): ?>
							<p>
								<?php echo $items['name']; ?> x <?php echo $this->cart->format_number($items['qty']); ?> <span
								class="pull-right">$<?php echo $this->cart->format_number($items['subtotal']); ?></span>
						</p>
						<?php endforeach; ?>
		
						<a id="goToCart" href=# class="btn btn-primary btn-xs">Go to Cart</a>
					</div>
				</div>
			</div>

			<div class="well">
				<ul class="nav nav-pills nav-stacked">
					<li class="nav-header disabled"><a>Mobile Phones</a></li>
					<?php foreach($categories as $category):?>
						<li><a id="category_<?php echo $category->producentID; ?>"
						class="category_link" href=#><?php echo $category->nazwa; ?></a></li>
					<?php endforeach;?>
				</ul>
			</div>
		</div>
		<div id="main_content" class="col-lg-9">

			<div id="special_offer" class="jumbotron">
				<h1 class=""><span class="glyphicon glyphicon-bullhorn"></span> Special Offer </h1>
				<p class="">Up to 30% discount 3 selected products. Do not miss it!  <span class="glyphicon glyphicon-thumbs-up"></span></p>
				<p>
					<a id="special_offer_btn" href=# class="btn btn-primary btn-lg">Check it out!  <span class="glyphicon glyphicon-shopping-cart"></span></a>
				</p>
			</div>
			<div id="products" class="container-fluid"></div>
		</div>
	</div>
</div>

<hr />

<footer>
	<div class="container">
		<div class="row">
			<div class="col-lg-4">
				<h4>Info</h4>
				<ul class="nav nav-stacked">
					<li><a href="#">Sell Conditions</a>
					
					<li><a href="#">Shipping Costs</a>
					
					<li><a href="#">Shipping Conditions</a>
					
					<li><a href="#">Returns</a>
					
					<li><a href="#">About Us</a>
				
				</ul>
			</div>

			<div class="col-lg-4">
				<h4>Location and Contacts</h4>
				<p>
					<i class="icon-map-marker"></i>&nbsp;I do not Know Avenue, A City
				</p>
				<p>
					<i class="icon-phone"></i>&nbsp;Phone: 234 739.126.72
				</p>
				<p>
					<i class="icon-print"></i>&nbsp;Fax: 213 123.12.090
				</p>
				<p>
					<i class="icon-envelope"></i>&nbsp;Email: info@mydomain.com
				</p>
				<p>
					<i class="icon-globe"></i>&nbsp;Web: http://www.mydomain.com
				</p>
			</div>

			<div class="col-lg-4">
				<h4>Newsletter</h4>
				<p>Write you email to subscribe to our Newsletter service. Thanks!</p>
				<form class="form-newsletter">
					<div class="input-append">
						<input type="email" class="span2" placeholder="your email">
						<button type="submit" class="btn">Subscribe</button>
					</div>
				</form>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-6">
				<p>
					&copy; Copyright 2012.&nbsp;<a href="#">Privacy</a>&nbsp;&amp;&nbsp;<a
						href="#">Terms and Conditions</a>
				</p>
			</div>
			<div class="col-lg-6"></div>
		</div>
	</div>
</footer>

<script>
function ajax_submit(form_data, url, result, before, complete) {
	$.ajax({
		url: url,
		type: 'POST',
		data: form_data,
		beforeSend: before,
		success: function(msg) {
			  var res = $(msg).filter('span.redirect');
              if($(res).html() != null){
                  window.location.replace($(res).html()); 
                  return false;
              }
			$(result).html(msg);
		}
	}).done(complete);
};

$(function() {
	 $(".category_link").click(function(e){
		 var id = $(e.target).attr("id").match(/[\d]+$/);
		 ajax_submit(
					form_data = {
						categoryID: id.toString()},
						"<?php echo site_url('store/home/products'); ?>",
						'#products',
						function () {
							$("#products").hide("slow");
						},
						function () {
							$("#products").show("slow");
						}
				);
		 $( "#special_offer" ).show( "slow" );
			
				return false; 
	 });

	 $("#goToCart").click(function(e){
		 ajax_submit(
					form_data = {},
					"<?php echo site_url('store/cart'); ?>",
					'#products',
					function () {
						$( "#special_offer" ).hide( "slow" );
						$("#products").hide("slow");
					},
					function () {
						$("#products").show("slow");
					}
		);
		return false; 
	 });
	 
	 $(document.body).on('click', '.pagination_page_link > a' ,function(e){
		 var page = $(e.target).attr('href');
		 var catID = $("#products").children("div").attr('data-categoryID');
		 
		 ajax_submit(
					form_data = {
						categoryID: catID},
						page,
						'#products'
				);
				return false; 
		 });

	 $(document.body).on('click', '.view_btn' ,function(e){
		 var productID = $(e.target).attr('data-productID');
		 ajax_submit(
					form_data = {
						productID: productID}, 
						"<?php echo site_url('store/item'); ?>",
						'#products',
						function () {
							$("#products").hide("slow");
							$( "#special_offer" ).hide( "slow" );
						},
						function() {
							$( "#products" ).show( "slow" );
						}
				);
		 
				return false; 
		 });

	 $(document.body).on('click', '.addToCart_btn' ,function(e){

		 var productID = $(e.target).attr('data-productID');
		 var amount =  $('#quantity').val();
		 ajax_submit(
					form_data = {
						productID: productID,
						amount: amount}, 
						"<?php echo site_url('store/item/addToCart'); ?>",
						'#products',
						function () {
							$("#products").hide("slow");
						},
						function() {
							$( "#products" ).show( "slow" );
							$("#compact_cart").load(location.href+" #compact_cart>*","");
						}
				);
				return false; 
		 });

	 $(document.body).on('click', '#check_out_btn' ,function(e){
			 ajax_submit(
						form_data = {},
							"<?php echo site_url('store/cart/add_order'); ?>",
							'#products',
							function () {
								$("#products").hide("slow");
							},
							function() {
								$( "#special_offer" ).show( "slow" );
								$("#compact_cart").load(location.href+" #compact_cart>*","");
							}
					);
					return false; 
			 });
	 
	 $(document.body).on('click', '#special_offer_btn' ,function(e){
		 ajax_submit(
					form_data = {},
						"<?php echo site_url('store/home/special_offerts'); ?>",
						'#products',
						function () {
							$("#products").hide("slow");
							$( "#special_offer" ).hide( "slow" );
						},
						function() {
							$( "#products" ).show( "slow" );
						}
				);
				return false; 
		 });
});
</script>