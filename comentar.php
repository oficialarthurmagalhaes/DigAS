<?php
require_once("funcoes.php");
require_once("conexao.php");
exigir_login();
exigir_post();
validar_csrf();

$publicacao_id = (int) ($_POST['publicacao_id'] ?? 0);
$autor = $_SESSION['nome'];
$texto = trim($_POST['comentario'] ?? '');

if ($publicacao_id > 0 && $texto !== '') {
    // O SELECT garante que só é possível comentar em uma publicação que existe.
    $stmt = $conn->prepare("INSERT INTO comentarios (publicacao_id, autor, texto) SELECT id, ?, ? FROM publicacoes WHERE id = ?");
    $stmt->bind_param("ssi", $autor, $texto, $publicacao_id);
    $stmt->execute();
}

header("Location: index.php");
