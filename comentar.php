<?php
// inicia a sessão e faz a conexão com o banco de dados
session_start();
include("conexao.php");

$publicacao_id = $_POST['publicacao_id']; // Recebe o ID da publicação do formulário de comentário
$autor = $_SESSION['nome']; // Obtém o nome do usuário logado na sessão
$texto = $_POST['comentario']; // Recebe os dados do formulário de comentário

//Inserção do comentário no banco de dados
$sql = "INSERT INTO comentarios (publicacao_id, autor, texto) VALUES ('$publicacao_id', '$autor', '$texto')";
$conn->query($sql);

header("Location: index.php"); // Redireciona para a página principal após o comentário ser adicionado
