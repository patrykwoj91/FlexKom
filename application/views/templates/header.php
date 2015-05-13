<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Online electronics store">
	<meta name="author" content="Patryk Wojcik">
	<title>FlexKom</title>
	
	
	<script src="<?php echo asset_url();?>/js/jquery-2.1.1.min.js"></script>
	<script src="<?php echo asset_url();?>/bootstrap/js/bootstrap.min.js"></script>
	<script src="<?php echo asset_url();?>/bootstrap-select-1.6.3/js/bootstrap-select.min.js"></script>
	
	<link rel="stylesheet" href="<?php echo asset_url();?>/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo asset_url();?>/bootstrap-select-1.6.3/css/bootstrap-select.min.css">
	<link rel="stylesheet" href="<?php echo asset_url();?>/css/style.css" type="text/css" media="screen"> <!-- Should be last to redefine some bootstrap styling -->
</head>
<body>
<script>

$(document).on({
    ajaxStart: function() { 
    	$('#spinner').show();   
    },
     ajaxStop: function() { $('#spinner').hide(); } ,
     ajaxError: function() {  $('#spinner').hide(); }
});
</script>
<div id="spinner" class="spinner" style="display:none;">
    <img id="img-spinner" src="<?php echo asset_url();?>/img/ajax-loader.gif" alt="Loading"/>
</div>