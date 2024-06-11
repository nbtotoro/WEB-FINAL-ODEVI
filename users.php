<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Tablo Örneği</title>
    <style>
table {
    font-family: Arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.1);
}

th, td {
    padding: 15px;
    text-align: left;
    border-bottom: 1px solid #f2f2f2;
}

th {
    background-color: #4CAF50;
    color: white;
    font-weight: bold;
}

tr:nth-child(even) {
    background-color: #f2f2f2;
}

tr:hover {
    background-color: #008f75;
    transform: scale(1.01);
    transition: transform 0.5s ;
}

td:first-child {
    border-top-left-radius: 5px;
    border-bottom-left-radius: 5px;
}

td:last-child {
    border-top-right-radius: 5px;
    border-bottom-right-radius: 5px;
}

    </style>
</head>
<body>
    <?php
$servername = "localhost";
$username = "root";
$password_db = ""; 
$dbname = "kullanicilar";

$conn = new mysqli($servername, $username, $password_db, $dbname);

if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}

$sql = "SELECT name, surname, email FROM users";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1'><tr><th>İsim</th><th>Soyisim</th><th>E-posta</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . htmlspecialchars($row["name"]) . "</td><td>" . htmlspecialchars($row["surname"]) . "</td><td>" . htmlspecialchars($row["email"]) . "</td></tr>";
    }
    echo "</table>";
} else {
    echo "Kayıtlı kullanıcı yok.";
}
$conn->close();
?>
<?php
try {
   
    $dsn = "mysql:host=localhost;dbname=kullanicilar;charset=utf8mb4";
    $username = "root";
    $password = ""; 

    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];

    $pdo = new PDO($dsn, $username, $password, $options);

    $stmt = $pdo->query("SELECT name, surname, email FROM users");

    
    while ($row = $stmt->fetch()) {
    }

} catch (PDOException $e) {
    echo "Bağlantı hatası: " . $e->getMessage();
}
?>
</body>
</html>


