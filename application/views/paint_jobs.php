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
		margin: 0 15px 0 15px;
		size: 8px;
	}

	#container {
		margin: 10px;
		border: 1px solid #D0D0D0;
		box-shadow: 0 0 8px #D0D0D0;
		height: 800px;
	}
	.header{

		color: white;
		background-color: red;
	}
	
	td.leftpadding {
	  padding-left: 50px;
	}
	#blue, #red, #green, #total{
		text-align: right;
		width: 50px;
	}

	#performance{
		padding: 0px;
		background-color: #F0F0F0;
		width: 100%;
		margin: 10px;
		height: 150px;
		margin-top: 45px;
	}

	#tbperformance{
		margin-left: 20px;
	}
	thead{
		background-color: #F0F0F0;
	}

	</style>
</head>
<body>

<div id="container">
	<h1>Paint Jobs <span><a style="float:right" href='create_job'>New Paint Jobs</a><span></h1>

	<div id="body">
		<div class="row">
			<div class="col-md-8 float-left">
			<h6>Paint in Progress</h6><br>
				<table id="jobsTable" class="table">
					<thead>
						<td>Plate No.</td>
						<td>Current Color</td>
						<td>Target Color</td>
						<td>Action</td>
					</thead>
					<tbody></tbody>

				</table>
			</div>
				
			<div class="col-md-3 float-right" id="performance">
				<div class="header">
					<h6>Shop Performance</h6>
				</div>
			
				<div>	
					<table id="tbperformance">
						<tr>
							<td>Total Car Painted :</td>
							<td id="total"></td>
						</tr>
						<tr >
							<td>Braakdown :</td>
							<td></td>
						</tr>
						<tr>
							<td class="leftpadding">Blue</td>
							<td id="blue"></td>
						</tr>
						<tr>
							<td class="leftpadding">Red </td>
							<td id="red"></td>
						</tr>
						<tr>
							<td class="leftpadding">Green</td>
							<td id="green"></td>
						</tr>
					</table>
				</div>
		
			</div>
		</div>

		<div class="row">
			<div class="col-md-8"><br><br>
				<h6>Paint in Queue</h6>
				<table id="queuejobsTable" class="table">
					<thead>
						<td>Plate No.</td>
						<td>Current Color</td>
						<td>Target Color</td>
					</thead>
					<tbody></tbody>

				</table>
			</div>
		</div>

	</div>
</div>

</body>

<script type="text/javascript">

	$(document).ready( function () {


		var datatable = $('#jobsTable').DataTable({
			
			"ajax": {
	            'url' : "Paint_jobs/get_active_jobs",
	            'type' : 'GET'
	        },
            "processing": true,
            "serverSide": true,
			"searching": false,
			"order": false,
			"bPaginate": false,
		    "bFilter": true,
		    "bInfo": false		    

		});


		var datatable2 =$('#queuejobsTable').DataTable({
			
			"ajax": {
	            'url' : "Paint_jobs/get_queue_jobs",
	            'type' : 'GET'
	        },
            "processing": true,
            "serverSide": true,
			"searching": false,
			"order": false,
			// "bPaginate": false,
		    "bFilter": true,
		    "bInfo": false		    

		});
		

		refreshtables();
	
		setInterval(refreshtables, 5000);

		$("#jobsTable").on("click", ".complete_job", function(e){
		   	e.preventDefault();
		   	var plate_no = $(this).data('plate_no')
		   	console.log(plate_no);
			$.post("Paint_jobs/complete_job",
			{
				'plate_no': plate_no
			},
			function(data, status){
				
				refreshtables();
			});

		});

		function refreshtables(){
			getsummary();
		    datatable.ajax.reload();
		    datatable2.ajax.reload();
		}

		function getsummary(){
			$.get( "Paint_jobs/get_summary", function( data ) {
				data = JSON.parse(data);
				data = data[0];
			  	$( "#total" ).text( data.total );
			  	$( "#blue" ).text( data.blue );
			  	$( "#red" ).text( data.red );
			  	$( "#green" ).text( data.green );
			  	
			});
		}
	} );

</script>
</html>