<?php
require('db.php');

$targetdir = dirname(__DIR__) . '\\images\\';


$sql = $conn->prepare("SELECT * FROM $table_name WHERE user = ? AND album = ?");
$sql->execute([$user, $album]);

$return_value = array();

$result = $sql->setFetchMode(PDO::FETCH_ASSOC);
foreach ($sql->fetchAll() as $k => $v) {
    array_push($return_value, $v);
}

echo json_encode($return_value);

// for ($i = 0; $i < count($_FILES['files']['name']); $i++) {
//   $targetfile = $targetdir . $_FILES['files']['name'][$i];

//   if (move_uploaded_file($_FILES['files']['tmp_name'][$i], $targetfile)) {
//     // file uploaded succeeded
//   } else {
//     // file upload failed
//   }
// }
