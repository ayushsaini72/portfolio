<?php 
// select-persons.php
// Show all records from the 'form' table

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>View Records</title>
    <style type="text/css">
        div {
            background-color: #ddd;
            padding: 5px;
            border: 1px solid blue;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <a href="project.php">Add a new record</a>

    <?php
    // Connect to the database
    $dsn = "mysql:host=localhost;dbname=contactme;charset=utf8mb4";
    $dbusername = "root";
    $dbpassword = "";
    
    try {
        $pdo = new PDO($dsn, $dbusername, $dbpassword);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prepare and execute the SELECT query
        $stmt = $pdo->prepare("SELECT * FROM `form`");
        $stmt->execute();

        // Fetch and display the records
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            ?>
            <div>
                <p><strong>Name:</strong> <?= htmlspecialchars($row["name"]) ?></p>
                <p><strong>Email:</strong> <?= htmlspecialchars($row["email"]) ?></p>
                <p><strong>Message:</strong> <?= htmlspecialchars($row["message"]) ?></p>
            </div>
            <?php
        }
    } catch (PDOException $e) {
        echo "<h1>Error: " . htmlspecialchars($e->getMessage()) . "</h1>";
    }
    ?>

</body>
</html>
