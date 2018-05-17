<?php
include('check_teacherlogin.php');
include ("static/connect-database.php");


// New Class-button pressed -> New Class
if (!empty($_POST["classes_new_submit"])) {

    $_classes_new_name = mysqli_real_escape_string($conn, $_POST["classes_new_name"]);

    $_sql = "INSERT INTO classes (name, teacher, first_language, second_language) VALUES ('{$_classes_new_name}', '{$_SESSION["user"]["id"]}', '{$_POST["classes_new_language_first"]}', '{$_POST["classes_new_language_second"]}')";

    if (!mysqli_query($conn, $_sql)) {
        echo "Error: " . $_sql . "<br>" . mysqli_error($conn);
        exit;
    }

    include("teacher_classes.php");
    exit;
}


$_sql = "SELECT * FROM languages";
if (!$_res = mysqli_query($conn, $_sql)) {
    echo "Error: %s\n" . mysqli_sqlstate($conn);
}

$_language_str = "";

if (mysqli_num_rows($_res) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($_res)) {
        $_language_str .= "<option value='{$row["id"]}'>{$row["name"]}</option>";
    }
} else {
    $_language_str = "Error";
}

mysqli_close($conn);

include("teacher_classes_new_page.php");

?>