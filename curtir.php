<?php
session_start();
include("conexao.php");

$publicacao_id = $_POST['publicacao_id'];
$email = $_SESSION['email'];

// Verificar se já curtiu
$verifica = $conn->query("SELECT * FROM curtidas WHERE publicacao_id = $publicacao_id AND usuario_email = '$email'");
if ($verifica->num_rows === 0) {
    $conn->query("INSERT INTO curtidas (publicacao_id, usuario_email) VALUES ($publicacao_id, '$email')");
}

header("Location: index.php");
?>