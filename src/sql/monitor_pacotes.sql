CREATE DATABASE monitor_pacotes;
USE monitor_pacotes;

CREATE TABLE IF NOT EXISTS PACOTES (
  id INT AUTO_INCREMENT PRIMARY KEY,
  src_ip VARCHAR(15) NOT NULL,
  dest_ip VARCHAR(15) NOT NULL,
  protocolo VARCHAR(10) NOT NULL,
  tamanho INT NOT NULL
);

CREATE TABLE USUARIOS (
  id_usuario INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(100),
  email VARCHAR(100) UNIQUE,
  senha_hash VARCHAR(255)
);

CREATE TABLE CAPTURA (
    id_captura INT AUTO_INCREMENT PRIMARY KEY,
    data_hora_inicio DATETIME,
    interface VARCHAR(50),
    id_usuario INT,
    FOREIGN KEY (id_usuario) REFERENCES Usuario(id_usuario)
);

CREATE TABLE FILTRO (
    id_filtro INT AUTO_INCREMENT PRIMARY KEY,
    expressao TEXT,
    id_captura INT,
    FOREIGN KEY (id_captura) REFERENCES Captura(id_captura)
);

CREATE TABLE RELATORIO (
    id_relatorio INT AUTO_INCREMENT PRIMARY KEY,
    nome_arquivo VARCHAR(100),
    data_geracao DATETIME,
    tipo VARCHAR(50),
    id_captura INT,
    FOREIGN KEY (id_captura) REFERENCES Captura(id_captura)
);


-- Inserindo um usuário de teste (senha: 1234)
INSERT INTO usuarios (usuario, senha)
VALUES ('admin', SHA2('adminmaster', 256));
