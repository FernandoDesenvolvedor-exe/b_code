-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 06-Out-2023 às 02:40
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
-- Estrutura da tabela `receita`
--

CREATE TABLE `receita` (
  `idReceita` int(11) NOT NULL COMMENT 'PK - chave identificadora da relação da do produto e as matérias primas.',
  `idProduto` int(11) NOT NULL COMMENT 'Fk - chave estrangeira que identifica o produto usado relacionado com a matéria prima',
  `idMateriaPrima` int(11) NOT NULL COMMENT 'Fk - chave estrangeira que identifica o matéria prima usada relacionado com o produto.',
  `descricao` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT 'Descrição da situação onde as duas ids de produto e matéria prima se relacionam'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Tabela que registra a relação de um produto com uma matéria ';

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `receita`
--
ALTER TABLE `receita`
  ADD PRIMARY KEY (`idReceita`),
  ADD KEY `FK_idProduto` (`idProduto`),
  ADD KEY `FK_idMateriaPrima` (`idMateriaPrima`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `receita`
--
ALTER TABLE `receita`
  MODIFY `idReceita` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK - chave identificadora da relação da do produto e as matérias primas.';

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `receita`
--
ALTER TABLE `receita`
  ADD CONSTRAINT `receita_ibfk_1` FOREIGN KEY (`idProduto`) REFERENCES `produtos` (`idProduto`),
  ADD CONSTRAINT `receita_ibfk_2` FOREIGN KEY (`idMateriaPrima`) REFERENCES `materia_prima` (`idMateriaPrima`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
