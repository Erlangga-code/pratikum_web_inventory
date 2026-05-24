<?php
session_start();
include '../koneksi.php';



$data = mysqli_query($koneksi, "SELECT * FROM barang");
?>

<!DOCTYPE html>
<html>

<head>
    <title>Dashboard Inventory</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid">

            <span class="navbar-brand">
                Inventory Barang
            </span>

            <div>
                <span class="text-white">
                    <?= $_SESSION['nama_lengkap']; ?>
                </span>

                <a href="../logout.php" class="btn btn-danger btn-sm">
                    Logout
                </a>
            </div>

        </div>
    </nav>

    <div class="container mt-4">

        <div class="card">

            <div class="card-header d-flex justify-content-between">

                <h4>Data Barang</h4>

                <?php if ($_SESSION['role'] == 'admin' || 'pengguna') { ?>

                    <a href="tambah_barang.php" class="btn btn-primary">
                        Tambah Barang
                    </a>

                <?php } ?>

            </div>

            <div class="card-body">

                <table class="table table-bordered">

                    <tr>
                        <th>No</th>
                        <th>Nama Barang</th>
                        <th>Status</th>
                        <th>Penyimpanan</th>
                        <th>Harga</th>

                        <?php if ($_SESSION['role'] == 'admin') { ?>
                            <th>Aksi</th>
                        <?php } ?>
                    </tr>

                    <?php
                    $no = 1;
                    while ($row = mysqli_fetch_assoc($data)) {
                    ?>

                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $row['nama_barang']; ?></td>
                            <td><?= $row['status_barang']; ?></td>
                            <td><?= $row['penyimpanan_barang']; ?></td>
                            <td>Rp <?= number_format($row['harga_barang']); ?></td>

                            <?php if ($_SESSION['role'] == 'admin') { ?>

                                <td>

                                    <a href="edit_barang.php?id=<?= $row['id']; ?>" class="btn btn-warning btn-sm">
                                        Edit
                                    </a>

                                    <a href="hapus_barang.php?id=<?= $row['id']; ?>" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Hapus data?')">
                                        Hapus
                                    </a>

                                </td>

                            <?php } ?>

                        </tr>

                    <?php } ?>

                </table>

            </div>
        </div>

    </div>

</body>

</html>