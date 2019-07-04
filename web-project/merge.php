<?php
require('db.php');

if (isset($_POST['album_to_be_merged']) && isset ($_POST ['album_to_be_merged_into'])) {
    $album_to_be_merged = $_POST['album_to_be_merged'];
    $album_to_be_merged_into = $_POST['album_to_be_merged_into'];
}

if ($album_to_be_merged === $album_to_be_merged_into) {
    http_response_code(400);
    echo json_encode(['error' => "Please, can't merge the same album!"]);
    exit;
}

    $sql = $conn->prepare("UPDATE $images_table SET album = ? WHERE album = ?");

$sql->execute([$album_to_be_merged_into, $album_to_be_merged]);
