CREATE DATABASE IF NOT EXISTS monitor_pacotes;
USE monitor_pacotes;

-- Tabela de pacotes capturados
CREATE TABLE IF NOT EXISTS PACOTES (
  id INT AUTO_INCREMENT PRIMARY KEY,
  src_ip VARCHAR(15) NOT NULL,
  dest_ip VARCHAR(15) NOT NULL,
  protocolo VARCHAR(10) NOT NULL,
  tamanho INT NOT NULL
);

-- Usuários do sistema
CREATE TABLE IF NOT EXISTS USUARIOS (
  id_usuario INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(100),
  email VARCHAR(100) UNIQUE,
  senha_hash VARCHAR(255)
);

-- Registro de sessões de captura
CREATE TABLE IF NOT EXISTS CAPTURA (
  id_captura INT AUTO_INCREMENT PRIMARY KEY,
  data_hora_inicio DATETIME,
  interface VARCHAR(50),
  id_usuario INT,
  FOREIGN KEY (id_usuario) REFERENCES USUARIOS(id_usuario)
);

-- Filtros utilizados na captura
CREATE TABLE IF NOT EXISTS FILTRO (
  id_filtro INT AUTO_INCREMENT PRIMARY KEY,
  expressao TEXT,
  id_captura INT,
  FOREIGN KEY (id_captura) REFERENCES CAPTURA(id_captura)
);

-- Relatórios gerados a partir das capturas
CREATE TABLE IF NOT EXISTS RELATORIO (
  id_relatorio INT AUTO_INCREMENT PRIMARY KEY,
  nome_arquivo VARCHAR(100),
  data_geracao DATETIME,
  tipo VARCHAR(50),
  id_captura INT,
  FOREIGN KEY (id_captura) REFERENCES CAPTURA(id_captura)
);

-- Inserindo usuário de teste
INSERT INTO USUARIOS (nome, email, senha_hash)
VALUES ('Admin', 'admin@wirefish.local', SHA2('adminmaster', 256));
