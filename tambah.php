<?php
include 'connection.php';

// Cek apakah tombol Simpan sudah diklik
if (isset($_POST['submit'])) {
    try {
        // 1. Ambil data dari form
        $judul = $_POST['judul'];
        $harga = $_POST['harga'];
        $stok  = $_POST['stok'];
        $cover = $_POST['cover']; // Sementara input teks nama file

        // 2. Siapkan Query INSERT dengan Prepared Statement (Lebih Aman)
        $sql = "INSERT INTO buku (judul, harga, stok, cover) VALUES (:judul, :harga, :stok, :cover)";
        $stmt = $conn->prepare($sql);

        // 3. Bind Parameter (Menghubungkan variabel dengan placeholder)
        $stmt->bindParam(':judul', $judul);
        $stmt->bindParam(':harga', $harga);
        $stmt->bindParam(':stok', $stok);
        $stmt->bindParam(':cover', $cover);

        // 4. Eksekusi
        $stmt->execute();

        echo "<script>alert('Data Berhasil Ditambahkan!'); window.location='index.php';</script>";
    } catch (PDOException $e) {
        echo "Gagal menambah data: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Buku Baru</title>
    <style>
        .form-container { width: 300px; margin: 50px auto; font-family: Arial; }
        input { width: 100%; padding: 8px; margin: 10px 0; display: block; }
        button { background: green; color: white; padding: 10px; border: none; width: 100%; cursor: pointer; }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Tambah Buku</h2>
    <form action="" method="POST">
        <label>Judul Buku</label>
        <input type="text" name="judul" required>

        <label>Harga</label>
        <input type="number" name="harga" required>

        <label>Stok</label>
        <input type="number" name="stok" required>

        <label>Nama File Cover (Contoh: baru.png)</label>
        <input type="text" name="cover" required>

        <button type="submit" name="submit">Simpan Buku</button>
        <a href="index.php">Kembali</a>
    </form>
</div>

</body>
</html>