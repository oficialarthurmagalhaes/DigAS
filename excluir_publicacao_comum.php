<?php
// Exclui uma publicação junto com seus comentários, curtidas e arquivos enviados.
function excluir_publicacao(mysqli $conn, array $publicacao): void
{
    $id = (int) $publicacao['id'];

    $conn->begin_transaction();
    foreach (["DELETE FROM comentarios WHERE publicacao_id = ?",
              "DELETE FROM curtidas WHERE publicacao_id = ?",
              "DELETE FROM publicacoes WHERE id = ?"] as $sql) {
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
    }
    $conn->commit();

    // Remove os arquivos do disco (basename impede sair da pasta uploads)
    foreach (['imagem', 'arquivo'] as $campo) {
        if (!empty($publicacao[$campo])) {
            $caminho = __DIR__ . "/uploads/" . basename($publicacao[$campo]);
            if (is_file($caminho)) {
                unlink($caminho);
            }
        }
    }
}
