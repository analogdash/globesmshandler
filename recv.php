<?php

if($_POST[access_token]){

$link = mysqli_connect('localhost','root','rootpower','globesmshandler');

$query = "INSERT INTO users (access_token, subscriber_number) VALUES ('".$_POST[access_token]."', '".$_POST[subscriber_number]."');";

mysqli_query($link, $query);

mysqli_close();

} else {

	echo "NO data!";
}

?>