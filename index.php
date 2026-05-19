<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Unggah & Kelola File Sederhana</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background-color: #f4f4f4; }
        .btn { padding: 5px 10px; text-decoration: none; color: white; border-radius: 3px; font-size: 14px; margin-right: 5px; }
        .btn-preview { background-color: #007bff; }
        .btn-download { background-color: #28a745; }
        .btn-delete { background-color: #dc3545; }
    </style>
</head>
<body>

<h2>Unggah File Baru</h2>
<form action="upload.php" method="post" enctype="multipart/form-data">
    Pilih file untuk diunggah:
    <input type="file" name="fileToUpload" id="fileToUpload" required>
    <input type="submit" value="Unggah File" name="submit">
</form>

<hr>

<h2>Daftar File di Server</h2>
<table>
    <thead>
        <tr>
            <th>Nama File</th>
            <th>Ukuran</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $dir = "uploads/";
        
        // Buat folder uploads jika belum ada secara otomatis
        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }

        // Membaca file di dalam direktori
        $files = array_diff(scandir($dir), array('.', '..'));

        if (count($files) > 0) {
            foreach ($files as $file) {
                $file_path = $dir . $file;
                $file_size = round(filesize($file_path) / 1024, 2) . " KB";
                
                echo "<tr>";
                echo "<td>" . htmlspecialchars($file) . "</td>";
                echo "<td>" . $file_size . "</td>";
                echo "<td>";
                
                // 1. Fitur Preview: Membuka file di tab baru browser
                echo "<a href='" . $file_path . "' target='_blank' class='btn btn-preview'>Preview</a>";
                
                // 2. Fitur Unduh: Memaksa browser mendownload lewat atribut 'download'
                echo "<a href='" . $file_path . "' download class='btn btn-download'>Unduh</a>";
                
                // 3. Fitur Delete: Diarahkan ke delete.php membawa parameter nama file
                echo "<a href='delete.php?file=" . urlencode($file) . "' class='btn btn-delete' onclick='return confirm(\"Yakin ingin menghapus file ini?\")'>Delete</a>";
                
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='3' style='text-align:center;'>Belum ada file yang diunggah.</td></tr>";
        }
        ?>
    </tbody>
</table>

</body>
</html>