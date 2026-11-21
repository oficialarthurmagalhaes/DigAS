<?php
require_once("funcoes.php");
require_once("conexao.php");
exigir_login();
exigir_post();
validar_csrf();

$id = (int) ($_POST['id'] ?? 0);

// Busca a publicação garantindo que ela pertence ao usuário logado
$stmt = $conn->prepare("SELECT id, imagem, arquivo FROM publicacoes WHERE id = ? AND usuario_email = ?");
$stmt->bind_param("is", $id, $_SESSION['email']);
$stmt->execute();
$publicacao = $stmt->get_result()->fetch_assoc();

if ($publicacao) {
    require_once("excluir_publicacao_comum.php");
    excluir_publicacao($conn, $publicacao);
}

header("Location: index.php");
