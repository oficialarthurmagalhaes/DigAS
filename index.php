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

    <!-- Importa o CSS-->
    <link rel="stylesheet" href="css/style.css">
    <!-- Importa a fonte Inter do Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Script para carregar cabeçalho e rodapé em todas as páginas -->
    <script type="text/JavaScript" src="js/script.js"></script>
    <script>
        var isAdmin = <?php echo (isset($_SESSION['email']) && $_SESSION['email'] === 'admin@as.com') ? 'true' : 'false'; ?>;
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
                <textarea name="conteudo" placeholder="O que houve?" rows="3" required></textarea>
                <div class="nova-publicacao-botoes">
                    <button type="submit">Publicar</button>
                    <label for="upload-imagem" class="nova-publicacao-botoes-upload-btn">
                        <i class="fa-regular fa-image" style="color: #ffffff;"></i>
                        <input type="file" name="imagem" id="upload-imagem" class="input-file" style="display: none;" accept=".jpg, .jpeg, .png, .gif, .mp4, .mov">
                    </label>
                    <label for="upload-arquivo" class="nova-publicacao-botoes-upload-btn">
                        <i class="fa-regular fa-file" sty></i>
                        <input type="file" name="arquivo" id="upload-arquivo" class="input-file" style="display: none;" accept=".pdf, .doc, .docx, .xls, .xlsx, .ppt, .pptx, .zip, .rar, .txt">
                    </label>
                </div>       
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