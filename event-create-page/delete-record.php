<?php


$matched_events = array();

$mysql_host = "localhost";
$mysql_user = "root";
$mysql_pass = "unknownremo24";

$mysql_db = 'event_portal';
$conn = mysql_connect($mysql_host, $mysql_user, $mysql_pass) or die("connection failed");

mysql_select_db($mysql_db);

if(isset($_POST["total_events"]))
{
	$del_event = $_POST["total_events"];
	
	$delsql = "DELETE FROM event where eventname = '$del_event'";
	$retval2 = mysql_query($delsql,$conn);
	if(! $retval2 )
	{
		die('Could not enter data: ' . mysql_error());
	}


	$sql2 = "SELECT * FROM event";
	$retval3 = mysql_query( $sql2, $conn );


	$str = "data = [";
	while($row = mysql_fetch_array($retval3, MYSQL_ASSOC))
	{
		$str =  $str.json_encode($row).',';
	}
	$str = $str."]";

	//echo $str;
	$fpointer = fopen("event_data.js",'w') or die("File didnt open");

	fwrite($fpointer, $str);
}

if(isset($_POST["search"]))
{
	$loginid = $_POST["search"];
	//echo $loginid;

	$sql = "SELECT * FROM event where email = '$loginid'";
	//echo $sql;
	
	$retval = mysql_query($sql,$conn);
	if(! $retval )
	{
		die('Could not enter data: ' . mysql_error());
	}
	
	if($retval != "")
	{
		$x=0;
		while($row = mysql_fetch_array($retval, MYSQL_ASSOC))
		{
			//echo $row["eventname"];
			$matched_events[$x] = $row["eventname"];
			$x = $x + 1;
		}
	}
	else
		echo "No such email exists"."<br><br>";

}


mysql_close($conn);
?>

<form action="delete-record.php" method="POST">
	Search by email: <input type="text" name="search"><br><br>
	<input type="submit" name="submit"><br><br>
</form>

<h3> Events to delete </h3>

<form action="delete-record.php" method="POST">
	
	<?php

	
	
	if(isset($_POST["search"]))
	{
		$len = count($matched_events);
		if($len==0)
		{
			echo "No event found"."<br>";
		}
		else
		{
			echo '<select id="total_events" name="total_events">';
			for($x = 0; $x < $len; $x++)
			{
				echo '<option value='.$matched_events[$x].'>'.$matched_events[$x].'</option>'."<br>";
			}
			echo '</select><br><br>';
			echo '<input type="submit" name="submit"><br><br>';
		}
	}
	?>
	
	
	
</form>
