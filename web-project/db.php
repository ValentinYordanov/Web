<?php
    header('Content-Type: application/json;charset:UTF-8');

    $db_name = 'photos-project';
    $table_name = 'images';
    $album = 'jul2019';
    
    $users_table = 'users';
    $images_table = 'images';
    $albums_table = 'albums';

    $conn = new PDO('mysql:host=localhost;dbname=photos-project;charset=utf8', 'root', null);

?>