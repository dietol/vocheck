<?php
include('check_teacherlogin.php');
include('static/connect-database.php');

// Edit or Delete Class
if (!isset($_POST['op']) || !isset($_POST['classid'])) {
    echo "Error. Invalid Call.";
    exit;
}

switch ($_POST["op"]) {
    case "show":
        $_sql = "SELECT fe_users.id AS studentid, fe_users.firstname AS fname, fe_users.lastname AS lname FROM fe_users JOIN user_classes ON fe_users.id = user_classes.student WHERE user_classes.deleted=0 AND fe_users.deleted=0 AND user_classes.class={$_POST["classid"]}";
        if (!$_res = mysqli_query($conn, $_sql)) {
            echo "Error: %s\n" . mysqli_sqlstate($conn);
        }

        $_students_str = "";

        if (mysqli_num_rows($_res) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($_res)) {
                $_students_str .= "<li class=\"list-group-item d-flex justify-content-between align-items-center\" id=\"student-{$row["studentid"]}\">{$row["lname"]}, {$row["fname"]}<i class=\"fas fa-trash-alt student-delete\"></i></li>";
            }
        } else {
            $_students_str = "No students in this class";
        }

        mysqli_close($conn);

        include("teacher_classes_detail_page.php");

        break;
    case "remove":

        // Remove student with deleted=1
        $_sql = "UPDATE user_classes SET deleted=1 WHERE id='{$_POST["classid"]}'";

        if (!mysqli_query($conn, $_sql)) {
            echo "Error: " . $_sql . "<br>" . mysqli_error($conn);
            exit;
        }

        // Close Database
        mysqli_close($conn);

        break;
    default:
        break;
}