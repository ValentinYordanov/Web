<?php
require('db.php');

session_start();

if (isset($_POST['album'])) {

    $user = $_SESSION['user'];
    $album = $_POST['album'];

    $result = $conn->query("SELECT name FROM $albums_table WHERE user = '$user' AND name = '$album'");
    $album_id = $result->fetch();
    $album_id = $album_id['name'];

    if ($album_id) {
        http_response_code(400);
        exit;
    } else {
        $sql = $conn->prepare("INSERT INTO $albums_table (name, user) VALUES (?, ?)");
        $sql->execute([$album, $user]);
    }
}
