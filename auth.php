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


{

   "unsubscribed":{

          "subscriber_number":"9171234567",

          "access_token":"abcdefghijklmnopqrstuvwxyz",

          "time_stamp": "2014-10-19T12:00:00"

   }

}

{

      "access_token":"1ixLbltjWkzwqLMXT-8UF-UQeKRma0hOOWFA6o91oXw",
     "subscriber_number":"9171234567"

 }

?>