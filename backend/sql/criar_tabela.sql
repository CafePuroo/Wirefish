CREATE TABLE usuarios (
  id INT AUTO_INCREMENT PRIMARY KEY,
  usuario VARCHAR(50) NOT NULL UNIQUE,
  senha VARCHAR(255) NOT NULL
);

-- Inserindo um usuário de teste (senha: 1234)
INSERT INTO usuarios (usuario, senha)
VALUES ('admin', SHA2('1234', 256));
