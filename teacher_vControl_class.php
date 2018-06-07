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
        $_sql = "SELECT COUNT(vocab) AS num FROM statistics WHERE list={$list["lid"]} AND status=0";

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
        $_sql = "SELECT COUNT(vocab) AS num FROM statistics WHERE list={$list["lid"]} AND status=1";

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
        $_sql = "SELECT COUNT(vocab) AS num FROM statistics WHERE list={$list["lid"]} AND status=2";

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

        $_sql = "SELECT status FROM lists WHERE id={$list["lid"]} AND deleted=0";

        if (!$_res = mysqli_query($conn, $_sql)) {
            echo "Error: %s\n" . mysqli_sqlstate($conn);
        }

        if (mysqli_num_rows($_res) == 1) {
            $row = mysqli_fetch_assoc($_res);
            if ($row["status"] == 1) {
                $_list_class = "list_activated";
            } else {
                $_list_class = "list_deactivated";
            }
        } else {
            echo "Error in getting status of list!";
            exit;
        }

        // Calculation Percentages
        $_total_voc = $_num_unseen + $_num_incorrect + $_num_correct;
        $_num_unseen = round(($_num_unseen * 100) / $_total_voc, 2);
        $_num_incorrect = round(($_num_incorrect * 100) / $_total_voc, 2);
        $_num_correct = round(($_num_correct * 100) / $_total_voc, 2);

        $_lists_str .= "<li class=\"list-group-item {$_list_class}\" id=\"list-{$list["lid"]}-{$_cid}\"><div class=\"row\"><div class=\"col-6\"><a href='toListStat'>{$list["lname"]}</a></div><div class=\"col-2\"><span class=\"voc_num_unseen\">{$_num_unseen} %</span></div><div class=\"col-2\"><span class=\"voc_num_incorrect\">{$_num_incorrect} %</span></div><div class=\"col-2\"><span class=\"voc_num_correct\">{$_num_correct} %</span></div></div></li>";
    }
} else {
    $_students_str = "No Lists";
}

mysqli_close($conn);


include("teacher_vControl_class_page.php");
