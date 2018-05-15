<?php

include('check_teacherlogin.php');
include ("static/connect-database.php");

$_username = $_SESSION["user"]["username"];

// Settings SaveChanges-button pressed -> Check and save Changes
if (!empty($_POST["submit-settingsT-save"])) {

    // Escape data against SQL Injections
    $_settings_firstname = mysqli_real_escape_string($conn, $_POST["settingsT_form_firstname"]);
    $_settings_lastname = mysqli_real_escape_string($conn, $_POST["settingsT_form_lastname"]);
    $_settings_email = mysqli_real_escape_string($conn, $_POST["settingsT_form_email"]);

    $_settings_email = strtolower($_settings_email);

    $_sql = "SELECT * FROM fe_users WHERE 
                    username='$_username' AND 
                    deleted=0 
                LIMIT 1";

    // Check if user exists in database
    if (!$_res = mysqli_query($conn, $_sql)) {
        echo "Error: %s\n" . mysqli_sqlstate($conn);
    }
    $_rows = mysqli_num_rows($_res);

    // Check number of solutions
    // If #rows = 1 -> user is in db
    // If #rows = 0 -> user is not in db -> fatal error
    if ($_rows == 1) {

        // Update user data
        $_sql = "UPDATE fe_users SET firstname='{$_settings_firstname}', lastname='{$_settings_lastname}', email='{$_settings_email}' WHERE username='{$_username}'";

        if (!mysqli_query($conn, $_sql)) {
            echo "Error: " . $_sql . "<br>" . mysqli_error($conn);
            exit;
        }

        // Update Session variable
        $_sql = "SELECT * FROM fe_users WHERE username='$_username' AND deleted=0 LIMIT 1";
        if (!$_res = mysqli_query($conn, $_sql)) {
            echo "Error: %s\n" . mysqli_sqlstate($conn);
        }
        $_SESSION["user"] = mysqli_fetch_array($_res, MYSQLI_ASSOC);
    }
    else {
        echo "Error: Update entry was not possible. Inconsistent data.";
        // Close Database
        mysqli_close($conn);
        exit;
    }
}

if (!empty($_POST["submit-settingsT-save-password"])) {

    // Escape data against SQL Injections
    $_settingsT_password_enter = mysqli_real_escape_string($conn, $_POST["settingsT_form_password_enter"]);
    $_settingsT_password_reenter = mysqli_real_escape_string($conn, $_POST["settingsT_form_password_reenter"]);

    if ($_settingsT_password_enter != $_settingsT_password_reenter) {
        echo "Error: Passwords are not equal!";
        exit;
    }

    $_settingsT_pw_hash =  hash ( "sha256" , $_settingsT_password_enter);

    $_sql = "SELECT * FROM fe_users WHERE 
                    username='$_username' AND 
                    deleted=0 
                LIMIT 1";

    // Check if user exists in database
    if (!$_res = mysqli_query($conn, $_sql)) {
        echo "Error: %s\n" . mysqli_sqlstate($conn);
    }
    $_rows = mysqli_num_rows($_res);

    // Check number of solutions
    // If #rows = 1 -> user is in db
    // If #rows = 0 -> user is not in db -> fatal error
    if ($_rows == 1) {

        // Update password
        $_sql = "UPDATE fe_users SET password='{$_settingsT_pw_hash}' WHERE username='{$_username}'";

        if (!mysqli_query($conn, $_sql)) {
            echo "Error: " . $_sql . "<br>" . mysqli_error($conn);
            exit;
        }

        // Update Session variable
        $_sql = "SELECT * FROM fe_users WHERE username='$_username' AND deleted=0 LIMIT 1";
        if (!$_res = mysqli_query($conn, $_sql)) {
            echo "Error: %s\n" . mysqli_sqlstate($conn);
        }
        $_SESSION["user"] = mysqli_fetch_array($_res, MYSQLI_ASSOC);
    }
    else {
        echo "Error: Update entry was not possible. Inconsistent data.";
        // Close Database
        mysqli_close($conn);
        exit;
    }
}

if (!empty($_POST["submit-settingsT-delete"])) {

    $_sql = "SELECT * FROM fe_users WHERE 
                    username='$_username' AND 
                    deleted=0 
                LIMIT 1";

    // Check if user exists in database
    if (!$_res = mysqli_query($conn, $_sql)) {
        echo "Error: %s\n" . mysqli_sqlstate($conn);
    }
    $_rows = mysqli_num_rows($_res);

    // Check number of solutions
    // If #rows = 1 -> user is in db
    // If #rows = 0 -> user is not in db -> fatal error
    if ($_rows == 1) {

        // Delete user with deleted=1
        $_sql = "UPDATE fe_users SET deleted=1 WHERE username='{$_username}'";

        if (!mysqli_query($conn, $_sql)) {
            echo "Error: " . $_sql . "<br>" . mysqli_error($conn);
            exit;
        }

        // Close Database
        mysqli_close($conn);

        $_SESSION = array();
        SESSION_DESTROY();

        include("account-deleted.php");
        exit;
    }
    else {
        echo "Error: Delete Account was not possible. Inconsistent data.";
        // Close Database
        mysqli_close($conn);
        exit;
    }
}

// no button was pressed. So just show current user information

include("teacher_settings_page.php");

// Close Database
mysqli_close($conn);