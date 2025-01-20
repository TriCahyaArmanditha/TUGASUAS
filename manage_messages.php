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

// Ambil data messages
$sql_messages = "SELECT * FROM messages ORDER BY id DESC";
$result_messages = $conn->query($sql_messages);

// Menutup koneksi
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Messages</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f8ff;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #1e90ff;
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

        .message-table {
            width: 80%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: white;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        .message-table th,
        .message-table td {
            padding: 12px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        .message-table th {
            background-color: #87cefa;
            color: white;
        }

        .message-table tr:hover {
            background-color: #f1f1f1;
        }

        .manage-buttons {
            display: flex;
            justify-content: space-around;
        }

        .manage-buttons a {
            padding: 5px 10px;
            background-color: #4682b4;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        .manage-buttons a:hover {
            background-color: #1e90ff;
        }
    </style>
</head>
<body>
    <header>
        <h1>Manage Messages</h1>
        <nav>
            <a href="admindashboard.php">Back to Dashboard</a>
        </nav>
    </header>

    <div class="container">
        <table class="message-table">
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
                <?php if ($result_messages->num_rows > 0): ?>
                    <?php while ($row = $result_messages->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td><?php echo $row['subject']; ?></td>
                            <td><?php echo $row['message']; ?></td>
                            <td><?php echo $row['created_at']; ?></td>
                            <td class="manage-buttons">
                                <a href="edit_message.php?id=<?php echo $row['id']; ?>">Edit</a>
                                <a href="delete_message.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this message?')">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7">No messages available.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
