<?php

## KAWAY subscriber registration
## by Dash Castellano

include 'conndb.php';

if(isset($_GET["access_token"])){

	$tkn = $_GET["access_token"];

	$usernum = $_GET["subscriber_number"];

	$query = "INSERT INTO users (access_token, subscriber_number) VALUES ('".$tkn."', '".$usernum."');";
	mysqli_query($link, $query);


} else if (isset($_POST["json"])) {
	$unsub = json_decode($_POST["json"]);
	$subnum = $unsub["unsubscribed"]["subscriber_number"];


	$query = "DELETE FROM users WHERE subscriber_number=".$subnum.";";
	mysqli_query($link, $query);


}

	mysqli_close();

?>