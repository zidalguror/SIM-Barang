<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit;
}
require_once "Barang.php";

$daftarBarang = [
    new Barang("BRG-001", "Laptop", 10, "Elektronik", "Baik"),
    new Barang("BRG-002", "Proyektor", 3, "Elektronik", "Baik"),
    new Barang("BRG-003", "Kursi Lab", 25, "Perabot", "Rusak Ringan"),
];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIM-Barang</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>SIM-Barang</h1>
        <p>Sistem Informasi Manajemen Barang Laboratorium dan Jurusan</p>
        <p>Masuk sebagai: <?= htmlspecialchars($_SESSION["username"]) ?> | <a href="logout.php">Logout</a></p>
    </header>

    <nav>
        <ul>
            <li><a href="#inventaris">Inventaris Barang</a></li>
            <li><a href="#input-barang">Input Barang</a></li>
        </ul>
    </nav>

    <main>
        <section id="inventaris">
            <h2>Tabel Inventaris Barang</h2>
            <input type="search" id="cari" placeholder="Cari barang..." aria-label="Cari barang">
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>Nama Barang</th>
                        <th>Kategori</th>
                        <th>Jumlah</th>
                        <th>Kondisi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($daftarBarang as $barang): ?>
                        <?= $barang->tampilkanBaris() ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        </section>

        <section id="input-barang">
            <h2>Formulir Input Barang</h2>
            <form action="simpan.php" method="post" class="form-barang" id="form-barang">
                <p>
                    <label for="kode">Kode Barang:</label><br>
                    <input type="text" id="kode" name="kode" placeholder="Contoh: BRG-004" required>
                </p>
                <p>
                    <label for="nama">Nama Barang:</label><br>
                    <input type="text" id="nama" name="nama" placeholder="Masukkan nama barang" required>
                    <small id="err-kode" class="error"></small>
                </p>
                <p>
                    <label for="kategori">Kategori:</label><br>
                    <select id="kategori" name="kategori" required>
                        <option value="">-- Pilih Kategori --</option>
                        <option value="elektronik">Elektronik</option>
                        <option value="perabot">Perabot</option>
                        <option value="alat-lab">Alat Laboratorium</option>
                    </select>
                </p>
                <p>
                    <label for="jumlah">Jumlah:</label><br>
                    <input type="number" id="jumlah" name="jumlah" placeholder="Masukkan jumlah" min="1" required>
                    <small id="err-jumlah" class="error"></small>
                </p>
                    <label for="harga">Harga Satuan (Rp):</label><br>
                    <input type="number" id="harga" name="harga" placeholder="Contoh: 5000000" min="0" required>
                <p>
                    <label for="kondisi">Kondisi:</label><br>
                    <select id="kondisi" name="kondisi" required>
                        <option value="">-- Pilih Kondisi --</option>
                        <option value="baik">Baik</option>
                        <option value="rusak-ringan">Rusak Ringan</option>
                        <option value="rusak-berat">Rusak Berat</option>
                    </select>
                </p>
                <button type="submit" class="btn-simpan">Simpan</button>
            </form>
        </section>
    </main>

    <footer>
        <p>&copy; 2026 SIM-Barang - Muhammad Zidal Muttaqin (062530801587)</p>
    </footer>

    <div id="toast" class="toast" role="status"></div>
    <script src="main.js"></script>
</body>
</html>