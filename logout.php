<?php

$_SESSION["login"] = 0;
SESSION_DESTROY();

// echo "You logged out!";

include("login-formular.html");
