<?php
header('Content-Type: application/json;charset:UTF-8');
$ini_array = parse_ini_file("../config.ini");

$user = $ini_array['user'];
$password = $ini_array['password'];

$conn = new PDO('mysql:host=localhost;charset=utf8', $user, $password);

$db_name = $ini_array['db_name'];

$users_table = $ini_array['users_table'];
$images_table = $ini_array['images_table'];
$albums_table = $ini_array['albums_table'];

$sql = "CREATE DATABASE $db_name";
$conn->query($sql);

$new_conn = new PDO('mysql:host=localhost;dbname=' . $db_name . ';charset=utf8', $user, $password);

$create_users = "CREATE TABLE $users_table(
        id INT NOT NULL AUTO_INCREMENT,
        name varchar(50) NOT NULL,
        password varchar(200) NOT NULL,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (id),
        INDEX index_name (name)
    )";

$create_albums = "CREATE TABLE $albums_table(
        id INT NOT NULL AUTO_INCREMENT,
        name varchar(50) NOT NULL,
        user varchar(50) NOT NULL,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (id)
)";

$create_images = "CREATE TABLE $images_table(
    id INT NOT NULL AUTO_INCREMENT,
    path varchar(200) NOT NULL,
    user varchar(50) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    album varchar(50) NOT NULL,
    album_id int NOT NULL,
    PRIMARY KEY (id)
)";

$new_conn->query($create_users);
$new_conn->query($create_albums);
$new_conn->query($create_images);

$add_index_album = "CREATE INDEX some_index ON $images_table(album_id)";
$new_conn->query($add_index_album);

$add_foreign_key1 = "ALTER TABLE $albums_table ADD CONSTRAINT unnamed FOREIGN KEY (user) REFERENCES $users_table(name) ON DELETE CASCADE ON UPDATE CASCADE;";
$add_foreign_key2 = "ALTER TABLE $images_table ADD CONSTRAINT unnamed1 FOREIGN KEY (user) REFERENCES $users_table(name) ON DELETE CASCADE ON UPDATE CASCADE;";
$add_foreign_key3 = "ALTER TABLE $images_table ADD CONSTRAINT unnamed2 FOREIGN KEY (album_id) REFERENCES $albums_table(id) ON DELETE CASCADE ON UPDATE CASCADE;";


$new_conn->query($add_foreign_key1);
$new_conn->query($add_foreign_key2);
$new_conn->query($add_foreign_key3);
