<?php
require('db.php');

session_start();

if (isset($_POST['album'])) {

    $sql = $conn->prepare("INSERT INTO $albums_table (name, user) VALUES (?, ?)");

    $sql->execute([$_POST['album'], $_SESSION["user"]]);
}
