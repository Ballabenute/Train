<?php

	$id = $_REQUEST["ID"];

	require 'database.php';

	$db = new database();

	$con = $db->OpenCon("agenda");

	$delete1 = "DELETE FROM contact WHERE id = \"".$id."\"";
	$delete2 = "DELETE FROM tel_number WHERE contact_id = \"".$id."\"";
	
	$true1 = $con->query($delete1);
	$true2 = $con->query($delete2);

?>
<html lang="en">
	<head>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	</head>

	<body>
		<script>
			alert("Contact deleted.");
			window.location = "index";
		</script>
	</body>
</html>