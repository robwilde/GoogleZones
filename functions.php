<?php

function _log( $message ) {
	if ( is_array( $message ) || is_object( $message ) ) {
			error_log( print_r( $message, TRUE ) );
		} else {
			error_log( $message );
		}
}

function pretty_printr($variable, $title = ''){

	echo '<code><pre>';
	echo '<strong>'. $title .' : </strong>';
	print_r($variable);
	echo '</pre></code>';

}

$address     = '4159';
$coordinates = file_get_contents( 'http://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode( $address ) . '&sensor=true' );
$coordinates = json_decode( $coordinates );

//pretty_printr( $coordinates, 'CO-Ordinates' );

echo 'Latitude:' . $coordinates->results[ 0 ]->geometry->location->lat;
echo 'Longitude:' . $coordinates->results[ 0 ]->geometry->location->lng;

$lat = $coordinates->results[ 0 ]->geometry->location->lat;
$lng = $coordinates->results[ 0 ]->geometry->location->lng;

$ne_lat = $coordinates->results[ 0 ]->geometry->bounds->northeast->lat;
$ne_lng = $coordinates->results[ 0 ]->geometry->bounds->northeast->lng;

$sw_lat = $coordinates->results[ 0 ]->geometry->bounds->southwest->lat;
$sw_lng = $coordinates->results[ 0 ]->geometry->bounds->southwest->lng;