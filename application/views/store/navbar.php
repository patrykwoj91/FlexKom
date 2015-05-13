<nav id="store_navbar" class="navbar navbar-inverse" role="navigation">
	<div class="container-fluid">
		<div class="navbar-header">
			<a href="" class="pull-left logo"> <img
				src="<?php echo asset_url();?>img/logo.png" alt="FlexKom" />
			</a>
			<h1 class="navbar-text">Online Mobile Store</h1>
			<h5 class="pull-right navbar-text">
			<?php $this->load->view('store/login_part');?>
				<!-- Modal -->

				<div class="modal fade" id="store_panel_modal" tabindex="-1"
					role="dialog" aria-labelledby="store_panel_modal_label"
					aria-hidden="true">
					<div class="modal-dialog modal-width">
						<div class="modal-content"></div>
						<!-- /.modal-content -->
					</div>
					<!-- /.modal-dialog -->
				</div>
				<!-- /.modal -->
			</h5>
		</div>
	</div>
</nav>