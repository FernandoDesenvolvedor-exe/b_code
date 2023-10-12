-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 12-Out-2023 às 03:19
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
-- Banco de dados: `lab_plasticos`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `idUsuario` int(11) NOT NULL COMMENT 'Pk - Chave identificadora dos usuários que farão uso do sistema',
  `login` varchar(50) COLLATE utf8_bin NOT NULL COMMENT 'Identificação de login do usuário',
  `senha` varchar(32) COLLATE utf8_bin NOT NULL COMMENT 'Senha de acesso ao sistema para o usuário.',
  `nome` varchar(80) COLLATE utf8_bin NOT NULL COMMENT 'Nome do usuário.',
  `sobrenome` varchar(80) COLLATE utf8_bin NOT NULL COMMENT 'Registra o sobrenome do usuários',
  `idTurma` int(11) NOT NULL COMMENT 'FK - Chave estrangeira da tabela turma que permite ver a qual turma um usuário está cadastrado.',
  `tipo` tinyint(1) NOT NULL COMMENT 'Nível de acesso dos usuários:\r\nadministrador(1);\r\nusuário comum(2).  ',
  `ativo` char(1) COLLATE utf8_bin NOT NULL COMMENT 'Serve para ver se uma conta ainda está ativa.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Tabela de registro dos usuários cadastrados  no sistema';

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `login`, `senha`, `nome`, `sobrenome`, `idTurma`, `tipo`, `ativo`) VALUES
(1, 'a@teste.com', '123', 'Teste', 'Testudo de teste', 1, 2, 'S');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUsuario`),
  ADD KEY `FK_idTurma` (`idTurma`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
