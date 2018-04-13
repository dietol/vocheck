<?php

$_SESSION["login"] = 0;
session_destroy();

include("login-formular.html");
