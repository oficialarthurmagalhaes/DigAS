<?php
session_start();
include("conexao.php");

if (!isset($_SESSION['email'])) {
    header("Location: login.html");
    exit();
}

$nome = $_POST['nome'];
$nova_senha = $_POST['senha'];
$email = $_SESSION['email'];

if (!empty($nova_senha)) {
    $senha_hash = password_hash($nova_senha, PASSWORD_DEFAULT);
    $sql = "UPDATE usuarios SET nome='$nome', senha='$senha_hash' WHERE email='$email'";
} else {
    $sql = "UPDATE usuarios SET nome='$nome' WHERE email='$email'";
}

if ($conn->query($sql) === TRUE) {
    $_SESSION['nome'] = $nome;
    header("Location: index.php");
} else {
    echo "Erro ao atualizar perfil: " . $conn->error;
}
?>