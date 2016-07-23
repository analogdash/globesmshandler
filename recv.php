<?php

$obj=file_get_contents('php://input');

$value = json_decode($obj,true);

$columns = implode(", ",array_keys($value["inboundSMSMessageList"]["inboundSMSMessage"][0]));

$escaped_values = array_map('mysql_real_escape_string', array_values($value["inboundSMSMessageList"]["inboundSMSMessage"][0]));
$values  = implode(", ", $escaped_values);

$dateTime = $value["inboundSMSMessageList"]["inboundSMSMessage"]["dateTime"];
$message = $value["inboundSMSMessage"]["message"];
$senderAddress = $value["senderAddress"];

$link = mysqli_connect('localhost','root','rootpower','globesmshandler');

#$query = "INSERT INTO kaways (timestomp, sender, message) VALUES ('".$dateTime."', '".$message."', '".$senderAddress."');";
$query = "INSERT INTO debug (dump, valdump) VALUES ('".$values."', '".$columns."');";

mysqli_query($link, $query);

mysqli_close();

?>