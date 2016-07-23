"<?php

## KAWAY Globe API handler
## By Dash Castellano
## a single PHP file that does everything because hackathon
## activated by sending an SMS to app short code
$fourdigitshortcode = "9331"; #used by Globe API

# Parsing json like C programmer
$inbound = json_decode(file_get_contents('php://input'),true);


$dateTime = $inbound["inboundSMSMessageList"]["inboundSMSMessage"][0]["dateTime"];
$message = $inbound["inboundSMSMessageList"]["inboundSMSMessage"][0]["message"];
$senderAddress = $inbound["inboundSMSMessageList"]["inboundSMSMessage"][0]["senderAddress"];
$senderAddressTrimmed = substr($senderAddress, 7); #removes tel:+63 prefix
$break = explode(" ",$message);

# Retrieve access_token given subscriber_number
include 'conndb.php';
$query = "SELECT access_token FROM users WHERE subscriber_number=".$senderAddressTrimmed;
$result = mysqli_query($link, $query);
$row = mysqli_fetch_assoc($result);
$authtoken = $row["access_token"];


if($break[0] = "whereami"){ #BONUS FEATURE, text 'whereami' to get current address

	$searchurl = "https://devapi.globelabs.com.ph/location/v1/queries/location?access_token=".$authtoken."&address=".$senderAddressTrimmed."&requestedAccuracy=200";
	$locjson = file_get_contents($searchurl);
	$locarray = json_decode($locjson, true);

	$long = $locarray["terminalLocationList"]["terminalLocation"]["currentLocation"]["longitude"];
	$lat = $locarray["terminalLocationList"]["terminalLocation"]["currentLocation"]["latitude"];

	$resolveurl = "https://maps.googleapis.com/maps/api/geocode/json?latlng=".$lat.",".$long."&key=AIzaSyBCO1XKQt8S0AO6vebjeK2Uyrf_E27V6RE";
	$resolvejson = file_get_contents($resolveurl);
	$resolvearray = json_decode($resolvejson, true);
	$currentloc = $resolvearray["results"][0]["formatted_address"];

	$textreply = "You are at ".$break[0];

} else if($break[0] != "KAWAY"){
	$textreply = "Invalid command. Text KAWAY, space, followed by a waiting shed code.";
} else if (!$break[1]) { #SOME TEST ABOUT VALIDITY OF SHED CODE
	$textreply = "Don't forget the shed code.";
} else if (true) { #SOME TEST ABOUT UNSUCCESSFUL BACK END THING
	$shedcode = $break[1];


## this is where we POST the $shedcode and a hash of $senderAddressTrimmed to the backend






	if (0/*POST TO BACK END SUCCESS*/){
			$textreply = "Kawaii! with shed code ".$shedcode;
	} else {
		$textreply = "Push to backend failed!";
	}
}

## SEND STUFF

# Writing JSON like a C programmer
#$n["outboundSMSMessageRequest"]["clientCorrelator"] = ""; #this is for retrying a PUSH without sending the message twice
$outbound["outboundSMSMessageRequest"]["senderAddress"] = "tel:8839";
$outbound["outboundSMSMessageRequest"]["outboundSMSTextMessage"]["message"] = $textreply;
$outbound["outboundSMSMessageRequest"]["address"][0] = $senderAddress;

$payload = json_encode($outbound);

$url = "https://devapi.globelabs.com.ph/smsmessaging/v1/outbound/".$fourdigitshortcode."/requests?access_token=".$authtoken;
#$url = "https://requestb.in/16v0czb1?access_token=".$authtoken; # This is for testing

$ch = curl_init($url);

curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload );                                                             
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                 
curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
    'Content-Type: application/json',                                                                                
    'Content-Length: ' . strlen($payload))                                                                       
);                                                                                                                   
                                                                                                                     
  $result = curl_exec($ch); 

mysqli_close();
  ## END send stuff

?>