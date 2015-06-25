<?php
$tranxid = trim($_POST['LFA_TRANX_ID']);

if ( $tranxid == 'GET_GROUPON_DATA') {
		$lat = $_POST['LAT'];	   
		$lon = $_POST['LON'];	    
	   $data = getGrouponForLatLon($lat,$lon);
		print $data;
		die();
}

function  getGrouponForLatLon($lat,$lon)
{

	$request = 'https://partner-api.groupon.com/deals.json?tsToken=US_AFF_0_987654_123456_0';  
	$request .= '&lat=' . $lat . '&lng=' . $lon;
	$request .= '&radius=5&limit=25';
	
//	$request = 'https://api.groupon.com/v2/deals.json?division_id=san-francisco';
//	$request .= '&client_id=9315a953e71a3c08751c31686ba5d4d6d2141bc6';  
	
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
    $deals = $jsonobj->{'deals'};
   
   $filtered_deals = array();
   
   foreach ($deals as $deal) {
            $merchant = $deal->{'merchant'};
			$name = $merchant->{'name'};
			$options = $deal->{'options'};
		//	echo "name = " . $name . "<br />";
			$tagsary = $deal->{'tags'};
			 foreach ($tagsary as $tag) {
			 //   echo "tag = " . $tag->{'name'} . "<br />";
			 /*  from js
			 if(tag === "Restaurants" || tag === "Food & Drink"){
					var image = 'images/pins/GrouponPinRestraunt_PT3forweb.png'; 
					}if(tag === "Arts and Entertainment"){
					var image = 'images/pins/GrouponPin_EventPT3forweb.png'; 
					} if(tag ==="Nightlife"){
					*/
				if ( ($tag->{'name'} == 'Restaurants')  || 
					($tag->{'name'} == 'Food & Drink') || 
					($tag->{'name'} == 'Arts and Entertainment') || 
					($tag->{'name'} == 'Nightlife') ) {
					   $fary =  array( 'merchant' => $merchant, 'options' => $options, 'tags' => $tagsary);
						array_push( $filtered_deals,$fary);
					//echo "name = " . $name . " - " . " tag = " . $tag->{'name'} . "<br />";
				}
			 }
	}
	
	  $str =  json_encode($filtered_deals);
	
	/*
	$jsonobj = json_decode($response);
	$ostr = "Request=" . $request . '<br /><br />';
	$ostr .= '<pre>' . json_encode($jsonobj,JSON_PRETTY_PRINT) . '</pre>';
	file_put_contents('ldnew_groupon_json.txt', $ostr);
	*/
	return $str;



}


?>