<?php
// 1. Sertakan file koneksi yang telah dibuat sebelumnya
include 'connection.php';

try {
    // 2. Siapkan query SQL untuk mengambil seluruh data dari tabel buku
    $query = "SELECT * FROM buku";
    $stmt = $conn->prepare($query);

    // 3. Jalankan query
    $stmt->execute();

    // 4. Ambil semua hasil query dan simpan dalam variabel $books sebagai array
    $books = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Gagal mengambil data: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Koleksi - the_book</title>
    <style>
        table { width: 80%; margin: 20px auto; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 12px; text-align: left; }
        th { background-color: #f4f4f4; }
        img { width: 80px; height: auto; border-radius: 5px; }
        .container { text-align: center; font-family: Arial, sans-serif; }
    </style>
</head>
<body>

<div class="container">
    <h1>Daftar Koleksi Perpustakaan</h1>
    <table>
        <thead>
            <tr>
                <th>Cover</th>
                <th>Judul Buku</th>
                <th>Stok</th>
                <th>Harga</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($books) > 0): ?>
                <?php foreach ($books as $row): ?>
                <tr>
                    <td>
                        <img src="assets/<?php echo $row['cover']; ?>" alt="Cover">
                    </td>
                    <td><?php echo $row['judul']; ?></td>
                    <td><?php echo $row['stok']; ?></td>
                    <td>Rp <?php echo number_format($row['harga'], 0, ',', '.'); ?></td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4">Tidak ada data buku yang ditemukan.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

</body>
</html>