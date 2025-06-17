<?php
session_start();
include("conexao.php");

if ($_SESSION['email'] !== 'admin@as.com') {
    die("Acesso negado.");
}

$id = $_GET['id'];
$conn->query("DELETE FROM publicacoes WHERE id=$id");
header("Location: admin.php");
?>