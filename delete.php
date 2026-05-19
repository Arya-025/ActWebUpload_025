<?php
if (isset($_GET['file'])) {
    $dir = "uploads/";
    // basename() dipakai buat mencegah user nakal manipulasi path seperti ../../file.txt
    $file = basename($_GET['file']); 
    $file_path = $dir . $file;

    // Periksa apakah file benar-benar ada di folder uploads sebelum dihapus
    if (file_exists($file_path)) {
        if (unlink($file_path)) {
            // Berhasil hapus, balik ke index.php
            header("Location: index.php");
            exit;
        } else {
            echo "<script>alert('Gagal menghapus file.'); window.location.href='index.php';</script>";
        }
    } else {
        echo "<script>alert('File tidak ditemukan.'); window.location.href='index.php';</script>";
    }
} else {
    header("Location: index.php");
    exit;
}
?>