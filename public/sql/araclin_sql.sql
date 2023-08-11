-- Gera��o de Modelo f�sico
-- Sql ANSI 2003 - brModelo.

CREATE TABLE Usuario (
ID_usuario INTEGER PRIMARY KEY,
Nome_usuario VARCHAR(100),
Senha_usaurio VARCHAR(50),
CPF_usuario VARCHAR(11),
Data_nascimento_usuario DATE,
Genero_usuario CHAR(1),
Email_usuario VARCHAR(50),
Whatsapp_usuario VARCHAR(15),
Telefone_usuario VARCHAR(15),
RG_usuario VARCHAR(13),
Logradouro VARCHAR(50),
Numero VARCHAR(10),
Bairro VARCHAR(40),
CEP VARCHAR(8)
)

CREATE TABLE Recupera��o (
ID_recuperacao INTEGER PRIMARY KEY,
ID_usuario INTEGER,
ID_clinica INTEGER,
Codigo_recuperacao BIGINT(50),
Tipo_recuperacao CHAR(2),
Validade_recuperacao DATETIME,
Status_recuperacao CHAR(1),
Data_recuperacao DATETIME,
FOREIGN KEY(ID_usuario) REFERENCES Usuario (ID_usuario)
)

CREATE TABLE avalia_avalia��o (
ID_avaliacao INTEGER PRIMARY KEY,
ID_usuario INTEGER,
ID_clinica INTEGER,
Texto_avaliacao TEXT,
Nota_avaliacao DECIMAL(4),
FOREIGN KEY(ID_usuario) REFERENCES Usuario (ID_usuario)
)

CREATE TABLE cl�nica (
ID_clinica INTEGER PRIMARY KEY,
Forma_pagamento_clinica VARCHAR(100),
Email_clinica VARCHAR(50),
Telefone_clinica VARCHAR(15),
Whatsapp_clinica VARCHAR(15),
Instagram_clinica VARCHAR(50),
CNPJ CHAR(14),
foto_clinica MEDIUMBLOB,
Especialidade_clinica VARCHAR(200),
Plano_saude_clinica VARCHAR(100),
Convenio_clinica VARCHAR(100),
Nome_fantasia_clinica VARCHAR(100),
Logradouro VARCHAR(50),
Bairro VARCHAR(50),
Numero VARCHAR(5),
Complemento VARCHAR(50),
Descricao_clinica TEXT
)

CREATE TABLE m�dico (
ID_medico INTEGER PRIMARY KEY,
Nome_medico VARCHAR(100),
CRM_medico VARCHAR(12)
)

CREATE TABLE possui_vinculo (
ID_medico INTEGER,
ID_clinica INTEGER,
FOREIGN KEY(ID_medico) REFERENCES m�dico (ID_medico),
FOREIGN KEY(ID_clinica) REFERENCES cl�nica (ID_clinica)
)

ALTER TABLE Recupera��o ADD FOREIGN KEY(ID_clinica) REFERENCES cl�nica (ID_clinica)
ALTER TABLE avalia_avalia��o ADD FOREIGN KEY(ID_clinica) REFERENCES cl�nica (ID_clinica)
