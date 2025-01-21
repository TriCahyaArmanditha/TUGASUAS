<?php
session_start();
if ($_SESSION['role'] != 'user') {
    header('Location: loginform.php');
    exit();
}

// Koneksi ke database
$conn = new mysqli('localhost', 'root', '', 'user_login');
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data produk
$sql_products = "SELECT * FROM products";
$result_products = $conn->query($sql_products);

// Ambil data review, termasuk balasan admin
$sql_reviews = "
    SELECT reviews.*, products.name AS product_name, responses.response AS admin_response 
    FROM reviews
    INNER JOIN products ON reviews.product_id = products.id
    LEFT JOIN responses ON reviews.id = responses.review_id
    ORDER BY reviews.created_at DESC";
$result_reviews = $conn->query($sql_reviews);

if (!$result_reviews) {
    die("Query gagal: " . $conn->error);
}

$success_message = '';

// Proses form untuk menambah ulasan
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_id = $_POST['product_id'];
    $rating = $_POST['rating'];
    $review = $conn->real_escape_string($_POST['review']);
    $username = $conn->real_escape_string($_POST['username']);

    $sql_add_review = "INSERT INTO reviews (product_id, rating, review, username) 
                        VALUES ('$product_id', '$rating', '$review', '$username')";
    if ($conn->query($sql_add_review)) {
        $success_message = "Terima kasih sudah mengirim ulasan! ❤";
    } else {
        echo "Gagal menambahkan ulasan: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color:rgba(240, 248, 255, 0.62);
            background-image: url(backgrounduserdashboard.jpg);
            background-size: cover;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        header {
            background-color: rgba(2, 29, 55, 0.8);
            color: white;
            width: 100%;
            text-align: center;
            padding: 10px;
        }

        table {
            background: rgba(255, 255, 255, 0.47);
            width: 80%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        th, td {
            border: 1px solid #ddd;
            text-align: center;
            padding: 8px;
        }

        th {
            background-color:rgba(2, 29, 55, 0.8);
            color: white;
        }

        form {
            width: 60%;
            background: rgba(255, 255, 255, 0.47);
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            margin-bottom: 30px;
        }

        input, select, textarea {
            width: 98%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            background-color:rgba(2, 29, 55, 0.8);
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #1c7ed6;
        }

        h2 {
            color: rgba(255, 255, 255, 0.8);
        }

        .notification {
            background-color:rgba(2, 29, 55, 0.8);
            color: white;
            padding: 10px;
            margin-top: 20px;
            border-radius: 5px;
            text-align: center;
            display: none;
        }
    </style>
</head>
<body>
    <header>
        <h1>Welcome to Dashboard User</h1>
        <nav>
            <a href="logout.php" style="color: white; font-size: 18px;">Logout</a>
        </nav>
    </header>

    <!-- Form untuk mengirim ulasan -->
    <form method="POST" action="">
        <h2>Berikan Ulasan terhadap Produk Kami</h2>

        <label for="username">Nama Pengguna:</label>
        <input type="text" name="username" id="username" required placeholder="Masukkan nama Anda">

        <label for="product_id">Pilih Produk:</label>
        <select name="product_id" id="product_id" required>
            <?php while ($row = $result_products->fetch_assoc()): ?>
                <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
            <?php endwhile; ?>
        </select>

        <label for="rating">Beri Rating:</label>
        <select name="rating" id="rating" required>
            <option value="1">⭐</option>
            <option value="2">⭐⭐</option>
            <option value="3">⭐⭐⭐</option>
            <option value="4">⭐⭐⭐⭐</option>
            <option value="5">⭐⭐⭐⭐⭐</option>
        </select>

        <label for="review">Ulasan Anda:</label>
        <textarea name="review" id="review" rows="4" placeholder="Tuliskan ulasan Anda..." required></textarea>

        <button type="submit">Kirim Ulasan</button>
    </form>

    <!-- Notifikasi -->
    <?php if ($success_message): ?>
        <div class="notification" id="notification"><?php echo $success_message; ?></div>
    <?php endif; ?>

    <!-- Tabel Ulasan -->
    <h2>Ulasan Pelanggan</h2>
    <?php if ($result_reviews->num_rows > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>Nama Produk</th>
                    <th>Nama Pengguna</th>
                    <th>Rating</th>
                    <th>Ulasan</th>
                    <th>Admin Response</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result_reviews->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['product_name']; ?></td>
                        <td><?php echo $row['username']; ?></td>
                        <td><?php echo str_repeat('⭐', $row['rating']); ?></td>
                        <td><?php echo htmlspecialchars($row['review']); ?></td>
                        <td><?php echo $row['admin_response'] ? htmlspecialchars($row['admin_response']) : "No response yet"; ?></td>
                        <td><?php echo $row['created_at']; ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Tidak ada ulasan tersedia.</p>
    <?php endif; ?>

    <script>
        // Cek apakah ada pesan sukses
        <?php if ($success_message): ?>
            window.onload = function() {
                // Tampilkan notifikasi
                document.getElementById('notification').style.display = 'block';

                // Hilangkan notifikasi setelah 4 detik
                setTimeout(function() {
                    document.getElementById('notification').style.display = 'none';
                }, 4000);
            }
        <?php endif; ?>
    </script>
</body>
</html>
