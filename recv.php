<?php

$inbound = json_decode(file_get_contents('php://input'),true);

$dateTime = $inbound["inboundSMSMessageList"]["inboundSMSMessage"][0]["dateTime"];
$message = $inbound["inboundSMSMessageList"]["inboundSMSMessage"][0]["message"];
$senderAddress = $inbound["inboundSMSMessageList"]["inboundSMSMessage"][0]["senderAddress"];



$break = explode(" ",$message);

if($break[0] != "KAWAY"){
	$textreply = "Invalid command. Text KAWAY, space, followed by a waiting shed code.";
} else if ($break[1]) { #SOME TEST ABOUT VALIDITY OF SHED CODE
	$textreply = "Don't forget the shed code.";
} else if (true) { #SOME TEST ABOUT UNSUCCESSFUL BACK END THING
	$shedcode = $break[1];
	$textreply = "Kaway received with shed code ".$shedcode;
} /*else if (0){ #KAWAY WAS SUCCESSFUL
	$textreply = "Kawaii!";
}*/

## SEND STUFF



##$n["outboundSMSMessageRequest"]["clientCorrelator"] = "888";
$outbound["outboundSMSMessageRequest"]["senderAddress"] = "tel:8839";
$outbound["outboundSMSMessageRequest"]["outboundSMSTextMessage"]["message"] = $textreply;
$outbound["outboundSMSMessageRequest"]["address"][0] = $senderAddress;

$payload = json_encode($outbound);

#get auth token
$link = mysqli_connect('localhost','root','rootpower','globesmshandler');
$query = "SELECT access_token FROM users WHERE subscriber_number=".substr($senderAddress, 7);
$result = mysqli_query($link, $query);
$row = mysqli_fetch_assoc($result);
$authtoken = $row["access_token"];

#$url = "https://devapi.globelabs.com.ph/smsmessaging/v1/outbound/8839/requests?access_token=".$authtoken;
$url = "https://requestb.in/16v0czb1?access_token=".$authtoken;

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





/*
$query = "INSERT INTO kaways (timberr, sender, message) VALUES ('".$dateTime."', '".$senderAddress."', '".$message."');";
mysqli_query($link, $query);
mysqli_close();

*/

?>