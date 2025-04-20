<?php
// Sambungin ke database
include 'koneksi.php';

// Cek apa tombol "Upload" diklik
if (isset($_POST['upload'])) {
    // Tidak perlu menetapkan $id_pengguna secara manual lagi

    // Tentuin tempat nyimpan gambar
    $target_dir = "profile_pics/";
    // Kalau foldernya belum ada, bikin dulu
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    // Nama file unik pake ID (otomatis dari database) dan waktu
    $timestamp = time(); // Waktu sekarang dalam detik
    $nama_file = $timestamp . ".jpg"; // Nama file unik berdasarkan waktu (bisa disesuaikan)
    $lokasi_database = $target_dir . $nama_file; // Path relatif untuk database
    $target_file = $_SERVER['DOCUMENT_ROOT'] . '/' . $lokasi_database; // Path fisik lengkap

    // Ambil info file yang diupload
    $gambar = $_FILES['gambar'];
    $ukuran_file = $gambar['size']; // Ukuran dalam bytes
    $tipe_file = strtolower(pathinfo($gambar['name'], PATHINFO_EXTENSION)); // Ambil ekstensi (jpg/png)
    $boleh_tipe = ['jpg', 'jpeg', 'png']; // Tipe yang boleh

    // Cek ukuran (1MB)
    if ($ukuran_file > 1048576) {
        die("File terlalu besar! Maksimal 1MB.");
    }

    // Cek tipe file
    if (!in_array($tipe_file, $boleh_tipe)) {
        die("Cuma boleh JPG, JPEG, atau PNG!");
    }

    // Cek apa bener gambar
    $cek_gambar = getimagesize($gambar['tmp_name']);
    if ($cek_gambar === false) {
        die("Ini bukan gambar!");
    }

    // Pindahin file ke folder
    if (move_uploaded_file($gambar['tmp_name'], $target_file)) {
        // Simpan info ke database
        $sql = "INSERT INTO profil_pengguna (nama_file, lokasi_file) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $nama_file, $lokasi_database);
        if ($stmt->execute()) {
            echo "Gambar berhasil diupload! <a href='dashboard.php'>Lihat di Dashboard</a>";
        } else {
            echo "Gagal nyimpan ke database: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Gagal upload gambar.";
    }
}

// Tutup koneksi
$conn->close();
?>