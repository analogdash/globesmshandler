<?php

## KAWAY subscriber registration
## by Dash Castellano

include 'conndb.php';

if(isset($_GET["access_token"])){

	$tkn = $_GET["access_token"];

	$usernum = $_GET["subscriber_number"];

	$query = "INSERT INTO users (access_token, subscriber_number) VALUES ('".$tkn."', '".$usernum."');";
	mysqli_query($link, $query);


} else { #ADD CONDITION
	$unsub = json_decode(file_get_contents('php://input'),true);
	$deadtoken = $unsub["unsubscribed"]["access_token"];

	$query = "DELETE FROM users WHERE access_token=".$deadtoken.";";
	$query2 = "INSERT INTO users (access_token, subscriber_number) VALUES ('nothing', '".$deadtoken."');";
	mysqli_query($link, $query);
	mysqli_query($link, $query2);

}

	mysqli_close();

?>