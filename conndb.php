<?php

## SQL connection settings file
## MAKE SURE mysqli_close is executed at the end of your logic, 
## or not, I don't care. it's your server

$servername = "localhost";
$username = "root";
$password = "rootpower";
$database = "globesmshandler";

$googMapAPIkey = "AIzaSyBCO1XKQt8S0AO6vebjeK2Uyrf_E27V6RE"; # Get your own, lol

$fourdigitshortcode = "9331"; #used by Globe API, also get your own

$link = mysqli_connect($servername,$username,$password,$database);

?>