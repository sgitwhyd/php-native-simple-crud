<?php
// include database connection file
include "./include/koneksi.php";

// Get id from URL to delete that user
$id = $_GET['id'];

$query = "SELECT * FROM siswa WHERE id=$id";

// Delete user row from table based on given id
$result = mysqli_query($conn, $query);

foreach ($result as $siswa) {
    // delete foto
    unlink("img/" . $siswa['gambar']);

    $result = mysqli_query($conn, "DELETE FROM siswa WHERE id='$id'");
    if ($result) {
        header("Location: index.php?delete=success");
    } else {
        echo "error";
        echo mysqli_error($conn);
    }
}