<?php
require('db.php');
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'GET' || (!isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] !== true)) {
  header("location: login.html");
  exit;
}

$user = $_SESSION['user'];

$sql = $conn->prepare("INSERT INTO $images_table (path, user, album) VALUES (?, ?, ?)");
$targetdir = dirname(__DIR__) . '\\images\\';

$file_count = count($_FILES['files']['name']);
$errors = array();

for ($i = 0; $i < $file_count; $i++) {

  $file_name = $_FILES['files']['name'][$i];
  $tmp_path = $_FILES['files']['tmp_name'][$i];

  if (validateFile($tmp_path) === false) {
    http_response_code(400);
    echo $file_name . ' is not an image. Please try again!';
    exit;
  }
}

for ($i = 0; $i < $file_count; $i++) {

  $file_name = $_FILES['files']['name'][$i];
  $tmp_path = $_FILES['files']['tmp_name'][$i];

  $targetfile = $targetdir . $file_name;

  if (
    $sql->execute([$file_name, $user, $album]) &&
    move_uploaded_file($tmp_path, $targetfile)
  ) {
    echo "file saved to data and file system";
  } else {
    // file upload failed
    echo "file could not be saved to db.";
  }
}
