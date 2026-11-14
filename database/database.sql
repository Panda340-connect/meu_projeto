CREATE DATABASE IF NOT EXISTS projeto_idoso DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE projeto_idoso;

CREATE TABLE IF NOT EXISTS usuario (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    telefone VARCHAR(20),
    tipo_usuario VARCHAR(50)
);

CREATE TABLE IF NOT EXISTS consulta (
    id_consulta INT AUTO_INCREMENT PRIMARY KEY,
    especialidade VARCHAR(100) NOT NULL,
    nome_medico VARCHAR(100),
    data_consulta DATE NOT NULL,
    horario TIME NOT NULL,
    local VARCHAR(150),
    id_usuario INT NOT NULL,
    FOREIGN KEY (id_usuario) REFERENCES usuario(id_usuario) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS refeicao (
    id_refeicao INT AUTO_INCREMENT PRIMARY KEY,
    nome_refeicao VARCHAR(100) NOT NULL,
    descricao VARCHAR(255),
    horario TIME NOT NULL,
    id_usuario INT NOT NULL,
    FOREIGN KEY (id_usuario) REFERENCES usuario(id_usuario) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS medicamento (
    id_medicamento INT AUTO_INCREMENT PRIMARY KEY,
    nome_medicamento VARCHAR(100) NOT NULL,
    dosagem VARCHAR(50) NOT NULL,
    horario TIME NOT NULL,
    frequencia VARCHAR(50) NOT NULL,
    id_usuario INT NOT NULL,
    FOREIGN KEY (id_usuario) REFERENCES usuario(id_usuario) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS exercicio (
    id_exercicio INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    descricao VARCHAR(255),
    frequencia VARCHAR(50),
    duracao INT,
    data_exercicio DATE,
    horario TIME,
    id_usuario INT NOT NULL,
    FOREIGN KEY (id_usuario) REFERENCES usuario(id_usuario) ON DELETE CASCADE
);