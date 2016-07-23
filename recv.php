<?php

$obj=file_get_contents('php://input');

$value = json_decode($obj,true);

$dateTime = $value["inboundSMSMessageList"]["inboundSMSMessage"]["dateTime"];
$message = $value["inboundSMSMessageList"]["inboundSMSMessage"]["message"];
$senderAddress = $value["inboundSMSMessageList"]["inboundSMSMessage"]["senderAddress"];

$link = mysqli_connect('localhost','root','rootpower','globesmshandler');

$query = "INSERT INTO kaways (timestamp, sender, message) VALUES ('".$dateTime."', '".$message."', '".$senderAddress."');";

mysqli_query($link, $query);

mysqli_close();

?>