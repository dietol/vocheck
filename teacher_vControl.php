<?php
include('check_teacherlogin.php');
include('static/connect-database.php');

$_sql = "SELECT temp.id AS id, temp.name AS classname, languages.name AS fl, temp.sl AS sl FROM (SELECT classes.id AS id, classes.name AS name, classes.first_language AS fl, languages.name AS sl FROM classes LEFT JOIN languages ON classes.second_language = languages.id WHERE classes.deleted = 0 AND classes.teacher = {$_SESSION["user"]["id"]}) AS temp LEFT JOIN languages ON temp.fl = languages.id";
if (!$_res = mysqli_query($conn, $_sql)) {
    echo "Error: %s\n" . mysqli_sqlstate($conn);
}

$_classes_str = "";

if (mysqli_num_rows($_res) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($_res)) {
        $_classes_str .= "<li class=\"list-group-item\" id=\"class-{$row["id"]}\"><div class='row'><div class='col-8'><a href='toClassStat'>{$row["classname"]}</a></div><div class='col-4'><span class=\"mr-5\">{$row["fl"]} - {$row["sl"]}</span></div></div></li>";
    }
} else {
    $_classes_str = "Error";
}

mysqli_close($conn);


include("teacher_vControl_page.php");