<?php

session_start();
if (isset($_SESSION['login'])) {
    header("Location: index.php");
    exit;
}

require './include/koneksi.php';

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // cek username di database
    $result = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");
    if (mysqli_num_rows($result) === 1) {
        // verifikasi password
        $user = mysqli_fetch_assoc($result);
        if (password_verify($password, $user['password'])) {

            $_SESSION['username'] = $username;
            $_SESSION['login']    = true;
            header("Location: index.php?login=success");
            exit;
        }
    }
    $error = true;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="d-flex justify-content-center">
            <div class="d-flex flex-column">
                <div class="d-flex align-items-center" style="width: 100%; height: 100vh;">
                    <div class="d-flex flex-column">
                        <h1>Halaman Login</h1>
                        <?php if (isset($error)): ?>
                        <div class="alert alert-danger" role="danger">
                            Wrong Username or Password
                        </div>
                        <?php endif ?>
                        <form action="" method="post">
                            <div class="mb-3">
                                <label for="username">Username</label>
                                <input type="text" class="form-control mb-3" name="username" required>
                            </div>
                            <div class="mb-3">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" name="password" required>
                            </div>
                            <button class="btn btn-primary mb-2" name="login">Login</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</body>
</html>