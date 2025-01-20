<?php
include('config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = MD5($_POST['password']); 
    $role = 'user'; 

  
    $sql_check = "SELECT * FROM users WHERE username='$username'";
    $result_check = mysqli_query($conn, $sql_check);

    if (mysqli_num_rows($result_check) > 0) {
        echo "<script>alert('Username sudah terdaftar. Silakan gunakan username lain.'); window.location.href='register.php';</script>";
    } else {
        
        $sql = "INSERT INTO users (username, password, role) VALUES ('$username', '$password', '$role')";
        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Registrasi berhasil! Silakan login.'); window.location.href='loginform.php';</script>";
        } else {
            echo "<script>alert('Terjadi kesalahan. Silakan coba lagi.'); window.location.href='register.php';</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
         body {
            font-family: Arial, sans-serif;
            background: url(backgrooundku.jpg);
            background-position: center;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .register-container {
            background-color:rgba(255, 255, 255, 0.51);
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
            width: 400px;
            text-align: center;
        }
        .register-container h2 {
            color: #3366cc;
            margin-bottom: 20px;
        }
        .register-container label {
            display: block;
            text-align: left;
            margin-bottom: 10px;
            color: #333;
        }
        .register-container input {
            width: calc(100% - 24px); 
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 14px;
        }
        .register-container button {
            width: 100%;
            padding: 12px;
            background-color: #3366cc;
            color: #fff;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
        }
        .register-container button:hover {
            background-color: #274b9f;
        }
        .register-container p {
            margin-top: 15px;
            font-size: 20px;
        }
        .register-container p a {
            font-size: 20px;
            color:rgb(0, 85, 255);
            text-decoration: none;
        }
        .register-container p a:hover {
            text-decoration: underline;
        }
        .error {
            color: red;
            margin-bottom: 20px;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <h2>Register</h2>
        <form action="register.php" method="POST">
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" required>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>
            <button type="submit">Register</button>
        </form>
        <p>Already have an account? <a href="loginform.php">Login here</a></p>
    </div>
</body>
</html>
