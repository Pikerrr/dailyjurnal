<?php
include "koneksi.php"; // Pastikan file koneksi database Anda benar

// Jika tombol "Simpan" diklik
if (isset($_POST['simpan'])) {
    $id_user = $_SESSION['id']; // Ambil ID user dari sesi
    $username = $_SESSION['username']; // Ambil username dari sesi
    $tanggal = date("Y-m-d H:i:s");

    $password_baru = $_POST['password_baru'];
    $gambar = '';
    $nama_gambar = $_FILES['gambar']['name'];

    // Jika ada file gambar yang diupload
    if ($nama_gambar != '') {
        $cek_upload = upload_foto($_FILES["gambar"]); // Fungsi upload gambar Anda

        if ($cek_upload['status']) {
            $gambar = $cek_upload['message'];
        } else {
            // Jika upload gagal
            echo "<script>
                alert('" . $cek_upload['message'] . "');
                document.location='profil.php';
            </script>";
            die;
        }
    } else {
        // Jika tidak ada gambar baru, gunakan gambar lama
        $gambar = $_POST['gambar_lama'];
    }

    // Jika password baru diisi, ubah password
    if (!empty($password_baru)) {
        $hashed_password = password_hash($password_baru, PASSWORD_BCRYPT); // Ubah ke PASSWORD_BCRYPT

        $stmt = $conn->prepare("UPDATE user SET password = ?, foto = ? WHERE id = ?");
        $stmt->bind_param("ssi", $hashed_password, $gambar, $id_user);
    } else {
        // Jika password tidak diubah
        $stmt = $conn->prepare("UPDATE user SET gambar = ?, tanggal_update = ? WHERE id = ?");
        $stmt->bind_param("ssi", $gambar, $tanggal, $id_user);
    }

    $simpan = $stmt->execute();

    if ($simpan) {
        echo "<script>
            alert('Data berhasil disimpan.');
            document.location='admin.php?page=profile';
        </script>";
    } else {
        echo "<script>
            alert('Data gagal disimpan.');
            document.location='admin.php?page=profile';
        </script>";
    }

    $stmt->close();
    $conn->close();
}

// Fungsi untuk upload gambar
function upload_foto($file)
{
    $target_dir = "img/";
    $target_file = $target_dir . basename($file["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Periksa apakah file benar-benar gambar
    $check = getimagesize($file["tmp_name"]);
    if ($check === false) {
        return ['status' => false, 'message' => "File bukan gambar."];
    }

    // Batasi ukuran file (contoh: 2MB)
    if ($file["size"] > 2000000) {
        return ['status' => false, 'message' => "Ukuran file terlalu besar."];
    }

    // Batasi tipe file gambar
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        return ['status' => false, 'message' => "Hanya file JPG, JPEG, dan PNG yang diizinkan."];
    }

    // Jika semua validasi lolos, pindahkan file
    if (move_uploaded_file($file["tmp_name"], $target_file)) {
        return ['status' => true, 'message' => basename($file["name"])];
    } else {
        return ['status' => false, 'message' => "Error saat mengupload gambar."];
    }
}

?>
<?php
include 'koneksi.php'; // Pastikan koneksi sudah disertakan

// Pastikan pengguna sudah login
if (!isset($_SESSION['id'])) {
    die("Anda harus login terlebih dahulu.");
}

$userId = $_SESSION['id'];

// Ambil gambar profil dari database
$query = "SELECT foto FROM user WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $userId);
$stmt->execute();
$stmt->bind_result($foto);
$stmt->fetch();
$stmt->close();

if (isset($_POST['simpan'])) {
    $passwordBaru = $_POST['password_baru'];
    $gambarLama = $_POST['gambar_lama'];
    $gambarBaru = $_FILES['gambar'];

    // Validasi dan update password jika ada input
    if (!empty($passwordBaru)) {
        if (strlen($passwordBaru) < 6) {
            die("Password harus memiliki minimal 6 karakter.");
        }

        $hashedPassword = password_hash($passwordBaru, PASSWORD_BCRYPT);
        $updatePasswordQuery = "UPDATE user SET password = ? WHERE id = ?";
        $stmt = $koneksi->prepare($updatePasswordQuery);
        $stmt->bind_param("si", $hashedPassword, $userId);
        $stmt->execute();
        $stmt->close();
    }

    // Validasi dan update gambar jika ada file yang diunggah
    if (!empty($gambarBaru['name'])) {
        $targetDir = "uploads/";
        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        $targetFile = $targetDir . basename($gambarBaru['name']);
        $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Validasi format file
        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array($fileType, $allowedTypes)) {
            die("Format file tidak valid. Hanya JPG, JPEG, PNG, dan GIF yang diperbolehkan.");
        }

        // Validasi ukuran file (maksimal 2MB)
        if ($gambarBaru['size'] > 2 * 1024 * 1024) {
            die("Ukuran file terlalu besar. Maksimal 2MB.");
        }

        // Hapus gambar lama jika ada
        if (!empty($gambarLama) && file_exists($gambarLama)) {
            unlink($gambarLama);
        }

        // Pindahkan file gambar baru
        if (!move_uploaded_file($gambarBaru['tmp_name'], $targetFile)) {
            die("Gagal mengunggah gambar.");
        }

        // Update gambar di database
        $updateGambarQuery = "UPDATE user SET foto = ? WHERE id = ?";
        $stmt = $koneksi->prepare($updateGambarQuery);
        $stmt->bind_param("si", $targetFile, $userId);
        $stmt->execute();
        $stmt->close();

        // Update session foto
        $_SESSION['foto'] = $targetFile;
    }

    echo "Profil berhasil diperbarui.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Profil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <!-- Form Ganti Password dan Gambar -->
    <form method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="passwordBaru" class="form-label">Ganti Password</label>
            <input type="password" class="form-control" name="password_baru" id="passwordBaru" placeholder="Masukkan password baru jika ingin mengganti">
        </div>
        <div class="mb-3">
            <label for="gambarBaru" class="form-label">Ganti Gambar</label>
            <input type="file" class="form-control" name="gambar" id="gambarBaru">
            <input type="hidden" name="gambar_lama" value="<?= $_SESSION['foto'] ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Gambar Profil Saat Ini</label><br>
            <?php if (!empty($foto)): ?>
                <img src="img/<?= $foto ?>" alt="Gambar Profil" class="img-thumbnail" width="150">
            <?php else: ?>
                <p>Belum ada gambar profil.</p>
            <?php endif; ?>
        </div>
        <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
    </form>
</div>
</body>
</html>

