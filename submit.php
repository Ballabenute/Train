<?php
	
	require 'database.php';

	$submit = array();

	$submit['name'] = $_REQUEST['name'];
	$submit['email'] = $_REQUEST['email'];
	$submit['address'] = $_REQUEST['address'];
	$submit['number'] = $_REQUEST['number'];
	$submit['complement'] = $_REQUEST['complement'];
	$submit['telephone'] = array();

	$number = $_REQUEST['nTel'];
	for ($n=0; $n <$number; $n++) {
		$submit['telephone'][$n] = $_REQUEST['number'.($n+1)];
	}


	if ($submit['name'] == "" || $submit['email'] == "" || $submit['telephone'][0] == "" ) {

?>
		<html lang="en">
		<head>
			<meta charset="utf-8">
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		</head>

		<body>
			<script>
				alert("Please complete the necessary fields.");
				window.location = "addContact";
			</script>
		</body>
		</html>
<?php

	}

	if ($submit['address'] == "") {
		$submit['address'] = NULL;
	}

	if ($submit['number'] == "") {
		$submit['number'] = 0;
	}

	if ($submit['complement'] == "") {
		$submit['complement'] = NULL;
	}

	$db = new database();

	$con = $db->OpenCon("agenda");

	$verify = "SELECT ID FROM contact WHERE email = \"".$submit['email']."\"";

	$resp = $con->query($verify);

	if ($resp->num_rows >0) {
?>
		<html lang="en">
		<head>
			<meta charset="utf-8">
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		</head>

		<body>
			<script>
				alert("This email is already registered.");
				window.location = "addContact";
			</script>
		</body>
		</html>
<?php
	}else{
		$insert = "INSERT INTO contact (name, email, address, number, complement) VALUES (\"".$submit['name']."\", \"".$submit['email']."\", \"".$submit['address']."\", \"".$submit['number']."\", \"".$submit['complement']."\");";

		$resp = $con->query($insert);

		$select = "SELECT ID FROM contact WHERE email= \"".$submit["email"]."\"";

		$resp = $con->query($select);

		$id = $db->RespIntoObject($resp,array('id'))[0];

		$insertTelephone = array();

		for ($t=0; $t <sizeof($submit["telephone"]) ; $t++) { 
			$insertTelephone[$n] = "INSERT INTO tel_number (number, contact_id) VALUES (\"".$submit['telephone'][$t]."\", \"".$id['id']."\");";
			$resp = $con->query($insertTelephone[$n]);
		}

	}
	?>
		<html lang="en">
		<head>
			<meta charset="utf-8">
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		</head>

		<body>
			<script>
				alert("Contact added to your Agenda.");
				window.location = "index";
			</script>
		</body>
		</html>
