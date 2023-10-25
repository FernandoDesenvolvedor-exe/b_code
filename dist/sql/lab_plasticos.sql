-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 25-Out-2023 às 02:26
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
-- Estrutura da tabela `classe_material`
--

CREATE TABLE `classe_material` (
  `idClasse` int(11) NOT NULL COMMENT 'PK - chave identificadora que guarda a id de cada classe da matéria prima',
  `descricao` varchar(32) COLLATE utf8_bin NOT NULL COMMENT 'Descrição da classe da matéria prima(comodities, engenharia)',
  `ativo` tinyint(1) NOT NULL COMMENT 'Verifica se a classe esta ativa'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Registro da classe associada a uma matéria prima';

--
-- Extraindo dados da tabela `classe_material`
--

INSERT INTO `classe_material` (`idClasse`, `descricao`, `ativo`) VALUES
(1, 'Comodities', 1),
(2, 'Engenharia', 1),
(3, 'Retrabalho', 0),
(4, 'Retrabalho', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `ferramental`
--

CREATE TABLE `ferramental` (
  `idFerramental` int(11) NOT NULL COMMENT 'PK - chave identificadora de IDs da tabela ferramental',
  `descricao` varchar(80) NOT NULL COMMENT 'Descrição de um ferramental(Nome)',
  `ativo` tinyint(1) NOT NULL COMMENT 'Registra se este item esta ativo',
  `idTiposFerramental` int(11) NOT NULL COMMENT 'FK - chave estrangeira da tabela tipos_ferramental',
  `idProduto` int(11) NOT NULL COMMENT 'FK - chave estrangeira da tabela produtos '
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Tabela que registra os dados do ferramental cadastrado';

--
-- Extraindo dados da tabela `ferramental`
--

INSERT INTO `ferramental` (`idFerramental`, `descricao`, `ativo`, `idTiposFerramental`, `idProduto`) VALUES
(2, 'CAP654845', 1, 1, 2),
(3, 'BEC5788', 1, 2, 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `ferramental_maquina`
--

CREATE TABLE `ferramental_maquina` (
  `idFerramental` int(11) NOT NULL COMMENT 'PK/FK - chave composta identificadora de IDs da tabela ferramental',
  `idMaquina` int(11) NOT NULL COMMENT 'PK/FK - chave composta identificadora de IDs da tabela maquinas'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Tabela associativa entre ferramental e maquinas';

-- --------------------------------------------------------

--
-- Estrutura da tabela `fornecedores`
--

CREATE TABLE `fornecedores` (
  `idFornecedor` int(11) NOT NULL COMMENT 'PK - chave identificadora das ids de cada fornecedor',
  `descricao` varchar(50) NOT NULL COMMENT 'Descrição de cada fornecedor(Nome);',
  `ativo` tinyint(1) NOT NULL COMMENT 'Verifica se este fornecedor irá aparecer nas pesquisas.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Registro dos fornecedores de materiais do laboratório';

--
-- Extraindo dados da tabela `fornecedores`
--

INSERT INTO `fornecedores` (`idFornecedor`, `descricao`, `ativo`) VALUES
(1, 'COLORFIX', 1),
(2, 'CRISTAL MASTER', 1),
(3, '', 1),
(4, 'QUIMIDROL', 1),
(5, 'QUIMIOTEC', 1),
(6, 'EMBRACO', 1),
(7, '', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `maquinas`
--

CREATE TABLE `maquinas` (
  `idMaquina` int(11) NOT NULL COMMENT 'PK - chave identificadora das maquinas usadas para fazer os produtos',
  `descricao` varchar(50) COLLATE utf8_bin NOT NULL COMMENT 'descrição da maquina registrada',
  `ativo` tinyint(1) NOT NULL COMMENT 'Verifica se esta maquina esta ativa',
  `observacoes` text COLLATE utf8_bin NOT NULL COMMENT 'Registra observações feitas pelo usuário sobre a máquina em questão'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Tabela para registro das maquinas a serem usadas na receita';

--
-- Extraindo dados da tabela `maquinas`
--

INSERT INTO `maquinas` (`idMaquina`, `descricao`, `ativo`, `observacoes`) VALUES
(1, 'VF - 32', 1, ''),
(2, 'VF - 35', 1, '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `materia_fornecedor`
--

CREATE TABLE `materia_fornecedor` (
  `idMateriaPrima` int(11) NOT NULL COMMENT 'PK/FK - chave composta desta tabela associativa com a tabela materia_prima',
  `idFornecedor` int(11) NOT NULL COMMENT 'PK/FK - chave composta desta tabela associativa com a tabela fornecedores'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Tabela associatica entre materia_prima e fornecedores';

-- --------------------------------------------------------

--
-- Estrutura da tabela `materia_pigmento`
--

CREATE TABLE `materia_pigmento` (
  `idMateriaPrima` int(11) NOT NULL COMMENT 'PK/FK - chave composta identificadora de IDs da tabela materia_prima',
  `idPigmento` int(11) NOT NULL COMMENT 'PK/FK - chave composta identificadora de IDs da tabela pigmentos'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Tabela associatica entre materia_prima e pigmentos';

-- --------------------------------------------------------

--
-- Estrutura da tabela `materia_prima`
--

CREATE TABLE `materia_prima` (
  `idMateriaPrima` int(11) NOT NULL COMMENT 'PK - chave identificadora de IDs da tabela materia_prima',
  `idClasse` int(11) NOT NULL COMMENT 'FK - chave estrangeira da tabela pigmentos',
  `idTipoMateriaPrima` int(11) NOT NULL COMMENT 'FK - chave estrangeira da tabela tipo_materia_prima',
  `descricao` varchar(80) NOT NULL COMMENT 'Registra a descrição deste item ',
  `quantidade` int(11) NOT NULL COMMENT 'registra a quantidade do item ',
  `ativo` tinyint(1) NOT NULL COMMENT 'Registra se este item está ativo',
  `observacoes` text DEFAULT NULL COMMENT 'Registra uma observação não obrigatória feita pelo usuário'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Tabela que registra as matérias primas do laboratório';

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedidos`
--

CREATE TABLE `pedidos` (
  `idPedido` int(11) NOT NULL COMMENT 'PK - chave identificadora da tabela Pedidos.',
  `idProduto` int(11) NOT NULL COMMENT 'FK - Chave estrangeira para identificar qual o produto relacionado ao pedido',
  `idUsuario` int(11) NOT NULL COMMENT 'FK - Chave estrangeira para identificar qual o usuário abriu o pedido',
  `DataHora_aberto` datetime NOT NULL COMMENT 'Salva a data e a hora em que o pedido foi aberto',
  `DataHora_fechado` datetime DEFAULT NULL COMMENT 'Salva a data e a hora em que o pedido foi fechado',
  `Status` tinyint(1) NOT NULL COMMENT 'Identifica se um pedido está em aberto ou se ja foi fechado:\r\naberto(1);\r\nfechado(2)',
  `Observacoes` varchar(80) COLLATE utf8_bin DEFAULT NULL COMMENT 'Permite gravar observações sobre um pedido. Ex: \r\npedido feito programou 500g de matéria prima para fazer 500 copos mas acabou fazendo apenas 490 copos.',
  `quantidade` int(11) NOT NULL COMMENT 'Mostra a quantidade de um produto a ser feito no pedido'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Tabela que registra os pedidos feito pelo usuário';

-- --------------------------------------------------------

--
-- Estrutura da tabela `pigmentos`
--

CREATE TABLE `pigmentos` (
  `idPigmento` int(11) NOT NULL COMMENT 'PK - codigo identificador do pigmento',
  `descricao` varchar(80) NOT NULL COMMENT 'descricao do pigmento',
  `idTipoPigmento` int(11) NOT NULL COMMENT 'FK - tipo de pigmento',
  `quantidade` int(11) NOT NULL COMMENT 'Mostra a quantidade de material de pigmento guardado no estoque',
  `codigo` varchar(32) DEFAULT NULL COMMENT 'Código de identificação do pigmento',
  `lote` varchar(32) DEFAULT NULL COMMENT 'Lote em que o pigmento foi comprado',
  `ativo` tinyint(1) NOT NULL COMMENT 'Verifica se o pigmento foi excluído do estoque ou não',
  `observacoes` text DEFAULT NULL COMMENT 'Observações que o usuário pode fazer sobre o pigmento'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `pigmentos`
--

INSERT INTO `pigmentos` (`idPigmento`, `descricao`, `idTipoPigmento`, `quantidade`, `codigo`, `lote`, `ativo`, `observacoes`) VALUES
(1, 'Verde claro', 1, 200, '5415466', 'B/656482', 1, NULL),
(2, 'Azul escuro', 2, 245, '48684Ad874', 'C/64882', 1, NULL),
(3, 'Vermelho', 1, 300, '94686545', 'A/48654', 1, NULL),
(4, 'Rosa', 1, 100, 'DS5995-89D', '64821', 1, ''),
(5, 'Verde folha', 2, 325, 'a789B/6S', '778945', 1, ''),
(6, 'Verde folha', 2, 325, 'a789B/6S', '778945', 1, ''),
(7, 'Azul marinho', 2, 100, '', '', 0, ''),
(8, 'Azul marinho', 2, 100, '', '', 1, ''),
(9, 'Marrom', 1, 500, '', '', 1, ''),
(10, 'asdas', 1, 100, '', '', 1, ''),
(11, 'asdasd', 1, 100, '', '', 0, ''),
(12, 'asdasd', 1, 100, '', '', 0, ''),
(13, 'asdasd', 1, 100, '', '', 0, ''),
(14, 'asdasd', 1, 100, '', '', 0, ''),
(15, 'asdasd', 1, 100, '', '', 0, ''),
(16, 'asdasd', 1, 100, '', '', 0, ''),
(17, 'asdasd', 1, 100, '', '', 0, '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pigmento_fornecedor`
--

CREATE TABLE `pigmento_fornecedor` (
  `idPigmento` int(11) NOT NULL COMMENT 'PK/FK - chave composta identificadora de IDs da tabela pigmentos',
  `idFornecedor` int(11) NOT NULL COMMENT 'PK/FK - chave composta identificadora de IDs da tabela fornecedores'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Tabela associativa entre pigmentos e fornecedores';

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

CREATE TABLE `produtos` (
  `idProduto` int(11) NOT NULL COMMENT 'PK - chave identificadora da tabela produtos, onde cada id representa um produto feito.',
  `descricao` varchar(80) COLLATE utf8_bin NOT NULL COMMENT 'descrição do produto feito',
  `imagem` blob DEFAULT NULL COMMENT 'Imagem do produto',
  `ativo` tinyint(1) NOT NULL COMMENT 'Verifica se este produto esta ativa'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Tabela que identifica o produto feito ';

--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`idProduto`, `descricao`, `imagem`, `ativo`) VALUES
(1, 'Suporte de carregador', '', 1),
(2, 'Capa de celular', 0x436170747572612064652074656c6120323032332d31302d3137203230343334322e706e67, 1),
(3, 'Becker', 0x436170747572612064652074656c6120323032332d31302d3234203139323930322e706e67, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto_maquina`
--

CREATE TABLE `produto_maquina` (
  `idProduto_maquina` int(11) NOT NULL COMMENT 'PK - chave identificadora de IDs da tabela associativa produto_maquina',
  `idProduto` int(11) NOT NULL COMMENT 'FK - chave estrangeira da tabela produtos',
  `idMaquina` int(11) NOT NULL COMMENT 'FK - chave estrangeira da tabela maquinas'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `receitas`
--

CREATE TABLE `receitas` (
  `idReceita` int(11) NOT NULL COMMENT 'PK - chave identificadora de IDs da tabela receitas',
  `quantidade` int(11) NOT NULL COMMENT 'registra a quantidade de matéria prima usada ',
  `observacoes` varchar(50) DEFAULT NULL COMMENT 'Registra observações feitas pelo usuário',
  `idProduto` int(11) NOT NULL COMMENT 'FK - chave estrangeira da tabela produtos',
  `idMateriaPrima` int(11) NOT NULL COMMENT 'FK - chave estrangeira da tabela matéria_prima',
  `ativo` tinyint(4) NOT NULL COMMENT 'Verifica se esta receita esta ativa',
  `quantidadeMateriaPrima` int(11) NOT NULL COMMENT 'Registra a quantidade de matéria prima na receita'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipos_ferramental`
--

CREATE TABLE `tipos_ferramental` (
  `idTiposFerramental` int(11) NOT NULL COMMENT 'PK - chave identificadora das ids dos tipos de moldes das maquinas.',
  `descricao` varchar(50) NOT NULL COMMENT 'Descrição do molde a ser usado(Nome e algumas observações).',
  `ativo` tinyint(1) NOT NULL COMMENT 'Verifica se esta maquina esta ativa'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Tabela de registro dos tipos de moldes usados no laboratório';

--
-- Extraindo dados da tabela `tipos_ferramental`
--

INSERT INTO `tipos_ferramental` (`idTiposFerramental`, `descricao`, `ativo`) VALUES
(1, 'Aluminio', 1),
(2, 'Aço', 1),
(3, 'Madeira', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo_materia_prima`
--

CREATE TABLE `tipo_materia_prima` (
  `idTipoMateriaPrima` int(11) NOT NULL COMMENT 'PK - chave identificadora de id dos tipos de matéria prima',
  `descricao` varchar(32) COLLATE utf8_bin NOT NULL COMMENT 'Descrição dos tipos de matéria prima(virgem, reciclado, remoído, scrap);',
  `ativo` tinyint(1) NOT NULL COMMENT 'Verifica se esta tipo de matéria prima esta ativa'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Tabela identificadora dos tipos de matéria prima ';

--
-- Extraindo dados da tabela `tipo_materia_prima`
--

INSERT INTO `tipo_materia_prima` (`idTipoMateriaPrima`, `descricao`, `ativo`) VALUES
(1, 'Virgem', 1),
(2, 'Reciclado', 1),
(3, 'Remoido', 1),
(4, 'Scrap', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo_pigmentos`
--

CREATE TABLE `tipo_pigmentos` (
  `idTipoPigmento` int(11) NOT NULL COMMENT 'PK - codigo identificador dos tipos de pigmentos',
  `descricao` varchar(80) NOT NULL COMMENT 'descricao do tipo pigmento',
  `ativo` tinyint(1) NOT NULL COMMENT 'Verifica se este tipo de pigmento esta ativo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tipo_pigmentos`
--

INSERT INTO `tipo_pigmentos` (`idTipoPigmento`, `descricao`, `ativo`) VALUES
(1, 'MB', 1),
(2, 'MTB', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `turma`
--

CREATE TABLE `turma` (
  `idTurma` int(11) NOT NULL COMMENT 'PK - chave identificadora da turma a qual o usuário pertence\r\nOBS: o admin não necessita estar em uma turma',
  `turno` char(1) COLLATE utf8_bin DEFAULT NULL COMMENT 'Mostra a qual turno uma turma pertence',
  `nomeTurma` varchar(32) COLLATE utf8_bin DEFAULT NULL COMMENT 'Nome da turma. \r\nEx: TDesi Senai/N1',
  `ativo` char(1) COLLATE utf8_bin DEFAULT NULL COMMENT 'Se a conta podea ou não pode ser usada'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Tabela que salva as informações sobre a turma dos usuários ';

--
-- Extraindo dados da tabela `turma`
--

INSERT INTO `turma` (`idTurma`, `turno`, `nomeTurma`, `ativo`) VALUES
(1, 'N', 'T DESI 2022', 'S'),
(2, 'M', 'Estilos de Moda', 'S'),
(3, 'V', 'Mecânica', 'S');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `idUsuario` int(11) NOT NULL COMMENT 'PK - chave identificadora de IDs da tabela usuarios',
  `login` varchar(80) NOT NULL COMMENT 'Registra o login de um usuário',
  `senha` varchar(32) NOT NULL COMMENT 'Registra a senha de um usuário',
  `nome` int(80) NOT NULL COMMENT 'Registra o primeiro nome do usuário',
  `sobrenome` int(80) NOT NULL COMMENT 'Registra o sobrenome do usuário',
  `idTurma` int(11) NOT NULL COMMENT 'FK - chave estrangeira que Registra a ID da turma do usuário',
  `tipo` tinyint(1) NOT NULL COMMENT 'Registra o tipo de usuário',
  `ativo` char(1) NOT NULL COMMENT 'Registra se o usuário estiver ativo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Tabela que registra os cadastros de suuarios';

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `classe_material`
--
ALTER TABLE `classe_material`
  ADD PRIMARY KEY (`idClasse`);

--
-- Índices para tabela `ferramental`
--
ALTER TABLE `ferramental`
  ADD PRIMARY KEY (`idFerramental`),
  ADD KEY `FK_idProduto` (`idProduto`),
  ADD KEY `FK_tipos_ferramental` (`idTiposFerramental`) USING BTREE;

--
-- Índices para tabela `ferramental_maquina`
--
ALTER TABLE `ferramental_maquina`
  ADD PRIMARY KEY (`idFerramental`,`idMaquina`),
  ADD KEY `FK_idFerramental` (`idFerramental`),
  ADD KEY `FK_idMaquina` (`idMaquina`);

--
-- Índices para tabela `fornecedores`
--
ALTER TABLE `fornecedores`
  ADD PRIMARY KEY (`idFornecedor`);

--
-- Índices para tabela `maquinas`
--
ALTER TABLE `maquinas`
  ADD PRIMARY KEY (`idMaquina`);

--
-- Índices para tabela `materia_fornecedor`
--
ALTER TABLE `materia_fornecedor`
  ADD PRIMARY KEY (`idMateriaPrima`,`idFornecedor`),
  ADD KEY `FK_idMateriaPrima` (`idMateriaPrima`),
  ADD KEY `FK_idFornecedor` (`idFornecedor`);

--
-- Índices para tabela `materia_pigmento`
--
ALTER TABLE `materia_pigmento`
  ADD PRIMARY KEY (`idMateriaPrima`,`idPigmento`),
  ADD KEY `FK_idMateriaPrima` (`idMateriaPrima`),
  ADD KEY `FK_idPigmento` (`idPigmento`);

--
-- Índices para tabela `materia_prima`
--
ALTER TABLE `materia_prima`
  ADD PRIMARY KEY (`idMateriaPrima`),
  ADD KEY `FK_idClasse` (`idClasse`),
  ADD KEY `FK_idTipoMateriaPrima` (`idTipoMateriaPrima`);

--
-- Índices para tabela `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`idPedido`),
  ADD KEY `FK_idProduto` (`idProduto`),
  ADD KEY `FK_idUsuario` (`idUsuario`);

--
-- Índices para tabela `pigmentos`
--
ALTER TABLE `pigmentos`
  ADD PRIMARY KEY (`idPigmento`),
  ADD KEY `FK_idTipoPigmento` (`idTipoPigmento`);

--
-- Índices para tabela `pigmento_fornecedor`
--
ALTER TABLE `pigmento_fornecedor`
  ADD PRIMARY KEY (`idPigmento`,`idFornecedor`),
  ADD KEY `FK_idPigmento` (`idPigmento`),
  ADD KEY `FK_idFornecedor` (`idFornecedor`);

--
-- Índices para tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`idProduto`);

--
-- Índices para tabela `produto_maquina`
--
ALTER TABLE `produto_maquina`
  ADD PRIMARY KEY (`idProduto_maquina`),
  ADD KEY `FK_idProduto` (`idProduto`),
  ADD KEY `FK_idMaquina` (`idMaquina`);

--
-- Índices para tabela `receitas`
--
ALTER TABLE `receitas`
  ADD PRIMARY KEY (`idReceita`),
  ADD KEY `FK_idMateriaPrima` (`idMateriaPrima`),
  ADD KEY `FK_idProduto` (`idProduto`);

--
-- Índices para tabela `tipos_ferramental`
--
ALTER TABLE `tipos_ferramental`
  ADD PRIMARY KEY (`idTiposFerramental`);

--
-- Índices para tabela `tipo_materia_prima`
--
ALTER TABLE `tipo_materia_prima`
  ADD PRIMARY KEY (`idTipoMateriaPrima`);

--
-- Índices para tabela `tipo_pigmentos`
--
ALTER TABLE `tipo_pigmentos`
  ADD PRIMARY KEY (`idTipoPigmento`);

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
-- AUTO_INCREMENT de tabela `classe_material`
--
ALTER TABLE `classe_material`
  MODIFY `idClasse` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK - chave identificadora que guarda a id de cada classe da matéria prima', AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `ferramental`
--
ALTER TABLE `ferramental`
  MODIFY `idFerramental` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK - chave identificadora de IDs da tabela ferramental', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `fornecedores`
--
ALTER TABLE `fornecedores`
  MODIFY `idFornecedor` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK - chave identificadora das ids de cada fornecedor', AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `maquinas`
--
ALTER TABLE `maquinas`
  MODIFY `idMaquina` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK - chave identificadora das maquinas usadas para fazer os produtos', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `materia_prima`
--
ALTER TABLE `materia_prima`
  MODIFY `idMateriaPrima` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK - chave identificadora de IDs da tabela materia_prima';

--
-- AUTO_INCREMENT de tabela `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `idPedido` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK - chave identificadora da tabela Pedidos.';

--
-- AUTO_INCREMENT de tabela `pigmentos`
--
ALTER TABLE `pigmentos`
  MODIFY `idPigmento` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK - codigo identificador do pigmento', AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `idProduto` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK - chave identificadora da tabela produtos, onde cada id representa um produto feito.', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `produto_maquina`
--
ALTER TABLE `produto_maquina`
  MODIFY `idProduto_maquina` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK - chave identificadora de IDs da tabela associativa produto_maquina';

--
-- AUTO_INCREMENT de tabela `receitas`
--
ALTER TABLE `receitas`
  MODIFY `idReceita` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK - chave identificadora de IDs da tabela receitas';

--
-- AUTO_INCREMENT de tabela `tipos_ferramental`
--
ALTER TABLE `tipos_ferramental`
  MODIFY `idTiposFerramental` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK - chave identificadora das ids dos tipos de moldes das maquinas.', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `tipo_materia_prima`
--
ALTER TABLE `tipo_materia_prima`
  MODIFY `idTipoMateriaPrima` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK - chave identificadora de id dos tipos de matéria prima', AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `tipo_pigmentos`
--
ALTER TABLE `tipo_pigmentos`
  MODIFY `idTipoPigmento` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK - codigo identificador dos tipos de pigmentos', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `turma`
--
ALTER TABLE `turma`
  MODIFY `idTurma` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK - chave identificadora da turma a qual o usuário pertence\r\nOBS: o admin não necessita estar em uma turma', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK - chave identificadora de IDs da tabela usuarios';

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `ferramental`
--
ALTER TABLE `ferramental`
  ADD CONSTRAINT `ferramental_ibfk_1` FOREIGN KEY (`idTiposFerramental`) REFERENCES `tipos_ferramental` (`idTiposFerramental`),
  ADD CONSTRAINT `ferramental_ibfk_2` FOREIGN KEY (`idProduto`) REFERENCES `produtos` (`idProduto`);

--
-- Limitadores para a tabela `ferramental_maquina`
--
ALTER TABLE `ferramental_maquina`
  ADD CONSTRAINT `ferramental_maquina_ibfk_1` FOREIGN KEY (`idFerramental`) REFERENCES `ferramental` (`idFerramental`),
  ADD CONSTRAINT `ferramental_maquina_ibfk_2` FOREIGN KEY (`idMaquina`) REFERENCES `maquinas` (`idMaquina`);

--
-- Limitadores para a tabela `materia_fornecedor`
--
ALTER TABLE `materia_fornecedor`
  ADD CONSTRAINT `materia_fornecedor_ibfk_1` FOREIGN KEY (`idFornecedor`) REFERENCES `fornecedores` (`idFornecedor`),
  ADD CONSTRAINT `materia_fornecedor_ibfk_2` FOREIGN KEY (`idMateriaPrima`) REFERENCES `materia_prima` (`idMateriaPrima`);

--
-- Limitadores para a tabela `materia_pigmento`
--
ALTER TABLE `materia_pigmento`
  ADD CONSTRAINT `materia_pigmento_ibfk_1` FOREIGN KEY (`idMateriaPrima`) REFERENCES `materia_prima` (`idMateriaPrima`),
  ADD CONSTRAINT `materia_pigmento_ibfk_2` FOREIGN KEY (`idPigmento`) REFERENCES `pigmentos` (`idPigmento`);

--
-- Limitadores para a tabela `materia_prima`
--
ALTER TABLE `materia_prima`
  ADD CONSTRAINT `materia_prima_ibfk_1` FOREIGN KEY (`idClasse`) REFERENCES `classe_material` (`idClasse`),
  ADD CONSTRAINT `materia_prima_ibfk_2` FOREIGN KEY (`idTipoMateriaPrima`) REFERENCES `tipo_materia_prima` (`idTipoMateriaPrima`);

--
-- Limitadores para a tabela `pigmento_fornecedor`
--
ALTER TABLE `pigmento_fornecedor`
  ADD CONSTRAINT `pigmento_fornecedor_ibfk_1` FOREIGN KEY (`idPigmento`) REFERENCES `pigmentos` (`idPigmento`),
  ADD CONSTRAINT `pigmento_fornecedor_ibfk_2` FOREIGN KEY (`idFornecedor`) REFERENCES `fornecedores` (`idFornecedor`);

--
-- Limitadores para a tabela `produto_maquina`
--
ALTER TABLE `produto_maquina`
  ADD CONSTRAINT `produto_maquina_ibfk_1` FOREIGN KEY (`idProduto`) REFERENCES `produtos` (`idProduto`),
  ADD CONSTRAINT `produto_maquina_ibfk_2` FOREIGN KEY (`idMaquina`) REFERENCES `maquinas` (`idMaquina`);

--
-- Limitadores para a tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`idTurma`) REFERENCES `turma` (`idTurma`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
