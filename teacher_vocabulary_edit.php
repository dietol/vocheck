<?php
include('check_teacherlogin.php');
include('static/connect-database.php');

// Edit or Delete Class
if (!isset($_POST['op']) || !isset($_POST['id'])) {
    echo "Error. Invalid Call.";
    exit;
}

switch ($_POST["op"]) {
    case "edit":
        $_listid = $_POST['id'];

        $_sql = "SELECT id, meaning_first_language AS mfl, meaning_second_language AS msl FROM (SELECT vocabulary FROM vocabulary_lists WHERE deleted=0 AND list={$_listid}) AS temp LEFT JOIN vocabulary ON temp.vocabulary=vocabulary.id WHERE vocabulary.deleted=0";

        if (!$_res = mysqli_query($conn, $_sql)) {
            echo "Error: %s\n" . mysqli_sqlstate($conn);
        }

        $_vocs_str = "";

        if (mysqli_num_rows($_res) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($_res)) {
                $_vocs_str .= "<li class=\"list-group-item d-flex justify-content-between align-items-center\" id=\"class-{$row["id"]}\"><table class=\"table .table-sm\"><tbody><tr><td>{$row["mfl"]}</td><td>{$row["msl"]}</td></tr></tbody></table><span><i class=\"fas fa-pencil-alt mr-3 class-edit\"></i><i class=\"fas fa-trash-alt class-delete\"></i></span></li>";
            }
        } else {
            $_vocs_str = "No vocabulary";
        }

        mysqli_close($conn);

        include("teacher_vocabulary_edit_page.php");
        break;
    case "remove":

        // Remove list with deleted=1
        $_sql = "UPDATE lists SET deleted=1 WHERE id='{$_POST["id"]}'";

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




