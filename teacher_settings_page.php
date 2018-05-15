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
            <li class="nav-item">
                <a class="nav-link" href="teacher_classes.php">Classes</a>
            </li>
            <li class="nav-item active">
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
        <h2>Your teacher Account - Settings</h2>
        <p>Edit your Settings of the profil</p>
    </div>
</div>
<div class="row mb-3">
    <div class="col-xl-4 offset-xl-4 col-lg-4 offset-lg-4 col-md-8 offset-md-2 col-sm-12 col-12">
        <form method="POST" action="teacher_settings.php">
            <h3>Basic Account properties</h3>
            <div class="form-group">
                <label for="settingsT_form_firstname">First name</label>
                <input type="text" class="form-control" id="settingsT_form_firstname" name="settingsT_form_firstname"
                       placeholder="First name" value="<?php echo $_SESSION["user"]["firstname"];?>" required>
            </div>
            <div class="form-group">
                <label for="settingsT_form_lastname">Last name</label>
                <input type="text" class="form-control" id="settingsT_form_lastname" name="settingsT_form_lastname"
                       placeholder="Last name" value="<?php echo $_SESSION["user"]["lastname"];?>" required>
            </div>
            <div class="form-group">
                <label for="settingsT_form_email">Email</label>
                <input type="email" class="form-control" id="settingsT_form_email" name="settingsT_form_email" placeholder="name@example.com" value="<?php echo $_SESSION["user"]["email"];?>" required>
            </div>
            <div class="form-group text-center">
                <input type="submit" name="submit-settingsT-save" class="btn btn-dark" value="Save Changes">
            </div>
        </form>
    </div>
</div>
<div class="row mb-3">
    <div class="col-xl-4 offset-xl-4 col-lg-4 offset-lg-4 col-md-8 offset-md-2 col-sm-12 col-12">
        <form method="POST" action="teacher_settings.php">
            <h3>Change Password</h3>
            <div class="form-group">
                <label for="settingsT_form_password_enter">Enter password</label>
                <input type="password" class="form-control" id="settingsT_form_password_enter" name="settingsT_form_password_enter" placeholder="New Password" >
            </div>
            <div class="form-group">
                <label for="settingsT_form_password_reenter">Reenter password</label>
                <input type="password" class="form-control" id="settingsT_form_password_reenter" name="settingsT_form_password_reenter" placeholder="New Password">
            </div>
            <div class="form-group text-center">
                <input type="submit" name="submit-settingsT-save-password" class="btn btn-dark" value="Save New Password">
            </div>
        </form>
    </div>
</div>
<div class="row mb-3">
    <div class="col-xl-4 offset-xl-4 col-lg-4 offset-lg-4 col-md-8 offset-md-2 col-sm-12 col-12">
        <form>
            <h3>Fixed account properties</h3>
            <div class="form-group">
                <label for="settingsT_form_username">Username</label>
                <input type="text" class="form-control" id="settingsT_form_username" name="settingsT_form_username" value="<?php echo $_SESSION["user"]["username"];?>" readonly>
            </div>
            <div class="form-group">
                <label for="settingsT_form_type">Account Type</label>
                <input type="text" class="form-control" id="settingsT_form_type" name="settingsT_form_type" value="<?php if ($_SESSION["user"]["account_type"] == 1) {echo "Student";} else if ($_SESSION["user"]["account_type"] == 2) {echo "Teacher";} else {echo "Error";}?>" readonly>
            </div>
        </form>
    </div>
</div>
<div class="row mb-3">
    <div class="col-xl-4 offset-xl-4 col-lg-4 offset-lg-4 col-md-8 offset-md-2 col-sm-12 col-12">
        <h3>Delete Account</h3>
        <div class="card border-danger">
            <div class="card-header">Danger zone</div>
            <div class="card-body text-danger">
                <h5 class="card-title">Delete your User account</h5>
                <div class="text-center mt-4">
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#accountDeleteModal">Delete Account</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="accountDeleteModal" tabindex="-1" role="dialog" aria-labelledby="accountDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Deleting Account</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete your user account? All data will be lost.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <form method="POST" action="teacher_settings.php">
                    <input type="submit" name="submit-settingsT-delete" class="btn btn-danger" value="Delete Account">
                </form>
            </div>
        </div>
    </div>
</div>

</body>
</html>