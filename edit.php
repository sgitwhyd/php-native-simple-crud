<?php

include_once './include/koneksi.php';

$id = $_GET['id'];

$sql = "SELECT * FROM siswa WHERE id=$id";

$result = mysqli_query($conn, $sql);
foreach ($result as $siswa) {

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
        <div class="d-flex justify-content-center flex-column">
            <h2 class="text-center mt-5">Edit Data Siswa</h2>
            <form action="" method="post">
                <input type="hidden" value=<?=$siswa['id'] ?> name="id" class="form-control">
                <label for="nis">NIS Siswa</label>
                <input type="number" placeholder="Masukan Nis" class="form-control mb-3" value="<?=$siswa['nis'] ?>"
                    name="nis" required>
                <label for="nama">Nama</label>
                <input type="text" class="form-control mb-3" id="inputNama" value="<?=$siswa['nama'] ?>" name="nama">
                <label for="kelas">Kelas</label>
                <input type="text" class="form-control mb-3" id="inputKelas" value="<?=$siswa['kelas'] ?>" name="kelas"
                    placeholder="Masukan Kelas Siswa">
                <button class="btn btn-primary" name="submit-edit">Submit</button>
                <a href="./index.php" class="btn btn-info text-white">Kembali</a>
            </form>
        </div>
    </div>
    <?php } ?>


    <?php
if (isset($_POST['submit-edit'])) {
    $id    = $_POST['id'];
    $nis   = $_POST['nis'];
    $nama  = $_POST['nama'];
    $kelas = $_POST['kelas'];

    $sql = "UPDATE siswa SET nis='$nis', nama='$nama', kelas='$kelas' WHERE id='$id'";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        header("Location: index.php?edit=success");
    } else {
        echo "<script>alert('gagal edit data')</script>";
        echo mysqli_error($conn);
    }
}

?>
</body>
</html>