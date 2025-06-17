<?php
include("conexao.php");

$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = $_POST['senha'];
$confirmar = $_POST['confirmarsenha'];

if ($senha !== $confirmar) {
    die("As senhas não coincidem.");
}

$senha_criptografada = password_hash($senha, PASSWORD_DEFAULT);
$sql = "INSERT INTO usuarios (nome, email, senha) VALUES ('$nome', '$email', '$senha_criptografada')";

if ($conn->query($sql)) {
    header("Location: login.html");
} else {
    echo "Erro ao cadastrar: " . $conn->error;
}
?>