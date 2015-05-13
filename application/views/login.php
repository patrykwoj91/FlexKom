<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	<h2 class="modal-title">Login</h2>
</div>
<!-- /modal-header -->

<div class="modal-body">
	<div id="admin_login" class="login_form">
		<?php 
		$attributes = array('id' => 'login');
		echo form_open('login/validateCredentials', $attributes);
		$data = array(
				'name'        	=> 'username',
				'id'			=> 'login_username',
				'type'        	=> 'text',
				'class'       	=> 'form-control',
				'placeholder'   => 'Username',
				'autofocus' 	=> 'autofocus',
				'required' 		=> 'required'
		);
		echo form_input($data);
		$data = array(
				'name'        	=> 'password',
				'id'			=> 'login_password',
				'type'        	=> 'text',
				'class'       	=> 'form-control',
				'placeholder'   => 'Password',
				'required' 		=> 'required'
		);
		echo form_password($data);
		echo form_close();
		?>
		<div class=errors></div>
	</div>
</div>
<!-- /modal-body -->

<div class="modal-footer login_form">
	<button class="btn btn-lg btn-primary btn-block" type="submit" id="login_submit">
				<strong>Login</strong>
	</button>
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
		 $("#login_submit").click(function(e){
			 ajax_submit(
						form_data = {
							username: $('#login_username').val(),
							password: $('#login_password').val()},
							"<?php echo site_url('login/validateCredentials'); ?>",
							'#admin_login .errors'
					);
					return false; 
			 });
	});
</script>
