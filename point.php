<!DOCTYPE html> 

<html> 
<head>     

<link href="style.css" rel="stylesheet"
type="text/css" media="screen" /> 

</head> 

<body> 
<div id="contact">

<?php

$points = $_POST["point"];

for($i=0;$i<$points;$i++)
{
?>

	<h1>Location of point<?php echo $i+1;?></h1>
	<form action="final.php?id1=<?php echo $points;?>" method="post">
		<fieldset>
			<label for="Location of point<?php echo $i;?>">Latitude</label>
			<input type="text" name="lat<?php echo $i+1;?>" placeholder="In degrees" />
			
			<label for="Number of Point">Longitude</label>
			<input type="text" name="lon<?php echo $i+1;?>" placeholder="In degrees" />
			
			<label for="Number of Point">Amplitude</label>
			<input type="text" name="point<?php echo $i+1;?>" placeholder="in DB" />

<?php } ?>
	
			<h1>Target Point</h1>
		<fieldset>
			<label for="Target Point">Latitude</label>
			<input type="text" name="Tlat" placeholder="In degrees" />
			
			<label for="Number of Point">Longitude</label>
			<input type="text" name="Tlon" placeholder="In degrees" />
			
			<input type="submit" value="Submit">
		</fieldset>
		</fieldset>
	</form>
</div>

</body>

</html>