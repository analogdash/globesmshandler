<?php

$value = json_decode($_POST['json'],true);



$dateTime = $value["inboundSMSMessageList"]["inboundSMSMessage"][dateTime];
$message = $value["inboundSMSMessage"]["message"];
$senderAddress = $value["inboundSMSMessage"][senderAddress];

$link = mysqli_connect('localhost','root','rootpower','globesmshandler');

$query = "INSERT INTO kaways (timestamp, sender, message) VALUES ('".$dateTime."', '".$message."', '".$senderAddress."');";

mysqli_query($link, $query);

mysqli_close();

?>