DROP DATABASE lab_plasticos;
CREATE DATABASE lab_plasticos;
USE lab_plasticos;

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
(3, 'BEC5788', 1, 2, 3),
(4, 'arroz', 1, 3, 1),
(5, 'CAND5189', 1, 1, 10),
(6, 'LAGf48548', 1, 1, 10),
(7, 'LAGf48548', 1, 1, 10),
(8, 'LAGf48548', 1, 1, 10),
(9, 'LAGf48548', 1, 1, 10),
(10, 'CAPCEL84854', 1, 3, 11),
(11, 'GAL54842', 1, 3, 12),
(12, 'GAR8421588', 1, 3, 13);

-- --------------------------------------------------------

--
-- Estrutura da tabela `ferramental_maquina`
--

CREATE TABLE `ferramental_maquina` (
  `idFerramental` int(11) NOT NULL COMMENT 'PK/FK - chave composta identificadora de IDs da tabela ferramental',
  `idMaquina` int(11) NOT NULL COMMENT 'PK/FK - chave composta identificadora de IDs da tabela maquinas'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Tabela associativa entre ferramental e maquinas';

--
-- Extraindo dados da tabela `ferramental_maquina`
--

INSERT INTO `ferramental_maquina` (`idFerramental`, `idMaquina`) VALUES
(5, 1),
(5, 2),
(6, 1),
(6, 2),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(10, 3),
(11, 3),
(12, 1),
(12, 3);

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
(3, 'sdsdsdsd', 0),
(4, 'QUIMIDROL', 1),
(5, 'QUIMIOTEC', 1),
(6, 'EMBRACO', 0),
(7, 'asdasdervz', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `historico`
--

CREATE TABLE `historico` (
  `idHistorico` int(11) NOT NULL COMMENT 'Chave identificadora de registros da tabela histórico',
  `nomeUsuario` varchar(80) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT 'Registra o nome do usuário que fez o pedido',
  `tipoUsuario` tinyint(1) NOT NULL COMMENT 'Registra o nível de acesso de quem fez o pedido',
  `turma` varchar(32) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT 'Registra a turma de quem fez o pedido. Se foi um adm, este valor será nulo',
  `turno` char(1) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT 'Registra o turno de quem fez o pedido. Se foi um adm, este valor será nulo',
  `idPedido` int(11) NOT NULL COMMENT 'Chave identificadora de registros da tabela pedidos',
  `materiaPrima` varchar(80) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT 'Registra a matéria prima usada em um pedido',
  `tipoMateria_prima` varchar(80) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT 'Registra o tipo de matéria prima usada em um pedido',
  `classeMateria_prima` varchar(80) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT 'Registra a classe de matéria prima usada em um pedido',
  `pigmento` varchar(80) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT 'Registro de pigmento usado em um pedido',
  `tipoPigmento` varchar(80) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT 'Registra o tipo de pigmento usado em um pedido',
  `produto` varchar(80) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT 'Registro de produto de um pedido',
  `maquina` varchar(80) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT 'Registro de máquina usada para atender um pedido',
  `quantidadeProduto` int(11) NOT NULL COMMENT 'Registra a quantidade de produtos feitos em um pedido',
  `quantidadeMateria_prima` float NOT NULL COMMENT 'Registra a quantidade de matéria prima usada em uma receita',
  `quantidadePigmento` float NOT NULL COMMENT 'registra a quantidade de pigmento usado em uma receita',
  `dataHora_aberto` datetime DEFAULT NULL COMMENT 'Registra a data e hora em que um pedido foi aberto ',
  `dataHora_fechado` datetime DEFAULT NULL COMMENT 'Registra a data e hora em que um pedido foi fechado',
  `dataHora_alterado` datetime DEFAULT NULL COMMENT 'Registra a data e hora em que um pedido foi alterado',
  `statusPedido` tinyint(1) NOT NULL COMMENT 'Registra o status de um pedido da tabela pedidos',
  `obsPedido` text CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL COMMENT 'Registra as observações registradas na tabela pedidos',
  `ativo` tinyint(1) NOT NULL COMMENT 'Registra o estado em que um registro do histórico se encontra(0 - desativado/1 - ativo)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Registro de histórico de pedidos';

--
-- Extraindo dados da tabela `historico`
--

INSERT INTO `historico` (`idHistorico`, `nomeUsuario`, `tipoUsuario`, `turma`, `turno`, `idPedido`, `materiaPrima`, `tipoMateria_prima`, `classeMateria_prima`, `pigmento`, `tipoPigmento`, `produto`, `maquina`, `quantidadeProduto`, `quantidadeMateria_prima`, `quantidadePigmento`, `dataHora_aberto`, `dataHora_fechado`, `dataHora_alterado`, `statusPedido`, `obsPedido`, `ativo`) VALUES
(1, '5', 0, '', '', 31, 'Poliéster', 'Virgem', 'Comodities', 'Amarelo', 'MTB', 'garrafinha', '', 50, 15, 5, NULL, NULL, NULL, 1, '', 1),
(2, '5', 0, '', '', 34, 'Etil-benzeno', 'Virgem', 'Comodities', 'Amarelo', 'MTB', 'garrafinha', '3', 50, 15, 5, '2023-11-14 19:37:51', NULL, NULL, 2, '', 1),
(3, '5', 0, '', '', 34, 'Poliéster', 'Virgem', 'Comodities', 'Amarelo', 'MTB', 'garrafinha', '3', 50, 15, 5, '2023-11-14 19:37:51', NULL, NULL, 2, '', 1),
(4, '5', 0, '', '', 35, 'Etil-benzeno', 'Virgem', 'Comodities', 'Amarelo', 'MTB', 'garrafinha', '3', 50, 15, 5, '2023-11-14 19:40:14', NULL, NULL, 2, '', 1),
(5, '5', 0, '', '', 35, 'Poliéster', 'Virgem', 'Comodities', 'Amarelo', 'MTB', 'garrafinha', '3', 50, 15, 5, '2023-11-14 19:40:14', NULL, NULL, 2, '', 1),
(6, '5', 0, '', '', 37, 'Array', 'Virgem', 'Comodities', 'Roxo', 'MB', 'Galao', '', 50, 30, 15, NULL, NULL, NULL, 1, '', 1),
(7, '5', 0, '', '', 38, 'Etil-benzeno', 'Virgem', 'Comodities', 'Roxo', 'MB', 'Galao', '', 50, 30, 15, NULL, NULL, NULL, 1, '', 1),
(8, '5', 0, '', '', 39, 'Polistileno', 'Virgem', 'Comodities', 'Roxo', 'MB', 'garrafinha', '', 50, 45, 5, NULL, NULL, NULL, 1, '', 1);

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
(2, 'VF - 35', 0, ''),
(3, 'VF - 44', 1, ''),
(4, 'VF - 29', 1, '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `materia_fornecedor`
--

CREATE TABLE `materia_fornecedor` (
  `idMateriaPrima` int(11) NOT NULL COMMENT 'PK/FK - chave composta desta tabela associativa com a tabela materia_prima',
  `idFornecedor` int(11) NOT NULL COMMENT 'PK/FK - chave composta desta tabela associativa com a tabela fornecedores'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Tabela associatica entre materia_prima e fornecedores';

--
-- Extraindo dados da tabela `materia_fornecedor`
--

INSERT INTO `materia_fornecedor` (`idMateriaPrima`, `idFornecedor`) VALUES
(1, 2),
(2, 5),
(8, 2),
(9, 5);

-- --------------------------------------------------------

--
-- Estrutura da tabela `materia_pigmento`
--

CREATE TABLE `materia_pigmento` (
  `idMateriaPrima` int(11) NOT NULL COMMENT 'PK/FK - chave composta identificadora de IDs da tabela materia_prima',
  `idPigmento` int(11) NOT NULL COMMENT 'PK/FK - chave composta identificadora de IDs da tabela pigmentos'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Tabela associatica entre materia_prima e pigmentos';

--
-- Extraindo dados da tabela `materia_pigmento`
--

INSERT INTO `materia_pigmento` (`idMateriaPrima`, `idPigmento`) VALUES
(1, 4),
(1, 5),
(3, 4),
(5, 4),
(5, 5),
(8, 1),
(8, 4),
(9, 4),
(9, 5);

-- --------------------------------------------------------

--
-- Estrutura da tabela `materia_prima`
--

CREATE TABLE `materia_prima` (
  `idMateriaPrima` int(11) NOT NULL COMMENT 'PK - chave identificadora de IDs da tabela materia_prima',
  `idClasse` int(11) NOT NULL COMMENT 'FK - chave estrangeira da tabela pigmentos',
  `idTipoMateriaPrima` int(11) NOT NULL COMMENT 'FK - chave estrangeira da tabela tipo_materia_prima',
  `descricao` varchar(80) NOT NULL COMMENT 'Registra a descrição deste item ',
  `quantidade` float NOT NULL COMMENT 'registra a quantidade do item ',
  `ativo` tinyint(1) NOT NULL COMMENT 'Registra se este item está ativo',
  `observacoes` text DEFAULT NULL COMMENT 'Registra uma observação não obrigatória feita pelo usuário'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Tabela que registra as matérias primas do laboratório';

--
-- Extraindo dados da tabela `materia_prima`
--

INSERT INTO `materia_prima` (`idMateriaPrima`, `idClasse`, `idTipoMateriaPrima`, `descricao`, `quantidade`, `ativo`, `observacoes`) VALUES
(1, 1, 2, 'plastico', 500, 0, NULL),
(2, 1, 1, 'Polistileno', 300, 0, NULL),
(3, 2, 4, 'Polioneto de carbonato', 400, 0, NULL),
(4, 1, 3, 'Sódio', 200, 0, NULL),
(5, 2, 1, 'Polistileno', 100, 1, NULL),
(6, 2, 3, 'Exopor', 50, 0, NULL),
(7, 1, 1, 'Java', 1, 0, NULL),
(8, 1, 1, 'Etil-benzeno', 256, 1, 'Não usar sem autorização do professor '),
(9, 1, 1, 'Poliéster', 100, 1, '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedidos`
--

CREATE TABLE `pedidos` (
  `idPedido` int(11) NOT NULL COMMENT 'PK - chave identificadora de IDs da tabela pedidos',
  `idUsuario` int(11) NOT NULL COMMENT 'FK - chave estrangeira da tabela usuarios',
  `idReceita` int(11) NOT NULL COMMENT 'Registra a id de uma receita usada em um pedido',
  `idMaquina` int(11) DEFAULT NULL COMMENT 'Registra em qual máquina o pedido será atendido',
  `dataHora_aberto` datetime DEFAULT NULL COMMENT 'Data e hora da abertura deste pedido',
  `dataHora_fechado` datetime DEFAULT NULL COMMENT 'Data e hora do fechamento deste pedido',
  `status` tinyint(1) NOT NULL COMMENT 'Status do pedido\r\n(0-cancelado/1-aberto/2-Em produção/3-concluido)',
  `observacoes` text DEFAULT NULL COMMENT 'Registro não obrigatório de observações do usuário',
  `refugo` int(11) DEFAULT NULL COMMENT 'Quantidade de refugo ',
  `quantidade` int(11) NOT NULL COMMENT 'Registra a quantidade de produtos selecionadas no pedido',
  `ativo` tinyint(1) NOT NULL COMMENT 'Registra se o item está ativo '
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Tabela que registra no banco de dados  um pedido';

--
-- Extraindo dados da tabela `pedidos`
--

INSERT INTO `pedidos` (`idPedido`, `idUsuario`, `idReceita`, `idMaquina`, `dataHora_aberto`, `dataHora_fechado`, `status`, `observacoes`, `refugo`, `quantidade`, `ativo`) VALUES
(1, 4, 2, 1, '2023-11-07 17:19:29', '2023-11-08 19:38:07', 3, 'Perda de produção: 20 produtos.', NULL, 60, 1),
(2, 5, 1, 1, '2023-11-07 17:24:39', '0000-00-00 00:00:00', 3, '', NULL, 60, 0),
(3, 5, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '', NULL, 150, 0),
(4, 5, 1, 3, '2023-11-07 19:01:59', '0000-00-00 00:00:00', 2, '', NULL, 50, 0),
(5, 5, 2, 3, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '', NULL, 150, 0),
(6, 5, 1, 1, '2023-11-08 19:41:50', '2023-11-08 20:53:42', 3, '', NULL, 80, 1),
(7, 5, 2, NULL, NULL, NULL, 1, '', NULL, 50, 1),
(8, 5, 2, NULL, NULL, NULL, 1, '', NULL, 50, 1),
(9, 5, 2, NULL, NULL, NULL, 1, '', NULL, 50, 1),
(10, 5, 2, NULL, NULL, NULL, 1, '', NULL, 50, 1),
(11, 5, 2, NULL, NULL, NULL, 1, '', NULL, 50, 1),
(12, 5, 2, NULL, NULL, NULL, 1, '', NULL, 50, 1),
(13, 5, 2, NULL, NULL, NULL, 1, '', NULL, 50, 1),
(14, 5, 2, NULL, NULL, NULL, 1, '', NULL, 50, 1),
(15, 5, 2, NULL, NULL, NULL, 1, '', NULL, 50, 1),
(16, 5, 2, NULL, NULL, NULL, 1, '', NULL, 50, 1),
(17, 5, 2, NULL, NULL, NULL, 1, '', NULL, 50, 1),
(18, 5, 2, NULL, NULL, NULL, 1, '', NULL, 50, 1),
(19, 5, 2, NULL, NULL, NULL, 1, '', NULL, 50, 1),
(20, 5, 2, NULL, NULL, NULL, 1, '', NULL, 50, 1),
(21, 5, 2, NULL, NULL, NULL, 1, '', NULL, 50, 1),
(22, 5, 2, NULL, NULL, NULL, 1, '', NULL, 50, 1),
(23, 5, 2, NULL, NULL, NULL, 1, '', NULL, 50, 1),
(24, 5, 2, NULL, NULL, NULL, 1, '', NULL, 50, 1),
(25, 5, 2, NULL, NULL, NULL, 1, '', NULL, 50, 1),
(26, 5, 2, NULL, NULL, NULL, 1, '', NULL, 50, 1),
(27, 5, 2, NULL, NULL, NULL, 1, '', NULL, 50, 1),
(28, 5, 2, NULL, NULL, NULL, 1, '', NULL, 50, 1),
(29, 5, 2, NULL, NULL, NULL, 1, '', NULL, 50, 1),
(30, 5, 2, NULL, NULL, NULL, 1, '', NULL, 50, 1),
(31, 5, 2, NULL, NULL, NULL, 1, '', NULL, 50, 1),
(32, 5, 2, 3, '2023-11-14 19:36:48', NULL, 2, '', NULL, 50, 1),
(33, 5, 2, 3, '2023-11-14 19:37:24', NULL, 2, '', NULL, 50, 1),
(34, 5, 2, 3, '2023-11-14 19:37:51', NULL, 2, '', NULL, 50, 1),
(35, 5, 2, 3, '2023-11-14 19:40:14', NULL, 2, '', NULL, 50, 1),
(36, 5, 1, NULL, NULL, NULL, 1, '', NULL, 50, 1),
(37, 5, 1, NULL, NULL, NULL, 1, '', NULL, 50, 1),
(38, 5, 1, NULL, NULL, NULL, 1, '', NULL, 50, 1),
(39, 5, 3, NULL, NULL, NULL, 1, '', NULL, 50, 1),
(40, 5, 2, NULL, NULL, NULL, 1, '', NULL, 50, 1),
(41, 5, 2, NULL, NULL, NULL, 1, '', NULL, 50, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `pigmentos`
--

CREATE TABLE `pigmentos` (
  `idPigmento` int(11) NOT NULL COMMENT 'PK - chave identificadora de IDs da tabela pigmentos',
  `descricao` varchar(80) NOT NULL COMMENT 'Registra a descrição de um item desta tabela',
  `idTipoPigmento` int(11) NOT NULL COMMENT 'FK - chave estrangeira que identificadora de IDs da tabela tipos_pigmentos',
  `quantidade` float NOT NULL COMMENT 'Registra a quantidade de um item registrado ',
  `codigo` varchar(50) NOT NULL COMMENT 'Registra o código de um item ',
  `lote` varchar(50) NOT NULL COMMENT 'Registra o lote de um item ',
  `ativo` tinyint(1) NOT NULL COMMENT 'Registra se o item está ativo (1-ativo / 0-inativo)',
  `observacoes` text DEFAULT NULL COMMENT 'Registra observações não obrigatórias feitas pelo usuário '
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Tabela que registra os pigmentos do laboratório de plásticos';

--
-- Extraindo dados da tabela `pigmentos`
--

INSERT INTO `pigmentos` (`idPigmento`, `descricao`, `idTipoPigmento`, `quantidade`, `codigo`, `lote`, `ativo`, `observacoes`) VALUES
(1, 'Verde claro', 1, 200, '5415466', 'B/656482', 0, ''),
(2, 'Azul escuro', 2, 245, '48684Ad874', 'C/64882', 0, ''),
(3, 'Vermelho', 1, 300, '94686545', 'A/48654', 0, ''),
(4, 'Amarelo', 2, 700, '', '', 1, ''),
(5, 'Roxo', 1, 100, 'SDDES496-7', '9598D', 1, '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pigmento_fornecedor`
--

CREATE TABLE `pigmento_fornecedor` (
  `idPigmento` int(11) NOT NULL COMMENT 'PK/FK - chave composta identificadora de IDs da tabela pigmentos',
  `idFornecedor` int(11) NOT NULL COMMENT 'PK/FK - chave composta identificadora de IDs da tabela fornecedores'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Tabela que associa um pigmento com um fornecedor';

--
-- Extraindo dados da tabela `pigmento_fornecedor`
--

INSERT INTO `pigmento_fornecedor` (`idPigmento`, `idFornecedor`) VALUES
(4, 1),
(5, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

CREATE TABLE `produtos` (
  `idProduto` int(11) NOT NULL COMMENT 'PK - chave identificadora da tabela produtos, onde cada id representa um produto feito.',
  `descricao` varchar(80) COLLATE utf8_bin NOT NULL COMMENT 'descrição do produto feito',
  `peso` int(11) NOT NULL COMMENT 'Grava o peso do produto mais canal ',
  `imagem` varchar(100) COLLATE utf8_bin DEFAULT NULL COMMENT 'Guarda caminho da imagem do produto',
  `ativo` tinyint(1) NOT NULL COMMENT 'Verifica se este produto esta ativa'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Tabela que identifica o produto feito ';

--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`idProduto`, `descricao`, `peso`, `imagem`, `ativo`) VALUES
(1, 'Suporte de carregador', 14, 'dist/img/d41d8cd98f00b204e9800998ecf8427e.', 0),
(2, 'Capa de celular', 7, 'dist/img/d41d8cd98f00b204e9800998ecf8427e.', 0),
(3, 'Becker', 11, 'dist/img/d41d8cd98f00b204e9800998ecf8427e.', 0),
(4, 'Copo', 0, 'dist/img/copo/copo.jpeg', 0),
(5, 'canudo', 0, '', 0),
(6, 'canudo', 0, '', 0),
(7, 'canudo', 0, '', 0),
(8, 'canudo', 0, NULL, 0),
(9, 'canudo', 0, NULL, 0),
(10, 'canudo', 0, NULL, 0),
(11, 'Capa de celular', 9, 'dist/img/901e0e06575e6d12618aac06a2b8a79f.png', 1),
(12, 'Galao', 60, 'dist/img/ccef519f29ca79ddc995ad2b1250f189.jpeg', 1),
(13, 'garrafinha', 35, 'dist/img/0f012b9ab778b50cae9e7c3010317306.jpg', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `receitas`
--

CREATE TABLE `receitas` (
  `idReceita` int(11) NOT NULL COMMENT 'PK - chave identificadora de IDs da tabela receitas ',
  `idProduto` int(11) NOT NULL COMMENT 'FK - chave estrangeira referenciando um item da tabela produtos',
  `idPigmento` int(11) DEFAULT NULL COMMENT 'IND - chave identificadora do pigmento. Pode ser nulo.',
  `quantidadePigmento` float NOT NULL COMMENT 'quantidade de pigmento no produto.',
  `observacoes` text DEFAULT NULL COMMENT 'Registra observações não obrigatórias feitas pelo usuário',
  `ativo` tinyint(1) NOT NULL COMMENT 'Registra se este item está ativo\r\n(1- ativo/ 0 - inativo)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Tabela que registra as receitas geradas no pedido';

--
-- Extraindo dados da tabela `receitas`
--

INSERT INTO `receitas` (`idReceita`, `idProduto`, `idPigmento`, `quantidadePigmento`, `observacoes`, `ativo`) VALUES
(1, 12, 5, 15, NULL, 1),
(2, 13, 4, 5, NULL, 1),
(3, 13, 5, 5, NULL, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `receita_materia_prima`
--

CREATE TABLE `receita_materia_prima` (
  `idReceita` int(11) NOT NULL COMMENT 'PK/FK- Chave identificadora de IDs da tabela receitas',
  `idMateriaPrima` int(11) NOT NULL COMMENT 'PK/FK- Chave identificadora de IDs da tabela materia_prima',
  `quantidadeMaterial` int(11) NOT NULL COMMENT 'Registra a quantidade de matéria prima usada nesta receita'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Tabela associativa das tabelas receitas com materia_prima';

--
-- Extraindo dados da tabela `receita_materia_prima`
--

INSERT INTO `receita_materia_prima` (`idReceita`, `idMateriaPrima`, `quantidadeMaterial`) VALUES
(1, 8, 30),
(2, 8, 15),
(2, 9, 15),
(3, 2, 45);

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
(3, 'Madeira', 1),
(4, 'Pedra', 1);

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
  `ativo` tinyint(1) DEFAULT NULL COMMENT 'Se a conta podea ou não pode ser usada'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Tabela que salva as informações sobre a turma dos usuários ';

--
-- Extraindo dados da tabela `turma`
--

INSERT INTO `turma` (`idTurma`, `turno`, `nomeTurma`, `ativo`) VALUES
(1, 'N', 'T DESI 2022', 0),
(2, 'M', 'Estilos de Moda', 0),
(3, 'V', 'Mecânica', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `idUsuario` int(11) NOT NULL COMMENT 'PK - chave identificadora de IDs da tabela usuarios',
  `login` varchar(80) NOT NULL COMMENT 'Registra o login de um usuário',
  `senha` varchar(32) NOT NULL COMMENT 'Registra a senha de um usuário',
  `nome` varchar(80) NOT NULL COMMENT 'Registra o primeiro nome do usuário',
  `sobrenome` varchar(80) NOT NULL COMMENT 'Registra o sobrenome do usuário',
  `idTurma` int(11) DEFAULT NULL COMMENT 'FK - chave estrangeira que Registra a ID da turma do usuário',
  `tipo` tinyint(1) NOT NULL COMMENT 'Registra o tipo de usuário',
  `ativo` tinyint(1) NOT NULL COMMENT 'Registra se o usuário estiver ativo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Tabela que registra os cadastros de suuarios';

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `login`, `senha`, `nome`, `sobrenome`, `idTurma`, `tipo`, `ativo`) VALUES
(1, 'adm@adm.com', '202cb962ac59075b964b07152d234b70', 'Adm', 'Adm', NULL, 1, 0),
(2, 'a@teste.com', '202cb962ac59075b964b07152d234b70', 'Luis', 'Fernando Pereira', NULL, 1, 0),
(3, 'b@teste.com', '202cb962ac59075b964b07152d234b70', 'Marco', 'dos Santos', 1, 2, 1),
(4, 'c@teste.com', '202cb962ac59075b964b07152d234b70', 'Teste', 'Testudo de teste', 1, 2, 1),
(5, 'adm1@adm.com', '81dc9bdb52d04dc20036dbd8313ed055', 'adm', 'adm', NULL, 1, 1),
(6, 'ad@ad.v', '81dc9bdb52d04dc20036dbd8313ed055', 'daniel', 'dani', 2, 2, 1),
(7, 'joao@teste.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Joao', 'cacilds', 3, 2, 1),
(8, 'da@dada.da', '81dc9bdb52d04dc20036dbd8313ed055', 'da', 'da', NULL, 1, 1);

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
-- Índices para tabela `historico`
--
ALTER TABLE `historico`
  ADD PRIMARY KEY (`idHistorico`);

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
  ADD KEY `FK_idUsuario` (`idUsuario`),
  ADD KEY `FK_idReceita` (`idReceita`),
  ADD KEY `FK_idMaquina` (`idMaquina`);

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
-- Índices para tabela `receitas`
--
ALTER TABLE `receitas`
  ADD PRIMARY KEY (`idReceita`),
  ADD KEY `FK_idProduto` (`idProduto`),
  ADD KEY `idPigmento` (`idPigmento`);

--
-- Índices para tabela `receita_materia_prima`
--
ALTER TABLE `receita_materia_prima`
  ADD PRIMARY KEY (`idReceita`,`idMateriaPrima`),
  ADD KEY `FK_idMateriaPrima` (`idMateriaPrima`),
  ADD KEY `FK_idReceita` (`idReceita`);

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
  ADD KEY `idTurma` (`idTurma`);

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
  MODIFY `idFerramental` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK - chave identificadora de IDs da tabela ferramental', AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `fornecedores`
--
ALTER TABLE `fornecedores`
  MODIFY `idFornecedor` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK - chave identificadora das ids de cada fornecedor', AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `historico`
--
ALTER TABLE `historico`
  MODIFY `idHistorico` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Chave identificadora de registros da tabela histórico', AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `maquinas`
--
ALTER TABLE `maquinas`
  MODIFY `idMaquina` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK - chave identificadora das maquinas usadas para fazer os produtos', AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `materia_prima`
--
ALTER TABLE `materia_prima`
  MODIFY `idMateriaPrima` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK - chave identificadora de IDs da tabela materia_prima', AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `idPedido` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK - chave identificadora de IDs da tabela pedidos', AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT de tabela `pigmentos`
--
ALTER TABLE `pigmentos`
  MODIFY `idPigmento` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK - chave identificadora de IDs da tabela pigmentos', AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `idProduto` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK - chave identificadora da tabela produtos, onde cada id representa um produto feito.', AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de tabela `receitas`
--
ALTER TABLE `receitas`
  MODIFY `idReceita` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK - chave identificadora de IDs da tabela receitas ', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `tipos_ferramental`
--
ALTER TABLE `tipos_ferramental`
  MODIFY `idTiposFerramental` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK - chave identificadora das ids dos tipos de moldes das maquinas.', AUTO_INCREMENT=5;

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
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK - chave identificadora de IDs da tabela usuarios', AUTO_INCREMENT=9;

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
-- Limitadores para a tabela `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_2` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idUsuario`),
  ADD CONSTRAINT `pedidos_ibfk_3` FOREIGN KEY (`idReceita`) REFERENCES `receitas` (`idReceita`);

--
-- Limitadores para a tabela `pigmentos`
--
ALTER TABLE `pigmentos`
  ADD CONSTRAINT `pigmentos_ibfk_1` FOREIGN KEY (`idTipoPigmento`) REFERENCES `tipo_pigmentos` (`idTipoPigmento`);

--
-- Limitadores para a tabela `pigmento_fornecedor`
--
ALTER TABLE `pigmento_fornecedor`
  ADD CONSTRAINT `pigmento_fornecedor_ibfk_1` FOREIGN KEY (`idFornecedor`) REFERENCES `fornecedores` (`idFornecedor`),
  ADD CONSTRAINT `pigmento_fornecedor_ibfk_2` FOREIGN KEY (`idPigmento`) REFERENCES `pigmentos` (`idPigmento`);

--
-- Limitadores para a tabela `receitas`
--
ALTER TABLE `receitas`
  ADD CONSTRAINT `receitas_ibfk_1` FOREIGN KEY (`idProduto`) REFERENCES `produtos` (`idProduto`);

--
-- Limitadores para a tabela `receita_materia_prima`
--
ALTER TABLE `receita_materia_prima`
  ADD CONSTRAINT `receita_materia_prima_ibfk_1` FOREIGN KEY (`idMateriaPrima`) REFERENCES `materia_prima` (`idMateriaPrima`),
  ADD CONSTRAINT `receita_materia_prima_ibfk_2` FOREIGN KEY (`idReceita`) REFERENCES `receitas` (`idReceita`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
