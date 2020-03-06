<html lang="en">
<head>
	<meta charset="utf-8">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<title>New Contact</title>
</head>

<body>
	<div>
		<center>
			<h1>Add Contact</h1>
		</center>
	</div>

	<center>
		<form action="/submit" method="Post">

			<div>
				<p style="font-weight: bold; display: inline-block;">Name</p><p style="color: red; display: inline-block;">*</p><p style="display: inline-block;">:  </p>
				<input type="text" name="name" placeholder="Name">
			</div>
			<div>
				<p style="font-weight: bold; display: inline-block;">Email</p><p style="color: red; display: inline-block;">*</p><p style="display: inline-block;">:  </p>
				<input type="text" name="email" placeholder="Email">
			</div>
			<div>
				<p style="font-weight: bold; display: inline-block;">Address:  </p>
				<input type="text" name="address" placeholder="Address">
			</div>
			<div>
				<p style="font-weight: bold; display: inline-block;">Number:  </p>
				<input type="text" name="number" placeholder="Number">
			</div>
			<div>
				<p style="font-weight: bold; display: inline-block;">Complement:  </p>
				<input type="text" name="complement" placeholder="Complement">
			</div>
			<div>
				<div>
					<h3 style="font-weight: bold; display: inline-block;">Telephone Number</h3><button type="button" style="margin-left: 1%;" id="addNumber">+</button>
					<button type="button" style="margin-left: 1%;" id="removeNumber">-</button>
					<input type="hidden" name="nTel" id="nTel" value="1">
				</div>

				<div>
					<p style="font-weight: bold; display: inline-block;">1º Number</p><p style="color: red; display: inline-block;">*</p><p style="display: inline-block;">:  </p>
					<input type="text" name="number1" placeholder="Telephone Number">
				</div>
				<div id="tel">
					
				</div>
			</div>
			<input type="submit" value="Add">
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
				
				for (var i = 1; i < number; i++) {


					tmp = "<div> <p style=\"font-weight: bold; display: inline-block;\">"+(i+1)+"º Number</p><p style=\"display: inline-block;\">:  </p> <input type=\"text\" name=\"number"+(i+1)+"\" placeholder=\"Telephone Number\"></div>";
					text = text.concat(tmp);
				}
				document.getElementById("tel").innerHTML = text;

				
			});
			$("#removeNumber").click(function(){
				var number = document.getElementById("nTel").value;

				number--;

				if (number < 1) {
					number = 1;
				}

				document.getElementById("nTel").value = number;

				var text = "";

				var tmp = "";
				
				for (var i = 1; i < number; i++) {


					tmp = "<div> <p style=\"font-weight: bold; display: inline-block;\">"+(i+1)+"º Number</p><p style=\"display: inline-block;\">:  </p> <input type=\"text\" id=\"number"+(i+1)+"\" placeholder=\"Telephone Number\"></div>";
					text = text.concat(tmp);
				}
				document.getElementById("tel").innerHTML = text;

				
			});
		});

	</script>
</body>
</html>