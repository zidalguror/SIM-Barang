<?php
session_start();

if (isset($_SESSION["username"])) {
    header("Location: index.php");
    exit;
}

$users = [
    "admin"   => "password123",
    "petugas" => "lab12345",
];

$pesan = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST["username"] ?? "");
    $password = $_POST["password"] ?? "";

    if (isset($users[$username]) && $users[$username] === $password) {
        session_regenerate_id(true);
        $_SESSION["username"] = $username;
        header("Location: index.php");
        exit;
    }
    $pesan = "Username atau password salah.";
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SIM-Barang</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>SIM-Barang</h1>
        <p>Silakan login untuk melanjutkan</p>
    </header>

    <main>
        <section class="login-box">
            <h2>Login</h2>
            <?php if ($pesan !== ""): ?>
                <p class="error"><?= htmlspecialchars($pesan) ?></p>
            <?php endif; ?>
            <form action="login.php" method="post" class="form-login">
                <p>
                    <label for="username">Username:</label><br>
                    <input type="text" id="username" name="username" placeholder="Masukkan username" required>
                </p>
                <p>
                    <label for="password">Password:</label><br>
                    <input type="password" id="password" name="password" placeholder="Masukkan password" required>
                </p>
                <button type="submit" class="btn-simpan">Masuk</button>
            </form>
        </section>
    </main>

    <footer>
        <p>&copy; 2026 SIM-Barang - Muhammad Zidal Muttaqin (062530801587)</p>
    </footer>
</body>
</html>