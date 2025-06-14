// ==========================
// Função para criar o cabeçalho
// ==========================
function criarHeader() {
    console.log("A função está sendo chamada!");

    const headerHTML = `
      <nav class="navbar navbar-expand-lg bg-body-tertiary">
          <div class="container-fluid">
              <a class="navbar-brand" href="#">
                  <img src="/assets/img/logo_DigAS_semfundo.png" alt="Logo digAS" width="auto" height="45px">
                  DigAS
              </a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                  aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarNav">
                  <ul class="navbar-nav">
                      <li class="nav-item">
                          <a class="nav-link active" aria-current="page" href="index.html">Início</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" href="contato.html">Contato</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" href="sobre.html">Sobre</a>
                      </li>
                  </ul>
              </div>
          </div>
      </nav>
  `;
document.getElementById("header").innerHTML = headerHTML;


    document.getElementById("header").innerHTML = headerHTML;
}
function criarFooter() {
    console.log("A função do rodapé está sendo chamada!")

    const FooterHTML = `
        <br>
        <p>Equipe: Arthur Magalhães, Sérgio Henrique, Eduardo Vasconcelos e Leonardo Botelho</p>
        <a href="">Saiba Mais</a>
    `;

    document.getElementById("footer").innerHTML = FooterHTML
}

// ==========================
// Lógica dos Tweets
// ==========================

// Espera o DOM carregar para garantir que os elementos existam
window.addEventListener("DOMContentLoaded", () => {
    const tweetButton = document.getElementById('tweet-button');
    const tweetInput = document.getElementById('tweet-input');
    const tweetsContainer = document.getElementById('tweets-container');

    // Função para criar um novo tweet
    function createTweet(tweetText) {
        const tweetDiv = document.createElement('div');
        tweetDiv.classList.add('tweet');

        tweetDiv.innerHTML = `
          <div class="tweet-header">
              <img src="/assets/img/IMG_20250112_163915.jpg" alt="IMG-20250112-163915" border="0" height="55px">
              <div class="tweet-info">
                  <strong>Arthur Magalhães</strong>
                  <span>@magaltotal</span>
              </div>
          </div>
          <p>${tweetText}</p>
          <div class="tweet-footer">
              <button>Curtir</button>
              <button>Comentar</button>
              <button>Compartilhar</button>
          </div>
      `;

        tweetsContainer.insertBefore(tweetDiv, tweetsContainer.firstChild);
    }

    // Evento de clique no botão "Tweetar"
    tweetButton.addEventListener('click', () => {
        const tweetText = tweetInput.value.trim();

        if (tweetText) {
            createTweet(tweetText);
            tweetInput.value = '';
        } else {
            alert("Digite algo para tweetar!");
        }
    });

    // Evento de tecla Enter para enviar tweet
    tweetInput.addEventListener('keypress', (event) => {
        if (event.key === 'Enter' && !event.shiftKey) {
            event.preventDefault();
            tweetButton.click();
        }
    });
});
