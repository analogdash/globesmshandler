<?php

$value["outboundSMSMessageRequest"]["clientCorrelator"] = "123456";
$value["outboundSMSMessageRequest"]["senderAddress"] = "tel:8839";
$value["outboundSMSMessageRequest"]["outboundSMSTextMessage"]["message"] = "Hello World";
$value["outboundSMSMessageRequest"]["Address"][0] = "tel:+639776519749";

$data_json = json_encode($value);

#$url = "https://devapi.globelabs.com.ph/smsmessaging/v1/outbound/8839/requests?access_token=69PVXqlqgQN5Ww_nd2KcKEnloEI_-Zt0wGLILZFKYBE"

$url = "https://requestb.in/16v0czb1?access_token=69PVXqlqgQN5Ww_nd2KcKEnloEI_-Zt0wGLILZFKYBE"

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS,$data_json);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response  = curl_exec($ch);
curl_close($ch);

/*
curl_setopt($ch, CURLOPT_URL, $url); 
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload );                                                             
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_TIMEOUT, 10); 
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);                                                                      
curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
    'Content-Type: application/json',                                                                                
    'Content-Length: ' . strlen($payload))                                                                       
);                                                                                                                   
                                                                                                                     
  $result = curl_exec($ch); 
  $errmsg = curl_error($ch); 
  $cInfo = curl_getinfo($ch); 
  curl_close($ch); 


echo "<pre>$result</pre><br>";
echo "<pre>$errmsg</pre><br>";
echo "<pre>$cInfo</pre><br>";
*/
?>