<?php
include('check_teacherlogin.php');
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
            <h2>Your teacher Account - Classes</h2>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-xl-4 offset-xl-4 col-lg-4 offset-lg-4 col-md-8 offset-md-2 col-sm-12 col-12">
            <form method="POST" action="teacher_classes_new.php">
                <h3>Create new class</h3>
                <div class="form-group">
                    <label for="classes_new_name">Class name</label>
                    <input type="text" class="form-control" id="classes_new_name" name="classes_new_name"
                           placeholder="Class name" required>
                </div>
                <div class="form-group">
                    <label for="classes_new_language_first">Mother Language</label>
                    <select class="form-control" id="classes_new_language_first" name="classes_new_language_first" required>
                        <?php echo $_language_str;?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="classes_new_language_second">Foreign Language</label>
                    <select class="form-control" id="classes_new_language_second" name="classes_new_language_second" required>
                        <?php echo $_language_str;?>
                    </select>
                </div>
                <div class="form-group text-center">
                    <input type="submit" name="classes_new_submit" class="btn btn-primary" value="Create Class">
                </div>
            </form>
            <form method="POST" action="teacher_classes.php">
                <div class="form-group text-center">
                    <input type="submit" name="classes_cancel" class="btn btn-secondary" value="Cancel">
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>