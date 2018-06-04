<?php
include('check_studentlogin.php');
include('static/connect-database.php');

if (!isset($_POST['lid']) && !isset($_lid)) {
    echo "Error. Invalid Call.";
    exit;
}

if (isset($_POST['lid'])) {
    $_lid = $_POST['lid'];
}

$_sql = "SELECT vocab FROM statistics WHERE student = {$_SESSION["user"]["id"]} AND list = {$_lid} AND (status = 0 OR status = 1)";

if (!$_res = mysqli_query($conn, $_sql)) {
    echo "Error1: %s\n" . mysqli_sqlstate($conn);
    exit;
}

$_possible_vocabs = array();
while ($row = mysqli_fetch_assoc($_res)) {
    $_possible_vocabs[] = $row["vocab"];
}

$_amount_vocab = count($_possible_vocabs);

$_chosen_vocab = $_possible_vocabs[rand(0, $_amount_vocab-1)];

$_sql = "SELECT temp.meaning_first_language AS mfl, temp.langname AS fl, languages.name AS sl FROM (SELECT meaning_first_language, languages.name AS langname, second_language FROM vocabulary JOIN languages ON first_language = languages.id WHERE vocabulary.id = {$_chosen_vocab}) AS temp JOIN languages ON temp.second_language = languages.id";

if (!$_res = mysqli_query($conn, $_sql)) {
    echo "Error2: %s\n" .$_sql. mysqli_sqlstate($conn);
    exit;
}

if (mysqli_num_rows($_res) == 1) {
    $row = mysqli_fetch_assoc($_res);
    $_mfl = $row["mfl"];
    $_fl = $row["fl"];
    $_sl = $row["sl"];
} else {
    echo "Error. Did not find vocabulary in DB.";
    exit;
}

include("student_vocheck_tool_page.php");