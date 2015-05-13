<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
<h2 class="modal-title">Synchronize local database</h2>
</div>
<!-- /modal-header -->

<div class="modal-body">
	<button class ="btn btn-lg btn-block btn-primary" type= "submit" id = "synchronization_btn">
		<span class="glyphicon glyphicon-transfer"></span> <strong>Synchronize</strong>
	</button>
</div>
<!-- /modal-body -->

<div class="modal-footer">
	<div id="synchronization_result"></div>
</div>
<!-- /modal-footer -->

<script>
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
			}
		});
	};

	$(function() {
		 $("#synchronization_btn").click(function(e){
			 ajax_submit(
						form_data = {},
							"<?php echo site_url('admin_panel/synchronization/synchronize'); ?>",
							'#synchronization_result'
					);
					return false; 
			 });
	});
</script>

