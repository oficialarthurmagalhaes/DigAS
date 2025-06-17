<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: login.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>AS - Início</title>
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/logo/icone_AS.svg">
    <link rel="icon" type="image/svg" href="assets/img/logo/icone_AS.svg">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Estilos -->
    <!-- <link rel="stylesheet" href="css/bootstrap.css"> -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">

    <!-- Script para carregar cabeçalho e rodapé em todas as páginas -->
    <script type="text/JavaScript" src="js/script.js"></script>
    <script>
        window.addEventListener("load", criarHeader);
        console.log(document.getElementById("header"));
        window.addEventListener("load", criarFooter);
        console.log(document.getElementById("footer"));
    </script>
</head>
<body>
    <header>
        <div class="header" id="header"></div>
    </header>
    <main class="container">
        <div class="feed">
            <form action="publicar.php" method="POST" class="nova-publicacao" enctype="multipart/form-data">
                <textarea name="conteudo" placeholder="O que houve?" rows="3" required></textarea><br>
                <button type="submit">Publicar</button>
                <label for="imagem" class="upload-label">📷</label>
                <input type="file" name="imagem" id="imagem" class="input-file">
                <span id="nome-arquivo">Nenhum arquivo selecionado</span>       

            </form>
            <hr>
            <?php include("listar_publicacoes.php"); ?>
        </div>
        <button class="btn-topo" onclick="voltarAoTopo()">↑</button>
    </main>
    <footer>
        <div class="footer" id="footer"></div>
    </footer>
</body>
</html>