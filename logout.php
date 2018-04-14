<?php

echo "I am loggin out";
$_SESSION["login"] = 0;
echo "Session value = " . $_SESSION["login"];
SESSION_DESTROY();

echo "You logged out!";

include("login-formular.html");
