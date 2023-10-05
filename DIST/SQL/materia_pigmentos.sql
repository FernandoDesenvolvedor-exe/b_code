-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 06-Out-2023 às 01:20
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
-- Estrutura da tabela `materia_pigmentos`
--

CREATE TABLE `materia_pigmentos` (
  `idMaterialPigmento` int(11) NOT NULL COMMENT 'PK - codigo identificador da tebela materia_pigmentos',
  `idMaterial` int(11) NOT NULL COMMENT 'FK - chave estrangeira da tabela materiaPrima',
  `idPigmento` int(11) NOT NULL COMMENT 'FK - chave estrangeira da tabela do pigmento',
  `descricao` varchar(80) NOT NULL COMMENT 'descricao da materia_pigmentos'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='tabela com as relações permitidas entre materia e pigmento';

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `materia_pigmentos`
--
ALTER TABLE `materia_pigmentos`
  ADD PRIMARY KEY (`idMaterialPigmento`),
  ADD KEY `idPigmento` (`idPigmento`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `materia_pigmentos`
--
ALTER TABLE `materia_pigmentos`
  MODIFY `idMaterialPigmento` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK - codigo identificador da tebela materia_pigmentos';

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `materia_pigmentos`
--
ALTER TABLE `materia_pigmentos`
  ADD CONSTRAINT `materia_pigmentos_ibfk_1` FOREIGN KEY (`idPigmento`) REFERENCES `pigmentos` (`idPigmento`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
