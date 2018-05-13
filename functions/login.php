<?php
$_db_host = "localhost";
$_db_database = "***REMOVED***";
$_db_username = "u01_***REMOVED***";
$_db_password = "***REMOVED***";
//$_db_host = "***REMOVED***";
//$_db_database = "***REMOVED***";
//$_db_username = "u02_***REMOVED***";
//$_db_password = "Tannen34Baum:";

SESSION_START();

function debug_to_console( $data ) {
    $output = $data;
    if ( is_array( $output ) )
        $output = implode( ',', $output);

    echo "<script>console.log( 'Debug Objects: " . $output . "' );</script>";
}

// Create connection
$conn = mysqli_connect($_db_host, $_db_username, $_db_password, $_db_database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Login-button pressed -> check login data
if (!empty($_POST["submit-login"])) {

    // Escape username and password against SQL Injections
    $_username = mysqli_real_escape_string($conn, $_POST["username"]);
    $_password = mysqli_real_escape_string($conn, $_POST["password"]);

    debug_to_console("Test");

    $_sql = "SELECT * FROM fe_users WHERE 
                    username='$_username' AND 
                    password='$_password' AND 
                    deleted=0 
                LIMIT 1";

    // Check user in database
    if (!$_res = mysqli_query($conn, $_sql)) {
        echo "Error: %s\n" . mysqli_sqlstate($conn);
    }
    $_rows = mysqli_num_rows($_res);

    // Check number of solutions
    // If #rows = 0 -> credentials incorrect
    // If #rows = 1 -> credentials correct
    if ($_rows > 0) {
        //echo "Login successful.<br>";

        // User is logged in
        $_SESSION["login"] = 1;

        // Save user data in Session
        $_SESSION["user"] = mysqli_fetch_array($_res, MYSQLI_ASSOC);

        // Update last login data
        $_sql = "UPDATE fe_users SET last_login=NOW() 
                     WHERE id=".$_SESSION["user"]["id"];
        mysqli_query($conn, $_sql);
    }
    else {
        echo "Login not successful.<br>";
        $_SESSION["login"] = 0;
    }
}

// Check if user is logged in
if (!isset($_SESSION["login"]) || $_SESSION["login"] != 1) {
    // User is not logged in -> show login and exit
    include("pages/login-page.php");
    mysqli_close($conn);
    exit;
}

// User is logged in successfully
include("pages/logout-page.php");

// Close Database
mysqli_close($conn);