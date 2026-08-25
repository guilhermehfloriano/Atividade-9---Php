CREATE DATABASE IF NOT EXISTS Atividade_2;
USE Atividade_2;
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nomeUsuario VARCHAR(150) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE
);

CREATE TABLE animais (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(200) NOT NULL,
    raca VARCHAR(200) NOT NULL,
    idade DECIMAL(10, 2) NOT NULL,
    usuario_id INT NOT NULL,

    CONSTRAINT fk_animal_usuario
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
    ON DELETE CASCADE
);