<?php
session_start();
include '../koneksi.php';

// Pastikan parameter 'id' ada di URL dan tidak kosong
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = mysqli_real_escape_string($koneksi, $_GET['id']);
    
    // Proses hapus hanya berjalan jika ID benar-benar valid dan ada isinya
    mysqli_query($koneksi, "DELETE FROM barang WHERE id='$id'");
} else {
    // Jika ID kosong atau tidak valid, simpan pesan eror ke session jika diperlukan
    $_SESSION['error'] = "ID Barang tidak ditemukan atau tidak valid!";
}

// Alihkan kembali ke halaman utama index.php (bukan dashboard.php)
header("Location: index.php");
exit();
?>