<?php

$value["outboundSMSMessageRequest"]["clientCorrelator"] = "888";
$value["outboundSMSMessageRequest"]["senderAddress"] = "tel:8839";
$value["outboundSMSMessageRequest"]["outboundSMSTextMessage"]["message"] = "Hey world! Heya";
$value["outboundSMSMessageRequest"]["address"][0] = "tel:+639776519749";

$payload = json_encode($value);

#$url = "https://devapi.globelabs.com.ph/smsmessaging/v1/outbound/8839/requests?access_token=69PVXqlqgQN5Ww_nd2KcKEnloEI_-Zt0wGLILZFKYBE";

$url = "https://requestb.in/16v0czb1?access_token=69PVXqlqgQN5Ww_nd2KcKEnloEI_-Zt0wGLILZFKYBE";

$ch = curl_init($url);

curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload );                                                             
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                 
curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
    'Content-Type: application/json',                                                                                
    'Content-Length: ' . strlen($payload))                                                                       
);                                                                                                                   
                                                                                                                     
  $result = curl_exec($ch); 

echo $result."here";

?>