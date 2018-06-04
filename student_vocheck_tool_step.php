<?php
include('check_studentlogin.php');
include('static/connect-database.php');

if (!isset($_vid) || !isset($_correct) || !isset($_lid)) {
    echo "Error. Invalid Call.";
    exit;
}

$_sql = "SELECT temp.mfl AS mfl, temp.msl AS msl, temp.fl AS fl, languages.name AS sl FROM (SELECT meaning_first_language AS mfl, meaning_second_language AS msl, languages.name AS fl, second_language AS sl FROM vocabulary JOIN languages ON first_language = languages.id WHERE vocabulary.id = {$_vid} AND deleted = 0) AS temp JOIN languages ON temp.sl = languages.id";

if (!$_res = mysqli_query($conn, $_sql)) {
    echo "Error: " . mysqli_error($conn);
    exit;
}

if (mysqli_num_rows($_res) == 1) {
    $row = mysqli_fetch_assoc($_res);
    $_voc_mfl = $row["mfl"];
    $_voc_msl = $row["msl"];
    $_voc_fl = $row["fl"];
    $_voc_sl = $row["sl"];
} else {
    echo "Error. Did not found vocabulary in DB.";
    mysqli_close($conn);
    exit;
}

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
<?php if ($_correct == 1) :?>
<div class="row mb-3">
    <div class="col-xl-6 offset-xl-3 col-lg-6 offset-lg-3 col-md-8 offset-md-2 col-sm-12 col-12">
        <div class="card border-success">
            <div class="card-header">Let's vocheck</div>
            <div class="card-body text-success">
                <h3>This answer was right!</h3>
                <form method="POST" action="student_vocheck_tool.php">
                    <label for="list_id" hidden >Nothing</label>
                    <input type ="text" name ="lid" id ="list_id"  value ="<?php echo $_lid;?>" hidden />
                    <div class="form-group text-center">
                        <input type="submit" name="vocheck_tool_submit" class="btn btn-success" value="Continue">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php else : ?>
    <div class="row mb-3">
        <div class="col-xl-6 offset-xl-3 col-lg-6 offset-lg-3 col-md-8 offset-md-2 col-sm-12 col-12">
            <div class="card border-danger">
                <div class="card-header">Let's vocheck</div>
                <div class="card-body text-danger">
                    <h3>This answer was wrong!</h3>
                    <p>The correct answer was:</p>
                    <h5><?php echo $_voc_fl.": ".$_voc_mfl?></h5>
                    <h5><?php echo $_voc_sl.": ".$_voc_msl?></h5>
                    <form method="POST" action="student_vocheck_tool.php">
                        <label for="list_id" hidden >Nothing</label>
                        <input type ="text" name ="lid" id ="list_id"  value ="<?php echo $_lid;?>" hidden />
                        <div class="form-group text-center">
                            <input type="submit" name="vocheck_tool_submit" class="btn btn-danger" value="Continue">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

</body>
</html>