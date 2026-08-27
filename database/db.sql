CREATE DATABASE Atividade_9;
USE Atividade_9;
CREATE TABLE usuarios (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(150) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    telefone VARCHAR(15) NOT NULL
);

CREATE TABLE animais (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(200) NOT NULL,
    especie VARCHAR(200) NOT NULL,
    raca VARCHAR(200) NOT NULL,
    idade DECIMAL(10, 2) NOT NULL,
    peso DECIMAL(5, 2) NOT NULL,
    usuario_id INT NOT NULL,

    FOREIGN KEY (usuario_id) REFERENCES usuarios(id),

);
