<?php
session_start();

$_SESSION["login"] = 0;
//$_SESSION = array();
//SESSION_DESTROY();

// echo "You logged out!";
echo isset($_SESSION["login"]);
echo $_SESSION["login"];
echo "test2";

include("login-formular.html");
