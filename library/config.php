<?php
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'fp';

// Membuat koneksi
$conn = mysqli_connect($dbhost, $dbuser, $dbpass);

// Memeriksa koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Memilih basis data
$db_selected = mysqli_select_db($conn, $dbname);

// Memeriksa pemilihan basis data
if (!$db_selected) {
    die("Gagal memilih basis data '$dbname': " . mysqli_error($conn));
}

// Menampilkan pesan koneksi berhasil
echo "Koneksi berhasil";
?>
