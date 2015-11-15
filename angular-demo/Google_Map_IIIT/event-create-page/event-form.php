<?php


if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$eventname = $_POST["event_name"];
	$organiser =  $_POST["event_organiser"];
	$contact = $_POST["organiser_contact"];
	$email = $_POST["email"];
	$startdate = $_POST["start_date"];
	$starttime = $_POST["start_time"];
	$enddate = $_POST["end_date"];
	$endtime = $_POST["end_time"];
	$eventlocation = $_POST["Parent_Location"];
	

	if(isset($_POST["event_detail"]))
		$room = $_POST["Child_Location"];
	else
		$room = "";
	
	if(isset($_POST["event_detail"]))
		$description = $_POST["event_detail"];
	else
		$description = "";

	$mysql_host = "localhost";
	$mysql_user = "root";
	$mysql_pass = "unknownremo24";

	$mysql_db = 'event_portal';

	$conn = mysql_connect($mysql_host, $mysql_user, $mysql_pass) or die("connection failed");

	$sql = "INSERT INTO event (eventname,organiser,contact,email,starttime,endtime,eventlocation,room,description) VALUES ('$eventname','$organiser','$contact','$email','$startdate. .$starttime','$enddate. .$endtime','$eventlocation','$room','$description')";

	mysql_select_db($mysql_db);

	$retval = mysql_query( $sql, $conn );
	if(! $retval )
	{
		die('Could not enter data: ' . mysql_error());
	}
	
	//echo "Connection to db succesful";
	//echo "Entered data successfully\n";

	$sql2 = "SELECT * FROM event";
	$retval2 = mysql_query( $sql2, $conn );
	
	
        $str = "data = [";
	while($row = mysql_fetch_array($retval2, MYSQL_ASSOC))
	{
		$str =  $str.json_encode($row).',';
	}
	$str = $str."]";

	//echo $str;
	$fpointer = fopen("/var/www/html/angular-demo/objectfiles/object.js",'w') or die("File didnt open");
	
	fwrite($fpointer, $str);
	mysql_close($conn);
}

?>

<!DOCTYPE html>
<html >
	<head>
		<meta charset="utf-8">
		<title>Events-page</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
		<script src="event-form.js"> </script>
		
	</head>
	<body>
		
		
		<h1>Event Form</h1>
		
		<form action="event-form.php" method="POST">
			Name: <input type="text" name="event_name" required pattern="[a-zA-Z0-9 ]+"> <br> <br>
			Event Organiser: <input type="text" name="event_organiser" required pattern="[a-zA-Z0-9 ]+"> <br> <br>
			Contact Number: <input type="text" name="organiser_contact" required pattern="[0-9]+"> <br> <br>
			Start date: <input type="date" name="start_date" required>
			Start time: <input type="time" name="start_time" required><br> <br>
			End date: <input type="date" name="end_date" required> 
			End time: <input type="time" name="end_time" required><br> <br>
			Email-ID: <input type="text" name="email" required><br><br>
			
			Event Location: <select id="Parent_Location" name="Parent_Location">
			<option value="Nilgiri">Nilgiri</option>
			<option value="Vindhya">Vindhya</option>
			<option value="Himalaya">Himalaya</option>
			<option value="OBH">OBH</option>
			</select> <br><br>

			Event Room: <select id="Child_Location" name="Child_Location">
				<option value="Open lab">Open Lab</option>
				<option value="Teaching Lab 1">Teaching Lab 1</option>
				<option value="Teaching lab 2">Teaching Lab 2</option>
			</select><br> <br>
			
			Event Detail:<br><textarea maxlength="100" cols="50" rows="3" name="event_detail"> </textarea>
			<input type="submit" value="submit" onClick="" ><br> <br>
		</form>

	</body>
</html>

