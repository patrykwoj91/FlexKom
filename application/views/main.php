<div class="container-fluid">
	<div class="row">
		<div class="col-lg-6 centered_panel">
			<a href=<?php echo base_url('store/home')?>> <img class="main_image"
				src="<?php echo asset_url()?>img/store.png" alt="Store">
				<h2>Enter Store</h2>
			</a>
		</div>

		<div class="col-lg-6 centered_panel">
			<!-- Button trigger modal -->
			<a data-toggle="modal" href=<?php echo base_url('login')?>
				data-target="#employee_panel_modal"> <img class="main_image"
				src="<?php echo asset_url()?>img/employee.png"
				alt="Login to employee panel">
				<h2>Enter Employee Panel</h2>
			</a>
			<!-- Modal -->
			<div class="modal fade" id="employee_panel_modal" tabindex="-1"
				role="dialog" aria-labelledby="employee_panel_modal_label"
				aria-hidden="true">
				<div class="modal-dialog modal-width">
					<div class="modal-content"></div>
					<!-- /.modal-content -->
				</div>
				<!-- /.modal-dialog -->
			</div>
			<!-- /.modal -->
		</div>
	</div>
</div>