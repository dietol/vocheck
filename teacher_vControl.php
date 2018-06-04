<?php
include('check_teacherlogin.php');
include('static/connect-database.php');

$_sql = "SELECT temp.id AS d, temp.name AS a, languages.name AS b, temp.sl AS c FROM (SELECT classes.id AS id, classes.name AS name, classes.first_language AS fl, languages.name AS sl FROM classes LEFT JOIN languages ON classes.second_language = languages.id WHERE classes.deleted = 0 AND classes.teacher = {$_SESSION["user"]["id"]}) AS temp LEFT JOIN languages ON temp.fl = languages.id";
if (!$_res = mysqli_query($conn, $_sql)) {
    echo "Error: %s\n" . mysqli_sqlstate($conn);
}

$_classes_str = "";

if (mysqli_num_rows($_res) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($_res)) {
        $_classes_str .= "<li class=\"list-group-item d-flex justify-content-between align-items-center\" id=\"class-{$row["d"]}\"><a href='toClassStat'>{$row["a"]}</a><span class=\"mr-5\">{$row["b"]} - {$row["c"]}</span></li>";
    }
} else {
    $_classes_str = "Error";
}

mysqli_close($conn);


include("teacher_vControl_page.php");