<?php
session_start();
if ($_SESSION['role'] != 'admin') {
    header('Location: loginform.php');
    exit();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Koneksi ke database
    $conn = new mysqli('localhost', 'root', '', 'user_login');
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    // Ambil data order berdasarkan ID
    $sql = "SELECT * FROM orders WHERE id = $id";
    $result = $conn->query($sql);
    $order = $result->fetch_assoc();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Ambil data dari form
        $nama = $_POST['nama'];
        $alamat = $_POST['alamat'];
        $hp = $_POST['hp'];
        $email = $_POST['email'];
        $product = $_POST['product'];
        $total = $_POST['total'];
        $selected_service = $_POST['selected_service'];

        // Update data ke database
        $update_sql = "UPDATE orders SET 
                        nama='$nama', 
                        alamat='$alamat', 
                        hp='$hp', 
                        email='$email', 
                        product='$product', 
                        total='$total', 
                        selected_service='$selected_service' 
                        WHERE id=$id";

        if ($conn->query($update_sql) === TRUE) {
            echo "Order updated successfully.";
            header("Location: admindashboard.php");
        } else {
            echo "Error: " . $conn->error;
        }
    }

    $conn->close();
} else {
    echo "Order not found.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Order</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: url(backgrounduserdashboard.jpg);
            background-position: center;
            background-size: cover;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        header {
            background-color: rgba(2, 29, 55, 0.8); /* Blue with transparency */
            color: white;
            padding: 15px 0;
            text-align: center;
        }

        nav a {
            color: white;
            font-size: 18px;
            margin-right: 20px;
            text-decoration: none;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            padding: 20px;
        }

        .form-container {
            background-color: rgba(255, 255, 255, 0.7); /* Transparent white */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            width: 50%;
            margin-top: 20px;
        }

        .form-container label {
            font-size: 16px;
            color: #333;
            margin-top: 10px;
        }

        .form-container input[type="text"],
        .form-container input[type="email"],
        .form-container input[type="number"] {
            width: 95%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 15px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .form-container input[type="submit"] {
            background-color:rgb(4, 32, 59);
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            font-size: 16px;
            border-radius: 5px;
        }

        .form-container input[type="submit"]:hover {
            background-color: #4682b4;
        }

        /* Styling for table */
        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #1e3a5f; /* Dark blue */
            color: white;
        }

        tr:nth-child(even) {
            background-color: rgba(240, 248, 255, 0.8); /* Slight transparent background for rows */
        }

        /* Responsive Design */
        @media only screen and (max-width: 768px) {
            .form-container {
                width: 90%;
            }
        }
    </style>
</head>
<body>
    <header>
        <h1>Edit Order</h1>
        <nav>
            <a href="admindashboard.php">Back to Dashboard</a>
        </nav>
    </header>

    <div class="container">
        <div class="form-container">
            <h2>Edit Order Details</h2>
            <form action="edit_order.php?id=<?php echo $id; ?>" method="POST">
                <label for="nama">Full Name:</label>
                <input type="text" name="nama" value="<?php echo $order['nama']; ?>" required>

                <label for="alamat">Address:</label>
                <input type="text" name="alamat" value="<?php echo $order['alamat']; ?>" required>

                <label for="hp">Phone:</label>
                <input type="text" name="hp" value="<?php echo $order['hp']; ?>" required>

                <label for="email">Email:</label>
                <input type="email" name="email" value="<?php echo $order['email']; ?>" required>

                <label for="product">Product:</label>
                <input type="text" name="product" value="<?php echo $order['product']; ?>" required>

                <label for="total">Total:</label>
                <input type="number" name="total" value="<?php echo $order['total']; ?>" required>

                <label for="selected_service">Selected Service:</label>
                <input type="text" name="selected_service" value="<?php echo $order['selected_service']; ?>" required>

                <input type="submit" value="Update Order">
            </form>
        </div>
    </div>
</body>
</html>
