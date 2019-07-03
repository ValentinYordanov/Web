<?php
header('Content-Type: application/json');
session_start();

echo json_encode(array('logged' => isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true));
