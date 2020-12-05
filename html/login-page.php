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

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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
        <ul class="navbar-nav ml-auto">
            <li>
                <form method="POST" action="register.php">
                    <input type=submit name=submit-register class="btn btn-outline-light" value="Register">
                </form>
            </li>
        </ul>
    </div>
</nav>

<div class="container">
    <div class="row">
        <div class="col-xl-8 offset-xl-2 col-lg-8 offset-lg-2 col-md-8 offset-md-2 col-sm-10 offset-sm-1 col-12">
            <h1>vocheck</h1>
            <h2>The new vocabulary checking tool for teachers and pupils</h2>

            <p><b>vocheck</b> is a new tool for teachers and pupils to easily check and do vocabulary homework. Teachers
                can
                create vocabulary lists for homework and the students can do their homework online<br/></p>
            <h2>Login<br></h2>
            <p>Login to your user account!</p>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-4 offset-xl-4 col-lg-4 offset-lg-4 col-md-4 offset-md-4 col-sm-10 offset-sm-1 col-12">
            <?php if ($_pw_incorrect == 1) :?>
                <p class="text-danger">The login data is not correct. Try again!</p>
            <?php endif; ?>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-4 offset-xl-4 col-lg-4 offset-lg-4 col-md-4 offset-md-4 col-sm-10 offset-sm-1 col-12">
            <form method="POST" action="login.php">
                <div class="form-group">
                    <label for="input_username">Username</label>
                    <input type="text" class="form-control" id="input_username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="input_password">Password</label>
                    <input type="password" class="form-control" id="input_password" name="password" required>
                </div>
                <input type="submit" name="submit-login" class="btn btn-primary" value="Login">
            </form>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-xl-4 offset-xl-4 col-lg-4 offset-lg-4 col-md-4 offset-md-4 col-sm-10 offset-sm-1 col-12">
            <p>You don't have an account? Than just register in one minute and use vocheck for your lessons! <a
                        href="register.php">Register here</a></p>
        </div>
    </div>
</div>

</body>
</html>