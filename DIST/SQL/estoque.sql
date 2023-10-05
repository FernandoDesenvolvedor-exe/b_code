-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 05-Out-2023 às 02:47
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
-- Estrutura da tabela `maquinas`
--

CREATE TABLE `maquinas` (
  `idMaquina` int(11) NOT NULL COMMENT 'PK - chave identificadora das maquinas usadas para fazer os produtos',
  `decricao` varchar(50) COLLATE utf8_bin NOT NULL COMMENT 'descrição da maquina registrada'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Tabela para registro das maquinas a serem usadas na receita';

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedidos`
--

CREATE TABLE `pedidos` (
  `idPedido` int(11) NOT NULL COMMENT 'PK - chave identificadora da tabela Pedidos.',
  `idProduto` int(11) NOT NULL COMMENT 'FK - Chave estrangeira para identificar qual o produto relacionado ao pedido',
  `idUsuario` int(11) NOT NULL COMMENT 'FK - Chave estrangeira para identificar qual o usuário abriu o pedido',
  `DataHora_aberto` datetime NOT NULL COMMENT 'Salva a data e a hora em que o pedido foi aberto',
  `DataHora_fechado` datetime NOT NULL COMMENT 'Salva a data e a hora em que o pedido foi fechado',
  `Status` tinyint(1) NOT NULL COMMENT 'Identifica se um pedido está em aberto ou se ja foi fechado:\r\naberto(1);\r\nfechado(2)',
  `Observacoes` varchar(80) COLLATE utf8_bin DEFAULT NULL COMMENT 'Permite gravar observações sobre um pedido. Ex: \r\npedido feito programou 500g de matéria prima para fazer 500 copos mas acabou fazendo apenas 490 copos.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Tabela que registra os pedidos feito pelo usuário';

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

CREATE TABLE `produtos` (
  `idProduto` int(11) NOT NULL COMMENT 'PK - chave identificadora da tabela produtos, onde cada id representa um produto feito.',
  `decricao` varchar(80) COLLATE utf8_bin NOT NULL COMMENT 'descrição do produto feito'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Tabela que identifica o produto feito ';

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos_maquinas`
--

CREATE TABLE `produtos_maquinas` (
  `idProduto_maquina` int(11) NOT NULL COMMENT 'PK - chave identificadora da tabela associativa produtos_maquinas. Mostra qual maquina esta sendo usada para qual produto',
  `idProduto` int(11) NOT NULL COMMENT 'FK - chave estrangeira que identifica qual produto uma maquina esta fazendo.',
  `idMaquina` int(11) NOT NULL COMMENT 'FK - chave estrangeira que identifica qual maquina esta realizando uma tarefa conforme indicada no pedido.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Tabela associatica entre produtos e maquinas ';

-- --------------------------------------------------------

--
-- Estrutura da tabela `turma`
--

CREATE TABLE `turma` (
  `idTurma` int(11) NOT NULL COMMENT 'PK - chave identificadora da turma a qual o usuário pertence\r\nOBS: o admin não necessita estar em uma turma',
  `Turno` char(1) COLLATE utf8_bin DEFAULT NULL COMMENT 'Mostra a qual turno uma turma pertence',
  `NomeTurma` varchar(32) COLLATE utf8_bin DEFAULT NULL COMMENT 'Nome da turma. \r\nEx: TDesi Senai/N1',
  `Ativo` char(1) COLLATE utf8_bin DEFAULT NULL COMMENT 'Se a conta podea ou não pode ser usada'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Tabela que salva as informações sobre a turma dos usuários ';

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `idUsuario` int(11) NOT NULL COMMENT 'Pk - Chave identificadora dos usuários que farão uso do sistema',
  `Login` varchar(50) COLLATE utf8_bin NOT NULL COMMENT 'Identificação de login do usuário',
  `Senha` varchar(32) COLLATE utf8_bin NOT NULL COMMENT 'Senha de acesso ao sistema para o usuário.',
  `Nome` varchar(80) COLLATE utf8_bin NOT NULL COMMENT 'Nome do usuário.',
  `idTurma` int(11) NOT NULL COMMENT 'FK - Chave estrangeira da tabela turma que permite ver a qual turma um usuário está cadastrado.',
  `Tipo` tinyint(1) NOT NULL COMMENT 'Nível de acesso dos usuários:\r\nadministrador(1);\r\nusuário comum(2).  ',
  `Ativo` char(1) COLLATE utf8_bin NOT NULL COMMENT 'Serve para ver se uma conta ainda está ativa.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Tabela de registro dos usuários cadastrados  no sistema';

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `maquinas`
--
ALTER TABLE `maquinas`
  ADD PRIMARY KEY (`idMaquina`);

--
-- Índices para tabela `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`idPedido`),
  ADD KEY `FK_idUsuario` (`idUsuario`),
  ADD KEY `FK_idProduto` (`idProduto`);

--
-- Índices para tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`idProduto`);

--
-- Índices para tabela `produtos_maquinas`
--
ALTER TABLE `produtos_maquinas`
  ADD PRIMARY KEY (`idProduto_maquina`),
  ADD KEY `FK_idProduto` (`idProduto`),
  ADD KEY `FK_idMaquina` (`idMaquina`) USING BTREE;

--
-- Índices para tabela `turma`
--
ALTER TABLE `turma`
  ADD PRIMARY KEY (`idTurma`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUsuario`),
  ADD KEY `FK_idTurma` (`idTurma`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `maquinas`
--
ALTER TABLE `maquinas`
  MODIFY `idMaquina` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK - chave identificadora das maquinas usadas para fazer os produtos';

--
-- AUTO_INCREMENT de tabela `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `idPedido` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK - chave identificadora da tabela Pedidos.';

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `idProduto` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK - chave identificadora da tabela produtos, onde cada id representa um produto feito.';

--
-- AUTO_INCREMENT de tabela `produtos_maquinas`
--
ALTER TABLE `produtos_maquinas`
  MODIFY `idProduto_maquina` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK - chave identificadora da tabela associativa produtos_maquinas. Mostra qual maquina esta sendo usada para qual produto';

--
-- AUTO_INCREMENT de tabela `turma`
--
ALTER TABLE `turma`
  MODIFY `idTurma` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK - chave identificadora da turma a qual o usuário pertence\r\nOBS: o admin não necessita estar em uma turma';

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Pk - Chave identificadora dos usuários que farão uso do sistema';

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idUsuario`),
  ADD CONSTRAINT `pedidos_ibfk_2` FOREIGN KEY (`idProduto`) REFERENCES `produtos` (`idProduto`);

--
-- Limitadores para a tabela `produtos_maquinas`
--
ALTER TABLE `produtos_maquinas`
  ADD CONSTRAINT `produtos_maquinas_ibfk_1` FOREIGN KEY (`idProduto`) REFERENCES `produtos` (`idProduto`),
  ADD CONSTRAINT `produtos_maquinas_ibfk_2` FOREIGN KEY (`idMaquina`) REFERENCES `maquinas` (`idMaquina`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;





#___alterações____