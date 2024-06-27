<?php
session_start();

$servername = "localhost";
$dbname = "usuario_db";
$dbusername = "root"; // Altere se necessário
$dbpassword = ""; // Altere se necessário

$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT id, username, email, password FROM usuarios WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();

        if (password_verify($password, $row['password'])) {
            // Login bem-sucedido
            $_SESSION['user_id'] = $row['id']; // Salva o ID do usuário na sessão
            $_SESSION['username'] = $row['username']; // Salva o nome de usuário na sessão se necessário
            header("Location: ../../logado.html"); // Redireciona para a página de dashboard após o login
            exit();
        } else {
            header("Location: ../../login.html");
        }
    } else {
        echo "Usuário não encontrado ou email incorreto!";
    }

    $stmt->close();
}

$conn->close();
?>
