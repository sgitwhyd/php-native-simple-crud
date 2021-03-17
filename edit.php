<?php

session_start();

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}


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
            <form action="" method="post" enctype="multipart/form-data">
                <input type="hidden" value=<?=$siswa['id'] ?> name="id" class="form-control">
                <div class="mb-3">
                    <label for="nis">NIS Siswa</label>
                    <input type="number" placeholder="Masukan NIS Siswa" class="form-control"
                        value="<?=$siswa['nis'] ?>" name="nis" required>
                </div>
                <div class="mb-3">
                    <label for="nama">Nama</label>
                    <input type="text" placeholder="Masukan Nama Siswa" class="form-control" id="inputNama"
                        value="<?=$siswa['nama'] ?>" name="nama" required>
                </div>
                <div class="mb-3">
                    <label for="kelas">Kelas</label>
                    <input type="text" class="form-control" id="inputKelas" value="<?=$siswa['kelas'] ?>" name="kelas"
                        placeholder="Masukan Kelas Siswa">
                </div>
                <div class="mb-3">
                    <input type="file" class="form-control" name="foto" id="inputGroupFile04"
                        aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                    <img src="img/<?=$siswa['gambar'] ?>" alt="foto-siswa" width="100px" class="mt-3">
                </div>
                <button class="btn btn-primary" name="submit-edit">Submit</button>
                <a href="./index.php" class="btn btn-info text-white">Kembali</a>
            </form>
        </div>
    </div>
    <?php } ?>


    <?php
if (isset($_POST['submit-edit'])) {
    $id    = $_POST['id'];
    $nis   = htmlspecialchars($_POST['nis']);
    $nama  = htmlspecialchars($_POST['nama']);
    $kelas = htmlspecialchars($_POST['kelas']);

    $foto     = $_FILES['foto']['name'];
    $err_foto = $_FILES['foto']['error'];
    $tmp_foto = $_FILES['foto']['tmp_name'];

    if ($err_foto === 4) {
        $sql = "UPDATE siswa SET nis='$nis', nama='$nama', kelas='$kelas' WHERE id='$id'";

        $result = mysqli_query($conn, $sql);

        if ($result) {
            header("Location: index.php?edit=success");
        } else {
            echo "<script>alert('gagal edit data')</script>";
            echo mysqli_error($conn);
        }

    }

    // chek gambar

    $allowedExtensi = ['jpg', 'png', 'jpeg'];
    $path_foto      = strtolower(pathinfo($foto)['extension']);
    if (!in_array($path_foto, $allowedExtensi)) {
        echo "<script>
                alert('Hanya Boleh Upload Foto')
                </script>";
    } else {
// check ukuran gambar
        if ($size_foto > 1024) {
            echo "<script>
                alert('Ukuran Melebihi Batas')
                </script>";
        }
        // hapus gambar sebelumnya
        if ($siswa['gambar'] !== 'nouser.jpg') {
            unlink("img/" . $siswa['gambar']);
        }

        // format penamaan file
        $tanggal     = new DateTime();
        $format      = $tanggal->format('d-m-Y');
        $newFotoName = uniqid() . "-" . $format .= ".$path_foto";
        move_uploaded_file($tmp_foto, "img/" . $newFotoName);

        // setelah lolos semua cek
        $sql = "UPDATE siswa SET nis='$nis', nama='$nama', kelas='$kelas', gambar='$newFotoName' WHERE id='$id'";

        $result = mysqli_query($conn, $sql);

        if ($result) {
            header("Location: index.php?edit=success");
        } else {
            echo "<script>alert('gagal edit data')</script>";
            echo mysqli_error($conn);
        }
    }
}

?>
</body>
</html>