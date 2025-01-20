<?php
session_start();
if ($_SESSION['role'] != 'admin') {
    header('Location: loginform.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $hp = $_POST['hp'];
    $email = $_POST['email'];
    $product = $_POST['product'];
    $total = $_POST['total'];
    $selected_service = $_POST['selected_service'];

    // Koneksi ke database
    $conn = new mysqli('localhost', 'root', '', 'user_login');
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    // Insert data
    $sql = "INSERT INTO orders (nama, alamat, hp, email, product, total, selected_service) VALUES ('$nama', '$alamat', '$hp', '$email', '$product', '$total', '$selected_service')";
    
    if ($conn->query($sql) === TRUE) {
        echo "New order created successfully.";
        header("Location: admindashboard.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
