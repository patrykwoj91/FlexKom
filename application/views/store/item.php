<div class="row">
	<div class="col-lg-6">
		<div id="items-carousel" class="carousel slide" data-ride="carousel">
			<!-- Indicators -->
			<ol class="carousel-indicators">
				<li data-target="#items-carousel" data-slide-to="0" class="active"></li>
				<li data-target="#items-carousel" data-slide-to="1"></li>
				<li data-target="#items-carousel" data-slide-to="2"></li>
			</ol>

			<div class="carousel-inner" role="listbox">
				<div class="item active">
					<img class="media-object" data-src="holder.js/470x310" alt="...">
					<div class="carousel-caption">...</div>
				</div>
				<div class="item">
					<img class="media-object" data-src="holder.js/470x310" alt="...">
					<div class="carousel-caption">...</div>
				</div>
				<div class="item">
					<img class="media-object" data-src="holder.js/470x310" alt="...">
					<div class="carousel-caption">...</div>
				</div>
			</div>

			<!-- Controls -->
			<a class="left carousel-control" href="#items-carousel" role="button"
				data-slide="prev"> <span class="glyphicon glyphicon-chevron-left"
				aria-hidden="true"></span> <span class="sr-only">Previous</span>
			</a> <a class="right carousel-control" href="#items-carousel"
				role="button" data-slide="next"> <span
				class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
				<span class="sr-only">Next</span>
			</a>
		</div>
	</div>

	<div class="col-lg-6">
		<h2><?php echo $product->nazwaProducenta ?></h2>
		<h3><?php echo $product->nazwaProduktu ?></h3>
		<p>Lorem Ipsum is simply dummy text of the printing and typesetting
			industry. Lorem Ipsum has been the industry's standard dummy text
			ever since the 1500s, when an unknown printer took a galley of type
			and scrambled it to make a type specimen book. It has survived not
			only five centuries, but also the leap into electronic typesetting,
			remaining essentially unchanged. It was popularised in the 1960s with
			the release of Letraset sheets containing Lorem Ipsum passages, and
			more recently with desktop publishing software like Aldus PageMaker
			including versions of Lorem Ipsum.</p>
		<h3>$<?php echo $product->cena?></h3>
		
		<form>
			<label> 
			Amount <input type="text" class="form-control form-control_reduced" id="quantity" name="quantity" value="1" class="" /> 
			</label>
			<button class="btn btn-primary addToCart_btn" data-productID = "<?php echo $productID ?>">Add to Cart</button>
		</form>
	</div>
</div>

<div class="row">
	<div class="col-lg-12">
		<div role="tabpanel">
			<ul class="nav nav-tabs" role="tablist">
				<li role="presentation" class="active"><a href="#description"
					aria-controls="description" role="tab" data-toggle="tab">Description</a></li>
				<li role="presentation"><a href="#reviews" aria-controls="reviews"
					role="tab" data-toggle="tab"> Reviews</a></li>
			</ul>

			<div class="tab-content">
				<div role="tabpanel" class="tab-pane active" id="description">
					<p>Lorem Ipsum is simply dummy text of the printing and typesetting
						industry. Lorem Ipsum has been the industry's standard dummy text
						ever since the 1500s, when an unknown printer took a galley of
						type and scrambled it to make a type specimen book. It has
						survived not only five centuries, but also the leap into
						electronic typesetting, remaining essentially unchanged. It was
						popularised in the 1960s with the release of Letraset sheets
						containing Lorem Ipsum passages, and more recently with desktop
						publishing software like Aldus PageMaker including versions of
						Lorem Ipsum.</p>
				</div>
				<div role="tabpanel" class="tab-pane" id="reviews">...</div>
			</div>
		</div>
	</div>
</div>
<script src="<?php echo asset_url();?>js/holder.js"></script>
<?php echo $scripting; ?>