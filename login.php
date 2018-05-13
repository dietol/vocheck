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

// Login-button pressed -> check login data
if (!empty($_POST["submit-login"])) {

    // Escape username and password against SQL Injections
    $_username = mysqli_real_escape_string($conn, $_POST["username"]);
    $_password = mysqli_real_escape_string($conn, $_POST["password"]);

    $_pw_hash =  hash ( "sha256" , $_password);

    $_sql = "SELECT * FROM fe_users WHERE 
                    username='$_username' AND 
                    password='$_pw_hash' AND 
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

        // save account type
        $_SESSION["account_type"] = $_SESSION["user"]["account_type"];

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
    include("login-page.php");
    mysqli_close($conn);
    exit;
}

// Decide if teacher or student
if ($_SESSION["account_type"] == 1) {
    // teacher
    include("teacher_home.php");
} else if ($_SESSION["user"]["account_type"] == 2) {
    //student
    include("student_home.php");
} else {
    // not valid
    include("login-page.php");
}

// Close Database
mysqli_close($conn);