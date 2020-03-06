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
	<title>Edit Contact</title>
</head>

<body>
	<div>
		<center>
			<h1>Edit Contact</h1>
		</center>
	</div>

	<center>
		<form action="/edit.php" method="Post">
			<div>
				<input type="hidden" name="id" value="<?php echo($id) ?>">
			</div>
			<div>
				<p style="font-weight: bold; display: inline-block;">Name</p><p style="color: red; display: inline-block;">*</p><p style="display: inline-block;">:  </p>
				<input type="text" name="name" placeholder="Name"  value="<?php echo($resp1[0]['name']) ?>">
			</div>
			<div>
				<p style="font-weight: bold; display: inline-block;">Email</p><p style="color: red; display: inline-block;">*</p><p style="display: inline-block;">:  </p>
				<input type="text" name="email" placeholder="Email"  value="<?php echo($resp1[0]['email']) ?>">
			</div>
			<div>
				<p style="font-weight: bold; display: inline-block;">Address:  </p>
				<input type="text" name="address" placeholder="Address"  value="<?php echo($resp1[0]['address']) ?>">
			</div>
			<div>
				<p style="font-weight: bold; display: inline-block;">Number:  </p>
				<input type="text" name="number" placeholder="Number"  value="<?php echo($resp1[0]['number']) ?>">
			</div>
			<div>
				<p style="font-weight: bold; display: inline-block;">Complement:  </p>
				<input type="text" name="complement" placeholder="Complement"  value="<?php echo($resp1[0]['complement']) ?>">
			</div>
			<div>
				<div>
					<h3 style="font-weight: bold; display: inline-block;">Telephone Number</h3><button type="button" style="margin-left: 1%;" id="addNumber">+</button>
					<button type="button" style="margin-left: 1%;" id="removeNumber">-</button>
					<input type="hidden" name="nTel" id="nTel" value="<?php echo(sizeof($resp2)); ?>">
				</div>
				<?php
					for ($t=0; $t <sizeof($resp2); $t++) { 
				?>					

				<div>
					<?php if ($t ==0) {?>
					<p style="font-weight: bold; display: inline-block;"><?php echo($t+1); ?>º Number</p><p style="color: red; display: inline-block;">*</p><p style="display: inline-block;">:  </p>
					<?php }else{ ?>
					<p style="font-weight: bold; display: inline-block;"><?php echo($t+1); ?>º Number:  </p>
					<?php } ?>
					<input type="text" name="number1" placeholder="Telephone Number" value="<?php echo($resp2[$t]['number']); ?>">
				</div>
				
				<?php
					}
				?>
				<div id="tel">
					
				</div>					
			</div>
			<input type="submit" value="Edit">
		</form>
	</center>
	<script>
		$(document).ready(function(){
			$("#addNumber").click(function(){
				var number = document.getElementById("nTel").value;

				number++;

				document.getElementById("nTel").value = number;

				var text = "";

				var tmp = "";
				
				for (var i = <?php echo(sizeof($resp2)); ?>; i < number; i++) {


					tmp = "<div> <p style=\"font-weight: bold; display: inline-block;\">"+(i+1)+"º Number</p><p style=\"display: inline-block;\">:  </p> <input type=\"text\" name=\"number"+(i+1)+"\" placeholder=\"Telephone Number\"></div>";
					text = text.concat(tmp);
				}
				document.getElementById("tel").innerHTML = text;

				
			});
			$("#removeNumber").click(function(){
				var number = document.getElementById("nTel").value;

				number--;

				if (number < <?php echo(sizeof($resp2)); ?>) {
					number = <?php echo(sizeof($resp2)); ?>;
				}

				document.getElementById("nTel").value = number;

				var text = "";

				var tmp = "";
				
				for (var i = <?php echo(sizeof($resp2)); ?>; i < number; i++) {


					tmp = "<div> <p style=\"font-weight: bold; display: inline-block;\">"+(i+1)+"º Number</p><p style=\"display: inline-block;\">:  </p> <input type=\"text\" id=\"number"+(i+1)+"\" placeholder=\"Telephone Number\"></div>";
					text = text.concat(tmp);
				}
				document.getElementById("tel").innerHTML = text;

				
			});
		});

	</script>
	</body>
</html>