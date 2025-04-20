<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Upload Gambar Profil</title>
</head>
<body>
    <h2>Upload Gambar Profil</h2>
    <form action="upload_profil.php" method="post" enctype="multipart/form-data">
        <label for="gambar">Pilih gambar (max 1MB, .jpg/.jpeg/.png):</label><br>
        <input type="file" name="gambar" id="gambar" accept=".jpg,.jpeg,.png" required><br><br>
        <input type="submit" name="upload" value="Upload">
    </form>
</body>
</html>