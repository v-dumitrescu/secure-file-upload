<?php require_once "file_upload.php"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Secure File Upload</title>
</head>
<body>
  
  <form method="POST" enctype="multipart/form-data">
    <input type="file" name="file" />
    <button>Upload</button>
  </form>

</body>
</html>