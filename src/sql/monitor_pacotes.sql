CREATE DATABASE IF NOT EXISTS monitor_pacotes;
USE monitor_pacotes;

CREATE TABLE IF NOT EXISTS pacotes (
  id INT AUTO_INCREMENT PRIMARY KEY,
  src_ip VARCHAR(15) NOT NULL,
  dest_ip VARCHAR(15) NOT NULL,
  protocolo VARCHAR(10) NOT NULL,
  tamanho INT NOT NULL
);

CREATE TABLE usuarios (
  id INT AUTO_INCREMENT PRIMARY KEY,
  usuario VARCHAR(50) NOT NULL UNIQUE,
  senha VARCHAR(255) NOT NULL
);

-- Inserindo um usuário de teste (senha: 1234)
INSERT INTO usuarios (usuario, senha)
VALUES ('admin', SHA2('adminmaster', 256));
