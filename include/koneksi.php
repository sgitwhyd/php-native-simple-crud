<?php

$server = 'localhost';
$dbuser = 'root';
$dbpwd  = '';
$dbname = 'simple_crud';

$conn = mysqli_connect($server, $dbuser, $dbpwd, $dbname);

if (!$conn) {
    echo "<script>alert('koneksi gagal')</script>";
}