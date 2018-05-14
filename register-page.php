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
    <a class="navbar-brand" href=".">vocheck</a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href=".">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="about.php">About vocheck</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="contact.php">Contact</a>
            </li>
        </ul>
    </div>
</nav>

<div class="row">
    <div class="col-xl-8 offset-xl-2 col-lg-8 offset-lg-2 col-md-8 offset-md-2 col-sm-10 offset-sm-1 col-12">
        <h1>vocheck</h1>
        <h2>The new vocabulary checking tool for teachers and pupils</h2>
        <h2>Register</h2>
    </div>
</div>
<div class="row">
    <div class="col-xl-4 offset-xl-4 col-lg-4 offset-lg-4 col-md-8 offset-md-2 col-sm-12 col-12">
        <form method="POST" action="register.php">
            <div class="form-group row">
                <div class="col">
                    <label for="register_form_firstname">First name</label>
                    <input type="text" class="form-control" id="register_form_firstname" name="register_form_firstname" placeholder="First name" required>
                </div>
                <div class="col">
                    <label for="register_form_lastname">Last name</label>
                    <input type="text" class="form-control" id="register_form_lastname" name="register_form_lastname" placeholder="Last name" required>
                </div>
            </div>
            <div class="form-group">
                <label for="register_form_username">Username</label>
                <input type="text" class="form-control" id="register_form_username" name="register_form_username" placeholder="Username" required>
            </div>
            <div class="form-group">
                <label for="register_form_email">Email</label>
                <input type="email" class="form-control" id="register_form_email" name="register_form_email" placeholder="name@example.com" required>
            </div>
            <div class="form-group">
                <label for="register_form_password">Password</label>
                <input type="password" class="form-control" id="register_form_password" name="register_form_password" required>
            </div>
            <div class="form-group">
                <label for="register_form_type">Account Type</label>
                <select class="form-control" id="register_form_type" name="register_form_type" required>
                    <option value="1">Student</option>
                    <option value="2">Teacher</option>
                </select>
            </div>
            <div class="form-group text-center">
                <input type="submit" name="submit-register-account" class="btn btn-primary" value="Register Account">
            </div>
        </form>
    </div>
</div>

</body>
</html>