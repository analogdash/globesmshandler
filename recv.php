<?php

$value = json_decode(file_get_contents('php://input'),true);

$dateTime = $value["inboundSMSMessageList"]["inboundSMSMessage"][0]["dateTime"];
$message = $value["inboundSMSMessageList"]["inboundSMSMessage"][0]["message"];
$senderAddress = $value["inboundSMSMessageList"]["inboundSMSMessage"][0]["senderAddress"];

/*

$break = explode(" ",$message);
$shedcode = $break[1];

if($break[0] != "KAWAY"){
	$textreply = "Invalid command. Text KAWAY, space, followed by a waiting shed code.";
} else if (1) { #SOME TEST ABOUT VALIDITY OF SHED CODE
	$textreply = "Invalid shed code. Please use a valide shed code.";
} else if (0) { #SOME TEST ABOUT UNSUCCESSFUL BACK END THING
	$textreply = "Kaway failed, please try again.";
} else if (0){ #KAWAY WAS SUCCESSFUL
	$textreply = "Kawaii!";
}
*/
## SEND STUFF

$textreply = $message;

##$value["outboundSMSMessageRequest"]["clientCorrelator"] = "888";
$value["outboundSMSMessageRequest"]["senderAddress"] = "tel:8839";
$value["outboundSMSMessageRequest"]["outboundSMSTextMessage"]["message"] = $textreply;
$value["outboundSMSMessageRequest"]["address"][0] = $senderAddress;

$payload = json_encode($value);

#get auth token
$link = mysqli_connect('localhost','root','rootpower','globesmshandler');
$query = "SELECT access_token FROM users WHERE subscriber_number=".substr($senderAddress, 7);
#$authtoken = mysqli_query($link, $query);

#$url = "https://devapi.globelabs.com.ph/smsmessaging/v1/outbound/8839/requests?access_token=".$authtoken;
$url = "https://requestb.in/16v0czb1";#.$authtoken;?access_token=

$ch = curl_init($url);

curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload );                                                             
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                 
curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
    'Content-Type: application/json',                                                                                
    'Content-Length: ' . strlen($payload))                                                                       
);                                                                                                                   
                                                                                                                     
  $result = curl_exec($ch); 

$query = "INSERT INTO kaways (timberr, sender, message) VALUES ('".$dateTime."', '".$senderAddress."', '".$message."');";
mysqli_query($link, $query);
mysqli_close();



mysqli_close();
  ## END send stuff





/*

*/

?>