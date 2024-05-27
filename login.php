<?php
session_start();
$errorMessage = '';
if (isset($_POST['login'])) {
    if (isset($_POST['username']) && isset($_POST['Password'])) {
        include './library/config.php';
        include './library/opendb.php';
        $username = $_POST['username'];
        $password = $_POST['Password'];
        
        // Periksa apakah username dan password cocok serta ambil perannya
        $sql = "SELECT username, role FROM data_akun WHERE username = '$username' AND password ='$password'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $role = $row['role'];
            
            $_SESSION['user_is_logged_in'] = true;
            $_SESSION['role'] = $role; // Simpan role di session
            $cookie_name = "user";
            $cookie_value = $username;
            setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
            
            // Arahkan ke halaman sesuai dengan peran
            if ($role == 'dosen') {
                header('Location: download.php');
            } else {
                header('Location: upload2.php');
            }
            exit;
        } else {
            $errorMessage = 'Sorry, wrong user id / password';
        }
        include './library/closedb.php';
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <title>Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="dist/css2/style.css">

    <script>
        function showCookieConsent() {
            var consent = confirm("This website uses cookies to ensure you get the best experience. By continuing to use this site, you agree to our use of cookies.");
            if (consent) {
                setCookie('cookieConsent', true, 30);
                return true;
            }
            return false;
        }

        function setCookie(cookieName, cookieValue, expirationDays) {
            var d = new Date();
            d.setTime(d.getTime() + (expirationDays * 24 * 60 * 60 * 1000));
            var expires = "expires=" + d.toUTCString();
            document.cookie = cookieName + "=" + cookieValue + ";" + expires + ";path=/";
        }

        function getCookie(cookieName) {
            var name = cookieName + "=";
            var decodedCookie = decodeURIComponent(document.cookie);
            var cookieArray = decodedCookie.split(';');
            for (var i = 0; i < cookieArray.length; i++) {
                var cookie = cookieArray[i];
                while (cookie.charAt(0) == ' ') {
                    cookie = cookie.substring(1);
                }
                if (cookie.indexOf(name) == 0) {
                    return cookie.substring(name.length, cookie.length);
                }
            }
            return "";
        }

        window.onload = function() {
            if (!getCookie('cookieConsent')) {
                showCookieConsent();
            }
        };

        document.getElementById('loginForm').addEventListener('submit', function(event) {
            if (!getCookie('cookieConsent') && !showCookieConsent()) {
                event.preventDefault();
            }
        });
    </script>
</head>

<body class="img js-fullheight" style="background-image: url(https://cdn-1.timesmedia.co.id/images/2022/04/14/Gedung-PENS.jpg);" onload="showCookieConsent()">

    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-4">
                    <div class="login-wrap p-0">
                        <h3 class="mb-4 text-center">Have an account?</h3>
                        <form id="loginForm" action="login.php" method="POST" class="signin-form">
                            <div class="form-group">
                                <input name="username" type="text" class="form-control" placeholder="Username">
                            </div>
                            <div class="form-group">
                                <input name="Password" id="login_password" type="password" class="form-control" placeholder="Password">
                                <span toggle="#login_password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                            </div>
                            <div class="form-group">
                                <button type="submit" name="login" class="form-control btn btn-primary submit px-3" onclick="showCookieConsent()">Sign In</button>
                            </div>
                            <div class="form-group">
                                <a href="regis.php" class="form-control btn btn-primary submit px-3">Register</a>
                            </div>
                        </form>
                        <?php
                        if ($errorMessage != '') {
                            echo "<div class='alert alert-danger' role='alert'>$errorMessage</div>";
                        }
                        ?>
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
