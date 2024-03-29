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

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="teacher_home.php">Home</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="teacher_vControl.php">vocheck Control</a>
            </li>
            <li class="nav-item">
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

<div class="container">
    <div class="row">
        <div class="col-xl-8 offset-xl-2 col-lg-8 offset-lg-2 col-md-8 offset-md-2 col-sm-10 offset-sm-1 col-12">
            <h1>vocheck</h1>
            <h2>Your teacher Account - vocheck Control<br/><br/></h2>
            <p>Here you find all lists for your class. You can see the progress of your class doing the list. For more
                details click on the list.</p>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-xl-8 offset-xl-2 col-lg-8 offset-lg-2 col-md-8 offset-md-2 col-sm-10 offset-sm-1 col-12">
            <form method="POST" action="teacher_vControl.php">
                <input type="submit" name=vControl-class-back class="btn btn-secondary"
                       value="Go back to vocheck Control"/>
            </form>
            <div class="card mt-4">
                <div class="card-body">
                    <div class="card-header bg-secondary text-white">
                        <div class="row font-weight-bold">
                            <div class="col-6">Lists</div>
                            <div class="col-2 voc_num_unseen"><i class="fas fa-eye-slash"></i></div>
                            <div class="col-2 voc_num_incorrect"><i class="fas fa-times-circle"></i></div>
                            <div class="col-2 voc_num_correct"><i class="fas fa-check-circle"></i></div>
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