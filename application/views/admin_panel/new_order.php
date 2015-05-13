<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal"
		aria-hidden="true">&times;</button>
	<h2 class="modal-title">Add new local order</h2>
</div>
<!-- /modal-header -->

<div class="modal-body">
	<div class="row" id="add_product">
		<div class="col-lg-5">
			<select class="selectpicker" data-live-search="true" data-size="auto">
					<?php foreach ($rows as $row): ?>
	    				<option data-subtext=<?php echo $row->cena?>><?php echo $row->nazwa ?></option>
					<?php endforeach; ?>	  			
	  			</select>
		</div>

		<div class="col-lg-4">
			<div class="row vertical-align">
				<div class="col-lg-5">
					<label>Amount</label>
				</div>

				<div class="col-lg-7">
					<input type="number" id="amount" class="form-control" value="1"
						required />
				</div>
			</div>
		</div>

		<div class="col-lg-3">
			<button class="btn btn-default" type="submit"
				id="product_list_add_btn">
				<span class="glyphicon glyphicon-ok-sign"></span> <strong>Add
					product</strong>
			</button>
		</div>
	</div>
	<div id="new_order_result">
		<div class="row">
			<h3>Shopping Cart</h3>
			<div class="table-responsive">
				<table class="table table-striped table-hover">
					<thead>
						<tr>
							<th>Item Name</th>
							<th>Qty</th>
							<th>Unit Price</th>
							<th>Total</th>
						</tr>
					</thead>
					<tbody id="add_product_result">

					</tbody>
				</table>
			</div>
		</div>
		<div class="row" id="summary">
			<dl class="dl-horizontal pull-right">
				<dt>Summary:</dt>
				<dd id="total_price">#</dd>
			</dl>
		</div>
	</div>
</div>
<!-- /modal-body -->

<div class="modal-footer">
	<button class="btn btn-lg btn-primary btn-block" type="submit"
		id="order_add_btn">
		<span class="glyphicon glyphicon-plus-sign"></span> <strong>Add order</strong>
	</button>
</div>
<!-- /modal-footer -->

<script>
	$('.selectpicker').selectpicker();

	function ajax_submit(form_data, url, result) {
		$.ajax({
			url: url,
			type: 'POST',
			data: form_data,
			success: function(msg) {
				  var res = $(msg).filter('span.redirect');
	              if($(res).html() != null){
	                  window.location.replace($(res).html()); 
	                  return false;
	              }
				$(result).html(msg);
			},
		});
	};

	function ajax_submit_append(form_data, url, result, complete) {
		$.ajax({
			url: url,
			type: 'POST',
			data: form_data,
			success: function(msg) {
				  var res = $(msg).filter('span.redirect');
	              if($(res).html() != null){
	                  window.location.replace($(res).html()); 
	                  return false;
	              }
				$(result).append(msg);
			}
		}).done(complete);
	};
	
	function calculateSum() {
		var sum = 0;
		// iterate through each td based on class and add the values
			$(".countit").each(function() {

	    	var value = $(this).text();
	    	// add only if the value is number
	    	if(!isNaN(value) && value.length != 0) {
	        	sum += parseFloat(value);
	    	}
		});
		$('#total_price').text(sum);  
	};
	
	$(function() {
		 $("#product_list_add_btn").click(function(e){
			 ajax_submit_append(
						form_data = {
							product_name: $('.selectpicker option:selected').val(),
							amount: $('#amount').val()},
							"<?php echo site_url('admin_panel/new_order/add_product'); ?>",
							'#add_product_result',
							calculateSum
					);
			 return false; 
			 });
	});

	$(function() {
		 $("#order_add_btn").click(function(e){
			 ajax_submit(
						form_data = {},
							"<?php echo site_url('admin_panel/new_order/add'); ?>",
							'#add_product_result'
					);
					return false; 
			 });
	});
	
</script>