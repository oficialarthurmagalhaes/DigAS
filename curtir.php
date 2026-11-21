<?php
require_once("funcoes.php");
require_once("conexao.php");
exigir_login();
exigir_post();
validar_csrf();

$publicacao_id = (int) ($_POST['publicacao_id'] ?? 0);
$email = $_SESSION['email'];

if ($publicacao_id > 0) {
    // A chave UNIQUE (publicacao_id, usuario_email) impede curtida duplicada;
    // INSERT IGNORE simplesmente não faz nada se o usuário já curtiu.
    // O SELECT garante que só é possível curtir uma publicação que existe.
    $stmt = $conn->prepare("INSERT IGNORE INTO curtidas (publicacao_id, usuario_email) SELECT id, ? FROM publicacoes WHERE id = ?");
    $stmt->bind_param("si", $email, $publicacao_id);
    $stmt->execute();
}

header("Location: index.php");
