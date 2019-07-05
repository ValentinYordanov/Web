<?php
header('Content-Type: application/json');
session_start();

echo isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true;
