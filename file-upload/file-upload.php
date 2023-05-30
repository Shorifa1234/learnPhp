<?php
// Specify the allowed file types
$allowedTypes = ['application/pdf', 'image/jpeg', 'image/png', 'image/gif', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];

// Specify the maximum file size in bytes (400 KB)
$maxFileSize = 400 * 1024;

// Check if a file was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["file"])) {
    $file = $_FILES["file"];

    // Check if there was an upload error
    if ($file["error"] !== UPLOAD_ERR_OK) {
        echo "Error uploading file. Please try again.";
        exit;
    }

    // Check if the file type is allowed
    if (!in_array($file["type"], $allowedTypes)) {
        echo "Invalid file type. Only PDF, image, and document files are allowed.";
        exit;
    }

    // Check if the file size is within the limit
    if ($file["size"] > $maxFileSize) {
        echo "File size exceeds the limit of 400 KB.";
        exit;
    }

    // Generate a unique filename to prevent conflicts
    $filename = uniqid() . '_' . $file["name"];

    // Specify the directory where the file should be saved
    $uploadDir = "uploads/";

    // Move the uploaded file to the desired location
    if (move_uploaded_file($file["tmp_name"], $uploadDir . $filename)) {
        echo "File uploaded successfully.";
    } else {
        echo "Error uploading file. Please try again.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File upload</title>
</head>
<body>
    <h1>File upload</h1>
    <form method="post" enctype="multipart/form-data">
      <input type="file" name="file" accept=" .pdf, .jpg, .jpeg, .png, .gif, .doc, .docx">
      <input type="submit" value="Upload">
    </form>
</body>
</html>