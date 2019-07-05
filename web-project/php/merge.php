<?php
require('db.php');

session_start();

if (isset($_POST['album_to_be_merged']) && isset($_POST['album_to_be_merged_into'])) {
    $album_to_be_merged = $_POST['album_to_be_merged'];
    $album_to_be_merged_into = $_POST['album_to_be_merged_into'];
} else {
    header("location: " . "index.html");
}

if ($album_to_be_merged === $album_to_be_merged_into) {
    http_response_code(400);
    echo json_encode(['error' => "Can't merge the same album!"]);
    exit;
}
$user = $_SESSION['user'];

$result = $conn->query("SELECT id FROM albums WHERE user = '$user' AND name = '$album_to_be_merged_into'");
$album_id = $result->fetch();
$album_id = $album_id['id'];

$sql = $conn->prepare("UPDATE $images_table SET album = ?, album_id = ? WHERE album = ?");
$sql_delete = $conn->prepare("DELETE FROM $albums_table WHERE name = ?");

// $album_to_be_merged_escape = mysql_real_escape_string($album_to_be_merged);
// $album_to_be_merged_into_escape = mysql_real_escape_string($album_to_be_merged_into);

$sql->execute([$album_to_be_merged_into, $album_id, $album_to_be_merged]);

$sql_delete->execute([$album_to_be_merged]);
