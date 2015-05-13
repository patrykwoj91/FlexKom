	<nav class="navbar navbar-inverse" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<a href="" class="pull-left logo"> <img
					src="<?php echo asset_url()?>img/logo.png" alt="FlexKom" />
				</a>
				<h1 class="navbar-text">Online Mobile Store</h1>
				<h5 class="pull-right navbar-text">
					<p><?php echo $username ?></p>

					<p><?php
					if (isset ( $username )) {
						echo anchor ( 'login/logout', 'Logout' );
					}
					?></p>
				</h5>
			</div>

		</div>
	</nav>