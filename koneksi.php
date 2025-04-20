<?php
// Informasi buat masuk ke database
$host = "localhost";  // Servernya di komputer sendiri
$user = "root";       // Username default XAMPP
$pass = "";           // Password default XAMPP kosong
$db = "db_web";       // Nama database yang tadi dibuat

// Coba sambungin
$conn = new mysqli($host, $user, $pass, $db);

// Kalau gagal, kasih tahu
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>