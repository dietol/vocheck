<?php
include('check_teacherlogin.php');
include('static/connect-database.php');

$_sql = "SELECT temp.id AS d, temp.name AS a, languages.name AS b, temp.sl AS c FROM (SELECT classes.id AS id, classes.name AS name, classes.first_language AS fl, languages.name AS sl FROM classes LEFT JOIN languages ON classes.second_language = languages.id WHERE classes.deleted = 0 AND classes.teacher = {$_SESSION["user"]["id"]}) AS temp LEFT JOIN languages ON temp.fl = languages.id";
if (!$_res = mysqli_query($conn, $_sql)) {
    echo "Error: %s\n" . mysqli_sqlstate($conn);
}

$_classes_str = "";

if (mysqli_num_rows($_res) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($_res)) {
        $_classes_str .= "<li class=\"list-group-item\" id=\"class-{$row["d"]}\"><div class='row'><div class='col-6'><a href='toClassDetails'>{$row["a"]}</a></div><div class='col-4'><span>{$row["b"]} - {$row["c"]}</span></div><div class='col-1'><i class=\"fas fa-pencil-alt class-edit\"></i></div><div class='col-1'><i class=\"fas fa-trash-alt class-delete\"></i></div></div></li>";
    }
} else {
    $_classes_str = "No classes";
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

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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
            <li class="nav-item">
                <a class="nav-link" href="teacher_vocabulary.php">Vocabulary</a>
            </li>
            <li class="nav-item active">
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

<div class="container">
    <div class="row">
        <div class="col-xl-8 offset-xl-2 col-lg-8 offset-lg-2 col-md-8 offset-md-2 col-sm-10 offset-sm-1 col-12">
            <h1>vocheck</h1>
            <h2>Your teacher Account - Classes<br/><br/></h2>
            <p>Here you can create new classes and edit the students of your class.</p>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-8 offset-xl-2 col-lg-8 offset-lg-2 col-md-8 offset-md-2 col-sm-10 offset-sm-1 col-12">
            <div class="text-right">
                <form method="POST" action="teacher_classes_new.php">
                    <input type="submit" class="btn btn-dark" value="Create Class"/>
                </form>
            </div>
            <div class="card mt-4">
                <div class="card-body">
                    <div class="card-header bg-secondary text-white">
                        <div class="row font-weight-bold">
                            <div class="col-6">My classes</div>
                            <div class="col-4">Language of class</div>
                        </div>
                    </div>
                    <ul class="list-group">
                        <?php echo $_classes_str;?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>