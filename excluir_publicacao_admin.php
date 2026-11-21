<?php
require_once("funcoes.php");
require_once("conexao.php");
exigir_admin();
exigir_post();
validar_csrf();

$id = (int) ($_POST['id'] ?? 0);

$stmt = $conn->prepare("SELECT id, imagem, arquivo FROM publicacoes WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$publicacao = $stmt->get_result()->fetch_assoc();

if ($publicacao) {
    require_once("excluir_publicacao_comum.php");
    excluir_publicacao($conn, $publicacao);
}

header("Location: admin.php");
