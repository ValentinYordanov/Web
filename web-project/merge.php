<?php
require('db.php');

print_r($_POST);

$sql = $conn->prepare("UPDATE $images_table SET album = ? WHERE album = ?");

$sql -> execute([$_POST['album_to_be_merged_into'], $_POST['album_to_be_merged']]);
