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

    // Hapus data message berdasarkan ID
    $sql = "DELETE FROM messages WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Message deleted successfully.";
        header("Location: manage_messages.php");
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
} else {
    echo "Invalid message ID.";
}
