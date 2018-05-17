<?php
include('check_teacherlogin.php');
include("static/connect-database.php");


// Update-button pressed -> check login data
if (!empty($_POST["classes_edit_submit"])) {
    $_classes_edit_name = mysqli_real_escape_string($conn, $_POST["classes_edit_name"]);

    $_sql = "UPDATE classes SET name='{$_classes_edit_name}', first_language='{$_POST["classes_edit_language_first"]}', second_language='{$_POST["classes_edit_language_second"]}' WHERE id = {$_POST["classes_edit_id"]} AND teacher='{$_SESSION["user"]["id"]}'";

    if (!mysqli_query($conn, $_sql)) {
        echo "Error: " . $_sql . "<br>" . mysqli_error($conn);
        exit;
    }

    include("teacher_classes.php");
    exit;
}

// Edit or Delete Class
if (!isset($_POST['op']) || !isset($_POST['id'])) {
    echo "Error. Invalid Call.";
    exit;
}

switch ($_POST["op"]) {
    case "edit":
        $_sql = "SELECT id, name, first_language, second_language FROM classes WHERE deleted=0 AND teacher={$_SESSION["user"]["id"]} AND id={$_POST["id"]}";

        if (!$_res = mysqli_query($conn, $_sql)) {
            echo "Error: %s\n" . mysqli_sqlstate($conn);
        }

        $_rows = mysqli_num_rows($_res);
        if ($_rows != 1) {
            echo "Error: No class is matching the edit string.";
            exit;
        }

        $_entry = mysqli_fetch_array($_res, MYSQLI_ASSOC);

        $_sql = "SELECT * FROM languages";
        if (!$_res = mysqli_query($conn, $_sql)) {
            echo "Error: %s\n" . mysqli_sqlstate($conn);
        }

        $_language_str_1 = "";
        $_language_str_2 = "";

        if (mysqli_num_rows($_res) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($_res)) {
                if ($row["id"] == $_entry["first_language"]) {
                    $_language_str_1 .= "<option value='{$row["id"]}' selected='selected'>{$row["name"]}</option>";
                } else {
                    $_language_str_1 .= "<option value='{$row["id"]}'>{$row["name"]}</option>";
                }
                if ($row["id"] == $_entry["second_language"]) {
                    $_language_str_2 .= "<option value='{$row["id"]}' selected='selected'>{$row["name"]}</option>";
                } else {
                    $_language_str_2 .= "<option value='{$row["id"]}'>{$row["name"]}</option>";
                }
            }
        } else {
            $_language_str_1 = "Error";
            $_language_str_2 = "Error";
        }

        include("teacher_classes_edit_page.php");

        break;
    case "delete":
        // Delete class with deleted=1
        echo "delete";
        $_sql = "UPDATE classes SET deleted=1 WHERE id='{$_POST["id"]}'";

        if (!mysqli_query($conn, $_sql)) {
            echo "Error: " . $_sql . "<br>" . mysqli_error($conn);
            exit;
        }

        // Close Database
        mysqli_close($conn);

        break;
    default:
        echo "Error. Invalid Call.";
        exit;
}