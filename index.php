<?php
include './include/koneksi.php';

$result = mysqli_query($conn, "SELECT * FROM siswa");

$jumlah_siswa = mysqli_num_rows($result);

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
<body class="container">
    <h1 class="text-center mt-5">Daftar Siswa</h1>
    <?php
if ($jumlah_siswa <= 0) {
    echo '    <div class="d-flex justify-content-center flex-column">
        <h1 class="text-center">Tidak Ada Data Siswa</h1>
        <a href="./tambah.php" class="btn btn-primary">Tambah Siswa</a>
    </div>';
}
?>

    <?php

if ($jumlah_siswa > 0) {

    ?>
    <a href="./tambah.php" class="btn btn-primary mb-3">Tambah Siswa</a>
    <h4>Jumlah <?=$jumlah_siswa ?> Siswa</h4>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Foto</th>
                <th scope="col">NIS</th>
                <th scope="col">NAMA</th>
                <th scope="col">KELAS</th>
                <th scope="col">ACTION</th>
            </tr>
        </thead>
        <tbody>
            <?php } ?>


            <?php
$no = 1;
foreach ($result as $siswa): ?>
            <div class="d-flex align-items-center">
                <tr>
                    <th scope="row"><?=$no++ ?></th>
                    <th><img src="img/<?=$siswa['gambar'] ?>" width="80px" alt=""></th>
                    <td><?=$siswa['nis'] ?></td>
                    <td><?=$siswa['nama'] ?></td>
                    <td><?=$siswa['kelas'] ?></td>
                    <td>
                        <a href="delete.php?id=<?=$siswa['id'] ?>" class="btn btn-danger">Delete</a>
                        <a href="edit.php?id=<?=$siswa['id'] ?>" class="btn btn-warning">Edit</a>
                    </td>
                </tr>
            </div>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>