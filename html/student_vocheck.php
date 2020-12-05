<?php
include('check_studentlogin.php');
include('static/connect-database.php');

$_sql = "SELECT temp3.t3_id AS t4_id, temp3.t3_name AS t4_name, temp3.t3_fl AS t4_fl, languages.name AS t4_sl, temp3.t3_cname AS t4_cname FROM (SELECT temp2.t2_id AS t3_id, temp2.t2_name AS t3_name, languages.name AS t3_fl, temp2.t2_sl AS t3_sl, temp2.t2_cname AS t3_cname FROM (SELECT temp1.l_id AS t2_id, temp1.l_name AS t2_name, temp1.l_fl AS t2_fl, temp1.l_sl AS t2_sl, classes.name AS t2_cname FROM (SELECT lists.id AS l_id, lists.name AS l_name, lists.first_language AS l_fl, lists.second_language AS l_sl, lists.class AS l_class FROM user_classes JOIN lists ON user_classes.class = lists.class WHERE user_classes.student ={$_SESSION["user"]["id"]} AND user_classes.deleted = 0 AND lists.deleted = 0 AND lists.status = 1) AS temp1 JOIN classes ON temp1.l_class = classes.id WHERE classes.deleted = 0) AS temp2 JOIN languages ON temp2.t2_fl = languages.id) AS temp3 JOIN languages ON temp3.t3_sl = languages.id";
if (!$_res = mysqli_query($conn, $_sql)) {
    echo "Error: %s\n" . mysqli_sqlstate($conn);
}

$_lists_str = "";

if (mysqli_num_rows($_res) > 0) {
    // output data of each row
    while ($row = mysqli_fetch_assoc($_res)) {
        $_lists_str .= "<li class=\"list-group-item\" id=\"list-{$row["t4_id"]}\"><div class='row'><div class='col-6'><a href='toListVocheck'>{$row["t4_name"]}</a></div><div class='col-3'><span>{$row["t4_cname"]}</span></div><div class='col-3'><span>{$row["t4_fl"]} - {$row["t4_sl"]}</span></div></div></li>";
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
    <a class="navbar-brand" href="student_home.php">vocheck</a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="student_home.php">Home</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="student_vocheck.php">Let's vocheck</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="student_statistics.php">Statistics</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="student_settings.php">Settings</a>
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

<div class="container">
    <div class="row">
        <div class="col-xl-8 offset-xl-2 col-lg-8 offset-lg-2 col-md-8 offset-md-2 col-sm-10 offset-sm-1 col-12">
            <h1>vocheck</h1>
            <h2>Your student Account - Let's vocheck<br/><br/></h2>

            <p>Choose a list and let's vocheck!</p>

        </div>
    </div>
    <div class="row">
        <div class="col-xl-8 offset-xl-2 col-lg-8 offset-lg-2 col-md-8 offset-md-2 col-sm-10 offset-sm-1 col-12">
            <div class="card mt-4">
                <div class="card-body">
                    <div class="card-header bg-secondary text-white">
                        <div class="row font-weight-bold">
                            <div class="col-6">Lists</div>
                            <div class="col-3">Class</div>
                            <div class="col-3">Language</div>
                        </div>
                    </div>
                    <ul class="list-group">
                        <?php echo $_lists_str; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>