<?php
session_start();
include('config.php'); // File koneksi database

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $subject = mysqli_real_escape_string($conn, $_POST['subject']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);

    // Query untuk menyimpan pesan ke database
    $sql = "INSERT INTO messages (name, email, subject, message) VALUES ('$name', '$email', '$subject', '$message')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Pesan Anda berhasil dikirim!'); window.location.href='index.php#contact';</script>";
    } else {
        echo "<script>alert('Gagal mengirim pesan. Silakan coba lagi.'); window.location.href='index.php#contact';</script>";
    }
} else {
    echo "<script>alert('Metode pengiriman tidak valid.'); window.location.href='index.php#contact';</script>";
}
?>
