<?php
header('Content-Type: text/xml, charset=utf-8');
// Joseph Jackson and Daniel V. 
//PHP request handler for API's


function js_array($array){
    $temp = array_map('js_str', $array);
	return '[' . implode(',', $temp) . ']';


}

function getSeatGeekForLatLon($lat,$lon,$sdate,$edate) {
/*
http://api.seatgeek.com/2/events?lat=39.7392&lon=-104.9847&datetime_utc.gte=2014-04-25&datetime_utc.lte=2014-04-27


	$request = 'http://api.seatgeek.com/2/events?';
	$request .= 'venue.state=CO';
	$request .= '&venue.city=Boulder';
	$request .= '&datetime_utc.gte=2014-04-05';
	$request .= '&datetime_utc.lte=2014-04-07';
	*/


	$request = 'http://api.seatgeek.com/2/events?';
	$request .= 'lat=' . $lat;
	$request .= '&lon=' . $lon;

	
	
	$session = curl_init($request);
	$header[] = "Accept: application/json";
	$header[] = "Accept-Encoding: gzip";
	curl_setopt( $session, CURLOPT_HTTPHEADER, $header );
	curl_setopt($session,CURLOPT_ENCODING , "gzip");
	curl_setopt($session, CURLOPT_CUSTOMREQUEST, 'GET');
	curl_setopt( $session, CURLOPT_URL, $request );
	curl_setopt( $session, CURLOPT_RETURNTRANSFER, true );
	$response = curl_exec($session);
	$jsonobj = json_decode($response);
	//parseJsonResults($jsonobj);
	$emptyarray = array();
    
	$hs_obj = $jsonobj->{'events'};
	
	foreach ($hs_obj as $item) {
		$title = $item->{'title'};
		$type = $item->{'type'};
		$datetime_local = $item->{'datetime_local'};
		$venue = $item->{'venue'};
		$id = $item->{'id'};
		$venueName = $venue->{'name'};
		$lat = $venue->{'location'}->{'lat'};
		$lon = $venue->{'location'}->{'lon'};
		$url = $item->{'url'};
		$address = $venue->{'address'};
		$city = $venue ->{'city'};
		$state = $venue ->{'state'};
		$data = array(
		'id' => $id,
		'title' => $title,
		'name' => $venueName,
		'datetime_local' => $datetime_local,
		'lat' => $lat,
		'lon' => $lon,
		'url' => $url,
		'address' => $address,
		'state'=> $state,
		'city' => $city
		);
		array_push($emptyarray, $data );	
	}
	
	$fp = fopen('results.json', 'w');
	fwrite($fp, json_encode($response));
	fclose($fp);
	return $response;
}	





getSeatGeekForLatLon(40,-105,'6/16/2015','6/17/2015')
?>



		
