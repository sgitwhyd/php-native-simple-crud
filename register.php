<?php

require './include/koneksi.php';

if (isset($_POST['register'])) {

    $username  = $_POST['username'];
    $password  = $_POST['password'];
    $cpassword = $_POST['cpassword'];

    if ($password === $cpassword) {
        // hash password
        $hash_password = password_hash($password, PASSWORD_DEFAULT);
        $result        = mysqli_query($conn, "INSERT INTO users VALUES ('', '$username', '$hash_password')");
        if ($result) {
            $success = true;
        }
    } else {
        $alert = true;
    }
}

$error = true;
echo mysqli_error($conn);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="d-flex justify-content-center">
            <div class="d-flex align-items-center flex-column mt-5" style="width: 100%; height: 100vh;">
                <h1>Halaman Register</h1>
                <div style="width: 400px;">
                    <?php if (isset($success)): ?>
                    <div class="alert alert-success" role="success">
                        Registrasi Berhasil
                    </div>
                    <?php elseif (isset($alert)): ?>
                    <div class="alert alert-danger" role="danger">
                        Password Tidak Sama
                    </div>
                    <?php endif; ?>
                    <form action="" method="post">
                        <div class="mb-3">
                            <label for="username">Username</label>
                            <input type="text" class="form-control mb-3" name="username" required>
                        </div>
                        <div class="mb-3">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name="password" required>
                        </div>
                        <div class="mb-3">
                            <label for="password">Confirm Password</label>
                            <input type="password" class="form-control" name="cpassword" required>
                        </div>
                        <div class="d-flex flex-column">
                            <button class="btn btn-primary mb-2" name="register">Submit</button>
                            <?php if (isset($success)): ?>
                            <a href="./login.php" class="btn btn-success text-white">Login</a>
                            <?php endif; ?>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>