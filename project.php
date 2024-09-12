<?php
// process-insert.php

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Receive data from form
    $name = htmlspecialchars(trim($_POST["name"]));
    $email = htmlspecialchars(trim($_POST["email"]));
    $message = htmlspecialchars(trim($_POST["message"]));

    // Debugging: display received data
    echo "<p>First Name: $name</p>";
    echo "<p>Email: $email</p>";
    echo "<p>Message: $message</p>";

    try {
        // Connecting to the database
        $dsn = "mysql:host=localhost;dbname=contactme;charset=utf8mb4";
        $dbusername = "root";
        $dbpassword = "";
        $pdo = new PDO($dsn, $dbusername, $dbpassword);

        // Set PDO error mode to exception
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prepare SQL statement
        $stmt = $pdo->prepare("INSERT INTO `form` (`name`, `email`, `message`) VALUES (:name, :email, :message)");

        // Bind parameters and execute
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':message', $message);

        if ($stmt->execute()) {
            echo "<p>Thank you for your message, $name! Your message has been successfully submitted.</p>";
        } else {
            echo "<p>Something went wrong. Please try again later.</p>";
        }

    } catch (PDOException $e) {
        // Display error message
        echo "<p>Error: " . $e->getMessage() . "</p>";
    }

    // Close the connection
    $pdo = null;
} else {
    echo "<p>Invalid request method.</p>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Submission</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        h1 {
            color: #333;
        }
        p {
            background-color: #ddd;
            padding: 10px;
            border: 1px solid #333;
            margin-bottom: 10px;
        }
        a {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #333;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }
        a:hover {
            background-color: #555;
        }
    </style>
</head>
<body>
    <a href="select-persons.php">Show All Records</a>
</body>
</html>
