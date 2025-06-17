<?php
session_start();
include("conexao.php");

if ($_SESSION['email'] !== 'admin@as.com') {
    die("Acesso negado.");
}

echo "<h1>Painel Administrativo</h1>";

echo "<h2>Usuários</h2>";
$res = $conn->query("SELECT * FROM usuarios");
while ($row = $res->fetch_assoc()) {
    echo "{$row['nome']} ({$row['email']}) <br>";
}

echo "<h2>Publicações</h2>";
$res = $conn->query("SELECT * FROM publicacoes");
while ($row = $res->fetch_assoc()) {
    echo "{$row['autor']}: {$row['conteudo']} ";
    echo "<a href='excluir_publicacao_admin.php?id={$row['id']}'>[Excluir]</a><br>";
}
?>