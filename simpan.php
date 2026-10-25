<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit;
}
require_once "Barang.php";

function hitungTotalAset($jumlah, $harga) {
    return $jumlah * $harga;
}

function rupiah($angka) {
    return "Rp " . number_format($angka, 0, ",", ".");
}

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: index.php");
    exit;
}

$kode     = htmlspecialchars(trim($_POST["kode"] ?? ""));
$nama     = htmlspecialchars(trim($_POST["nama"] ?? ""));
$kategori = htmlspecialchars(trim($_POST["kategori"] ?? ""));
$jumlah   = (int) ($_POST["jumlah"] ?? 0);
$harga    = (float) ($_POST["harga"] ?? 0);
$kondisi  = htmlspecialchars(trim($_POST["kondisi"] ?? ""));

$error = [];
if (!preg_match('/^BRG-\d+$/', $kode)) {
    $error[] = 'Kode barang harus diawali "BRG-" lalu angka.';
}
if ($nama === "") {
    $error[] = "Nama barang wajib diisi.";
}
if ($jumlah <= 0) {
    $error[] = "Jumlah harus lebih dari 0.";
}
if ($harga < 0) {
    $error[] = "Harga satuan tidak boleh negatif.";
}

$total = hitungTotalAset($jumlah, $harga);
$barang = new Barang($kode, $nama, $jumlah, $kategori, $kondisi);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Input - SIM-Barang</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>SIM-Barang</h1>
        <p>Ringkasan Data Barang</p>
    </header>

    <main>
        <section>
            <?php if (!empty($error)): ?>
                <h2>Data Tidak Valid</h2>
                <ul>
                    <?php foreach ($error as $pesan): ?>
                        <li class="error"><?= $pesan ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <h2>Data Berhasil Diproses</h2>
                <p><strong>Barang:</strong> <?= $barang->tampilkanInfo() ?></p>
                <div class="table-wrap">
                    <table>
                        <thead>
                            <tr><th>Keterangan</th><th>Data</th></tr>
                        </thead>
                        <tbody>
                            <tr><td>Kode Barang</td><td><?= $kode ?></td></tr>
                            <tr><td>Nama Barang</td><td><?= $nama ?></td></tr>
                            <tr><td>Kategori</td><td><?= $kategori ?></td></tr>
                            <tr><td>Jumlah</td><td><?= $jumlah ?></td></tr>
                            <tr><td>Harga Satuan</td><td><?= rupiah($harga) ?></td></tr>
                            <tr><td>Kondisi</td><td><?= $kondisi ?></td></tr>
                            <tr><th>Total Estimasi Nilai Aset</th><th><?= rupiah($total) ?></th></tr>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
            <p><a href="index.php">&larr; Kembali ke formulir</a></p>
        </section>
    </main>

    <footer>
        <p>&copy; 2026 SIM-Barang - Muhammad Zidal Muttaqin (062530801587)</p>
    </footer>
</body>
</html>