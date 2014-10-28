<!DOCTYPE html>
<html>
<head>
	<link href="style1.css" rel="stylesheet"
type="text/css" media="screen" /> 
<?php 
$id1=$_GET["id1"];
//echo $id1;
$lat = array($id1);
$lon = array($id1);
$DB  = array($id1);
$Tlat = $_POST['Tlat'];
$Tlon = $_POST['Tlon'];

for($i=1;$i<=$id1;$i++)
{
	$lat[$i] = $_POST['lat'.$i];
	$lon[$i] = $_POST['lon'.$i];
	$DB[$i]  = $_POST['point'.$i];
	/* check
  //echo "  ";
	//echo $_POST['lat'.$i];
	echo $DB[$i];
	echo "  ";
	echo $_POST['lat'.$i];
	//echo "  ";
	//echo 'lat'.$i;
  */
}
function distance($lat1, $lon1, $lat2, $lon2) {

  $theta = $lon1 - $lon2;
  $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
  $dist = acos($dist);
  $dist = rad2deg($dist);
  $miles = $dist * 60 * 1.1515;
  //$unit = strtoupper($unit);

//  if ($unit == "K") 
    return ($miles * 1.609344);
  /* else if ($unit == "N") {
      return ($miles * 0.8684);
    } else {
        return $miles;
      } */
}
$Dist = array();

for($i=1;$i<=$id1;$i++)
{
$Dist[$i] = distance($lat[$i], $lon[$i], $Tlat, $Tlon);
}
/* check
echo $Dist[1];
echo "     ";
echo $Dist[2];
echo "     ";
echo $Dist[3];
echo "     ";
echo $Dist[4];
echo "     ";
echo $Dist[5];
*/
for($i=1;$i<=$id1;$i++)
{
$TDB += $DB[$i]/($Dist[$i]*$Dist[$i]) ;
}
/* check
echo "                                                      ";

echo "                                                      ";

echo $TDB;
*/
?>

<!-- Map part used google API ********************************************************************
    Ideas are bullet proof.
    I was built to be the best, number one nothing less 
    Leauge of shadows....
-->

<script
src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDXcptRgjJBeh2B0a9YFx8TQGkAvVwqfWM&sensor=false">
</script>

<script>
var latitude = Array();
var longitude = Array();
var myCenter = new Array();
var i=0;
<?php
for($i=1;$i<=$id1;$i++)
	{ ?> 
		latitude[<?php echo $i; ?>]= <?php echo $lat[$i];?> ;
		longitude[<?php echo $i; ?>]= <?php echo $lon[$i];?> ;
		myCenter[<?php echo $i; ?>]=new google.maps.LatLng(latitude[<?php echo $i; ?>],longitude[<?php echo $i; ?>]);
		//alert(latitude[<?php echo $i; ?>]);
	<?php } ?>
  var Targetlocation = new google.maps.LatLng(<?php echo $Tlat;?>,<?php echo $Tlon;?>);

//alert(myCenter[2]);

function initialize()
{
var mapProp = {
  center:myCenter[1],
  zoom:17,
  mapTypeId:google.maps.MapTypeId.ROADMAP
  };

var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);

for(i=1;i<=<?php echo $id1?>;i++)
{
var marker=new google.maps.Marker({
  position:myCenter[i],
  });
marker.setMap(map);
}
var iconBase = 'https://maps.google.com/mapfiles/kml/shapes/';
var marker = new google.maps.Marker({
  position: Targetlocation,
  map: map,
  icon: iconBase + 'schools_maps.png'
});

}
google.maps.event.addDomListener(window, 'load', initialize);
</script>
</head>

<body>
<div id="googleMap" style="width:800px;height:380px;"></div>
</body>
    <!--Load the AJAX API-->
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">

      // Load the Visualization API and the piechart package.
      google.load('visualization', '1.0', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.setOnLoadCallback(drawChart);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {

        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Slices');
        data.addRows([
          <?php
          for($i=1;$i<=$id1;$i++)
          {?>
          [<?php echo "'"; echo 'point'.$i; echo "'"; ?>, <?php echo $DB[$i]/($Dist[$i]*$Dist[$i]);?>],
          <?php } ?>
          
        ]);

        // Set chart options
        var options = {'title':'Amplitude Distribution',
                        'backgroundColor': '#3399FF',
                       'width':400,
                       'height':380,
                        };

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('chart_div1'));
        chart.draw(data, options);
      }
    </script>
  </head>

  <body>
    <!--Div that will hold the pie chart-->
    <div id="chart_div1" align="right"></div>

  </body>

<table>
  <tr>
    <th>Point no</th>
    <th>Latitude</th>  
    <th>Longitude</th> 
    <th>Amplitude</th>
    <th>Distance</th>
    <th>Distance^2</th>
    <th>Amplitude/Distance^2</th> 
  </tr>
  <?php for($i=1;$i<=$id1;$i++)
  {?>
  <tr>
    <td><?php echo $i;?></td>
    <td><?php echo $lat[$i];?></td>
    <td><?php echo $lon[$i];?></td>    
    <td><?php echo $DB[$i];?></td>
    <td><?php echo $Dist[$i];?></td>
    <td><?php echo $Dist[$i]*$Dist[$i];?></td>
    <td><?php echo $DB[$i]/($Dist[$i]*$Dist[$i]);?></td>
  </tr>
  <?php } ?>
  </table>
    
    <table>
      <tr>
    <th>Target Point</th>
    <th>Latitude</th>  
    <th>Longitude</th>
    <th>Resultant Amplitude</th> 
  </tr>
  <tr>
    <td><?php echo 1;?></td>
    <td><?php echo $Tlat;?></td>
    <td><?php echo $Tlon;?></td>    
    <td><?php echo $TDB;?></td>
  
  </tr>
    </table>

</html>
