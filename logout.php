<?php

SESSION_START();

$_SESSION = array();
SESSION_DESTROY();

// echo "You logged out!";

include("login-formular.html");
