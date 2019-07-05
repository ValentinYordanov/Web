<?php
require('db.php');

session_start();

if (isset($_POST['album'])) {

    $sql = $conn->prepare("DELETE FROM $albums_table WHERE name = ? AND user = ?");

    echo $_SESSION["user"];

    $sql->execute([$_POST['album'], $_SESSION["user"]]);
}
