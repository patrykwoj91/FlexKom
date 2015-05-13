<h1>Create an Account</h1>
<fieldset>
	<legend>Personal Infomation</legend>
	
	<?php 
	
	echo form_open('login/create_member');
	echo form_input('first_name', set_value('first_name', 'First Name'));
	echo form_input('last_name', set_value('last_name', 'Last Name'));
	echo form_input('email_address', set_value('email_address', 'Email Address'));
	
	?>
	<!--
	echo form_radio('gender', 'mezczyzna', set_radio('gender','mezczyzna'));
	echo form_label('Male', 'gender');
	echo form_radio('gender', 'kobieta', set_radio('gender','kobieta'));
	echo form_label('Female', 'gender'); 
	-->
</fieldset>

<fieldset>
	<legend>Login Info</legend>

	<?php 
	
	echo form_input('username', set_value('username','Username'));
	echo form_input('password', 'Password');
	echo form_input('confirm_password', 'Confirm Password');
	echo form_submit('submit', 'Create Account');

	?>
	
	<?php echo validation_errors('<p class="error">'); ?>
	
</fieldset>