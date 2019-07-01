<?php 
    print_r($_FILES);

    $targetdir = 'C:\\images\\';   
      // name of the directory where the files should be stored
      for ($i = 0; $i < count($_FILES['files']['name']); $i++) {
  $targetfile = $targetdir.$_FILES['files']['name'][$i];

  if (move_uploaded_file($_FILES['files']['tmp_name'][$i], $targetfile)) {
    // file uploaded succeeded
  } else { 
    // file upload failed
  }
      }

?>