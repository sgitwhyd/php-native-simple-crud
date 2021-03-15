<?php
include './include/koneksi.php';
error_reporting(0);
$nis   = htmlspecialchars($_POST['nis']);
$nama  = htmlspecialchars($_POST['nama']);
$kelas = htmlspecialchars($_POST['kelas']);

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
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="nis">NIS</label>
                        <input type="number" class="form-control mb-3" value="<?php echo $nis ?>" name="nis" required>
                    </div>
                    <div class="mb-3">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control mb-3" value="<?php echo $nama ?>" name="nama" required>
                    </div>
                    <div class="mb-3">
                        <label for="kelas">Kelas</label>
                        <input type="text" class="form-control" value="<?php echo $kelas ?>" name="kelas" required>
                    </div>
                    <div class="input-group mb-3">
                        <input type="file" class="form-control" name="foto" id="inputGroupFile04"
                            aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                    </div>
                    <button class="btn btn-primary" name=" submit-siswa">Submit</button>
                    <a href="./index.php" class="btn btn-info text-white">Kembali</a>
                </form>
                <?php

if (isset($_POST['submit-siswa'])) {
    $GLOBALS = $nis;
    $GLOBALS = $nama;
    $GLOBALS = $kelas;

    $foto      = $_FILES['foto']['name'];
    $size_foto = $_FILES['foto']['size'];
    $err_foto  = $_FILES['foto']['error'];
    $tmp_foto  = $_FILES['foto']['tmp_name'];

    // check apakah user upload file
    if ($err_foto === 4) {
        echo "<script>
                alert('Silahkan Pilih Foto Terlebih Dahulu')
                </script>";
    } else {
// check apakah yang diupload gambar
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
            $tanggal     = new DateTime();
            $format      = $tanggal->format('d-m-Y');
            $newFotoName = uniqid() . "-" . $format .= ".$path_foto";
            move_uploaded_file($tmp_foto, "img/" . $newFotoName);

            $sql = "INSERT INTO siswa
                            VAlUES ('', '$nis', '$nama', '$kelas', '$newFotoName')";

            $result = mysqli_query($conn, $sql);
            if ($result) {
                header("Location: index.php?submit=success");
            } else {
                echo "<script>alert('submit failed')</script>";
                echo mysqli_error($conn);
            }
        }
    }
}

?>
            </div>
        </div>
    </div>
</body>
</html>