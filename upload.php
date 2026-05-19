<?php
$target_dir = "uploads/";

// Pastikan folder ada
if (!is_dir($target_dir)) {
    mkdir($target_dir, 0777, true);
}

$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

if (file_exists($target_file)) {
    echo "<script>alert('Maaf, berkas sudah ada.'); window.location.href='index.php';</script>";
    $uploadOk = 0;
}

if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "<script>alert('Maaf, berkas Anda terlalu besar (Maks 500KB).'); window.location.href='index.php';</script>";
    $uploadOk = 0;
}

if ($uploadOk == 0) {
    // Jika gagal
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        // Berhasil unggah, langsung lempar balik ke index.php
        header("Location: index.php");
        exit;
    } else {
        echo "<script>alert('Maaf, terjadi kesalahan saat mengunggah berkas.'); window.location.href='index.php';</script>";
    }
}
?>