<?php
include('check_teacherlogin.php');
include("static/connect-database.php");

if (!isset($_POST['op']) || !isset($_POST['id'])) {
    echo "Error. Invalid Call.";
    exit;
}

switch ($_POST["op"]) {
    case "edit":
        $_sql = "SELECT name, first_language, second_language FROM classes WHERE deleted=0 AND teacher={$_SESSION["user"]["id"]} AND id={$_POST["id"]}";

        if (!$_res = mysqli_query($conn, $_sql)) {
            echo "Error: %s\n" . mysqli_sqlstate($conn);
        }

        $_rows = mysqli_num_rows($_res);
        if ($_rows != 1) {
            echo "Error: No class is matching the edit string.";
            exit;
        }

        $_entry = mysqli_fetch_array($_res, MYSQLI_ASSOC);

        $_language_str = "";

        if (mysqli_num_rows($_res) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($_res)) {
                $_language_str .= "<option value='{$row["id"]}'>{$row["name"]}</option>";
            }
        } else {
            $_language_str = "Error";
        }

        echo "Hallo";
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