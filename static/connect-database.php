<?php
//$_db_host = "localhost";
$_db_host = "***REMOVED***";
$_db_database = "***REMOVED***";
$_db_username = "u01_***REMOVED***";
$_db_password = "***REMOVED***";

SESSION_START();

// Create connection
$conn = mysqli_connect($_db_host, $_db_username, $_db_password, $_db_database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}