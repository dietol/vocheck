<?php
include('check_teacherlogin.php');
include('static/connect-database.php');

if (!isset($_POST['cid'])) {
    echo "Error. Invalid Call.";
    exit;
}

$_cid = $_POST['cid'];

$_sql = "SELECT lists.id AS lid, lists.name AS lname FROM lists WHERE class={$_cid} AND deleted=0";
if (!$_res = mysqli_query($conn, $_sql)) {
    echo "Error: %s\n" . mysqli_sqlstate($conn);
}

$_lists_str = "";

if (mysqli_num_rows($_res) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($_res)) {
        $_lists_str .= "<li class=\"list-group-item d-flex justify-content-between align-items-center\" id=\"list-{$row["lid"]}-{$_cid}\"><a href='toListStat'>{$row["lname"]}</a></li>";
    }
} else {
    $_lists_str = "Error";
}

mysqli_close($conn);


include("teacher_vControl_class_page.php");