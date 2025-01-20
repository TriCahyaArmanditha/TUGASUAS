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

    // Ambil data message berdasarkan ID
    $sql = "SELECT * FROM messages WHERE id = $id";
    $result = $conn->query($sql);
    $message = $result->fetch_assoc();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Ambil data dari form
        $subject = $_POST['subject'];
        $message_content = $_POST['message'];

        // Update data ke database
        $update_sql = "UPDATE messages SET subject='$subject', message='$message_content' WHERE id=$id";

        if ($conn->query($update_sql) === TRUE) {
            echo "Message updated successfully.";
            header("Location: manage_messages.php");
        } else {
            echo "Error: " . $conn->error;
        }
    }

    $conn->close();
} else {
    echo "Message not found.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Message</title>
</head>
<body>
    <h1>Edit Message</h1>
    <form action="edit_message.php?id=<?php echo $id; ?>" method="POST">
        <label for="subject">Subject:</label>
        <input type="text" name="subject" value="<?php echo $message['subject']; ?>" required>

        <label for="message">Message:</label>
        <textarea name="message" required><?php echo $message['message']; ?></textarea>

        <input type="submit" value="Update Message">
    </form>
</body>
</html>
