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
$sql_orders = "SELECT * FROM orders";
$result_orders = $conn->query($sql_orders);

// Ambil data pesan
$sql_messages = "SELECT * FROM messages ORDER BY id DESC LIMIT 10"; // Ambil 10 pesan terbaru
$result_messages = $conn->query($sql_messages);

// Menutup koneksi
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: url(backgrounduserdashboard.jpg) no-repeat center center fixed;
        background-size: cover;
        margin: 0;
        padding: 0;
        color: #333;
    }

    header {
        background-color: rgba(8, 31, 55, 0.9); /* Transparan untuk header */
        color: white;
        padding: 20px 0;
        text-align: center;
        font-size: 24px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3);
    }

    nav a {
        color: white;
        font-size: 18px;
        margin: 0 15px;
        text-decoration: none;
        transition: color 0.3s;
    }

    nav a:hover {
        color: #87cefa;
    }

    .container {
        max-width: 1200px;
        margin: 30px auto;
        padding: 20px;
        background: rgba(255, 255, 255, 0.28); /* Transparansi untuk container */
        border-radius: 10px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
    }

    h2, h3 {
        color: rgb(8, 31, 55);
        text-align: center;
    }

    /* Desain minimalis untuk form Create Order */
    .create-order-form {
    width: 80%; /* Lebar form lebih kecil */
    max-width: 450px; /* Maksimal lebar form */
    margin: 0 auto 40px;
    padding: 20px;
    background: rgba(255, 255, 255, 0.85); /* Transparansi form */
    border-radius: 10px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
    text-align: center;
    box-sizing: border-box; /* Pastikan padding tidak mempengaruhi lebar */
    margin-left: 30%; /* Menambahkan margin kiri untuk menggeser form ke kanan */
}

.create-order-form input {
    width: 100%; /* Lebar 100% sesuai dengan lebar form */
    max-width: 380px; /* Lebar maksimal input lebih kecil */
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box; /* Pastikan padding tidak mempengaruhi lebar */
    margin-left: 1%; /* Memberikan sedikit jarak dari kiri untuk simetri */
}

.create-order-form input[type="submit"] {
    background-color: rgba(8, 31, 55, 0.9);
    color: white;
    border: none;
    padding: 12px 20px;
    cursor: pointer;
    font-size: 16px;
    border-radius: 5px;
    transition: background-color 0.3s;
    width: 100%;
}

.create-order-form input[type="submit"]:hover {
    background-color:rgb(70, 130, 180);
}


    table {
        width: 100%;
        border-collapse: collapse;
        margin: 20px 0;
        overflow: hidden;
        border-radius: 10px;
        background: rgba(255, 255, 255, 0.5); /* Transparansi tabel */
    }

    thead tr {
        background-color: rgba(10, 10, 48, 0.8); /* Header tabel transparan biru tua */
        color: white;
    }

    th, td {
        padding: 15px;
        text-align: center;
        border: 1px solid rgba(0, 0, 0, 0.1);
    }

    tbody tr {
        background-color: rgba(255, 255, 255, 0.3); /* Transparansi isi tabel */
    }

    tbody tr:nth-child(even) {
        background-color: rgba(255, 255, 255, 0.4); /* Kontras untuk baris genap */
    }

    tbody tr:hover {
        background-color: rgba(30, 144, 255, 0.2); /* Warna hover */
        cursor: pointer;
    }

    @media (max-width: 768px) {
        .create-order-form {
            width: 100%;
        }

        table {
            font-size: 14px;
        }
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
        <h2>Order Management</h2>

        <!-- CREATE Order -->
        <div class="create-order-form">
            <h3>Create New Order</h3>
            <form action="create_order.php" method="POST">
                <label for="nama">Full Name:</label>
                <input type="text" name="nama" required>

                <label for="alamat">Address:</label>
                <input type="text" name="alamat" required>

                <label for="hp">Phone:</label>
                <input type="text" name="hp" required>

                <label for="email">Email:</label>
                <input type="email" name="email" required>

                <label for="product">Product:</label>
                <input type="text" name="product" required>

                <label for="total">Total:</label>
                <input type="number" name="total" required>

                <label for="selected_service">Selected Service:</label>
                <input type="text" name="selected_service" required>

                <input type="submit" value="Create Order">
            </form>
        </div>

        <!-- READ Orders -->
        <h3>Manage Existing Orders</h3>
        <?php if ($result_orders->num_rows > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Full Name</th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Product</th>
                        <th>Total</th>
                        <th>Selected Service</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result_orders->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['nama']; ?></td>
                            <td><?php echo $row['alamat']; ?></td>
                            <td><?php echo $row['hp']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td><?php echo $row['product']; ?></td>
                            <td><?php echo $row['total']; ?></td>
                            <td><?php echo $row['selected_service']; ?></td>
                            <td><?php echo $row['created_at']; ?></td>
                            <td class="actions">
                                <a href="edit_order.php?id=<?php echo $row['id']; ?>">Edit</a>
                                <a href="delete_order.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this order?')">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No orders available.</p>
        <?php endif; ?>

        <!-- READ Messages with Edit and Delete -->
        <h3>Manage Messages</h3>
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
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result_messages->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td><?php echo $row['subject']; ?></td>
                            <td><?php echo $row['message']; ?></td>
                            <td><?php echo $row['created_at']; ?></td>
                            <td class="actions">
                                <a href="edit_message.php?id=<?php echo $row['id']; ?>">Edit</a>
                                <a href="delete_message.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this message?')">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No messages available.</p>
        <?php endif; ?>
    </div>
</body>
</html>
