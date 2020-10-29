<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Moto Change</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="//cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
	<!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script> -->


	<style type="text/css">

	::selection { background-color: #E13300; color: white; }
	::-moz-selection { background-color: #E13300; color: white; }

	body {
		background-color: #fff;
		margin: 40px;
		font: 13px/20px normal Helvetica, Arial, sans-serif;
		color: #4F5155;
	}

	a {
		color: #003399;
		background-color: transparent;
		font-weight: normal;
	}

	h1 {
		color: #444;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 19px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
	}

	#body {
		margin: 0px 50px 0 15px;
		size: 8px;
	}

	#container {
		margin: 10px;
		border: 1px solid #D0D0D0;
		box-shadow: 0 0 8px #D0D0D0;
		height: 800px;
	}
	form{
		margin-left: 350px;
	}

	#arrow_img{
		width: 100px;
		margin-top: 100px;
	}

	#current_img{
		width: 300px;
		margin-left: 300px;
	}

	#target_img{
		width: 300px;
	}


	</style>
</head>
<body>

<div id="container">
	<h1>New Paint Job<span><a style="float:right" href='Paint_jobs'>Paint Jobs</a><span></h1>

	<div id="body">
		<div class="row">
			<div class="col-md-5">
				<img id="current_img"src="/application/resources/image/default.png">
			</div>
			<div class="col-md-1">

				<img id="arrow_img" src="/application/resources/image/arrow_right.png">
			</div>
			<div class="col-md-4">
				<img id="target_img" src="/application/resources/image/default.png">
			</div>
		</div>

		<div class="row">
			<form method="POST" action="Create_job/add_job">
				<h6>Car Details</h6>
			 	<div class="form-group row">
				    <label  class="col-md-4 col-form-label">Plate No.</label>
				    <div class="col-md-8">
				    	<input type="text" class="form-control" placeholder="Plate No." name="plate_no" required="required">
				    </div>
			  	</div>

			  	<div class="form-group row">
					<label class="col-md-4 col-form-label" for="sel1">Current Color:</label>
					<div class="col-md-8">
						<select id= "current_color" class="form-control" name="current_color" required="required">
							<option></option>
							<option value="Blue">Blue</option>
							<option value="Red">Red</option>
							<option value="Green">Green</option>
						</select>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-md-4 col-form-label" for="sel1">Traget Color:</label>
					<div class="col-md-8">
						<select id= "target_color" class="form-control" name="target_color" required="required">
							<option></option>
							<option value="Blue">Blue</option>
							<option value="Red">Red</option>
							<option value="Green">Green</option>
						</select>
					</div>
				</div>
			  	
				
				<button type="submit" class="btn btn-primary">Submit</button>
				</form>
		</div>

	</div>
</div>

</body>

<script type="text/javascript">

	$(document).ready( function () {

		$( "#current_color" ).change(function() {
  			var color = $(this).val();
  			var image = get_image(color);
  			$('#current_img').attr("src", "/application/resources/image/"+image);
		});

		$( "#target_color" ).change(function() {
  			var color = $(this).val();
  			var image = get_image(color);
  			$('#target_img').attr("src", "/application/resources/image/"+image);
		});

		function get_image(color){
			var image = "default.png"
			if(color == "Red"){
				image = "red.png";
			}
			if(color == "Green"){
				image = "green.png";
			}
			if(color == "Blue"){
				image = "blue.png";
			}
			return image;
		}
	} );

</script>
</html>