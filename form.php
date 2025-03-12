<?php
include 'session.php'; 
$file_name = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $upload_dir = "uploads/";

    if (!file_exists($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    // Proses Upload Foto
    $foto_uploaded = false;
    if (!empty($_FILES['foto']['name']) && $_FILES['foto']['error'] == 0) {
        $allowed_types = ['image/jpeg', 'image/png', 'image/jpg'];
        $file_type = mime_content_type($_FILES['foto']['tmp_name']);

        if (in_array($file_type, $allowed_types)) {
            $file_name = time() . "_" . basename($_FILES["foto"]["name"]);
            $target_file = $upload_dir . $file_name;

            if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
                $_SESSION["foto"] = $target_file; // Simpan path di session
                setcookie("foto", $target_file, time() + (86400 * 30), "/");
                $foto_uploaded = true;
            } else {
                echo "❌ Gagal menyimpan file.";
            }
        } else {
            echo "❌ Format file tidak didukung.";
        }
    }

    // Simpan data ke dalam cookie
    $fields = ['nama', 'pekerjaan', 'ttl', 'no_hp', 'email', 'sma', 'gpa_sma', 'tahun_sma', 'pt', 'gpa_pt', 'tahun_pt'];

    foreach ($fields as $field) {
        if (!empty($_POST[$field])) {
            setcookie($field, $_POST[$field], time() + (86400 * 30), "/");
        }
    }

    // Redirect setelah semua data tersimpan
    header("Location: cv.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form CV</title>
    <link rel="stylesheet" href="form.css">
</head>

<body>
    <div class="form-container">
        <div class="form-header">MAKE YOUR CV</div>

        <form method="POST" enctype="multipart/form-data">
            <div class="input-group">
                <label>Nama Lengkap</label>
                <input type="text" name="nama" required>
            </div>

            <div class="input-group">
                <label>Pekerjaan</label>
                <input type="text" name="pekerjaan" required>
            </div>

            <div class="input-group">
                <label>Upload Foto</label>
                <input type="file" name="foto" accept="image/*" required>
            </div>

            <div class="input-group">
                <label>Tanggal Lahir</label>
                <input type="date" name="ttl" required>
            </div>

            <h3>Kontak</h3>
            <div class="input-group">
                <label>No HP</label>
                <input type="text" name="no_hp" required>
            </div>
            <div class="input-group">
                <label>Email</label>
                <input type="email" name="email" required>
            </div>

            <h3>Pendidikan</h3>
            <div class="input-group">
                <label>Sekolah Menengah Atas</label>
                <input type="text" name="sma" required>
            </div>
            <div class="input-group">
                <label>GPA SMA</label>
                <input type="text" name="gpa_sma" required>
            </div>
            <div class="input-group">
                <label>Tahun Lulus SMA/SMK/MA</label>
                <input type="text" name="tahun_sma" required>
            </div>

            <div class="input-group">
                <label>Perguruan Tinggi</label>
                <input type="text" name="pt">
            </div>
            <div class="input-group">
                <label>GPA ACADEMIC</label>
                <input type="text" name="gpa_pt">
            </div>
            <div class="input-group">
                <label>Tahun Lulus Perguruan Tinggi</label>
                <input type="text" name="tahun_pt">
            </div>

            <button type="submit">create CV</button>
        </form>
    </div>
</body>
</html>
