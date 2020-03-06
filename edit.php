<?php

	$id = $_REQUEST["id"];

	$edit["name"] = $_REQUEST["name"];
	$edit["email"] = $_REQUEST["email"];
	$edit["address"] = $_REQUEST["address"];
	$edit["number"] = $_REQUEST["number"];
	$edit["complement"] = $_REQUEST["complement"];

	$nTel = $_REQUEST["nTel"];

	$edit['telephone'] = array();

	for ($n=0; $n <$nTel; $n++) {
		$edit['telephone'][$n] = $_REQUEST['number'.($n+1)];
	}

////////////////////////////////////////////////////////


	if ($edit['name'] == "" || $edit['email'] == "" || $edit['telephone'][0] == "" ) {

?>
		<html lang="en">
		<head>
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		</head>

		<body>
			<script>
				alert("Please complete the necessary fields.");
				window.location = "editContact";
			</script>
		</body>
		</html>
<?php
	}

////////////////////////////////////////////////////////

	require 'database.php';

	$db = new database();

	$con = $db->OpenCon("agenda");

	$update = "UPDATE contact SET name = \"".$edit["name"]."\", address = \"".$edit["address"]."\", number = \"".$edit["number"]."\", complement = \"".$edit["complement"]."\", email = \"".$edit["email"]."\" WHERE id = \"".$id."\"";

	$resp = $con->query($update);

////////////////////////////////////////////////////////

	$remove = "DELETE FROM tel_number WHERE contact_id = \"".$id."\"";

	$insertTelephone = array();

	for ($t=0; $t <sizeof($edit["telephone"]) ; $t++) { 
		$insertTelephone[$n] = "INSERT INTO tel_number (number, contact_id) VALUES (\"".$edit['telephone'][$t]."\", \"".$id."\");";
		$resp = $con->query($insertTelephone[$n]);
	}
?>
<html lang="en">
	<head>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	</head>

	<body>
		<script>
			alert("Contact edited.");
			window.location = "index";
		</script>
	</body>
</html>