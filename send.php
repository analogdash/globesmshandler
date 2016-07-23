<?php

$value["outboundSMSMessageRequest"]["clientCorrelator"] = "123456";
$value["outboundSMSMessageRequest"]["senderAddress"] = "tel:8839";
$value["outboundSMSMessageRequest"]["outboundSMSTextMessage"]["message"] = "Hello World";
$value["outboundSMSMessageRequest"]["Address"][0] = "tel:+639776519749";

$payload = json_encode($value);

$url = "https://requestb.in/16v0czb1?access_token=69PVXqlqgQN5Ww_nd2KcKEnloEI_-Zt0wGLILZFKYBE"

$ch = curl_init($url);

curl_setopt( $ch, CURLOPT_POSTFIELDS, $payload );
curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
$result = curl_exec($ch);
curl_close($ch);

echo "<pre>$result</pre>";

?>