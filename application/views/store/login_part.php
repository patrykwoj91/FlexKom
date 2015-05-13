<div id="login_part">
	<p><?php echo $username; ?></p>
					
				<?php if ($username != NULL): ?>
					<a href=<?php echo base_url('store/user_login/logout');?>> Logout </a>
				<?php else: ?>
					<!-- Button trigger modal -->
	<a data-toggle="modal" id="login_click" href=<?php echo base_url('store/user_login');?>
		data-target="#store_panel_modal"> Login </a>
				<?php endif; ?>
</div>