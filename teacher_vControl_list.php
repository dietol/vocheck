<?php
include('check_teacherlogin.php');
include('static/connect-database.php');

if (!isset($_POST['lid']) || !isset($_POST['cid'])) {
    echo "Error. Invalid Call.";
    exit;
}

$_lid = $_POST['lid'];
$_cid = $_POST['cid'];

$_sql = "SELECT fe_users.id AS uid, fe_users.lastname AS uln, fe_users.firstname AS ufn FROM user_classes LEFT JOIN fe_users ON user_classes.student = fe_users.id WHERE user_classes.class={$_cid} AND fe_users.deleted=0";
if (!$_res = mysqli_query($conn, $_sql)) {
    echo "Error: %s\n" . mysqli_sqlstate($conn);
}

$_students_str = "";
$students = array();

if (mysqli_num_rows($_res) > 0) {
    while ($row = mysqli_fetch_assoc($_res)) {
        $students[] = $row;
    }
} else {
    $_students_str = "No Students";
}


if (count($students) > 0) {
    foreach ($students as $student) {

        // Count unseen vocabs
        $_sql = "SELECT COUNT(vocab) AS num FROM statistics WHERE student={$student["uid"]} AND list={$_lid} AND status=0";

        if (!$_res = mysqli_query($conn, $_sql)) {
            echo "Error in counting Unseen Vocabs.\n" . mysqli_sqlstate($conn);
            exit;
        }
        if (mysqli_num_rows($_res) == 1) {
            $row = mysqli_fetch_assoc($_res);
            $_num_unseen = $row["num"];
        } else {
            echo "Error in counting Unseen Vocabs!";
            exit;
        }

        // Count seen but incorrect vocabs
        $_sql = "SELECT COUNT(vocab) AS num FROM statistics WHERE student={$student["uid"]} AND list={$_lid} AND status=1";

        if (!$_res = mysqli_query($conn, $_sql)) {
            echo "Error in counting Unseen Vocabs.\n" . mysqli_sqlstate($conn);
        }
        if (mysqli_num_rows($_res) == 1) {
            $row = mysqli_fetch_assoc($_res);
            $_num_incorrect = $row["num"];
        } else {
            echo "Error in counting incorrect Vocabs!";
            exit;
        }

        // Count correct vocabs
        $_sql = "SELECT COUNT(vocab) AS num FROM statistics WHERE student={$student["uid"]} AND list={$_lid} AND status=2";

        if (!$_res = mysqli_query($conn, $_sql)) {
            echo "Error in counting Unseen Vocabs.\n" . mysqli_sqlstate($conn);
        }
        if (mysqli_num_rows($_res) == 1) {
            $row = mysqli_fetch_assoc($_res);
            $_num_correct = $row["num"];
        } else {
            echo "Error in counting correct Vocabs!";
            exit;
        }

        $_students_str .= "<li class=\"list-group-item\"><div class=\"row\"><div class=\"col-6\"><span>{$student["uln"]}, {$student["ufn"]}</span></div><div class=\"col-2\"><span class=\"voc_num_unseen\">{$_num_unseen}</span></div><div class=\"col-2\"><span class=\"voc_num_incorrect\">{$_num_incorrect}</span></div><div class=\"col-2\"><span class=\"voc_num_correct\">{$_num_correct}</span></div></div></li>";
    }
} else {
    $_students_str = "No students";
}

mysqli_close($conn);


include("teacher_vControl_list_page.php");