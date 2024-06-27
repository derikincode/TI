<?php
$servername = "localhost";
$dbname = "usuario_db";
$dbusername = "root"; // Altere se necessário
$dbpassword = ""; // Altere se necessário

$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password !== $confirm_password) {
        echo "As senhas não coincidem!";
        exit;
    }

    // Hash da senha
    $password_hashed = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO usuarios (username, email, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $username, $email, $password_hashed);

    if ($stmt->execute()) {
        // Redirecionar para a página de login após o registro bem-sucedido
        header("Location: ../../login.html");
        exit(); // Certifique-se de sair após o redirecionamento
    } else {
        echo "Erro: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
