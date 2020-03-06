<?php

	require 'database.php';

	$db = new database();

	$con = $db->OpenCon("agenda");

	$query = "SELECT * FROM contact ORDER BY name";

	$resp = $con->query($query);

	$col = array("ID","Name","Address","Number","Complement");

	$contacts = $db->RespIntoObject($resp,$col);

	$colTel = array("ID","Number","Contact Id");

	for ($c=0; $c <sizeof($contacts) ; $c++) { 
		$queryNumber[$c] = "SELECT * FROM tel_number WHERE contact_id = '".$contacts[$c]['ID']."'";

		$respNumber[$c] = $con->query($queryNumber[$c]);

		$contacts[$c]["Tel"] = $db->RespIntoObject($respNumber[$c],$colTel);

	}

	$db->CloseCon($con);

?>

<html lang="en">
<head>
	<meta charset="utf-8">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<title>Menu</title>
</head>

<body>
	<div>
		<center>
			<h1>Agenda</h1>
		</center>
	</div>

	<center>
		<form action="/addContact" method="Post">
			<input type="submit" value="New Contact">
		</form>
	</center>
	

	<?php
		for ($c=0; $c <sizeof($contacts); $c++) { 
	?>
		<center>
			<div>
				<h3 style=" display: inline-block;margin-right: 2%;"><?php echo $contacts[$c]["Name"]; ?></h3>
				<form action="/editContact" method="Post" style=" display: inline-block;">
					<input type="hidden" name="ID" value="<?php echo $contacts[$c]["ID"]; ?>">
					<input type="submit" value="Edit">
				</form>
				<form action="/seeContact" method="Post" style=" display: inline-block;">
					<input type="hidden" name="ID" value="<?php echo $contacts[$c]["ID"]; ?>">
					<input type="submit" value="Visualize Contact">
				</form>
				<form action="/delete" method="Post" style=" display: inline-block;">
					<input type="hidden" name="ID" value="<?php echo $contacts[$c]["ID"]; ?>">
					<input type="submit" value="Delete Contact">
				</form>
			</div>
		</center>
		<br>
	<?php
		}
	?>

</body>
</html>