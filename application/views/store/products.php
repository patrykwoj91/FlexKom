<div data-categoryID = "<?php echo $catID ?>">
	<nav class="text-center">
		<p><?php echo $links; ?></p>
	</nav>

	<div class="container-fluid">
		<div class="row">

	<?php foreach($products as $product) : ?>
		<div class="col-lg-4">
				<div class="thumbnail">
					<img data-src="holder.js/300x200" alt="...">
					<div class="caption">
						<h3><?php echo $product->nazwa; ?></h3>
						<p>
						$<?php echo $product->cena; ?>
					</p>
						<p>
							<a data-productID = "<?php echo $product->produktID ?>" class="btn btn-primary view_btn" role="button">View</a> 
							<a data-productID = "<?php echo $product->produktID ?>" class="btn btn-success add_to_cart_btn" role="button">Add to Cart</a>
						</p>
					</div>
				</div>
			</div>
	<?php endforeach;?>
	</div>
	</div>

	<nav class="text-center">
		<p><?php echo $links; ?></p>
	</nav>
</div>
<script src="<?php echo asset_url();?>js/holder.js"></script>
