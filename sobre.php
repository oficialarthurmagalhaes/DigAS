<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>AS - Sobre</title> <!--Título da página-->
    <!-- Logo da aba do navegador -->
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/logo/icone_AS.svg">
    <link rel="icon" type="image/svg" href="assets/img/logo/icone_AS.svg">
    <!-- Importa o CSS-->
    <link rel="stylesheet" href="css/style.css">
    <!-- Importa a fonte Inter do Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
        rel="stylesheet">
    <script>
        var isAdmin = <?php echo (isset($_SESSION['email']) && $_SESSION['email'] === 'admin@as.com') ? 'true' : 'false'; ?>;
    </script>
    <!-- Importa o JavaScript do header e footer-->
    <script type="text/JavaScript" src="js/script.js"></script>
    <!-- Script para carregar cabeçalho e rodapé -->
    <script>
        window.addEventListener("load", criarHeader);
        console.log(document.getElementById("header"));
        window.addEventListener("load", criarFooter);
        console.log(document.getElementById("footer"));
    </script>
</head>

<body>
    <header>
        <!-- Cabeçalho com links de navegação-->
        <div id="header"></div>
    </header>
    <main class="container">
        <!--Início da Visão Geral-->
        <section id="container-visao-geral" class="container-visao-geral">
            <div class="container-visao-geral-sobre">
                <h1 class="container-visao-geral-sobre-titulo">Visão geral</h1>
                <p class="contato-escrito-sobre-paragrafo">O AS é um site de publicações dinâmicas voltado à divulgação
                    de conteúdos acadêmicos no meio institucional. O projeto surge diante da crescente produção de
                    trabalhos escolares e acadêmicos que, muitas vezes, ficam restritos ao ambiente da sala de aula, sem
                    alcançar uma audiência mais ampla.</p><br>
                <p class="contato-escrito-sobre-paragrafo">Atualmente, observa-se a ausência de um sistema de
                    publicações que una alunos do ensino médio e superior, além de professores, para o compartilhamento
                    de informações gerais e trabalhos acadêmicos, como artigos, TCCs, projetos e experimentos realizados
                    em sala de aula.</p><br>
                <p class="contato-escrito-sobre-paragrafo">O objetivo principal do AS é criar um ambiente online
                    acessível que permita a publicação e a consulta de materiais acadêmicos produzidos por alunos e
                    professores, promovendo a disseminação do conhecimento, o reconhecimento do esforço estudantil e o
                    incentivo à pesquisa e à escrita científica.</p><br>
                <p class="contato-escrito-sobre-paragrafo">O público-alvo são os alunos do ensino médio e superior, mas
                    o sistema também pode ser utilizado por professores, coordenadores e instituições de ensino que
                    desejem incentivar a pesquisa e a troca de conhecimento entre os estudantes.</p>
            </div>
        </section>
    </main>
    <footer>
        <!-- Rodapé com nome e link-->
        <div class="footer" id="footer"></div>
    </footer>
</body>

</html>