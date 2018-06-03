<?php
include('check_teacherlogin.php');
include('static/connect-database.php');

// Save-button pressed -> Update vocab
if (!empty($_POST["vocabulary_entry_save"])) {

    if(!isset($_POST["vocabulary_first"]) || !isset($_POST["vocabulary_second"])) {
        echo "Error while updating. Can not read new values.";
        // Close Database
        mysqli_close($conn);
        include("teacher_vocabulary_edit_page.php");
        exit;
    }

    $_vocabulary_first = mysqli_real_escape_string($conn, $_POST["vocabulary_first"]);
    $_vocabulary_second = mysqli_real_escape_string($conn, $_POST["vocabulary_second"]);
    $_vocabulary_list = mysqli_real_escape_string($conn, $_POST["vocabulary_list"]);

    $_vocabulary_listArray = explode("-", $_vocabulary_list);

    $_sql = "UPDATE vocabulary SET meaning_first_language='{$_vocabulary_first}', meaning_second_language='{$_vocabulary_second}' WHERE id = '{$_vocabulary_listArray[0]}'";

    if (!mysqli_query($conn, $_sql)) {
        echo "Error: " . $_sql . "<br>" . mysqli_error($conn);
        exit;
    }

    $_POST["op"] = "edit";
    $_POST["id"] = $_vocabulary_listArray[1];

    mysqli_close($conn);
    include("teacher_vocabulary_edit.php");
    exit;
}

if(!empty($_POST['vocabulary_entry_save-new'])) {

    if(!isset($_POST["vocabulary_first"]) || !isset($_POST["vocabulary_second"])) {
        echo "Error while updating. Can not read new values.";
        // Close Database
        mysqli_close($conn);
        include("teacher_vocabulary.php");
        exit;
    }

    $_vocabulary_first = mysqli_real_escape_string($conn, $_POST["vocabulary_first"]);
    $_vocabulary_second = mysqli_real_escape_string($conn, $_POST["vocabulary_second"]);
    $_vocabulary_list = mysqli_real_escape_string($conn, $_POST["vocabulary_list"]);

    $_sql = "SELECT first_language, second_language FROM lists WHERE id='{$_vocabulary_list}' AND deleted = 0";

    if (!$_res = mysqli_query($conn, $_sql)) {
        echo "Error: %s\n" . mysqli_sqlstate($conn);
    }

    if (mysqli_num_rows($_res) == 1) {
        // output data of each row
        $row = mysqli_fetch_assoc($_res);

    } else {
        echo "Error while inserting. Cannot find list.";
        // Close Database
        mysqli_close($conn);
        exit;
    }

    $_sql = "INSERT INTO vocabulary (meaning_first_language, meaning_second_language, first_language, second_language) VALUES ('{$_vocabulary_first}', '{$_vocabulary_second}', '{$row['first_language']}', '{$row['second_language']}')";

    if (!mysqli_query($conn, $_sql)) {
        echo "Error while inserting. Problems with creating new vocabulary.";
        // Close Database
        mysqli_close($conn);
        exit;
    }

    $_vocid = mysqli_insert_id($conn);

    $_sql = "INSERT INTO vocabulary_lists (vocabulary, list) VALUES ('{$_vocid}','{$_vocabulary_list}')";

    if (!mysqli_query($conn, $_sql)) {
        echo "Error while inserting. Problems with adding vocabulary to list.";
        // Close Database
        mysqli_close($conn);
        exit;
    }

    $_POST["op"] = "edit";
    $_POST["id"] = $_vocabulary_list;

    mysqli_close($conn);
    include("teacher_vocabulary_edit.php");
    exit;
}

if (!isset($_POST['op']) || !isset($_POST['vocid']) || !isset($_POST['listid'])) {
    mysqli_close($conn);
    echo "Error. Invalid Call.";
    exit;
}

if ($_POST['op'] == "delete") {
    $_sql = "UPDATE vocabulary SET deleted=1 WHERE id = '{$_POST["vocid"]}'";
    if (!mysqli_query($conn, $_sql)) {
        echo "Error: " . $_sql . "<br>" . mysqli_error($conn);
        mysqli_close($conn);
        exit;
    }

    $_sql = "UPDATE vocabulary_lists SET deleted=1 WHERE vocabulary = '{$_POST["vocid"]}' AND list = '{$_POST["listid"]}' ";
    if (!mysqli_query($conn, $_sql)) {
        echo "Error: " . $_sql . "<br>" . mysqli_error($conn);
        mysqli_close($conn);
        exit;
    }
}