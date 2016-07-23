<?php

$value = json_decode(file_get_contents('php://input'),true);

$dateTime = $value["inboundSMSMessageList"]["inboundSMSMessage"][0]["dateTime"];
$message = $value["inboundSMSMessageList"]["inboundSMSMessage"][0]["message"];
$senderAddress = $value["inboundSMSMessageList"]["inboundSMSMessage"][0]["senderAddress"];

$link = mysqli_connect('localhost','root','rootpower','globesmshandler');

$query = "INSERT INTO kaways (timberr, sender, message) VALUES ('".$dateTime."', '".$message."', '".$senderAddress."');";

mysqli_query($link, $query);

mysqli_close();

?>