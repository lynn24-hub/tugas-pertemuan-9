<?php
include 'koneksi.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    die('ID tidak ditemukan');
}

$stmt = $conn->prepare("SELECT * FROM mahasiswa WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$data = $stmt->get_result()->fetch_assoc();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Update Data Mahasiswa</title>
</head>

<body>
    <h2>Update Data Mahasiswa</h2>
    <form action="proses_pembaruan.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= htmlspecialchars($id) ?>">
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