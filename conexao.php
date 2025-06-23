<?php
// Conexão com o banco de dados MySQL
$host = "localhost";
$user = "root";
$senha = "";
$banco = "digas";

$conn = new mysqli($host, $user, $senha, $banco);
if ($conn->connect_error) {
    die("Erro: " . $conn->connect_error);
}
