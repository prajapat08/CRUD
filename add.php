<html>
<head>
	<title>Add Data</title>
</head>

<body>
<?php
//database connection 
include_once("config.php");
if(isset($_POST['Submit'])) {	
	$name = mysqli_real_escape_string($connection, $_POST['name']);
	$age = mysqli_real_escape_string($connection, $_POST['age']);
	$email = mysqli_real_escape_string($connection, $_POST['email']);
		
	// checking empty fields
	if(empty($name) || empty($age) || empty($email)) {
				
		if(empty($name)) {
			echo "<font color='red'>Name field is empty.</font><br/>";
		}
		
		if(empty($age)) {
			echo "<font color='red'>Age field is empty.</font><br/>";
		}
		
		if(empty($email)) {
			echo "<font color='red'>Email field is empty.</font><br/>";
		}
		
		//link to the previous page
		echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
	} else { 
		 	
		$result = mysqli_query($connection, "INSERT INTO users(name,age,email) VALUES('$name','$age','$email')");
		
		 
		echo "<font color='green'>User added successfully.";
		echo "<br/><a href='index.php'>View Result</a>";
	}
}
?>
</body>
</html>