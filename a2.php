<?php
	
	$db = mysqli_connect('localhost', 'root', '', 'mydbassi2');

	parse_str($_SERVER['QUERY_STRING'], $output);
	
	$length = sizeof($output);
	$method = $output['method'];
	if($method == "get" && $length == 1) {

    	$results = mysqli_query($db, "SELECT * FROM users");
    	$data = array();
    	while ($row = mysqli_fetch_array($results)) {
    		array_push($data, $row);
    	}
		echo json_encode($data);
		
	} else if($method == "get" && $length == 2) {

		$id = $_GET['id'];
		$results = mysqli_query($db, "SELECT * FROM users WHERE id=$id");
    	$data = array();
    	while ($row = mysqli_fetch_array($results)) {
    		array_push($data, $row);
    	}
		echo json_encode($data);

	} else if($method == "post" && $length == 3) {
		//echo "Entered post";
		$first_name = $_GET['first_name'];
		$last_name = $_GET['last_name'];
		//echo $first_name;
		//echo $last_name;
		mysqli_query($db, "INSERT INTO users (first_name, last_name) VALUES ('$first_name', '$last_name')"); 
    	$data = array();
    	$results = mysqli_query($db, "SELECT * FROM users ORDER BY id DESC LIMIT 1");
    	while ($row = mysqli_fetch_array($results)) {
    		array_push($data, $row);
    	}
    	echo json_encode($data);

	} else if($method == "put" && $length == 4) {

		$id = $_GET['id'];
		$results = mysqli_query($db, "SELECT * FROM users WHERE id=$id");
		$rowcount = mysqli_num_rows($results);
		if($rowcount == 1) {
			$first_name = $_GET['first_name'];
			$last_name = $_GET['last_name'];
			mysqli_query($db, "UPDATE users SET first_name = '$first_name', last_name = '$last_name' WHERE id=$id"); 
	    	$data = array();
	    	$results = mysqli_query($db, "SELECT * FROM users WHERE id=$id");
	    	while ($row = mysqli_fetch_array($results)) {
	    		array_push($data, $row);
	    	}
	    	echo json_encode($data);
		} else {
			$first_name = $_GET['first_name'];
			$last_name = $_GET['last_name'];
			mysqli_query($db, "INSERT INTO users (first_name, last_name) VALUES ('$first_name', '$last_name')"); 
	    	$data = array();
	    	$results = mysqli_query($db, "SELECT * FROM users ORDER BY id DESC LIMIT 1");
	    	while ($row = mysqli_fetch_array($results)) {
	    		array_push($data, $row);
	    	}
	    	echo json_encode($data);
		}

	} else if($method == "delete" && $length == 2) {

		$id = $_GET['id'];
		$results = mysqli_query($db, "SELECT * FROM users WHERE id=$id");
		$rowcount = mysqli_num_rows($results);
		if($rowcount == 1) {
			$id = $_GET['id'];
			mysqli_query($db, "DELETE FROM users WHERE id=$id"); 
    		echo "Employee with ID $id is successfully deleted.";
		} else {
			echo "Could not find employee with ID $id.";
		}
		

	}
?>