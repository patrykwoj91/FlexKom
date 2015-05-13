<div class="row">
	<div class="col-lg-12">
		<h2>Shopping Cart</h2>
		<form>
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th>Item Name</th>
						<th>Qty</th>
						<th>Unit Price</th>
						<th>Total</th>
					</tr>
				</thead>
				<tbody>
				
				<?php foreach($this->cart->contents() as $item): ?>
					<tr>
						<td><?php echo $item['name'] ?></td>
						<td><input id="quantity-1" name="quantity-1" type="text"
							class="form-control form-control_reduced_more" value="<?php echo $item['qty'] ?>" />&nbsp;
							<a href="#"><span class="glyphicon glyphicon-refresh"></span></a><a href="#"><span class="glyphicon glyphicon-trash"></span></a>
						</td>
						<td><?php echo $item['price'] ?></td>
						<td class ="countit"><?php echo $item['subtotal'] ?></td>
					</tr>
				<?php endforeach;?>
				</tbody>
			</table>
		</form>

		<dl class="dl-horizontal pull-right">
			<dt>Total:</dt>
			<dd><?php echo $this->cart->total();?></dd>
		</dl>
		
		<div class="clearfix"></div>
		<a href=# class="btn btn-success pull-right" id="check_out_btn">Check out</a> <a
			href="<?php echo site_url('store/home')?>" class="btn btn-primary">Continue Shopping</a>
	</div>
</div>