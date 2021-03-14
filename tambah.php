<?php
include './include/koneksi.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="d-flex justify-content-center">
            <div class="d-flex flex-column">
                <h1>Form Tambah Data</h1>
                <form action="" method="post">
                    <label for="nis">nis</label>
                    <input type="number" class="form-control mb-3" name="nis" required>
                    <label for="nama">Nama</label>
                    <input type="text" class="form-control mb-3" name="nama" required>
                    <label for="kelas">Kelas</label>
                    <input type="text" class="form-control mb-3" name="kelas" required>
                    <button class="btn btn-primary" name="submit-siswa">Submit</button>
                    <a href="./index.php" class="btn btn-info text-white">Kembali</a>
                </form>
                <?php

if (isset($_POST['submit-siswa'])) {
    $nis   = htmlspecialchars($_POST['nis']);
    $nama  = htmlspecialchars($_POST['nama']);
    $kelas = htmlspecialchars($_POST['kelas']);

    $sql = "INSERT INTO siswa (id,nis,nama,kelas)
                            VAlUES ('', '$nis', '$nama', '$kelas')";

    $result = mysqli_query($conn, $sql);
    if ($result) {
        header("Location: index.php?submit=success");
    } else {
        echo "<script>alert('submit failed')</script>";
        echo mysqli_error($conn);
    }
}

?>
            </div>
        </div>
    </div>
</body>
</html>