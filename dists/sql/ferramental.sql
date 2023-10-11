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
-- Estrutura da tabela `ferramental`
--

CREATE TABLE `ferramental` (
  `idFerramental` int(11) NOT NULL COMMENT 'PK - chave identificadora da tabela ferramental.',
  `idProduto` int(11) NOT NULL COMMENT 'FK - chave estrangeira que irá identificar o produto relacionado ao ferramental usado.',
  `idTipoFerramental` int(11) NOT NULL COMMENT 'FK - chave estrangeira que irá relacionar o tipo de ferramenta com o ferramental.',
  `descricao` varchar(80) COLLATE utf8_bin NOT NULL COMMENT 'Descrição do ferramental usado'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Tabela com os registros do ferramental usado na receita';

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `ferramental`
--
ALTER TABLE `ferramental`
  ADD PRIMARY KEY (`idFerramental`),
  ADD KEY `FK_idTipoFerramental` (`idTipoFerramental`),
  ADD KEY `FK_idProduto` (`idProduto`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `ferramental`
--
ALTER TABLE `ferramental`
  MODIFY `idFerramental` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK - chave identificadora da tabela ferramental.';

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `ferramental`
--
ALTER TABLE `ferramental`
  ADD CONSTRAINT `ferramental_ibfk_1` FOREIGN KEY (`idProduto`) REFERENCES `produtos` (`idProduto`),
  ADD CONSTRAINT `ferramental_ibfk_2` FOREIGN KEY (`idTipoFerramental`) REFERENCES `tiposferramental` (`idTipoFerramental`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
