-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 11-Ago-2023 às 04:50
-- Versão do servidor: 10.4.24-MariaDB
-- versão do PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `araclin`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `avalia_avaliacao`
--

CREATE TABLE `avalia_avaliacao` (
  `ID_avaliacao` int(11) NOT NULL,
  `ID_usuario` int(11) DEFAULT NULL,
  `ID_clinica` int(11) DEFAULT NULL,
  `Texto_avaliacao` text DEFAULT NULL,
  `Nota_avaliacao` decimal(4,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `clinica`
--

CREATE TABLE `clinica` (
  `ID_clinica` int(11) NOT NULL,
  `Forma_pagamento_clinica` varchar(100) DEFAULT NULL,
  `Email_clinica` varchar(50) DEFAULT NULL,
  `Telefone_clinica` varchar(15) DEFAULT NULL,
  `Whatsapp_clinica` varchar(15) DEFAULT NULL,
  `Instagram_clinica` varchar(50) DEFAULT NULL,
  `CNPJ` char(14) DEFAULT NULL,
  `foto_clinica` mediumblob DEFAULT NULL,
  `Especialidade_clinica` varchar(200) DEFAULT NULL,
  `Plano_saude_clinica` varchar(100) DEFAULT NULL,
  `Convenio_clinica` varchar(100) DEFAULT NULL,
  `Nome_fantasia_clinica` varchar(100) DEFAULT NULL,
  `Logradouro` varchar(50) DEFAULT NULL,
  `Bairro` varchar(50) DEFAULT NULL,
  `Numero` varchar(5) DEFAULT NULL,
  `Complemento` varchar(50) DEFAULT NULL,
  `Descricao_clinica` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `medico`
--

CREATE TABLE `medico` (
  `ID_medico` int(11) NOT NULL,
  `Nome_medico` varchar(100) DEFAULT NULL,
  `CRM_medico` varchar(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `possui_vinculo`
--

CREATE TABLE `possui_vinculo` (
  `ID_medico` int(11) DEFAULT NULL,
  `ID_clinica` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `recuperacao`
--

CREATE TABLE `recuperacao` (
  `ID_recuperacao` int(11) NOT NULL,
  `ID_usuario` int(11) DEFAULT NULL,
  `ID_clinica` int(11) DEFAULT NULL,
  `Codigo_recuperacao` varchar(50) DEFAULT NULL,
  `Tipo_recuperacao` char(2) DEFAULT NULL,
  `Validade_recuperacao` datetime DEFAULT NULL,
  `Status_recuperacao` char(1) DEFAULT NULL,
  `Data_recuperacao` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `ID_usuario` int(11) NOT NULL,
  `Nome_usuario` varchar(100) DEFAULT NULL,
  `Senha_usaurio` varchar(50) DEFAULT NULL,
  `CPF_usuario` varchar(11) DEFAULT NULL,
  `Data_nascimento_usuario` date DEFAULT NULL,
  `Genero_usuario` char(1) DEFAULT NULL,
  `Email_usuario` varchar(50) DEFAULT NULL,
  `Whatsapp_usuario` varchar(15) DEFAULT NULL,
  `Telefone_usuario` varchar(15) DEFAULT NULL,
  `RG_usuario` varchar(13) DEFAULT NULL,
  `Logradouro` varchar(50) DEFAULT NULL,
  `Numero` varchar(10) DEFAULT NULL,
  `Bairro` varchar(40) DEFAULT NULL,
  `CEP` varchar(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `avalia_avaliacao`
--
ALTER TABLE `avalia_avaliacao`
  ADD PRIMARY KEY (`ID_avaliacao`),
  ADD KEY `ID_usuario` (`ID_usuario`),
  ADD KEY `ID_clinica` (`ID_clinica`);

--
-- Índices para tabela `clinica`
--
ALTER TABLE `clinica`
  ADD PRIMARY KEY (`ID_clinica`);

--
-- Índices para tabela `medico`
--
ALTER TABLE `medico`
  ADD PRIMARY KEY (`ID_medico`);

--
-- Índices para tabela `possui_vinculo`
--
ALTER TABLE `possui_vinculo`
  ADD KEY `ID_medico` (`ID_medico`),
  ADD KEY `ID_clinica` (`ID_clinica`);

--
-- Índices para tabela `recuperacao`
--
ALTER TABLE `recuperacao`
  ADD PRIMARY KEY (`ID_recuperacao`),
  ADD KEY `ID_usuario` (`ID_usuario`),
  ADD KEY `ID_clinica` (`ID_clinica`);

--
-- Índices para tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`ID_usuario`);

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `avalia_avaliacao`
--
ALTER TABLE `avalia_avaliacao`
  ADD CONSTRAINT `avalia_avaliacao_ibfk_1` FOREIGN KEY (`ID_usuario`) REFERENCES `usuario` (`ID_usuario`),
  ADD CONSTRAINT `avalia_avaliacao_ibfk_2` FOREIGN KEY (`ID_clinica`) REFERENCES `clinica` (`ID_clinica`);

--
-- Limitadores para a tabela `possui_vinculo`
--
ALTER TABLE `possui_vinculo`
  ADD CONSTRAINT `possui_vinculo_ibfk_1` FOREIGN KEY (`ID_medico`) REFERENCES `medico` (`ID_medico`),
  ADD CONSTRAINT `possui_vinculo_ibfk_2` FOREIGN KEY (`ID_clinica`) REFERENCES `clinica` (`ID_clinica`);

--
-- Limitadores para a tabela `recuperacao`
--
ALTER TABLE `recuperacao`
  ADD CONSTRAINT `recuperacao_ibfk_1` FOREIGN KEY (`ID_usuario`) REFERENCES `usuario` (`ID_usuario`),
  ADD CONSTRAINT `recuperacao_ibfk_2` FOREIGN KEY (`ID_clinica`) REFERENCES `clinica` (`ID_clinica`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
