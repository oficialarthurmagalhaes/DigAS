<?php
session_start();
include("conexao.php");

$conteudo = $_POST['conteudo'];
$autor = $_SESSION['nome'];

$imagem_nome = "";
if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] == 0) {
    $ext = strtolower(pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION));
    $imagem_nome = uniqid() . "." . $ext;
    move_uploaded_file($_FILES['imagem']['tmp_name'], "uploads/" . $imagem_nome);
}

$sql = "INSERT INTO publicacoes (conteudo, autor, imagem) VALUES ('$conteudo', '$autor', '$imagem_nome')";
$conn->query($sql);

header("Location: index.php");
?>