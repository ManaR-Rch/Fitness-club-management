<?php

require_once './../../classes/User.php';
session_start();

$user = new User(null, null, null, null, null, null, null);
$user->logout();
header('Location: ./sign-in.php');