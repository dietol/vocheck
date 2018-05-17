<?php
include('check_teacherlogin.php');
echo $_POST["classid"];
include('static/connect-database.php');



//$_sql = "SELECT name, first_language, second_language FROM classes WHERE deleted=0 AND id={$_POST["classid"]} AND teacher={$_SESSION["user"]["id"]}";
$_sql = "SELECT name, first_language, second_language FROM classes WHERE deleted=0 AND id={$_POST["classid"]}";

if (!$_res = mysqli_query($conn, $_sql)) {
    echo "Error: %s\n" . mysqli_sqlstate($conn);
}

if (mysqli_num_rows($_res) == 1) {
    $_name = $_res["name"];
    $_first_language = $_res["first_language"];
    $_second_language = $_res["second_language"];
} else {
    echo "Error: No class found in DB";
    exit;
}

$_sql = "SELECT * FROM languages";
if (!$_res = mysqli_query($conn, $_sql)) {
    echo "Error: %s\n" . mysqli_sqlstate($conn);
}

$_language_str_1 = "";
$_language_str_2 = "";

if (mysqli_num_rows($_res) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($_res)) {
        if ($row["id"] == $_first_language) {
            $_language_str_1 .= "<option value='{$row["id"]}' selected='selected'>{$row["name"]}</option>";
        } else {
            $_language_str_1 .= "<option value='{$row["id"]}'>{$row["name"]}</option>";
        }
        if ($row["id"] == $_second_language) {
            $_language_str_2 .= "<option value='{$row["id"]}' selected='selected'>{$row["name"]}</option>";
        } else {
            $_language_str_2 .= "<option value='{$row["id"]}'>{$row["name"]}</option>";
        }
    }
} else {
    $_language_str_1 = "Error";
    $_language_str_2 = "Error";
}

// Close Database
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

<div class="row">
    <div class="col-xl-8 offset-xl-2 col-lg-8 offset-lg-2 col-md-8 offset-md-2 col-sm-10 offset-sm-1 col-12">
        <h1>vocheck</h1>
        <h2>Your teacher Account - Classes</h2>
    </div>
</div>

<div class="row mb-3">
    <div class="col-xl-4 offset-xl-4 col-lg-4 offset-lg-4 col-md-8 offset-md-2 col-sm-12 col-12">
        <form method="POST" action="teacher_classes_edit.php">
            <h3>Edit class</h3>
            <div class="form-group">
                <label for="classes_edit_name">Class name</label>
                <input type="text" class="form-control" id="classes_edit_name" name="classes_edit_name"
                       value="<?php echo $_name;?>" required>
            </div>
            <div class="form-group">
                <label for="classes_edit_language_first">Mother Language</label>
                <select class="form-control" id="classes_edit_language_first" name="classes_edit_language_first" required>
                    <?php echo $_language_str_1;?>
                </select>
            </div>
            <div class="form-group">
                <label for="classes_edit_language_second">Foreign Language</label>
                <select class="form-control" id="classes_edit_language_second" name="classes_edit_language_second" required>
                    <?php echo $_language_str_2;?>
                </select>
            </div>
            <div class="form-group text-center">
                <input type="submit" name="classes_edit_submit" class="btn btn-primary" value="Create Class">
            </div>
        </form>
        <form method="POST" action="teacher_classes.php">
            <div class="form-group text-center">
                <input type="submit" name="classes_cancel" class="btn btn-secondary" value="Cancel">
            </div>
        </form>
    </div>
</div>

</body>
</html>