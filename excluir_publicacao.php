<?php
session_start();
include("conexao.php");

$id = $_GET['id'];
$usuario = $_SESSION['nome'];

$sql = "DELETE FROM publicacoes WHERE id=$id AND autor='$usuario'";
$conn->query($sql);

header("Location: index.php");
?>