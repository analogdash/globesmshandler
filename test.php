<?php


$tkn = $_GET["access_token"];

$usernum = $_GET["subscriber_number"];

$link = mysqli_connect('localhost','root','rootpower','globesmshandler');

$query = "INSERT INTO users (access_token, subscriber_number) VALUES ('".$tkn."', '".$usernum."');";

mysqli_query($link, $query);

mysqli_close();

?>