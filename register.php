<?php

include ("static/connect-database.php");

// Register-button pressed -> create account
if (!empty($_POST["submit-register-account"])) {

    // Escape username and password against SQL Injections
    $_register_firstname = mysqli_real_escape_string($conn, $_POST["register_form_firstname"]);
    $_register_lastname = mysqli_real_escape_string($conn, $_POST["register_form_lastname"]);
    $_register_username = mysqli_real_escape_string($conn, $_POST["register_form_username"]);
    $_register_email = mysqli_real_escape_string($conn, $_POST["register_form_email"]);
    $_register_password = mysqli_real_escape_string($conn, $_POST["register_form_password"]);
    $_register_type = mysqli_real_escape_string($conn, $_POST["register_form_type"]);

    $_register_username = strtolower($_register_username);
    $_register_email = strtolower($_register_email);

    $_register_pw_hash =  hash ( "sha256" , $_register_password);

    $_sql = "SELECT * FROM fe_users WHERE 
                    username='$_register_username' AND 
                    deleted=0 
                LIMIT 1";

    // Check if username already exists in database
    if (!$_res = mysqli_query($conn, $_sql)) {
        echo "Error: %s\n" . mysqli_sqlstate($conn);
    }
    $_rows = mysqli_num_rows($_res);

    // Check number of solutions
    // If #rows = 0 -> username is free
    // If #rows = 1 -> username is existing
    if ($_rows == 0) {

        if ($_register_type != '1' && $_register_type != '2') {
            echo "Error. Not correct type. \n";
            exit;
        }

        // Update last login data
        $_sql = "INSERT INTO fe_users (firstname, lastname, username, password, email, account_type) VALUES ('{$_register_firstname}', '{$_register_lastname}', '{$_register_username}', '{$_register_pw_hash}', '{$_register_email}', '{$_register_type}')";

        if (!mysqli_query($conn, $_sql)) {
            echo "Error: " . $_sql . "<br>" . mysqli_error($conn);
            exit;
        }

        include("register-successful.php");
        // Close Database
        mysqli_close($conn);
        exit;
    }
    else {
        include("register-error.php");
        // Close Database
        mysqli_close($conn);
        exit;
    }
}

include("register-page.php");

// Close Database
mysqli_close($conn);