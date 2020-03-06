<?php
	require 'database.php';

	$id = $_REQUEST['ID'];

	$db = new database();

	$con = $db->OpenCon("agenda");

	$select1 = "SELECT name,address,number,complement,email FROM contact WHERE ID = \"".$id."\"";
	$select2 = "SELECT number FROM tel_number WHERE contact_id = \"".$id."\"";

	$result1 = $con->query($select1);
	$result2 = $con->query($select2);

	$col1 = array('name','address','number','complement','email');
	$col2 = array('number');


	$resp1 = $db->RespIntoObject($result1,$col1);
	$resp2 = $db->RespIntoObject($result2,$col2);
?>
<html lang="en">
<head>
	<meta charset="utf-8">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<title>See Contact</title>
</head>

<body>
	<div>
		<center>
			<h1>See Contact</h1>
		</center>
	</div>

	<center>

			<div>
				<p style="font-weight: bold; display: inline-block;">Name:  </p>
				<input type="text" name="name" placeholder="Name" readonly="true" value="<?php echo($resp1[0]['name']) ?>">
			</div>
			<div>
				<p style="font-weight: bold; display: inline-block;">Email:  </p>
				<input type="text" name="email" placeholder="Email" readonly="true" value="<?php echo($resp1[0]['email']) ?>">
			</div>
			<div>
				<p style="font-weight: bold; display: inline-block;">Address:  </p>
				<input type="text" name="address" placeholder="Address" readonly="true" value="<?php echo($resp1[0]['address']) ?>">
			</div>
			<div>
				<p style="font-weight: bold; display: inline-block;">Number:  </p>
				<input type="text" name="number" placeholder="Number" readonly="true" value="<?php echo($resp1[0]['number']) ?>">
			</div>
			<div>
				<p style="font-weight: bold; display: inline-block;">Complement:  </p>
				<input type="text" name="complement" placeholder="Complement" readonly="true" value="<?php echo($resp1[0]['complement']) ?>">
			</div>
			<div>
				<div>
					<h3 style="font-weight: bold; display: inline-block;">Telephone Number</h3>
					<input type="hidden" name="nTel" id="nTel" value="1">
				</div>
				<?php
					for ($t=0; $t <sizeof($resp2); $t++) { 
				?>					

				<div>
					<p style="font-weight: bold; display: inline-block;"><?php echo($t+1); ?>º Number:  </p>
					<input type="text" name="number1" placeholder="Telephone Number" readonly="true" value="<?php echo($resp2[$t]['number']); ?>">
				</div>
				<?php
					}
				?>					
			</div>
	</center>
	<script></script>
</body>
</html>