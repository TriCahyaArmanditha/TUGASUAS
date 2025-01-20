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

    // Hapus data order berdasarkan ID
    $sql = "DELETE FROM orders WHERE id = $id";
    
    if ($conn->query($sql) === TRUE) {
        echo "Order deleted successfully.";
        header("Location: admindashboard.php");
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
} else {
    echo "Invalid order ID.";
}
