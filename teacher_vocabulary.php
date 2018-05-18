<?php
include('check_teacherlogin.php');
include('static/connect-database.php');

$_sql = "SELECT temp2.t1_id AS t2_id, temp2.t1_name AS t2_name, temp2.t1_fl AS t2_fl, languages.name AS t2_sl, temp2.t1_cname AS t2_cname FROM (SELECT temp1.l_id AS t1_id, temp1.l_name AS t1_name, languages.name AS t1_fl, temp1.l_sl AS t1_sl, temp1.c_name AS t1_cname FROM (SELECT lists.id AS l_id, lists.name AS l_name, lists.first_language AS l_fl, lists.second_language AS l_sl, classes.name AS c_name FROM lists LEFT JOIN classes ON lists.class=classes.id WHERE classes.deleted=0 AND lists.deleted=0 AND classes.teacher={$_SESSION["user"]["id"]}) AS temp1 LEFT JOIN languages ON temp1.l_fl=languages.id) AS temp2 LEFT JOIN languages ON temp2.t1_sl=languages.id";
if (!$_res = mysqli_query($conn, $_sql)) {
    echo "Error: %s\n" . mysqli_sqlstate($conn);
}

$_lists_str = "";

if (mysqli_num_rows($_res) > 0) {
    // output data of each row
    while ($row = mysqli_fetch_assoc($_res)) {
        $_lists_str .= "<li class=\"list-group-item d-flex justify-content-between align-items-center\" id=\"list-{$row["t2_id"]}\"><a href='toListDetails'>{$row["t2_name"]}</a><span><span class=\"mr-5\">{$row["t2_cname"]}</span><span class=\"mr-5\">{$row["t2_fl"]} - {$row["t2_sl"]}</span><i class=\"fas fa-trash-alt list-delete\"></i></span></li>";
    }
} else {
    $_lists_str = "No Lists";
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>vocheck</title>

    <?php
    include('static/head-imports.html');
    ?>

</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <a class="navbar-brand" href="teacher_home.php">vocheck</a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="teacher_home.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="teacher_vControl.php">vocheck Control</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="teacher_vocabulary.php">Vocabulary</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="teacher_classes.php">Classes</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="teacher_settings.php">Settings</a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li>
                <form method="POST" action="logout.php">
                    <input type=submit name=submit-logout class="btn btn-outline-light" value="Logout">
                </form>
            </li>
        </ul>
    </div>
</nav>

<div class="row">
    <div class="col-xl-8 offset-xl-2 col-lg-8 offset-lg-2 col-md-8 offset-md-2 col-sm-10 offset-sm-1 col-12">
        <h1>vocheck</h1>
        <h2>Your teacher Account - Vocabulary Lists</h2>
    </div>
</div>
<div class="row mt-4">
    <div class="col-xl-8 offset-xl-2 col-lg-8 offset-lg-2 col-md-8 offset-md-2 col-sm-10 offset-sm-1 col-12">
        <div class="text-right">
            <form method="POST" action="teacher_classes_new.php">
                <input type="submit" class="btn btn-dark" value="Create Class"/>
            </form>
        </div>
        <div class="card mt-4">
            <div class="card-body">
                <ul class="list-group">
                    <?php echo $_lists_str; ?>
                </ul>
            </div>
        </div>
    </div>
</div>

</body>
</html>