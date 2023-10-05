-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 06-Out-2023 às 00:07
-- Versão do servidor: 10.4.22-MariaDB
-- versão do PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `estoque`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tiposferramental`
--

CREATE TABLE `tiposferramental` (
  `idTipoFerramental` int(11) NOT NULL COMMENT 'PK - chave identificadora dos registros salvos em tiposFerramental.',
  `descricao` int(11) NOT NULL COMMENT 'Descrição dos tipos de ferramental.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Tabela com os registros dos tipos de Ferramental dos moldes ';

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `tiposferramental`
--
ALTER TABLE `tiposferramental`
  ADD PRIMARY KEY (`idTipoFerramental`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tiposferramental`
--
ALTER TABLE `tiposferramental`
  MODIFY `idTipoFerramental` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK - chave identificadora dos registros salvos em tiposFerramental.';
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
