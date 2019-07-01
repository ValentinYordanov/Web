<?php
    header('Content-Type: application/json;charset:UTF-8');

    $db_name = 'photos-project';
    $table_name = 'images';
    $user = 'valko';
    $album = 'jul2019';

    $conn = new PDO('mysql:host=localhost;dbname=photos-project;charset=utf8', 'root', null);

?>