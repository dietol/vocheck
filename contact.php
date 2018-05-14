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
            <li class="nav-item">
                <a class="nav-link" href=".">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="about.php">About vocheck</a>
            </li>
            <li class="nav-item active">
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

<div class="row">
    <div class="col-xl-8 offset-xl-2 col-lg-8 offset-lg-2 col-md-8 offset-md-2 col-sm-10 offset-sm-1 col-12">
        <h1>vocheck</h1>
        <h2>The new vocabulary checking tool for teachers and pupils</h2>

        <p>Contact section</p>
    </div>
</div>

</body>
</html>