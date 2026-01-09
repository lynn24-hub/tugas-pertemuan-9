<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: list.php');
    exit;
}

$id = $_POST['id'] ?? null;
$nim = $_POST['nim'] ?? '';
$nama = $_POST['nama'] ?? '';
$email = $_POST['email'] ?? '';
$foto_lama = $_POST['foto_lama'] ?? '';

if (!$id) {
    die('Missing id');
}

// handle upload (only when a new file was uploaded without errors)
$foto = $foto_lama;
if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK && !empty($_FILES['foto']['name'])) {
    if (!is_dir('uploads')) mkdir('uploads', 0755, true);
    $ext = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
    $foto = time() . '_' . uniqid() . '.' . $ext;
    if (!move_uploaded_file($_FILES['foto']['tmp_name'], "uploads/$foto")) {
        die('Upload failed: could not move uploaded file');
    }
    if ($foto_lama && file_exists("uploads/$foto_lama")) {
        @unlink("uploads/$foto_lama");
    }
} elseif (isset($_FILES['foto']) && $_FILES['foto']['error'] !== UPLOAD_ERR_NO_FILE) {
    // if there was an upload attempt but an error occurred, show it
    $err = $_FILES['foto']['error'];
    die('File upload error code: ' . $err);
}

// use prepared statement to update by id
// prepare and execute update
$stmt = $conn->prepare("UPDATE mahasiswa SET nim = ?, nama = ?, email = ?, foto = ? WHERE id = ?");
if (!$stmt) {
    die('Prepare failed: ' . $conn->error);
}

// ensure $id is integer for the `i` type
$id = (int)$id;
$stmt->bind_param('ssssi', $nim, $nama, $email, $foto, $id);
if (!$stmt->execute()) {
    die('Update failed: ' . $stmt->error);
}
$stmt->close();

header('Location: list.php');
exit;