<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	<h2 class="modal-title">Login</h2>
</div>
<!-- /modal-header -->

<div class="modal-body">
	<div id="store_login" class="login_form">
		<?php 
		$attributes = array('id' => 'login');
		echo form_open('store/user_login/validateCredentials', $attributes);
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
	<button class="btn btn-lg btn-primary btn-block" type="submit" id="user_login_submit">
				<strong>Login</strong>
	</button>
<!-- /modal-footer -->

<script>
	function ajax_submit(form_data, url, result, result2) {
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
	              var error = $(msg).filter('p.alert');
	              if ($(error).html() != null) {
					  $(result2).html(msg);
					  return false;
	              }
	             $(result).replaceWith(msg);
			}
		});
	};

	$(function() {
		 $("#user_login_submit").click(function(e){
			 ajax_submit(
						form_data = {
							url: $(location).attr('href'),
							username: $('#login_username').val(),
							password: $('#login_password').val()},
							"<?php echo site_url('store/user_login/validateCredentials'); ?>",
							'#login_part',
							'#store_login .errors'	
					);
					return false; 
			 });
	});
</script>