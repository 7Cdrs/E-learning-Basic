<?php
session_start();
include './library/config.php';
include './library/opendb.php';

$errorMessage = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['txtPassword'];
    $role = $_POST['role']; // Ambil role dari form

    $sql = "INSERT INTO data_akun (nama, email, username, password, role) VALUES ('$nama', '$email', '$username', '$password', '$role')";
    if (mysqli_query($conn, $sql)) {
        $_SESSION['data_akun'] = true;
        header('Location: login.php');
        exit;
    } else {
        $errorMessage = 'Error: ' . mysqli_error($conn);
    }
}
include './library/closedb.php';
?>

<!doctype html>
<html lang="en">

<head>
    <title>Register</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="dist/css2/style.css">
</head>

<body class="img js-fullheight" style="background-image: url(https://cdn-1.timesmedia.co.id/images/2022/04/14/Gedung-PENS.jpg);">
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-4">
                    <div class="login-wrap p-0">
                        <h3 class="mb-4 text-center">CREATE AN ACCOUNT</h3>
                        <?php if ($errorMessage != '') : ?>
                            <p align="center"><strong><font color="#990000"><?php echo $errorMessage; ?></font></strong></p>
                        <?php endif; ?>
                        <form method="post" action="">
                            <div class="form-group">
                                <input name="nama" type="text" id="nama" class="form-control" placeholder="Nama" value="<?php echo isset($_POST['nama']) ? $_POST['nama'] : ''; ?>" required>
                            </div>
                            <div class="form-group">
                                <input name="email" type="text" id="email" class="form-control" placeholder="Email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>" required>
                            </div>
                            <div class="form-group">
                                <input name="username" type="text" id="username" class="form-control" placeholder="Username" value="<?php echo isset($_POST['username']) ? $_POST['username'] : ''; ?>" required>
                            </div>
                            <div class="form-group">
                                <input name="txtPassword" id="txtPassword" type="password" class="form-control" placeholder="Password" value="<?php echo isset($_POST['txtPassword']) ? $_POST['txtPassword'] : ''; ?>" required>
                            </div>
                            <div class="form-group">
                                <select name="role" id="role" class="form-control" required>
                                    <option value="">Select Role</option>
                                    <option value="mahasiswa">Mahasiswa</option>
                                    <option value="dosen">Dosen</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="form-control btn btn-primary submit px-3">Register</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="dist/js2/jquery.min.js"></script>
    <script src="dist/js2/popper.js"></script>
    <script src="dist/js2/bootstrap.min.js"></script>
    <script src="dist/js2/main.js"></script>

</body>

</html>
