<?php

$conn = new PDO('mysql:host=localhost;dbname=photos-project;charset=utf8', 'root', null);

// $sql_get_album_id = $conn->query("SELECT id FROM $albums_table WHERE user = valko AND name = test");

// print_r($sql_get_album_id);

$user = 'valko';
$album = 'test';
foreach ($conn->query("SELECT id FROM albums WHERE user = '$user' AND name = '$album'") as $row) {
    print_r($row['id']);
}
