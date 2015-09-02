<?php

// Opens a connection to our database
DEFINE ('DB_HOST', 'localhost');
DEFINE ('DB_USER', 'feather_root');
DEFINE ('DB_PASSWORD', 'enterprise');
DEFINE ('DB_NAME', 'feather_cms');

$db_connection = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
OR die('Could not connect to the databse ' . mysqli_connect_error());

?>