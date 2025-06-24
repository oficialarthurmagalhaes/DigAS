CREATE DATABASE IF NOT EXISTS digas;
USE digas;

CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS publicacoes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    conteudo TEXT NOT NULL,
    autor VARCHAR(100) NOT NULL,
    imagem VARCHAR(255),
    arquivo VARCHAR(255) DEFAULT NULL,
    imagem_nome_original VARCHAR(255) DEFAULT NULL,
    arquivo_nome_original VARCHAR(255) DEFAULT NULL,
    data TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


CREATE TABLE IF NOT EXISTS comentarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    publicacao_id INT,
    autor VARCHAR(100),
    texto TEXT,
    data TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS curtidas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    publicacao_id INT,
    usuario_email VARCHAR(100),
    UNIQUE KEY (publicacao_id, usuario_email)
);