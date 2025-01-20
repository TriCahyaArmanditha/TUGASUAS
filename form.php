<?php
session_start();
// Koneksi ke database
$conn = new mysqli('localhost', 'root', '', 'user_login');
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Mendapatkan layanan dari URL
$selected_service = isset($_GET['service']) ? $_GET['service'] : '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $hp = $_POST['hp'];
    $email = $_POST['email'];
    $product = $_POST['product'];
    $total = $_POST['total'];

    // Query untuk menyimpan data ke database
    $sql = "INSERT INTO orders (nama, alamat, hp, email, product, total, selected_service) 
            VALUES ('$nama', '$alamat', '$hp', '$email', '$product', '$total', '$selected_service')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Order berhasil disimpan!'); window.location='index.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <link rel="stylesheet" href="CSS\form.css">
</head>

<body>
    <h1>Crafting Digital Dreams - Form</h1>
    <div class="container">
        <div class="img">
            <img src="images\form icon.jpg">
        </div>

        <div class="form">
            <form action="" method="POST">
                <h3>Personal Information</h3>
                <label>Full Name: </label>
                <input type="text" name="nama" required><br>

                <label>Address: </label>
                <textarea name="alamat" cols="30" rows="5" required></textarea><br><br>

                <h3>Contact Information</h3>
                <label>Phone Number: </label>
                <input type="number" placeholder="+62" name="hp" required><br>

                <label>Email: </label>
                <input type="email" placeholder="Your Email" name="email" required><br><br><br>

                <h3>Selected Ordering</h3>
                <label>Selected Service: </label>
                <input type="text" value="<?= htmlspecialchars($selected_service); ?>" readonly><br>

                <label>Select Product: </label>
                <select name="product" required>
                    <option value="kalkulator bmi">Kalkulator BMI</option>
                    <option value="personal website">Personal Website</option>
                    <option value="app management event">App Management Event</option>
                    <option value="web design">Web Design</option>
                    <option value="UI/UX design">UI/UX design</option>
                    <option value="app design">App Design</option>
                    <option value="design custom">Design Custom</option>
                    <option value="special features">Special Features</option>
                </select><br>

                <label>Total Ordering: </label>
                <input type="number" name="total" required><br><br>

                <input type="submit" name="submit" value="Processed to Payment">
                <a href="index.php">Cancel</a>
            </form>
        </div>
    </div>
</body>

</html>
