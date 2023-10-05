-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 06-Out-2023 às 00:08
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
-- Estrutura da tabela `ferramental_maquinas`
--

CREATE TABLE `ferramental_maquinas` (
  `idFerramentalMaquina` int(11) NOT NULL COMMENT 'PK - chave identificadora da tabela associativa ferramental_maquinas',
  `idFerramental` int(11) NOT NULL COMMENT 'FK - chave estrangeira que registra o ferramental usado na relação ferramental/maquina',
  `idMaquina` int(11) NOT NULL COMMENT 'FK - chave estrangeira que registra o id da maquina usada na relação ferramental/maquina',
  `descricao` int(11) DEFAULT NULL COMMENT 'Uma observação do processo não obrigatória.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='tabela associativa resultante de relação muitos pra muitos';

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `ferramental_maquinas`
--
ALTER TABLE `ferramental_maquinas`
  ADD PRIMARY KEY (`idFerramentalMaquina`),
  ADD KEY `FK_idMaquina` (`idMaquina`) USING BTREE,
  ADD KEY `FK_idFerramental` (`idFerramental`) USING BTREE;

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `ferramental_maquinas`
--
ALTER TABLE `ferramental_maquinas`
  MODIFY `idFerramentalMaquina` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK - chave identificadora da tabela associativa ferramental_maquinas';

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `ferramental_maquinas`
--
ALTER TABLE `ferramental_maquinas`
  ADD CONSTRAINT `ferramental_maquinas_ibfk_1` FOREIGN KEY (`idFerramental`) REFERENCES `ferramental` (`idFerramental`),
  ADD CONSTRAINT `ferramental_maquinas_ibfk_2` FOREIGN KEY (`idMaquina`) REFERENCES `maquinas` (`idMaquina`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
