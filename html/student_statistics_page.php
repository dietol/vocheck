<?php
include('check_studentlogin.php');
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
            <li class="nav-item">
                <a class="nav-link" href="student_vocheck.php">Let's vocheck</a>
            </li>
            <li class="nav-item active">
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
            <h2>Your student Account - Statistics <br/><br/></h2>
            <p>Here you have an overview about your progress in your vocheck lists.</p>

        </div>
    </div>
    <div class="row">
        <div class="col-xl-8 offset-xl-2 col-lg-8 offset-lg-2 col-md-8 offset-md-2 col-sm-10 offset-sm-1 col-12">
            <div class="card mt-4">
                <div class="card-body">
                    <div class="card-header bg-secondary text-white">
                        <div class="row font-weight-bold">
                            <div class="col-3">List</div>
                            <div class="col-3">Class</div>
                            <div class="col-3">Language</div>
                            <div class="col-1 voc_num_unseen"><i class="fas fa-eye-slash"></i></div>
                            <div class="col-1 voc_num_incorrect"><i class="fas fa-times-circle"></i></div>
                            <div class="col-1 voc_num_correct"><i class="fas fa-check-circle"></i></div>
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