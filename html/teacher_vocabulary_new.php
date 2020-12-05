<?php
include('check_teacherlogin.php');
include('static/connect-database.php');

// New List-button pressed -> New List
if (!empty($_POST["voclist_new_submit"])) {

    $_classid = $_POST["voclist_new_class"];

    // get languages from this class
    $_sql = "SELECT first_language, second_language FROM classes WHERE deleted=0 AND id={$_classid}";

    if (!$_res = mysqli_query($conn, $_sql)) {
        echo "Error: %s\n" . mysqli_sqlstate($conn);
    }

    if (mysqli_num_rows($_res) == 1) {
        $row = mysqli_fetch_assoc($_res);
    } else {
        echo "Error: No matching class in the DB";
        exit;
    }

    $_sql ="INSERT INTO lists (name, first_language, second_language, class) VALUES ('{$_POST["voclist_new_name"]}', '{$row["first_language"]}', '{$row["second_language"]}', '{$_classid}')";

    if (!mysqli_query($conn, $_sql)) {
        echo "Error: creating new list: %s\n" . mysqli_sqlstate($conn);
    }

    mysqli_close($conn);
    include("teacher_vocabulary.php");
    exit;
}

$_sql = "SELECT id, name FROM classes WHERE deleted=0 AND teacher={$_SESSION["user"]["id"]}";

if (!$_res = mysqli_query($conn, $_sql)) {
    echo "Error: %s\n" . mysqli_sqlstate($conn);
}

$_classes_str = "";

if (mysqli_num_rows($_res) > 0) {
    // output data of each row
    while ($row = mysqli_fetch_assoc($_res)) {
        $_classes_str .= "<option value='{$row["id"]}'>{$row["name"]}</option>";
    }
} else {
    $_classes_str = "No Classes available";
}

mysqli_close($conn);

include("teacher_vocabulary_new_page.php");
