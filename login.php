<?php
session_start();

// Подключение к базе данных (замените данными вашей базы данных)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user_demo";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT username, password FROM clients WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['username'] = $row['username'];
        $_SESSION['password'] = $row['password'];
        header("Location: welcome.php");
    } else {
        echo "Invalid username or password";
    }
}

$conn->close();
?>
