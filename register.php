
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

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = htmlspecialchars(trim($_POST['name']));
        $surname = htmlspecialchars(trim($_POST['surname']));
        $email = htmlspecialchars(trim($_POST['email']));
        $password = htmlspecialchars(trim($_POST['password']));
        $confirm_password = htmlspecialchars(trim($_POST['confirm_password']));
        $dob = htmlspecialchars(trim($_POST['dob']));
        $gender = htmlspecialchars(trim($_POST['gender']));

       
        if (empty($name) || empty($surname) || empty($email) || empty($password) || empty($confirm_password) || empty($dob) || empty($gender)) {
            die("Lütfen tüm alanları doldurunuz.");
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            die("Geçerli bir e-posta adresi giriniz.");
        }

        if ($password !== $confirm_password) {
            die("Şifreler uyuşmuyor.");
        }

        if (strlen($password) < 6) {
            die("Şifre en az 6 karakter olmalıdır.");
        }

       
        $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$email]);
        if ($stmt->fetch()) {
            die("Bu e-posta adresi zaten kullanılıyor.");
        }

        
        $stmt = $pdo->prepare("INSERT INTO users (name, surname, email, password, dob, gender) VALUES (?, ?, ?, ?, ?, ?)");
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt->execute([$name, $surname, $email, $hashed_password, $dob, $gender]);

        echo "Kayıt başarılı.";
        echo '<meta http-equiv="refresh" content="2;url=users.php">';
    }
} catch (PDOException $e) {
    echo "Bağlantı hatası: " . $e->getMessage();
}
?>

