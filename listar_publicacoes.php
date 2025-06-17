<?php
include("conexao.php");

$sql = "SELECT * FROM publicacoes ORDER BY data DESC";
$res = $conn->query($sql);

while ($row = $res->fetch_assoc()) {
    $post_id = $row['id'];
    echo "<div style='margin-bottom: 20px; margin-top: 10px;'>";
    echo "<p><strong>{$row['autor']}</strong>: {$row['conteudo']}</p>";
    if (!empty($row['imagem'])) {
        echo "<img src='uploads/{$row['imagem']}' width='200'><br>";
    }

    // Curtidas
    $curtidas = $conn->query("SELECT COUNT(*) as total FROM curtidas WHERE publicacao_id = $post_id")->fetch_assoc()['total'];
    echo "<form action='curtir.php' method='POST' style='display:inline'>";
    echo "<input type='hidden' name='publicacao_id' value='$post_id'>";
    echo "<button type='submit'>❤️ Curtir ($curtidas)</button>";
    echo "</form>";

    // Comentários
    echo "<div style='margin-top:10px; margin-left: 15px;'>";
    $comentarios = $conn->query("SELECT * FROM comentarios WHERE publicacao_id = $post_id ORDER BY data ASC");
    while ($coment = $comentarios->fetch_assoc()) {
        echo "<p><strong>{$coment['autor']}:</strong> {$coment['texto']}</p>";
    }
    echo "</div>";

    // Formulário de comentário
    echo "<form action='comentar.php' method='POST'>";
    echo "<input type='hidden' name='publicacao_id' value='$post_id'>";
    echo "<input type='text' name='comentario' placeholder='Comente algo...' required>";
    echo "<button type='submit'>Comentar</button>";
    echo "</form>";

    if (isset($_SESSION['nome']) && $_SESSION['nome'] === $row['autor']) {
        echo "<br><a href='excluir_publicacao.php?id={$post_id}'>Excluir</a>";
    }
    echo "</div><hr>";
}
?>