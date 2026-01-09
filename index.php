<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Tambah Data Mahasiswa</title>
</head>

<body>
    <h2>Tambah Data Mahasiswa</h2>
    <form action="proses_simpan.php" method="POST" enctype="multipart/form-data">
        <label for="nim">NIM:</label><br>
        <input type="text" id="nim" name="nim" required><br><br>
        <label for="nama">Nama:</label><br>
        <input type="text" id="nama" name="nama" required><br><br>
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br><br>
        <label for="foto">Foto:</label><br>
        <input type="file" id="foto" name="foto" accept="image/*"><br><br>
        <button type="submit">Simpan</button>
    </form>
    <br>
    <a href="list.php">Lihat Data Mahasiswa</a>
</body>

</html>