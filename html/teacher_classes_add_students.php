<?php
include('check_teacherlogin.php');
include('static/connect-database.php');

if (!isset($_POST['op']) || !isset($_POST['studentid']) || !isset($_POST['classid'])) {
    $_sql = "SELECT id, firstname, lastname FROM fe_users WHERE id NOT IN (SELECT user_classes.student FROM user_classes WHERE deleted=0 AND class={$_POST["class-detail-classid"]}) AND deleted=0 AND account_type=1";

    if (!$_res = mysqli_query($conn, $_sql)) {
        echo "Error: %s\n" . mysqli_sqlstate($conn);
    }

    $_students_str = "";

    if (mysqli_num_rows($_res) > 0) {
        while($row = mysqli_fetch_assoc($_res)) {
            $_students_str .= "<li class=\"list-group-item d-flex justify-content-between align-items-center\" id=\"student-{$row["id"]}-{$_POST["class-detail-classid"]}\">{$row["lastname"]}, {$row["firstname"]}<i class=\"fas fa-plus student-add\"></i></li>";
        }
    } else {
        $_students_str = "No students available";
    }

    $_sql = "SELECT name FROM classes WHERE classes.id = {$_POST["class-detail-classid"]}";
    if (!$_res = mysqli_query($conn, $_sql)) {
        echo "Error: %s\n" . mysqli_sqlstate($conn);
    }

    if (mysqli_num_rows($_res) == 1) {
        $row = mysqli_fetch_assoc($_res);
        $_classname = $row["name"];
    }
    $_classid = $_POST["class-detail-classid"];

    mysqli_close($conn);

    include('teacher_classes_add_students_page.php');
    exit;
}

switch ($_POST["op"]) {
    case "add":
        $_studentid = mysqli_real_escape_string($conn, $_POST["studentid"]);
        $_classid = mysqli_real_escape_string($conn, $_POST["classid"]);


        // check if user is really teacher of class
        $_sql = "SELECT teacher FROM classes WHERE id={$_classid}";

        if (!$_res = mysqli_query($conn, $_sql)) {
            echo "Error: %s\n" . mysqli_sqlstate($conn);
        }

        if (mysqli_num_rows($_res) == 1) {
            $row = mysqli_fetch_assoc($_res);
            if ($row["teacher"] != $_SESSION["user"]["id"]) {
                echo "You do not have the privileges for this class";
                exit;
            }
        }

        // Add student to class
        $_sql = "INSERT INTO user_classes (student, class) VALUES ('{$_studentid}','{$_classid}')";

        if (!mysqli_query($conn, $_sql)) {
            echo "Error: %s\n" . mysqli_sqlstate($conn);
        }

        break;
    default:
        echo "Error. Wrong parameter";
        break;
}

