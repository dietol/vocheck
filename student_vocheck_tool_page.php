<?php
include('check_studentlogin.php');
include('static/connect-database.php');
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

<div class="row">
    <div class="col-xl-8 offset-xl-2 col-lg-8 offset-lg-2 col-md-8 offset-md-2 col-sm-10 offset-sm-1 col-12">
        <h1>vocheck</h1>
        <h2>Your student Account - Let's vocheck</h2>

    </div>
</div>
<div class="row mb-3">
    <div class="col-xl-6 offset-xl-3 col-lg-6 offset-lg-3 col-md-8 offset-md-2 col-sm-12 col-12">
        <div class="card border-primary">
            <div class="card-header">Let's vocheck</div>
            <div class="card-body text-dark">
                <h5 class="vocheck_first_language"><?php echo $_fl;?></h5>
                <h3 class="vocheck_translate"><?php echo $_mfl;?></h3>
                <h5 class="vocheck_second_language"><?php echo $_sl;?></h5>
                <form method="POST" action="student_vocheck_tool_check.php">
                    <div class="form-group">
                        <label for="voc_id" hidden >Nothing</label>
                        <input type ="text" name ="voc_id" id ="voc_id"  value ="<?php echo $_chosen_vocab."-".$_lid?>" hidden />
                        <label for="vocheck_tool_input" hidden>Last name</label>
                        <input type="text" class="form-control" id="vocheck_tool_input" name="vocheck_tool_input" required>
                    </div>
                    <div class="form-group text-center">
                        <input type="submit" name="vocheck_tool_submit" class="btn btn-dark" value="Vocheck">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

</body>
</html>