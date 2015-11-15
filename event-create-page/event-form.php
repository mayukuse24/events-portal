<?php

$fpointer = fopen("data.txt","a") or die("File didnt open");
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$eventname = $_POST["event_name"];
	$organiser =  $_POST["event_organiser"];
	$startdate = $_POST["start_date"];
	$starttime = $_POST["start_time"];
	$enddate = $_POST["end_date"];
	$endtime = $_POST["end_time"];
	$eventlocation = $_POST["Parent_Location"];
	$room = $_POST["Child_Location"];
	
	if(isset($_POST["event_detail"]))
		$description = $_POST["event_detail"];
	else
		$description = "";
	
	fwrite($fpointer,"{'eventname':'$eventname','startdate':'$startdate','starttime':'$starttime','endtime':'$endtime', 'enddate':'$enddate','eventlocation':'$eventlocation','room':'$room','organiser':'$organiser','description':'$description'}\n");	
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

