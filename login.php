<?php
session_start();
include("conexao.php");

$email = $_POST['email'];
$senha = $_POST['senha'];

$sql = "SELECT * FROM usuarios WHERE email = '$email'";
$result = $conn->query($sql);

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();
    if (password_verify($senha, $user['senha'])) {
        $_SESSION['email'] = $user['email'];
        $_SESSION['nome'] = $user['nome'];
        header("Location: index.php");
        exit();
    }
}
echo "Login inválido.";
?>