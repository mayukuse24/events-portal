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
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Julius+Sans+One">
  <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Lobster">
  <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Lobster+Two">
  <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Indie Flower">
  <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Monoton">
	</head>
<style>
body, html {
    height:100%;

}

* {
    margin:0;
    padding:0;
}

#container{
    
    min-height:100%;
    background-size: 1500px 700px;
    background-repeat: no-repeat;
    background-attachment: fixed;
    min-height:100%;
}
#content{
  background-color: #040000;
  background-repeat: no-repeat;
  background-attachment: fixed;
}

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

.header-font{
    
}

.row{
	background-attachment: fixed;
	height:100%;
	margin-top:1em;

		background: -moz-linear-gradient(top, rgba(255,255,255,0.9) 0%, rgba(254,254,254,0.9) 4%, rgba(249,249,249,0.7) 22%, rgba(247,247,247,0.7) 29%, rgba(241,241,241,0.7) 50%, rgba(225,225,225,0.7) 51%, rgba(240,240,240,0.7) 85%, rgba(245,245,245,0.9) 98%, rgba(246,246,246,0.9) 100%); /* FF3.6+ */
			background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(255,255,255,0.9)), color-stop(4%,rgba(254,254,254,0.9)), color-stop(22%,rgba(249,249,249,0.7)), color-stop(29%,rgba(247,247,247,0.7)), color-stop(50%,rgba(241,241,241,0.7)), color-stop(51%,rgba(225,225,225,0.7)), color-stop(85%,rgba(240,240,240,0.7)), color-stop(98%,rgba(245,245,245,0.9)), color-stop(100%,rgba(246,246,246,0.9))); /* Chrome,Safari4+ */
			background: -webkit-linear-gradient(top, rgba(255,255,255,0.9) 0%,rgba(254,254,254,0.9) 4%,rgba(249,249,249,0.7) 22%,rgba(247,247,247,0.7) 29%,rgba(241,241,241,0.7) 50%,rgba(225,225,225,0.7) 51%,rgba(240,240,240,0.7) 85%,rgba(245,245,245,0.9) 98%,rgba(246,246,246,0.9) 100%); /* Chrome10+,Safari5.1+ */
			background: -o-linear-gradient(top, rgba(255,255,255,0.9) 0%,rgba(254,254,254,0.9) 4%,rgba(249,249,249,0.7) 22%,rgba(247,247,247,0.7) 29%,rgba(241,241,241,0.7) 50%,rgba(225,225,225,0.7) 51%,rgba(240,240,240,0.7) 85%,rgba(245,245,245,0.9) 98%,rgba(246,246,246,0.9) 100%); /* Opera 11.10+ */
			background: -ms-linear-gradient(top, rgba(255,255,255,0.9) 0%,rgba(254,254,254,0.9) 4%,rgba(249,249,249,0.7) 22%,rgba(247,247,247,0.7) 29%,rgba(241,241,241,0.7) 50%,rgba(225,225,225,0.7) 51%,rgba(240,240,240,0.7) 85%,rgba(245,245,245,0.9) 98%,rgba(246,246,246,0.9) 100%); /* IE10+ */
			background: linear-gradient(to bottom, rgba(255,255,255,0.9) 0%,rgba(254,254,254,0.9) 4%,rgba(249,249,249,0.7) 22%,rgba(247,247,247,0.7) 29%,rgba(241,241,241,0.7) 50%,rgba(225,225,225,0.7) 51%,rgba(240,240,240,0.7) 85%,rgba(245,245,245,0.9) 98%,rgba(246,246,246,0.9) 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#e6ffffff', endColorstr='#e6f6f6f6',GradientType=0 ); /* IE6-9 */

        		position:absolute;
        		width:1200px;
        		height:4	0em;
        		/*font-family: Tahoma, Geneva, sans-serif;*/
        		/*font-size: 14px;	*/
        		line-height: 24px;
        		/*font-weight: bold;*/
        		/*color:#001919;*/
			margin-left:03em;
			margin-right:10em;
        		text-decoration: none;
        		-webkit-border-radius: 10px;
        		-moz-border-radius: 10px;
        		border-radius: 10px;
        		/*padding:10px;*/
			-webkit-box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);
	        	-moz-box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);
	        	box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);
		font-family: 'Lobster', serif;
}

. row h1{
	font-family: 'Lobster', serif;
}

.form-control1{
		/*float:middle;*/
		margin-left:0em;
		/*text-align:middle;*/
		font-weight: bold;
		font-family: Tahoma,sans-serif;
		font-size:20px;
		color:#2F1414;
		margin-top: 1em;
}	       


.form-control2{
		/*float:middle;*/
		margin-left:0em;
		/*text-align:middle;*/
		font-weight: bold;
		font-family: Tahoma,sans-serif;
		font-size:20px;
		color:#2F1414;
		margin-top: 1em;

}	       


.form-control3{
		/*float:middle;*/
		margin-left:0em;
		/*text-align:middle;*/
		font-weight: bold;
		font-family: Tahoma,sans-serif;
		font-size:20px;
		color:#2F1414;
		margin-top: 1em;
}	       


.form-control4{
		/*float:middle;*/
		margin-left:0em;
		/*text-align:middle;*/
		font-weight: bold;
		font-family: Tahoma,sans-serif;
		font-size:20px;
		color:#2F1414;
		margin-top: 1em;
}	       

.form-control5{
		/*float:middle;*/
		margin-left:0em;
		/*text-align:middle;*/
		font-weight: bold;
		font-family: Tahoma,sans-serif;
		font-size:20px;
		color:#2F1414;
		margin-top: 1em;
}	
.form-control6{
		/*float:middle;*/
		margin-left:0em;
		/*text-align:middle;*/
		font-weight: bold;
		font-family: Tahoma,sans-serif;
		font-size:20px;
		color:#2F1414;
		margin-top: 1em;
}	
.form-control7{
		/*float:middle;*/
		margin-left:0em;
		/*text-align:middle;*/
		font-weight: bold;
		font-family: Tahoma,sans-serif;
		font-size:20px;
		color:#2F1414;
		margin-top: 1em;
}
.form-control8{
		/*float:middle;*/
		margin-left:0em;
		/*text-align:middle;*/
		font-weight: bold;
		font-family: Tahoma,sans-serif;
		font-size:20px;
		color:#2F1414;
		margin-top: 1em;
}
.form-control9{
		/*float:middle;*/
		margin-left:0em;
		/*text-align:middle;*/
		font-weight: bold;
		font-family: Tahoma,sans-serif;
		font-size:20px;
		color:#2F1414;
		margin-top: 1em;
}
.form-control10{
		/*float:middle;*/
		margin-left:0em;
		/*text-align:middle;*/
		font-weight: bold;
		font-family: Tahoma,sans-serif;
		font-size:20px;
		color:#2F1414;
		margin-top: 1em;
}	
.form-control11{
		/*float:middle;*/
		margin-left:0em;
		/*text-align:middle;*/
		font-weight: bold;
		font-family: Tahoma,sans-serif;
		font-size:20px;
		color:#2F1414;
		margin-top: 1em;
}
.form-control12{
		/*float:middle;*/
		margin-left:0em;
		/*text-align:middle;*/
		font-weight: bold;
		font-family: Tahoma,sans-serif;
		font-size:20px;
		color:#2F1414;
		margin-top: 1em;
}
.btn-btn-primary{
	margin-top: 2em;
	width:14em;
        	position:absolute;
     top:55%;
	background:#0A0A1F;
        	color:#fff;
        	font-family: Tahoma, Geneva, sans-serif;
        	height:5em;
        	/*border: 1px solid #999;*/
        	font-weight:bold;
		-webkit-border-radius: 5px;
        	-moz-border-radius: 5px;
        	border-radius: 5px;
}

.btn-btn-primary input:hover {
        	background:#ECECF2;
        	color:#0A0A1F;
        	font-weight: bold;	
        	-webkit-transition: 500ms linear 0s;
        	-moz-transition: 500ms linear 0s;
        	-o-transition: 500ms linear 0s;
        	transition: 500ms linear 0s;
        	outline: 0 none;
        	}

.Error{
	font-family: Tahoma,sans-serif;
		font-size:11px;
		color:#DC0808;
		margin-left: 12em;
}

#home{
    height:5em;
    width:60em;
    margin-left: auto;
    margin-right: auto;
    text-align: center;
    margin-top: 10em;
}

#home h2{
    font-family: 'Julius Sans One', serif;
    color: #fff;
    font-size: 1.8em;
}

.nav-bar{
    margin-left: 15em;
}

.nav-big{
    height:10em;
    width: 10em;
    background-color: #C47BC4;
    border-radius: 10px;
    margin-left: 8em;
    transition: background-color 0.2s linear 0s;
    -webkit-box-shadow: 15px 21px 122px -10px rgba(0,0,0,0.75);
    -moz-box-shadow: 15px 21px 122px -10px rgba(0,0,0,0.75);
    box-shadow: 15px 21px 122px -10px rgba(0,0,0,0.75);
    -webkit-box-shadow: inset 10px 10px 64px -18px rgba(0,0,0,0.75);
    -moz-box-shadow: inset 10px 10px 64px -18px rgba(0,0,0,0.75);
    box-shadow: inset 10px 10px 64px -18px rgba(0,0,0,0.75);
    text-align: center;
}

.nav-big:hover{
    background-color:#5F5F5F;
}

.nav-big h2{
    color: #fff;
    font-family: 'Julius Sans One', serif;
    font-size: 1.2em;
}

.img-about{
    margin-left: 0em;
    margin-top: 2em;
    margin-bottom: 1em;
}

.ab{
    float:left;
    overflow: hidden;
}

.ph{
    float:left;
    overflow: hidden;
}

.like{
    float: left;
    overflow: hidden;
}

a{
    text-decoration: none;
    color: #767683;
}



#footer{
    position:relative;
    bottom:0;
    width:100%;
    height:6em;
    background-color: #000000;
    color: #fff;
    -webkit-box-shadow: inset 10px 10px 64px -18px rgba(0,0,0,0.75);
    -moz-box-shadow: inset 10px 10px 64px -18px rgba(0,0,0,0.75);
    box-shadow: inset 10px 10px 64px -18px rgba(0,0,0,0.75);
    margin-top:0em;
    clear:both; 
}

.footer-txt{
    width: 60em;
    padding-top: 5em;
    padding-left: 10em;
}

.footer-txt h2{
    padding-bottom: 20px;
}

.footer-txt p{
    font-family: 'Lobster Two', serif;
    font-size: 18px;
    padding-top: 2px;
}

.social .follow {
    margin-left: 8em;
    padding-top: 2em;
}

.follow h2{
    font-family: 'Julius Sans One', serif;
    padding-top: 5px;
}
.footer-txt h2{
    font-family:  'Julius Sans One', serif;
}
.social .follow a {
    background: url("sprite_splash.png") no-repeat scroll 0 -1730px transparent;
    display: block;
    height: 26px;
    text-indent: -9999px;
    width: 45px;
}

.social .follow a:hover {
    background-position: 0 -1786px;
}

.social .youtube a {
    background-position: 0 -2290px;
}

.social .youtube a:hover {
    background-position: 0 -2346px;
}

.social .google a {
    background-position: 0 -1842px;
}

.social .google a:hover {
    background-position: 0 -1898px;
}

.social li {
    float: left;
    display: inline;
    margin-top:1.5em;
    padding-left: 2em;
}




	.mylabel{
    padding-top:5px;
     width:250px; 
     height: 150px;
       transition: background-color 0.2s linear 0s;
   border-style: solid;
      background-color: #A47979;
    font-family: Verdana;

      border-color: #E8DBDB;  
   }
   .mylabel:hover{
        /*: rgba(255,255,255,0.6);*/
        background-color : #855858;
      border-color: #E8DBDB;  
          font-family: Verdana;

        }
</style>
	<body>
	      <header class="header-img">
  <div class="symbol-design">
    <h1>EP</h1>
  </div>
  <a href="../IIIT_map.html"><h2>Events Portal</h2></a>
		     </header>	
		
		<div class="row"><h1>Event Form</h1>
		
		<form action="event-form.php" method="POST">
		<div class='form-control1'>	Event Name: <input type="text" name="event_name" required pattern="[a-zA-Z0-9 ]+"> <br> <br></div>
		<div class='form-control2'>	Event Organiser: <input type="text" name="event_organiser" required pattern="[a-zA-Z0-9 ]+"> <br> <br></div>
		<div class='form-control3'>	Contact Number: <input type="text" name="organiser_contact" required pattern="[0-9]+"> <br> <br></div>
			Start date: <input type="date" name="start_date" required>
		<div class='form-control5'>	Start time: <input type="time" name="start_time" required><br> <br></div>
		<div class='form-control6'>	End date: <input type="date" name="end_date" required> </div>
		<div class='form-control7'>	End time: <input type="time" name="end_time" required><br> <br></div>
			<div class='form-control8'>Email-ID: <input type="text" name="email" required><br><br></div>
			
			<div class='form-control9'>Event Location: <select id="Parent_Location" name="Parent_Location">
			<option value="Nilgiri">Nilgiri</option>
			<option value="Vindhya">Vindhya</option>
			<option value="Himalaya">Himalaya</option>
			<option value="OBH">OBH</option>
			</select> <br><br></div>

			<div class='form-control10'>Event Room: <select id="Child_Location" name="Child_Location">
				<option value="Open lab">Open Lab</option>
				<option value="Teaching Lab 1">Teaching Lab 1</option>
				<option value="Teaching lab 2">Teaching Lab 2</option>
			</select><br> <br></div>
			
			<div class='form-control11'>Event Detail:<br><textarea maxlength="100" cols="50" rows="3" name="event_detail"> </textarea>
			<input type="submit" value="submit" onClick="" ><br> <br></div>
		</form>
</div>
	</body>
</html>

