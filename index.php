<?php
/**
 * Created by WTC.
 * User: Rob Wilde
 * Date: 14/03/2015
 * Time: 6:56 PM
 */
include_once ("functions.php");
?>

<!doctype html>
<html lang = "en">
<head>
	<meta charset = "UTF-8">
	<title>Google Zones</title>

	<style>
		html, body, #map-canvas {
			height: 100%;
			margin: 0;
			padding: 0;
		}
	</style>

	<script src = "https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&language=en"></script>
	<script src = "https://code.jquery.com/jquery-1.11.2.min.js"></script>
	<script>
		function initialize() {
			var myLatLng = new google.maps.LatLng('<?= $lat ?>', '<?= $lng ?>');

			// General Options
			var mapOptions = {
				zoom: 12,
				center: myLatLng,
				mapTypeId: google.maps.MapTypeId.RoadMap
			};
			var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

			var triangleCoords = [
				new google.maps.LatLng('<?= $lat ?>', '<?= $lng ?>'), // location
				new google.maps.LatLng('<?= $ne_lat ?>', '<?= $ne_lng ?>'), // South East Boundary
				new google.maps.LatLng('<?= $sw_lat ?>', '<?= $sw_lng ?>')  // North West Boundary
			];

			console.log(triangleCoords);
			// Styling & Controls
			myPolygon = new google.maps.Polygon({
				paths: triangleCoords,
				draggable: true, // turn off if it gets annoying
				editable: true,
				strokeColor: '#FF0000',
				strokeOpacity: 0.8,
				strokeWeight: 2,
				fillColor: '#FF44ee',
				fillOpacity: 0.35
			});

			myPolygon.setMap(map);
			//google.maps.event.addListener(myPolygon, "dragend", getPolygonCoords);
			google.maps.event.addListener(myPolygon.getPath(), "insert_at", getPolygonCoords);
			//google.maps.event.addListener(myPolygon.getPath(), "remove_at", getPolygonCoords);
			google.maps.event.addListener(myPolygon.getPath(), "set_at", getPolygonCoords);
		}

		google.maps.event.addDomListener(window, 'load', initialize);
	</script>
</head>
<body>
<div id="map-canvas"></div>
<!--<form action = "post"></form>-->
</body>
</html>