<?php
include './include/koneksi.php';

$result = mysqli_query($conn, "SELECT * FROM siswa ORDER BY id DESC");

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
    <div class="row d-flex align-items-center">
        <div class="col-9">
            <h5>Jumlah <?=$jumlah_siswa ?> Siswa</h5>
        </div>
        <div class="col">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Cari Siswa" aria-describedby="button-addon2">
                <button class="btn btn-outline-secondary" type="button" id="button-addon2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-search" viewBox="0 0 16 16">
                        <path
                            d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                    </svg></button>
            </div>
        </div>
    </div>
    <table class="table table-striped">
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
            <div>
                <tr>
                    <th scope="row"><?=$no++ ?></th>
                    <th><img src="img/<?=$siswa['gambar'] ?>" width="50" alt=""></th>
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