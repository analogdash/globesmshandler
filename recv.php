<?php

$obj=file_get_contents('php://input');

$value = json_decode($obj,true);

$columns = $value["inboundSMSMessageList"]["inboundSMSMessage"];

$arco = json_decode($columns,true);

$dateTime = $value["inboundSMSMessageList"]["inboundSMSMessage"]["dateTime"];
$message = $value["inboundSMSMessage"]["message"];
$senderAddress = $value["senderAddress"];

$link = mysqli_connect('localhost','root','rootpower','globesmshandler');

#$query = "INSERT INTO kaways (timestomp, sender, message) VALUES ('".$dateTime."', '".$message."', '".$senderAddress."');";
$query = "INSERT INTO debug (dump, valdump) VALUES ('".$arco."', '".$columns."');";

mysqli_query($link, $query);

mysqli_close();

?>