!doctype html>
<head>
	<title>Leafly Test</title>
	<style type="text/css">
	body{ font: 14px helvetica,sans-serif; color: #433; }
	</style>
</head>
<body>

	<h1>DB Drewing API Testing</h1>
<?/php 

/*function js_array($array)
{
    $temp = array_map('js_str', $array);
	return '[' . implode(',', $temp) . ']';

}*/

//$request = http:'//api.brewerydb.com/v2/';
//$request .= '?key=ac5ec710b28c4e2f2ea7a7467cdc5d8c';
$bdb = new Pintlabs_Service_Brewerydb(ac5ec710b28c4e2f2ea7a7467cdc5d8c);
$bdb->setFormat('json');
//$session = curl_init($request); 
//$response = curl_exec($session);
try{ 
	$request = $bdb->request('beers', $params, 'GET');
	$fp = fopen('DBrewery_Results.js', 'w');
	$JS_array = 'var array = [' . json_encode($response)  . ']';
	fwrite($fp,$JS_array );
	fclose($fp);
	return $response;
	
}

catch(Exception $e)
{
	$results = array('error' => $e->getMessage())
}
/*
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
	$emptyarray = array();*/
	?>


