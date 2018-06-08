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
            <li class="nav-item">
                <a class="nav-link" href=".">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active">
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

            <p><br/><b>vocheck</b> is a new tool for teachers and pupils to easily check and do vocabulary homework. Teachers can
                create vocabulary lists for homework and the students can do their homework online.<br/><br/></p>
            <h3>Importance and Relevance</h3>
            <p>Learning vocabularies as a homework is always a difficult business for all parties. On the one hand the
                pupils do not want to learn vocabularies from the book or getting in an awkward situation when the
                parents are testing the vocabularies. Pupils prefer to learn the vocabularies on their own when it is
                not completely boring. <br/>
                On the other hand, the parents have to spend time in testing the vocabularies of
                their children if they have to learn it from the book. If you have more than one child, you must spend a
                Lot of time. <br/>
                At least there are the teachers who have no control if the pupils have learned the
                vocabularies. Therefore, teachers must write a Lot of tests to check if they did their homework or they
                have to test them in front of the class. Using this time of checking the learning status of the pupils
                during the lessons for other learning matter will promote the English knowledge of the class.<br/><br/>
                <b>vocheck</b> is an online tool which offers a solution for all these problems. The teacher of a class just
                put all the vocabularies in the online system. The pupils must learn and test the vocabularies with
                <b>vocheck</b> as homework. Thus, the parents do not have to test the vocabulary of their children because the
                teacher sees the learning status of every pupil. The pupils have more fun learning and testing the
                vocabularies because they can use a fancy online tool. And the teacher does not have to check the
                learning progress during the lessons because he sees the progress online.</p>
        </div>
    </div>
</div>

</body>
</html>