<?php
// Sambungin ke database
include 'koneksi.php';

// Ambil ID pengguna (sementara pake 1)
$id_pengguna = 1;

// Ambil gambar terbaru dari database
$sql = "SELECT lokasi_file FROM profil_pengguna WHERE id_pengguna = ? ORDER BY uploaded_at DESC LIMIT 1";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_pengguna); // i = integer
$stmt->execute();
$result = $stmt->get_result();

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
</head>
<body>
    <h2>Dashboard - Profil Pengguna</h2>
    <?php
    if ($row = $result->fetch_assoc()) {
        echo "<img src='" . $row['lokasi_file'] . "' alt='Foto Profil' width='150'>";
    } else {
        echo "Belum ada gambar profil.";
    }
    ?>
    <br><br>
    <a href="index.php">Upload Gambar Baru</a>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>