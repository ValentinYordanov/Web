<?php
require('db.php');
session_start();

if (!isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] !== true) {
  header("location: login.html");
  exit;
}

print_r($_FILES);
$user = $_SESSION['user'];

$sql = $conn->prepare("INSERT INTO $images_table (path, user, album) VALUES (?, ?, ?)");
$targetdir = dirname(__DIR__) . '\\images\\';

for ($i = 0; $i < count($_FILES['files']['name']); $i++) {
  $targetfile = $targetdir . $_FILES['files']['name'][$i];

  if (
    $sql->execute([$_FILES['files']['name'][$i], $user, $album]) &&
    move_uploaded_file($_FILES['files']['tmp_name'][$i], $targetfile)
  ) {
    echo "Everything is OK!";
  } else {
    // file upload failed
    echo "Something is not ok!";
  }
}
