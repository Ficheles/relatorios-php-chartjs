<?php
	error_reporting(E_ALL);
	ini_set("display_errors", 1);

	include_once('classes/Traffic.php');
	new Traffic();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<meta charset="utf-8">
	<title>Home</title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
	<link rel="stylesheet" href="/assets/css/style.css">

</head>
<body>
	<div class="container-fluid">
<?php 
	include_once('includes/header.php'); 
?>
<?php	
	if ( isset($page) && file_exists($page)):
		include_once($page); 
	endif;
?>
		<div class="row">	
			<div class="col-md-4">
				<a href="ip-api.com">Api-IP</a>
			</div>
		</div>
	</div>

	<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
	<script src="/assets/js/chart.init.js" charset="utf-8"></script>

</body>
</html>