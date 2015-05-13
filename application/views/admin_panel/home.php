<div class="container-fluid">
	<div class="row">
		<div class="col-lg-6 centered_panel">
		<!-- Button trigger modal -->
			<a data-toggle="modal" href=<?php echo base_url('admin_panel/find_order')?>
				data-target="#find_order_panel_modal"> 
				<span class="glyphicon glyphicon-search"></span>
				<h2>Find order</h2>
			</a>
			<!-- Modal -->
			<div class="modal fade" id="find_order_panel_modal" tabindex="-1"
				role="dialog" aria-labelledby="find_order_panel_modal_label"
				aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content"></div>
					<!-- /.modal-content -->
				</div>
				<!-- /.modal-dialog -->
			</div>
			<!-- /.modal -->
		</div>
		
		<div class="col-lg-6 centered_panel">
		<!-- Button trigger modal -->
			<a data-toggle="modal" href=<?php echo base_url('admin_panel/product_availability')?>
				data-target="#product_availability_panel_modal"> 
				<span class="glyphicon glyphicon-barcode"></span>
				<h2>Check product availability</h2>
			</a>
			<!-- Modal -->
			<div class="modal fade" id="product_availability_panel_modal" tabindex="-1"
				role="dialog" aria-labelledby="product_availability_panel_modal_label"
				aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content"></div>
					<!-- /.modal-content -->
				</div>
				<!-- /.modal-dialog -->
			</div>
			<!-- /.modal -->
		</div>	
	</div>
	
	<div class="row">
		<div class="col-lg-6 centered_panel">
		<!-- Button trigger modal -->
			<a data-toggle="modal" href=<?php echo base_url('admin_panel/new_order')?>
				data-target="#new_order_panel_modal">
				<span class="glyphicon glyphicon-plus"></span>
				<h2>Add new local order</h2>
			</a>
			<!-- Modal -->
			<div class="modal fade" id="new_order_panel_modal" tabindex="-1"
				role="dialog" aria-labelledby="new_order_panel_modal_label"
				aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content"></div>
					<!-- /.modal-content -->
				</div>
				<!-- /.modal-dialog -->
			</div>
			<!-- /.modal -->
		</div>
		
		<div class="col-lg-6 centered_panel">
		<!-- Button trigger modal -->
			<a data-toggle="modal" href=<?php echo base_url('admin_panel/synchronization')?>
				data-target="#synchronization_panel_modal"> 
				<span class="glyphicon glyphicon-transfer"></span>
				<h2>Synchronize databases</h2>
			</a>
			<!-- Modal -->
			<div class="modal fade" id="synchronization_panel_modal" tabindex="-1"
				role="dialog" aria-labelledby="synchronization_panel_modal_label"
				aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content"></div>
					<!-- /.modal-content -->
				</div>
				<!-- /.modal-dialog -->
			</div>
			<!-- /.modal -->
		
		</div>		
	</div>
	
</div>