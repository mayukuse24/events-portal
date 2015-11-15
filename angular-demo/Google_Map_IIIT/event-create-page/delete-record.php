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
	$fpointer = fopen("/var/www/html/angular-demo/objectfiles/object.js",'w') or die("File didnt open");

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
<head>
<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Julius+Sans+One">
  <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Lobster">
  <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Lobster+Two">
  <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Indie Flower">
  <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Monoton">
</head>

<style>

h3 {
    color: #eee;
    font-family: Verdana;
}

.header-img{
    position: relative;
    text-align: center;
    background-color: #FFF;
    height: 5em;
    /*box-shadow: 10px 10px 15px #888888;*/
}
#map-canvas
{
    width:70vw;
    height:80vh;
    padding-left: 1em;
}


.symbol-design{
    float:left;
    overflow: hidden;
    color: #fff;
    background-color: #000;
    height: 5em;
}

.symbol-design h1{
    padding-top: 0.7em;
    padding-left: 1em;
    padding-right: 1em;
    font-family: 'Monoton', serif;
}

.symbol-design h3{
    padding-top: 0.7em;
    padding-left: 2em;
    font-family: 'Monoton', serif;
}

.header-img h2{
    font-size: 2em;
    letter-spacing: 2px;
    padding-top: 0.7em;
    color: #0A0005;
    -webkit-transition: color 0.2s ease-out 0.2s;
    transition: color 0.2s ease-out 0.2s;
    -o-transition: color 0.2s ease-out 0.2s;
    transition: color 0.2s ease-out 0.2s;
    cursor:pointer;
    font-family: 'Lobster', serif;
}
.header-img h2:hover{
    color: #6B0024;
}
</style>
<header class="header-img">
  <div class="symbol-design">
    <h1>EP</h1>
  </div>
  <a href="../IIIT_map.html"><h2>Events Portal</h2></a>
		     </header>	
<h3 style="color: gray"> Events to delete </h3>
<form action="delete-record.php" method="POST">
	Search by email: <input type="text" name="search"><br><br>
	<input type="submit" name="submit"><br><br>
</form>

<form action="delete-record.php" method="POST">
	
	<?php

	
	
	if(isset($_POST["search"]))
	{
            echo '<h3>Your events </h3>';
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
