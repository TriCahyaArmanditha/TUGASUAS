<?php
session_start();
if ($_SESSION['role'] != 'admin') {
    header('Location: loginform.php');
    exit();
}

// Koneksi ke database
$conn = new mysqli('localhost', 'root', '', 'user_login');
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data pesanan
$sql_orders = "SELECT * FROM orders ORDER BY created_at DESC";
$result_orders = $conn->query($sql_orders);

// Ambil data pesan
$sql_messages = "SELECT * FROM messages ORDER BY created_at DESC";
$result_messages = $conn->query($sql_messages);

// Ambil data ulasan
$sql_reviews = "
    SELECT reviews.*, products.name AS product_name, responses.response AS admin_response 
    FROM reviews 
    INNER JOIN products ON reviews.product_id = products.id
    LEFT JOIN responses ON reviews.id = responses.review_id
    ORDER BY reviews.created_at DESC";
$result_reviews = $conn->query($sql_reviews);

// Proses form untuk membuat pesanan
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['create_order'])) {
    $nama = $conn->real_escape_string($_POST['nama']);
    $alamat = $conn->real_escape_string($_POST['alamat']);
    $hp = $conn->real_escape_string($_POST['hp']);
    $email = $conn->real_escape_string($_POST['email']);
    $product = $conn->real_escape_string($_POST['product']);
    $total = $conn->real_escape_string($_POST['total']);
    $selected_service = $conn->real_escape_string($_POST['selected_service']);

    $sql_create_order = "INSERT INTO orders (nama, alamat, hp, email, product, total, selected_service) 
                         VALUES ('$nama', '$alamat', '$hp', '$email', '$product', '$total', '$selected_service')";
    $conn->query($sql_create_order);
    header("Location: admindashboard.php");
    exit();
}

// Proses form untuk mengedit pesan
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit_message'])) {
    $message_id = $_POST['message_id'];
    $message_content = $conn->real_escape_string($_POST['message_content']);
    $conn->query("UPDATE messages SET message = '$message_content' WHERE id = '$message_id'");
    header("Location: admindashboard.php");
    exit();
}

// Proses form untuk menghapus pesan
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_message'])) {
    $message_id = $_POST['message_id'];
    $conn->query("DELETE FROM messages WHERE id = '$message_id'");
    header("Location: admindashboard.php");
    exit();
}

// Proses form untuk mengedit pesanan
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit_order'])) {
    $order_id = $_POST['order_id'];
    $nama = $conn->real_escape_string($_POST['nama']);
    $alamat = $conn->real_escape_string($_POST['alamat']);
    $hp = $conn->real_escape_string($_POST['hp']);
    $email = $conn->real_escape_string($_POST['email']);
    $product = $conn->real_escape_string($_POST['product']);
    $total = $conn->real_escape_string($_POST['total']);
    $selected_service = $conn->real_escape_string($_POST['selected_service']);

    $conn->query("UPDATE orders SET 
        nama = '$nama', 
        alamat = '$alamat', 
        hp = '$hp', 
        email = '$email', 
        product = '$product', 
        total = '$total', 
        selected_service = '$selected_service' 
        WHERE id = '$order_id'");
    header("Location: admindashboard.php");
    exit();
}

// Proses form untuk menghapus pesanan
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_order'])) {
    $order_id = $_POST['order_id'];
    $conn->query("DELETE FROM orders WHERE id = '$order_id'");
    header("Location: admindashboard.php");
    exit();
}

// Proses form untuk memberikan balasan ulasan
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['review_id'])) {
    $review_id = $_POST['review_id'];
    $response = $conn->real_escape_string($_POST['response']);

    // Cek apakah balasan sudah ada
    $check_response = $conn->query("SELECT * FROM responses WHERE review_id = '$review_id'");
    if ($check_response->num_rows > 0) {
        $conn->query("UPDATE responses SET response = '$response' WHERE review_id = '$review_id'");
    } else {
        $conn->query("INSERT INTO responses (review_id, response) VALUES ('$review_id', '$response')");
    }
    header("Location: admindashboard.php");
    exit();
}

// Proses form untuk menghapus ulasan
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_review'])) {
    $review_id = $_POST['review_id'];
    $conn->query("DELETE FROM reviews WHERE id = '$review_id'");
    header("Location: admindashboard.php");
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="CSS\admin.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
            background: url('backgrounduserdashboard.jpg') no-repeat center center fixed;
            background-size: cover;
        }
    </style>
</head>
<body>
    <header>
        <h1>Admin Dashboard</h1>
        <nav>
            <a href="logout.php">Logout</a>
        </nav>
    </header>

    <div class="container">
        <!-- Manage Orders -->
        <section>
            <h2>Manage Existing Orders</h2>
            <?php if ($result_orders->num_rows > 0): ?>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Product</th>
                            <th>Total</th>
                            <th>Service</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result_orders->fetch_assoc()): ?>
                            <tr>
                                <td><?= $row['id'] ?></td>
                                <td><?= $row['nama'] ?></td>
                                <td><?= $row['alamat'] ?></td>
                                <td><?= $row['hp'] ?></td>
                                <td><?= $row['email'] ?></td>
                                <td><?= $row['product'] ?></td>
                                <td><?= $row['total'] ?></td>
                                <td><?= $row['selected_service'] ?></td>
                                <td><?= $row['created_at'] ?></td>
                                <td>
                                    <form method="POST" style="display:inline;">
                                        <input type="hidden" name="order_id" value="<?= $row['id'] ?>">
                                        <button type="submit" name="delete_order">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>No orders found.</p>
            <?php endif; ?>
        </section>

        <!-- Manage Messages -->
        <section>
            <h2>Manage Messages</h2>
            <?php if ($result_messages->num_rows > 0): ?>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Subject</th>
                            <th>Message</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result_messages->fetch_assoc()): ?>
                            <tr>
                                <td><?= $row['id'] ?></td>
                                <td><?= $row['name'] ?></td>
                                <td><?= $row['email'] ?></td>
                                <td><?= $row['subject'] ?></td>
                                <td><?= $row['message'] ?></td>
                                <td><?= $row['created_at'] ?></td>
                                <td>
                                    <form method="POST" style="display:inline;">
                                        <input type="hidden" name="message_id" value="<?= $row['id'] ?>">
                                        <button type="submit" name="delete_message">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>No messages found.</p>
            <?php endif; ?>
        </section>

        <!-- Manage Reviews -->
        <section>
            <h2>Manage Reviews</h2>
            <?php if ($result_reviews->num_rows > 0): ?>
                <table>
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>User</th>
                            <th>Rating</th>
                            <th>Review</th>
                            <th>Admin Response</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result_reviews->fetch_assoc()): ?>
                            <tr>
                                <td><?= $row['product_name'] ?></td>
                                <td><?= $row['username'] ?></td>
                                <td><?= $row['rating'] ?></td>
                                <td><?= $row['review'] ?></td>
                                <td><?= $row['admin_response'] ?? 'No response' ?></td>
                                <td>
                                    <form method="POST">
                                        <input type="hidden" name="review_id" value="<?= $row['id'] ?>">
                                        <textarea name="response" required><?= $row['admin_response'] ?></textarea>
                                        <button type="submit">Respond</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>No reviews found.</p>
            <?php endif; ?>
        </section>
    </div>
</body>
</html>
