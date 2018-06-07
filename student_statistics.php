<?php
include('check_studentlogin.php');
include('static/connect-database.php');


$_sql = "SELECT temp3.t3_id AS t4_id, temp3.t3_name AS t4_name, temp3.t3_fl AS t4_fl, languages.name AS t4_sl, temp3.t3_cname AS t4_cname, temp3.t3_lstat AS t4_lstat FROM (SELECT temp2.t2_id AS t3_id, temp2.t2_name AS t3_name, languages.name AS t3_fl, temp2.t2_sl AS t3_sl, temp2.t2_cname AS t3_cname, temp2.t2_lstat AS t3_lstat FROM (SELECT temp1.l_id AS t2_id, temp1.l_name AS t2_name, temp1.l_fl AS t2_fl, temp1.l_sl AS t2_sl, classes.name AS t2_cname, temp1.l_stat AS t2_lstat FROM (SELECT lists.id AS l_id, lists.name AS l_name, lists.first_language AS l_fl, lists.second_language AS l_sl, lists.class AS l_class, lists.status as l_stat FROM user_classes JOIN lists ON user_classes.class = lists.class WHERE user_classes.student ={$_SESSION["user"]["id"]} AND user_classes.deleted = 0 AND lists.deleted = 0 AND (lists.status = 1 OR lists.status = 2)) AS temp1 JOIN classes ON temp1.l_class = classes.id WHERE classes.deleted = 0) AS temp2 JOIN languages ON temp2.t2_fl = languages.id) AS temp3 JOIN languages ON temp3.t3_sl = languages.id";
if (!$_res = mysqli_query($conn, $_sql)) {
    echo "Error: %s\n" . mysqli_sqlstate($conn);
}

$_lists_str = "";
$lists = array();
if (mysqli_num_rows($_res) > 0) {
    while ($row = mysqli_fetch_assoc($_res)) {
        $lists[] = $row;
    }
} else {
    $_lists_str = "No Lists";
}


if (count($lists) > 0) {
    foreach ($lists as $list) {

        // Count unseen vocabs
        $_sql = "SELECT COUNT(vocab) AS num FROM statistics WHERE student={$_SESSION["user"]["id"]} AND list={$list["t4_id"]} AND status=0";

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
        $_sql = "SELECT COUNT(vocab) AS num FROM statistics WHERE student={$_SESSION["user"]["id"]} AND list={$list["t4_id"]} AND status=1";

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
        $_sql = "SELECT COUNT(vocab) AS num FROM statistics WHERE student={$_SESSION["user"]["id"]} AND list={$list["t4_id"]} AND status=2";

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

        if ($list["t4_lstat"] == 1) {
            $_list_class = "list_activated";
        } else {
            $_list_class = "list_deactivated";
        }

        $_lists_str .= "<li class=\"list-group-item {$_list_class}\"><div class=\"row\"><div class=\"col-3\"><span>{$list["t4_name"]}</span></div><div class=\"col-3\"><span>{$list["t4_cname"]}</span></div><div class=\"col-3\"><span>{$list["t4_fl"]} - {$list["t4_sl"]}</span></div><div class=\"col-1\"><span class=\"voc_num_unseen\">{$_num_unseen}</span></div><div class=\"col-1\"><span class=\"voc_num_incorrect\">{$_num_incorrect}</span></div><div class=\"col-1\"><span class=\"voc_num_correct\">{$_num_correct}</span></div></div></li>";
    }
} else {
    $_lists_str = "No Lists";
}

mysqli_close($conn);

include("student_statistics_page.php");