<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>AS - Contato</title> <!--Título da página-->
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
    <script type="text/JavaScript" src="js/script.js"></script>
    <script>
        window.addEventListener("load", criarHeader);
        console.log(document.getElementById("header"));
        window.addEventListener("load", criarFooter);
        console.log(document.getElementById("footer"));
    </script>
</head>

<body>
    <!-- Cabeçalho-->
    <header>
        <div id="header"></div>
    </header>
    <!-- todo o conteúdo, conteúdo principal-->
    <main class="container">
        <!--Início de contato-->
        <section id="contato" class="contato">
            <div class="contato-escrito">
                <h1 class="contato-escrito-titulo2">Integrantes</h1>
                <p class="contato-escrito-subtitulo">Aqui você pode ver os responsáveis pela criação e desenvolvimento
                    do projeto e entrar em contato pelas suas redes sociais.</p>
            </div>

            <div class="contato-container"> <!--Alinha os blocos de contato-->
                <!--Início de um integrante-->
                <div class="contato-container-unico">
                    <h4>Arthur Magalhães</h4>
                    <p>Aluno do IFTO, cursando o 3º período do curso de Sistemas de Informação</p>
                    <div class="contato-container-unico-imagem">
                        <img src="assets/img/persons/ArthurMagalhaes.jpg" alt="Foto de Arthur Magalhães">
                    </div>
                    <div class="contato-container-unico-botao">
                        <div class="contato-container-unico-botao-lattes">
                            <a href="http://lattes.cnpq.br/3539469579741963"
                                class="contato-container-unico-botao-lattes-link" target="_blank">
                                <img src="assets/img/logo/logo_lattes.png" alt="">
                                <p>Lattes</p>
                            </a>
                        </div>
                        <div class="contato-container-unico-botao-github">
                            <a href="https://github.com/oficialarthurmagalhaes"
                                class="contato-container-unico-botao-github-link" target="_blank">
                                <img src="assets/img/logo/logo_github_branco.png" alt="">
                                <p>Github</p>
                            </a>
                        </div>
                        <div class="contato-container-unico-botao-linkedin">
                            <a href="https://www.linkedin.com/in/arthurdasilvamagalhaes/"
                                class="contato-container-unico-botao-linkedin-link" target="_blank">
                                <img src="assets/img/logo/logo_linkedin_azul.png" alt="">
                                <p>Linkedin</p>
                            </a>
                        </div>
                    </div>
                </div>
                <!--Fim de um integrante-->

                <!--Início de um integrante-->
                <div class="contato-container-unico">
                    <h4>Sérgio Henrique Martins</h4>
                    <p>Aluno do IFTO, cursando o 3º período do curso de Sistemas de Informação</p>
                    <div class="contato-container-unico-imagem">
                        <img src="assets/img/persons/SergioHenrique.png" alt="Foto de Sérgio Henrique">
                    </div>
                    <div class="contato-container-unico-botao">
                        <div class="contato-container-unico-botao-lattes">
                            <a href="#" class="contato-container-unico-botao-lattes-link" target="_blank">
                                <img src="assets/img/logo/logo_lattes.png" alt="">
                                <p>Lattes</p>
                            </a>
                        </div>
                        <div class="contato-container-unico-botao-github">
                            <a href="#" class="contato-container-unico-botao-github-link" target="_blank">
                                <img src="assets/img/logo/logo_github_branco.png" alt="">
                                <p>Github</p>
                            </a>
                        </div>
                        <div class="contato-container-unico-botao-linkedin">
                            <a href="#" class="contato-container-unico-botao-linkedin-link" target="_blank">
                                <img src="assets/img/logo/logo_linkedin_azul.png" alt="">
                                <p>Linkedin</p>
                            </a>
                        </div>
                    </div>
                </div>
                <!--Fim de um integrante-->

                <!--Início de um integrante-->
                <div class="contato-container-unico">
                    <h4>Eduardo Vasconcelos</h4>
                    <p>Aluno do IFTO, cursando o 7º período do curso de Sistemas de Informação</p>
                    <div class="contato-container-unico-imagem">
                        <img src="assets/img/persons/EduardoVasconcelos.jpg" alt="Foto de Eduardo Vasconcelos">
                    </div>
                    <div class="contato-container-unico-botao">
                        <div class="contato-container-unico-botao-lattes">
                            <a href="#" class="contato-container-unico-botao-lattes-link" target="_blank">
                                <img src="assets/img/logo/logo_lattes.png" alt="">
                                <p>Lattes</p>
                            </a>
                        </div>
                        <div class="contato-container-unico-botao-github">
                            <a href="https://github.com/edu-ard0" class="contato-container-unico-botao-github-link"
                                target="_blank">
                                <img src="assets/img/logo/logo_github_branco.png" alt="">
                                <p>Github</p>
                            </a>
                        </div>
                        <div class="contato-container-unico-botao-linkedin">
                            <a href="http://www.linkedin.com/in/eduardo-nascimento-902104233"
                                class="contato-container-unico-botao-linkedin-link" target="_blank">
                                <img src="assets/img/logo/logo_linkedin_azul.png" alt="">
                                <p>Linkedin</p>
                            </a>
                        </div>
                    </div>
                </div>
                <!--Fim de um integrante-->

                <!--Início de um integrante-->
                <div class="contato-container-unico">
                    <h4>Leonardo Santos Botelho</h4>
                    <p>Aluno do IFTO, cursando o 3º período do curso de Sistemas de Informação</p>
                    <div class="contato-container-unico-imagem">
                        <img src="assets//img/persons/LeonardoBotelho.jpg" alt="Foto de Leonardo Botelho">
                    </div>
                    <div class="contato-container-unico-botao">
                        <div class="contato-container-unico-botao-lattes">
                            <a href="#" class="contato-container-unico-botao-lattes-link" target="_blank">
                                <img src="assets/img/logo/logo_lattes.png" alt="">
                                <p>Lattes</p>
                            </a>
                        </div>
                        <div class="contato-container-unico-botao-github">
                            <a href="#" class="contato-container-unico-botao-github-link" target="_blank">
                                <img src="assets/img/logo/logo_github_branco.png" alt="">
                                <p>Github</p>
                            </a>
                        </div>
                        <div class="contato-container-unico-botao-linkedin">
                            <a href="#" class="contato-container-unico-botao-linkedin-link" target="_blank">
                                <img src="assets/img/logo/logo_linkedin_azul.png" alt="">
                                <p>Linkedin</p>
                            </a>
                        </div>
                    </div>
                    <!--Fim de um integrante-->
                </div>
        </section>
        <!--Fim de contato-->
    </main>
    <footer>
        <!-- Rodapé com nome e link-->
        <div class="footer" id="footer"></div>
    </footer>
</body>

</html>