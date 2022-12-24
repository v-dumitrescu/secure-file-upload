<?php

// Enable PHP-GD library

if($_SERVER['REQUEST_METHOD'] === 'POST') {

  define('DS', DIRECTORY_SEPARATOR);

  // Change $upload_dir to your desired path
  $upload_dir = "/home/vali/uploads/";
  
  $system_temp_dir = ((ini_get( 'upload_tmp_dir' ) === '') ? (sys_get_temp_dir()) : (ini_get( 'upload_tmp_dir')));

  $allowed_size = 2000000;

  $file_name = $_FILES['file']['name'];
  $file_tmp_name = $_FILES['file']['tmp_name'];
  $file_size = $_FILES['file']['size'];
  $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
  $file_ext = strtolower($file_ext);

  $random_name = random_int(1, 9999999999).'.'.$file_ext;
  $target_path = $system_temp_dir.DS.$random_name;

  $finfo = finfo_open(FILEINFO_MIME_TYPE);
  $mime = finfo_file($finfo, $file_tmp_name);
  finfo_close($finfo);

  if($file_ext === 'jpg' || $file_ext === 'jpeg' || $file_ext === 'png' || $file_ext === '') {
    if($file_size < $allowed_size) {
      if(($mime === 'image/jpeg' || $mime === 'image/png') && getimagesize($file_tmp_name)) {
        if($mime === 'image/jpeg') {
          $image = imagecreatefromjpeg($file_tmp_name);
          imagejpeg($image, $target_path ,100);
        } else {
          $image = imagecreatefrompng($file_tmp_name);
          imagepng($image, $target_path ,9);
        }
        imagedestroy($image);
        if(rename($target_path, $upload_dir.$random_name)) {
          echo 'File uploaded';
        } else {
          echo 'Error in file uploading.';
        }
        if(file_exists($target_path)) {
          unlink($target_path);
        }
      } else {
        echo 'File type not supported.';
      }
    } else {
      echo 'File must be less than 2MB.';
    } 
  } else {
    echo 'Invalid file.';
  }
} 

?>