<?php

$value["outboundSMSMessageRequest"]["clientCorrelator"] = 123456;
$value["outboundSMSMessageRequest"]["senderAddress"] = "tel:8839";
$value["outboundSMSMessageRequest"]["outboundSMSTextMessage"]["message"] = "Hello World";
$value["outboundSMSMessageRequest"]["senderAddress"] = "tel:+639776519749";

$payload = json_encode($value);

echo $payload;

?>