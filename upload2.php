<?php
session_start();
if (!isset($_SESSION['user_is_logged_in'])) {
    header('Location: login.php');
    exit;
}
?>

<!doctype html>
<html lang="en">

<head>
    <title>Upload File To MySQL Database</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .container {
            margin-top: 50px;
        }
        .box {
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
    </style>
</head>

<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="box">
                <h3 class="text-center">Upload File Penugasan</h3>
                <?php
                // Folder penempatan untuk file yang diupload bisa disesuaikan
                // selama PHP bisa membaca folder tersebut
                $uploadDir = 'file/';
                if (isset($_POST['upload'])) {
                    $fileName = $_FILES['userfile']['name'];
                    $tmpName = $_FILES['userfile']['tmp_name'];
                    $fileSize = $_FILES['userfile']['size'];
                    $fileType = $_FILES['userfile']['type'];
                    $filePath = $uploadDir . $fileName;
                    $result = move_uploaded_file($tmpName, $filePath);
                    if (!$result) {
                        echo "<div class='alert alert-danger'>Error uploading file</div>";
                        exit;
                    }
                    include 'library/config.php';
                    include 'library/opendb.php';
                    $fileName = addslashes($fileName);
                    $filePath = addslashes($filePath);
                    $query = "INSERT INTO upload (name, size, type, path ) " .
                    "VALUES ('$fileName', '$fileSize', '$fileType', '$filePath')";
                    mysqli_query($conn, $query) or die('Error, query failed : ' . mysqli_error($conn));
                    include 'library/closedb.php';
                    echo "<div class='alert alert-success'>File uploaded successfully</div>";
                }
                ?>

                <form action="" method="post" enctype="multipart/form-data" name="uploadform">
                    <div class="form-group">
                        <label for="userfile">Choose file</label>
                        <input type="hidden" name="MAX_FILE_SIZE" value="2000000">
                        <input name="userfile" type="file" class="form-control-file" id="userfile">
                    </div>
                    <div class="form-group text-center">
                        <input name="upload" type="submit" class="btn btn-primary" id="upload" value="Upload">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
