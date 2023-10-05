-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 06-Out-2023 às 01:18
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
-- Estrutura da tabela `materia_prima`
--

CREATE TABLE `materia_prima` (
  `idMateriaPrima` int(11) NOT NULL COMMENT 'PK - chave identificadora das matérias primas salvas no estoque ',
  `idClasse` int(11) NOT NULL COMMENT 'FK - chave estrangeira que identifica a classe da matéria prima(comodities e engenharia) ',
  `idTipoMateria` int(11) NOT NULL COMMENT 'FK - chave estrangeira que identifica o tipo de matéria prima(virgem, reciclado, remoido, scrap). ',
  `descricao` varchar(50) COLLATE utf8_bin NOT NULL COMMENT 'Descrição da matéria prima(Nome). '
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Salva os registros de Cadastros e alterações no estoque';

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `materia_prima`
--
ALTER TABLE `materia_prima`
  ADD PRIMARY KEY (`idMateriaPrima`),
  ADD KEY `FK_idClasse` (`idClasse`) USING BTREE,
  ADD KEY `FK_idTipoMateria` (`idTipoMateria`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `materia_prima`
--
ALTER TABLE `materia_prima`
  MODIFY `idMateriaPrima` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK - chave identificadora das matérias primas salvas no estoque ';

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `materia_prima`
--
ALTER TABLE `materia_prima`
  ADD CONSTRAINT `materia_prima_ibfk_1` FOREIGN KEY (`idClasse`) REFERENCES `classe_material` (`idClasse`),
  ADD CONSTRAINT `materia_prima_ibfk_2` FOREIGN KEY (`idTipoMateria`) REFERENCES `tipo_materia_prima` (`idTipoMateriaPrima`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
