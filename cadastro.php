<?php
include("conexao.php"); // Conexão com o banco de dados

//Recebe os dados do formulário
$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = $_POST['senha'];
$confirmar = $_POST['confirmarsenha'];

// Verifica se os campos de confirmar senha está diferente do campo senha
if ($senha !== $confirmar) {
    die("As senhas não coincidem.");
}

//Criptografa a senha e insere no banco de dados
$senha_criptografada = password_hash($senha, PASSWORD_DEFAULT);
$sql = "INSERT INTO usuarios (nome, email, senha) VALUES ('$nome', '$email', '$senha_criptografada')";

// Executa a consulta e verifica se foi bem-sucedida
if ($conn->query($sql)) {
    header("Location: login.html");
} else {
    echo "Erro ao cadastrar: " . $conn->error;
}
