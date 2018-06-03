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

        $_sql = "SELECT status FROM lists WHERE id={$_listid} AND deleted = 0";

        if (!$_res = mysqli_query($conn, $_sql)) {
            echo "Error: %s\n" . mysqli_sqlstate($conn);
        }

        if (mysqli_num_rows($_res) == 1) {
            // output data of each row
            $row = mysqli_fetch_assoc($_res);
            $_list_status = $row["status"];
        } else {
            echo "Error, do not found the list in db.";
            mysqli_close($conn);
            exit;
        }

        $_sql = "SELECT id, meaning_first_language AS mfl, meaning_second_language AS msl FROM (SELECT vocabulary FROM vocabulary_lists WHERE deleted=0 AND list={$_listid}) AS temp LEFT JOIN vocabulary ON temp.vocabulary=vocabulary.id WHERE vocabulary.deleted=0 ORDER BY id DESC";

        if (!$_res = mysqli_query($conn, $_sql)) {
            echo "Error: %s\n" . mysqli_sqlstate($conn);
        }

        $_vocs_str = "";

        if ($_list_status == 0) {
            $_vocs_str = "<li class=\"list-group-item d-flex justify-content-between align-items-center\" id=\"vocab-new\"><form method=\"POST\" action=\"teacher_vocabulary_edit_vocab.php\" id=\"vocab_form-new\" class=\"vocabulary_entry\"><label for=\"vocabulary_list\" hidden >Nothing</label><input type =\"text\" name = \"vocabulary_list\" id = \"vocabulary_list\"  value = \"{$_listid}\" hidden /><label for=\"vocabulary_first-new\" hidden > Nothing</label ><input type=\"text\" name=\"vocabulary_first\" id=\"vocabulary_first-new\"  value=\"New Vocabulary\" /><label for=\"vocabulary_second-new\" hidden > Nothing</label ><input type=\"text\" class=\"ml-1\" name=\"vocabulary_second\" id=\"vocabulary_second-new\" value=\"Translation\"/><input type=\"submit\" class=\"btn btn-info ml-3\" name=\"vocabulary_entry_save-new\" value=\"Add\"/ ></form></li>";
        }

        if (mysqli_num_rows($_res) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($_res)) {
                if ($_list_status == 0) {
                    $_vocs_str .= "<li class=\"list-group-item d-flex justify-content-between align-items-center\" id=\"vocab-{$row["id"]}-{$_listid}\"><form method=\"POST\" action=\"teacher_vocabulary_edit_vocab.php\" class=\"vocabulary_entry\"><label for=\"vocabulary_list\" hidden >Nothing</label><input type =\"text\" name = \"vocabulary_list\" id = \"vocabulary_list\"  value = \"{$row["id"]}-{$_listid}\" hidden /><label for=\"vocabulary_first-{$row["id"]}\" hidden>Nothing</label><input type=\"text\" name=\"vocabulary_first\" id=\"vocabulary_first-{$row["id"]}\"  value=\"{$row["mfl"]}\" readonly/><label for=\"vocabulary_second-{$row["id"]}\" hidden>Nothing</label><input type=\"text\" name=\"vocabulary_second\" class=\"ml-1\" id=\"vocabulary_second-{$row["id"]}\" value=\"{$row["msl"]}\" readonly/><input type=\"submit\" class=\"btn btn-info ml-3\" id=\"vocabulary_entry_save-{$row["id"]}\" name=\"vocabulary_entry_save\" value=\"Save\"/ hidden></form><span><i class=\"fas fa-pencil-alt mr-3 vocab-edit\"></i><i class=\"fas fa-trash-alt vocab-delete\"></i></span></li>";
                } else {
                    $_vocs_str .= "<li class=\"list-group-item d-flex justify-content-between align-items-center\"><form class=\"vocabulary_entry\"><label for=\"vocabulary_first-{$row["id"]}\" hidden>Nothing</label><input type=\"text\" name=\"vocabulary_first\" id=\"vocabulary_first-{$row["id"]}\"  value=\"{$row["mfl"]}\" readonly/><label for=\"vocabulary_second-{$row["id"]}\" hidden>Nothing</label><input type=\"text\" name=\"vocabulary_second\" class=\"ml-1\" id=\"vocabulary_second-{$row["id"]}\" value=\"{$row["msl"]}\" readonly/></form></li>";
                }
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
    case "activate":
        $_listid = $_POST['id'];

        $_sql = "UPDATE lists SET status = 1 WHERE id={$_listid}";

        if (!mysqli_query($conn, $_sql)) {
            echo "Error: %s\n" . mysqli_sqlstate($conn);
            exit;
        }

        // Close Database
        mysqli_close($conn);

        break;
    case "deactivate":
        $_listid = $_POST['id'];

        $_sql = "UPDATE lists SET status = 2 WHERE id={$_listid}";

        if (!mysqli_query($conn, $_sql)) {
            echo "Error: %s\n" . mysqli_sqlstate($conn);
            exit;
        }

        // Close Database
        mysqli_close($conn);

        break;
    default:
        break;
}




