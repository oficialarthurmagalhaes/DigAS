<?php
session_start();
include("conexao.php");

$publicacao_id = $_POST['publicacao_id'];
$autor = $_SESSION['nome'];
$texto = $_POST['comentario'];

$sql = "INSERT INTO comentarios (publicacao_id, autor, texto) VALUES ('$publicacao_id', '$autor', '$texto')";
$conn->query($sql);

header("Location: index.php");
?>