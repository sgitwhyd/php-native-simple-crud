<?php
// include database connection file
include "./include/koneksi.php";

// Get id from URL to delete that user
$id = $_GET['id'];

$query = "DELETE FROM siswa WHERE id=$id";

// Delete user row from table based on given id
$result = mysqli_query($conn, $query);

// After delete redirect to Home, so that latest user list will be displayed.
header("Location:index.php?delete=success");