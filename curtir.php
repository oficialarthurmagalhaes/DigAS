<?php
// inicia a sessão e faz a conexão com o banco de dados
session_start();
include("conexao.php"); 

$publicacao_id = $_POST['publicacao_id'];// Recebe o ID da publicação do formulário de curtida
$email = $_SESSION['email'];// Obtém o email do usuário logado na sessão

// Verificar se já curtiu
$verifica = $conn->query("SELECT * FROM curtidas WHERE publicacao_id = $publicacao_id AND usuario_email = '$email'");
// Se não curtiu, insere a curtida
if ($verifica->num_rows === 0) {
    // Inserção da curtida no banco de dados
    $conn->query("INSERT INTO curtidas (publicacao_id, usuario_email) VALUES ($publicacao_id, '$email')");
}

header("Location: index.php"); // Redireciona para a página principal após a curtida ser adicionada
?>