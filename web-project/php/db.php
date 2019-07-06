<?php
header('Content-Type: application/json;charset:UTF-8');

$ini_array = parse_ini_file("../config.ini");

$db_name = $ini_array['db_name'];

$users_table = $ini_array['users_table'];
$images_table = $ini_array['images_table'];
$albums_table = $ini_array['albums_table'];

$user = $ini_array['user'];
$password = $ini_array['password'];

$conn = new PDO('mysql:host=localhost;dbname=' . $db_name . ';charset=utf8', $user, $password);

function validateFile($file)
{
    if (exif_imagetype($file) != (IMAGETYPE_JPEG || IMAGETYPE_PNG || IMAGETYPE_BMP)) {
        return false;
    }
    return true;
}
