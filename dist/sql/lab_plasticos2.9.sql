DROP DATABASE lab_plasticos;
CREATE DATABASE lab_plasticos;
USE lab_plasticos;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

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

-- --------------------------------------------------------

--
-- Estrutura da tabela `historico_materia_prima`
--

CREATE TABLE `historico_materia_prima` (
  `idHistorico_materia` int(11) NOT NULL COMMENT 'PK - chave identificadora de registro da tabela historico_materia_prima.',
  `idMateria` int(11) NOT NULL COMMENT 'ID da matéria prima que foi alterada.',
  `nomeUsuario` varchar(120) COLLATE utf8_bin NOT NULL COMMENT 'Registra o nome do usuário.',
  `turma` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT 'Registra a turma do usuário que fez a alteração no estoque, caso não tenha sido feita por um adm.',
  `turno` char(1) COLLATE utf8_bin DEFAULT NULL COMMENT 'Registra o turno do usuário que fez a alteração no estoque, caso não tenah sido feita por um adm.',
  `tipoUsuario` tinyint(1) NOT NULL COMMENT 'Registra o tipo de usuário que fez a alteração no estoque(1-adm/2-comum).  ',
  `nomeMateria` varchar(80) COLLATE utf8_bin NOT NULL COMMENT 'Nome da matéria prima alterada.',
  `quantidadeAlterada` int(11) NOT NULL COMMENT 'Quantidade de matéria prima alterada.',
  `dataAlteracao` datetime NOT NULL COMMENT 'Registra a data e a hora em que a alteração foi feita',
  `ativo` tinyint(1) NOT NULL COMMENT 'Registra se este registro se encontra ativo ou não'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Registros da movimentação de matéria prima no estoque';

-- --------------------------------------------------------

--
-- Estrutura da tabela `historico_pedidos`
--

CREATE TABLE `historico_pedidos` (
  `idHistorico` int(11) NOT NULL COMMENT 'Chave identificadora de registros da tabela histórico',
  `nomeUsuario` varchar(80) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT 'Registra o nome do usuário que fez o pedido',
  `tipoUsuario` tinyint(1) NOT NULL COMMENT 'Registra o nível de acesso de quem fez o pedido',
  `turma` varchar(32) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT 'Registra a turma de quem fez o pedido. Se foi um adm, este valor será nulo',
  `turno` char(1) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT 'Registra o turno de quem fez o pedido. Se foi um adm, este valor será nulo',
  `idPedido` int(11) NOT NULL COMMENT 'Chave identificadora de registros da tabela pedidos',
  `materiaPrima` varchar(80) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT 'Registra a matéria prima usada em um pedido',
  `tipoMateria_prima` varchar(80) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT 'Registra o tipo de matéria prima usada em um pedido',
  `classeMateria_prima` varchar(80) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT 'Registra a classe de matéria prima usada em um pedido',
  `fornecedorMateria_Prima` varchar(80) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT 'Registra o fornecedor da matéria prima usada',
  `pigmento` varchar(80) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT 'Registro de pigmento usado em um pedido',
  `tipoPigmento` varchar(80) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT 'Registra o tipo de pigmento usado em um pedido',
  `codigo` varchar(30) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT 'Registra o codigo do pigmento usado',
  `lote` int(30) NOT NULL COMMENT 'Registra o lote do pigmento usado',
  `fornecedorPigmento` varchar(80) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT 'Registra o fornecedor do pigmento usado',
  `produto` varchar(80) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT 'Registro de produto de um pedido',
  `ferramental` varchar(80) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT 'Registra no histórico de pedidos qual molde foi usado',
  `tipoFerramental` varchar(80) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT 'Registra no histórico de pedidos qual o tipo de molde usado',
  `maquina` varchar(80) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT 'Registro de máquina usada para atender um pedido',
  `producaoPrevista` int(11) NOT NULL COMMENT 'Registra a quantidade de produtos feitos em um pedido',
  `refugo` int(11) DEFAULT NULL COMMENT 'Registra a quantidade de refugos feita em uma ordem de produção',
  `producaoRealizada` int(11) DEFAULT NULL COMMENT 'Registra a quantidade real de produção(QUANTIDADE REALMENTE PRODUZIDA - REFUGO).',
  `quantidadeMateria_prima` float NOT NULL COMMENT 'Registra a quantidade de matéria prima usada em uma receita',
  `quantidadePigmento` float NOT NULL COMMENT 'registra a quantidade de pigmento usado em uma receita',
  `dataHora_aberto` datetime DEFAULT NULL COMMENT 'Registra a data e hora em que um pedido foi aberto ',
  `dataHora_producao` datetime DEFAULT NULL COMMENT 'Registra a data e hora em que é iniciado a produção de um pedido. ',
  `dataHora_fechado` datetime DEFAULT NULL COMMENT 'Registra a data e hora em que um pedido foi fechado',
  `dataHora_alterado` datetime DEFAULT NULL COMMENT 'Registra a data e hora em que um pedido foi alterado',
  `statusPedido` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT 'Registra o status de um pedido da tabela pedidos',
  `obsPedido` text CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL COMMENT 'Registra as observações registradas na tabela pedidos'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Registro de histórico de pedidos';

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
  `quantidade` float NOT NULL COMMENT 'registra a quantidade do item ',
  `ativo` tinyint(1) NOT NULL COMMENT 'Registra se este item está ativo',
  `observacoes` text DEFAULT NULL COMMENT 'Registra uma observação não obrigatória feita pelo usuário'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Tabela que registra as matérias primas do laboratório';

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
  `dataHora_producao` datetime DEFAULT NULL COMMENT 'Registra a data e hora em que um pedido iniciou produção',
  `dataHora_fechado` datetime DEFAULT NULL COMMENT 'Data e hora do fechamento deste pedido',
  `status` tinyint(1) NOT NULL COMMENT 'Status do pedido\r\n(0-cancelado/1-aberto/2-Em produção/3-concluido)',
  `observacoes` text DEFAULT NULL COMMENT 'Registro não obrigatório de observações do usuário',
  `refugo` int(11) DEFAULT NULL COMMENT 'Quantidade de refugo ',
  `producaoPrevista` int(11) DEFAULT NULL COMMENT 'Registra a quantidade de produtos selecionadas no pedido',
  `producaoRealizada` int(11) DEFAULT NULL COMMENT 'Registra a quantidade de produtos que realmente foi feita pela máquina'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Tabela que registra no banco de dados  um pedido';

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

-- --------------------------------------------------------

--
-- Estrutura da tabela `pigmento_fornecedor`
--

CREATE TABLE `pigmento_fornecedor` (
  `idPigmento` int(11) NOT NULL COMMENT 'PK/FK - chave composta identificadora de IDs da tabela pigmentos',
  `idFornecedor` int(11) NOT NULL COMMENT 'PK/FK - chave composta identificadora de IDs da tabela fornecedores'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Tabela que associa um pigmento com um fornecedor';

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

-- --------------------------------------------------------

--
-- Estrutura da tabela `receita_materia_prima`
--

CREATE TABLE `receita_materia_prima` (
  `idReceita` int(11) NOT NULL COMMENT 'PK/FK- Chave identificadora de IDs da tabela receitas',
  `idMateriaPrima` int(11) NOT NULL COMMENT 'PK/FK- Chave identificadora de IDs da tabela materia_prima',
  `quantidadeMaterial` int(11) NOT NULL COMMENT 'Registra a quantidade de matéria prima usada nesta receita'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Tabela associativa das tabelas receitas com materia_prima';

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipos_ferramental`
--

CREATE TABLE `tipos_ferramental` (
  `idTiposFerramental` int(11) NOT NULL COMMENT 'PK - chave identificadora das ids dos tipos de moldes das maquinas.',
  `descricao` varchar(50) NOT NULL COMMENT 'Descrição do molde a ser usado(Nome e algumas observações).',
  `ativo` tinyint(1) NOT NULL COMMENT 'Verifica se esta maquina esta ativa'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Tabela de registro dos tipos de moldes usados no laboratório';

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo_materia_prima`
--

CREATE TABLE `tipo_materia_prima` (
  `idTipoMateriaPrima` int(11) NOT NULL COMMENT 'PK - chave identificadora de id dos tipos de matéria prima',
  `descricao` varchar(32) COLLATE utf8_bin NOT NULL COMMENT 'Descrição dos tipos de matéria prima(virgem, reciclado, remoído, scrap);',
  `ativo` tinyint(1) NOT NULL COMMENT 'Verifica se esta tipo de matéria prima esta ativa'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Tabela identificadora dos tipos de matéria prima ';

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo_pigmentos`
--

CREATE TABLE `tipo_pigmentos` (
  `idTipoPigmento` int(11) NOT NULL COMMENT 'PK - codigo identificador dos tipos de pigmentos',
  `descricao` varchar(80) NOT NULL COMMENT 'descricao do tipo pigmento',
  `ativo` tinyint(1) NOT NULL COMMENT 'Verifica se este tipo de pigmento esta ativo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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

-- --------------------------------------------------------

--
-- Estrutura stand-in para vista `view_altera_estoque`
-- (Veja abaixo para a view atual)
--
CREATE TABLE `view_altera_estoque` (
`idPedido` int(11)
,`producao` int(11)
,`qtdMaterial` int(11)
,`qtdPigmento` float
,`idReceita` int(11)
,`idMaterial` int(11)
,`estoqueMaterial` float
,`nomeMaterial` varchar(80)
,`idPigmento` int(11)
,`estoquePigmento` float
,`nomePigmento` varchar(80)
);

-- --------------------------------------------------------

--
-- Estrutura stand-in para vista `view_materia_receitas`
-- (Veja abaixo para a view atual)
--
CREATE TABLE `view_materia_receitas` (
`id` int(11)
,`quantidade` int(11)
,`material` varchar(80)
,`tipo` varchar(32)
,`classe` varchar(32)
,`fornecedor` varchar(50)
);

-- --------------------------------------------------------

--
-- Estrutura stand-in para vista `view_pedidos`
-- (Veja abaixo para a view atual)
--
CREATE TABLE `view_pedidos` (
`pedidoId` int(11)
,`userId` int(11)
,`receitaId` int(11)
,`maquinaId` int(11)
,`abertoData_hora` datetime
,`producaoData_hora` datetime
,`fechadoData_hora` datetime
,`stats` tinyint(1)
,`obs` text
,`qtdRefugo` int(11)
,`qtdPrevista` int(11)
,`qtdRealizada` int(11)
,`turmaId` int(11)
,`name` varchar(80)
,`sobName` varchar(80)
,`nivel` tinyint(1)
,`turma` varchar(32)
,`turno` char(1)
,`maquina` varchar(50)
,`produtoId` int(11)
,`pigmentoId` int(11)
,`qtdePigmento` float
,`materiaId` int(11)
,`qtdeMateria` int(11)
,`classeId` int(11)
,`tipoMatId` int(11)
,`material` varchar(80)
,`tipoMat` varchar(32)
,`classeMat` varchar(32)
,`fornecedorM` varchar(50)
,`fornecedorP` varchar(50)
,`tipoCorId` int(11)
,`cor` varchar(80)
,`codCor` varchar(50)
,`loteCor` varchar(50)
,`tipoCor` varchar(80)
,`produto` varchar(80)
,`pesoPro` int(11)
,`img` varchar(100)
,`moldeId` int(11)
,`molde` varchar(80)
,`tipoMoldeId` int(11)
,`tipoMolde` varchar(50)
);

-- --------------------------------------------------------

--
-- Estrutura stand-in para vista `view_receitas`
-- (Veja abaixo para a view atual)
--
CREATE TABLE `view_receitas` (
`receitaId` int(11)
,`produtoId` int(11)
,`qtdePigmento` float
,`receitaObs` text
,`ativoReceita` tinyint(1)
,`materiaId` int(11)
,`qtdeMateria` int(11)
,`produtoNome` varchar(80)
,`produtoImg` varchar(100)
,`moldeId` int(11)
,`moldeNome` varchar(80)
,`tipoMolde_nome` varchar(50)
,`materialNome` varchar(80)
,`tipo_materiaNome` varchar(32)
,`classeMaterial` varchar(32)
,`pigmentoId` int(11)
,`pigmentoNome` varchar(80)
,`tipoPigmento` varchar(80)
);

-- --------------------------------------------------------

--
-- Estrutura para vista `view_altera_estoque`
--
DROP TABLE IF EXISTS `view_altera_estoque`;

CREATE ALGORITHM=UNDEFINED DEFINER=CURRENT_USER SQL SECURITY DEFINER VIEW `view_altera_estoque`  AS SELECT `p`.`idPedido` AS `idPedido`, `p`.`producaoPrevista` AS `producao`, `mr`.`quantidadeMaterial` AS `qtdMaterial`, `r`.`quantidadePigmento` AS `qtdPigmento`, `mr`.`idReceita` AS `idReceita`, `mr`.`idMateriaPrima` AS `idMaterial`, `mat`.`quantidade` AS `estoqueMaterial`, `mat`.`descricao` AS `nomeMaterial`, `r`.`idPigmento` AS `idPigmento`, `pig`.`quantidade` AS `estoquePigmento`, `pig`.`descricao` AS `nomePigmento` FROM ((((`pedidos` `p` left join `receitas` `r` on(`p`.`idReceita` = `r`.`idReceita`)) left join `receita_materia_prima` `mr` on(`r`.`idReceita` = `mr`.`idReceita`)) left join `materia_prima` `mat` on(`mr`.`idMateriaPrima` = `mat`.`idMateriaPrima`)) left join `pigmentos` `pig` on(`r`.`idPigmento` = `pig`.`idPigmento`)) ;

-- --------------------------------------------------------

--
-- Estrutura para vista `view_materia_receitas`
--
DROP TABLE IF EXISTS `view_materia_receitas`;

CREATE ALGORITHM=UNDEFINED DEFINER=CURRENT_USER SQL SECURITY DEFINER VIEW `view_materia_receitas`  AS SELECT `rmat`.`idReceita` AS `id`, `rmat`.`quantidadeMaterial` AS `quantidade`, `m`.`descricao` AS `material`, `t`.`descricao` AS `tipo`, `c`.`descricao` AS `classe`, `f`.`descricao` AS `fornecedor` FROM (((((`receita_materia_prima` `rmat` left join `materia_prima` `m` on(`rmat`.`idMateriaPrima` = `m`.`idMateriaPrima`)) join `materia_fornecedor` `mf` on(`m`.`idMateriaPrima` = `mf`.`idMateriaPrima`)) left join `fornecedores` `f` on(`mf`.`idFornecedor` = `f`.`idFornecedor`)) left join `tipo_materia_prima` `t` on(`t`.`idTipoMateriaPrima` = `m`.`idTipoMateriaPrima`)) left join `classe_material` `c` on(`m`.`idClasse` = `c`.`idClasse`)) ;

-- --------------------------------------------------------

--
-- Estrutura para vista `view_pedidos`
--
DROP TABLE IF EXISTS `view_pedidos`;

CREATE ALGORITHM=UNDEFINED DEFINER=CURRENT_USER SQL SECURITY DEFINER VIEW `view_pedidos`  AS SELECT `ped`.`idPedido` AS `pedidoId`, `ped`.`idUsuario` AS `userId`, `ped`.`idReceita` AS `receitaId`, `ped`.`idMaquina` AS `maquinaId`, `ped`.`dataHora_aberto` AS `abertoData_hora`, `ped`.`dataHora_producao` AS `producaoData_hora`, `ped`.`dataHora_fechado` AS `fechadoData_hora`, `ped`.`status` AS `stats`, `ped`.`observacoes` AS `obs`, `ped`.`refugo` AS `qtdRefugo`, `ped`.`producaoPrevista` AS `qtdPrevista`, `ped`.`producaoRealizada` AS `qtdRealizada`, `usu`.`idTurma` AS `turmaId`, `usu`.`nome` AS `name`, `usu`.`sobrenome` AS `sobName`, `usu`.`tipo` AS `nivel`, `tur`.`nomeTurma` AS `turma`, `tur`.`turno` AS `turno`, `maq`.`descricao` AS `maquina`, `rec`.`idProduto` AS `produtoId`, `rec`.`idPigmento` AS `pigmentoId`, `rec`.`quantidadePigmento` AS `qtdePigmento`, `rmp`.`idMateriaPrima` AS `materiaId`, `rmp`.`quantidadeMaterial` AS `qtdeMateria`, `mat`.`idClasse` AS `classeId`, `mat`.`idTipoMateriaPrima` AS `tipoMatId`, `mat`.`descricao` AS `material`, `tmat`.`descricao` AS `tipoMat`, `cmat`.`descricao` AS `classeMat`, `form`.`descricao` AS `fornecedorM`, `forp`.`descricao` AS `fornecedorP`, `pig`.`idTipoPigmento` AS `tipoCorId`, `pig`.`descricao` AS `cor`, `pig`.`codigo` AS `codCor`, `pig`.`lote` AS `loteCor`, `tpig`.`descricao` AS `tipoCor`, `pro`.`descricao` AS `produto`, `pro`.`peso` AS `pesoPro`, `pro`.`imagem` AS `img`, `fer`.`idFerramental` AS `moldeId`, `fer`.`descricao` AS `molde`, `fer`.`idTiposFerramental` AS `tipoMoldeId`, `tfer`.`descricao` AS `tipoMolde` FROM (((((((`ferramental` `fer` left join ((`classe_material` `cmat` left join (`tipo_materia_prima` `tmat` left join (`materia_fornecedor` `format` left join ((`receita_materia_prima` `rmp` left join ((((`pedidos` `ped` left join `usuarios` `usu` on(`ped`.`idUsuario` = `usu`.`idUsuario`)) left join `turma` `tur` on(`usu`.`idTurma` = `tur`.`idTurma`)) left join `maquinas` `maq` on(`ped`.`idMaquina` = `maq`.`idMaquina`)) left join `receitas` `rec` on(`ped`.`idReceita` = `rec`.`idReceita`)) on(`rmp`.`idReceita` = `rec`.`idReceita`)) left join `materia_prima` `mat` on(`rmp`.`idMateriaPrima` = `mat`.`idMateriaPrima`)) on(`mat`.`idMateriaPrima` = `format`.`idMateriaPrima`)) on(`mat`.`idTipoMateriaPrima` = `tmat`.`idTipoMateriaPrima`)) on(`mat`.`idClasse` = `cmat`.`idClasse`)) left join `produtos` `pro` on(`rec`.`idProduto` = `pro`.`idProduto`)) on(`pro`.`idProduto` = `fer`.`idProduto`)) left join `tipos_ferramental` `tfer` on(`fer`.`idTiposFerramental` = `tfer`.`idTiposFerramental`)) left join `fornecedores` `form` on(`format`.`idFornecedor` = `form`.`idFornecedor`)) left join `pigmentos` `pig` on(`rec`.`idPigmento` = `pig`.`idPigmento`)) left join `tipo_pigmentos` `tpig` on(`pig`.`idTipoPigmento` = `tpig`.`idTipoPigmento`)) left join `pigmento_fornecedor` `forpig` on(`pig`.`idPigmento` = `forpig`.`idPigmento`)) left join `fornecedores` `forp` on(`forp`.`idFornecedor` = `forpig`.`idFornecedor`)) ;

-- --------------------------------------------------------

--
-- Estrutura para vista `view_receitas`
--
DROP TABLE IF EXISTS `view_receitas`;

CREATE ALGORITHM=UNDEFINED DEFINER=CURRENT_USER SQL SECURITY DEFINER VIEW `view_receitas`  AS SELECT `r`.`idReceita` AS `receitaId`, `r`.`idProduto` AS `produtoId`, `r`.`quantidadePigmento` AS `qtdePigmento`, `r`.`observacoes` AS `receitaObs`, `r`.`ativo` AS `ativoReceita`, `rmp`.`idMateriaPrima` AS `materiaId`, `rmp`.`quantidadeMaterial` AS `qtdeMateria`, `pr`.`descricao` AS `produtoNome`, `pr`.`imagem` AS `produtoImg`, `f`.`idFerramental` AS `moldeId`, `f`.`descricao` AS `moldeNome`, `tfer`.`descricao` AS `tipoMolde_nome`, `mat`.`descricao` AS `materialNome`, `tm`.`descricao` AS `tipo_materiaNome`, `c`.`descricao` AS `classeMaterial`, `pg`.`idPigmento` AS `pigmentoId`, `pg`.`descricao` AS `pigmentoNome`, `tp`.`descricao` AS `tipoPigmento` FROM ((((`ferramental` `f` left join (((((`receita_materia_prima` `rmp` left join `receitas` `r` on(`rmp`.`idReceita` = `r`.`idReceita`)) left join `materia_prima` `mat` on(`rmp`.`idMateriaPrima` = `mat`.`idMateriaPrima`)) left join `classe_material` `c` on(`c`.`idClasse` = `mat`.`idClasse`)) left join `tipo_materia_prima` `tm` on(`tm`.`idTipoMateriaPrima` = `mat`.`idTipoMateriaPrima`)) left join `produtos` `pr` on(`r`.`idProduto` = `pr`.`idProduto`)) on(`f`.`idProduto` = `pr`.`idProduto`)) left join `tipos_ferramental` `tfer` on(`f`.`idTiposFerramental` = `tfer`.`idTiposFerramental`)) left join `pigmentos` `pg` on(`pg`.`idPigmento` = `r`.`idPigmento`)) left join `tipo_pigmentos` `tp` on(`tp`.`idTipoPigmento` = `pg`.`idTipoPigmento`)) ;

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
  ADD KEY `FK_idProduto` (`idProduto`) USING BTREE,
  ADD KEY `FK_idTiposFerramental` (`idTiposFerramental`) USING BTREE;

--
-- Índices para tabela `ferramental_maquina`
--
ALTER TABLE `ferramental_maquina`
  ADD PRIMARY KEY (`idFerramental`,`idMaquina`),
  ADD KEY `FK_idFerramental` (`idFerramental`) USING BTREE,
  ADD KEY `FK_idMaquina` (`idMaquina`) USING BTREE;

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
  ADD KEY `FK_idFornecedor` (`idFornecedor`) USING BTREE,
  ADD KEY `FK_idMateriaPrima` (`idMateriaPrima`) USING BTREE;

--
-- Índices para tabela `materia_pigmento`
--
ALTER TABLE `materia_pigmento`
  ADD PRIMARY KEY (`idMateriaPrima`,`idPigmento`),
  ADD KEY `FK_idMateriaPrima` (`idMateriaPrima`) USING BTREE,
  ADD KEY `FK_idPigmento` (`idPigmento`) USING BTREE;

--
-- Índices para tabela `materia_prima`
--
ALTER TABLE `materia_prima`
  ADD PRIMARY KEY (`idMateriaPrima`),
  ADD KEY `FK_idClasse` (`idClasse`) USING BTREE,
  ADD KEY `FK_idTipoMateriaPrima` (`idTipoMateriaPrima`) USING BTREE;

--
-- Índices para tabela `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`idPedido`),
  ADD KEY `FK_idUsuario` (`idUsuario`) USING BTREE,
  ADD KEY `FK_idReceita` (`idReceita`) USING BTREE,
  ADD KEY `FK_idMaquina` (`idMaquina`) USING BTREE;

--
-- Índices para tabela `pigmentos`
--
ALTER TABLE `pigmentos`
  ADD PRIMARY KEY (`idPigmento`),
  ADD KEY `FK_idTipoPigmento` (`idTipoPigmento`) USING BTREE;

--
-- Índices para tabela `pigmento_fornecedor`
--
ALTER TABLE `pigmento_fornecedor`
  ADD PRIMARY KEY (`idPigmento`,`idFornecedor`),
  ADD KEY `FK_idFornecedor` (`idFornecedor`) USING BTREE,
  ADD KEY `FK_idPigmento` (`idPigmento`) USING BTREE;

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
  ADD KEY `idPigmento` (`idPigmento`),
  ADD KEY `FK_idProduto` (`idProduto`) USING BTREE;

--
-- Índices para tabela `receita_materia_prima`
--
ALTER TABLE `receita_materia_prima`
  ADD PRIMARY KEY (`idReceita`,`idMateriaPrima`),
  ADD KEY `FK_idMateriaPrima` (`idMateriaPrima`) USING BTREE,
  ADD KEY `FK_idReceita` (`idReceita`) USING BTREE;

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
  MODIFY `idClasse` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK - chave identificadora que guarda a id de cada classe da matéria prima';

--
-- AUTO_INCREMENT de tabela `ferramental`
--
ALTER TABLE `ferramental`
  MODIFY `idFerramental` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK - chave identificadora de IDs da tabela ferramental';

--
-- AUTO_INCREMENT de tabela `fornecedores`
--
ALTER TABLE `fornecedores`
  MODIFY `idFornecedor` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK - chave identificadora das ids de cada fornecedor';

--
-- AUTO_INCREMENT de tabela `maquinas`
--
ALTER TABLE `maquinas`
  MODIFY `idMaquina` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK - chave identificadora das maquinas usadas para fazer os produtos';

--
-- AUTO_INCREMENT de tabela `materia_prima`
--
ALTER TABLE `materia_prima`
  MODIFY `idMateriaPrima` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK - chave identificadora de IDs da tabela materia_prima';

--
-- AUTO_INCREMENT de tabela `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `idPedido` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK - chave identificadora de IDs da tabela pedidos';

--
-- AUTO_INCREMENT de tabela `pigmentos`
--
ALTER TABLE `pigmentos`
  MODIFY `idPigmento` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK - chave identificadora de IDs da tabela pigmentos';

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `idProduto` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK - chave identificadora da tabela produtos, onde cada id representa um produto feito.';

--
-- AUTO_INCREMENT de tabela `receitas`
--
ALTER TABLE `receitas`
  MODIFY `idReceita` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK - chave identificadora de IDs da tabela receitas ';

--
-- AUTO_INCREMENT de tabela `tipos_ferramental`
--
ALTER TABLE `tipos_ferramental`
  MODIFY `idTiposFerramental` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK - chave identificadora das ids dos tipos de moldes das maquinas.';

--
-- AUTO_INCREMENT de tabela `tipo_materia_prima`
--
ALTER TABLE `tipo_materia_prima`
  MODIFY `idTipoMateriaPrima` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK - chave identificadora de id dos tipos de matéria prima';

--
-- AUTO_INCREMENT de tabela `tipo_pigmentos`
--
ALTER TABLE `tipo_pigmentos`
  MODIFY `idTipoPigmento` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK - codigo identificador dos tipos de pigmentos';

--
-- AUTO_INCREMENT de tabela `turma`
--
ALTER TABLE `turma`
  MODIFY `idTurma` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK - chave identificadora da turma a qual o usuário pertence\r\nOBS: o admin não necessita estar em uma turma';

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
  ADD CONSTRAINT `ferramental_ibfk_1` FOREIGN KEY (`idProduto`) REFERENCES `produtos` (`idProduto`),
  ADD CONSTRAINT `ferramental_ibfk_2` FOREIGN KEY (`idTiposFerramental`) REFERENCES `tipos_ferramental` (`idTiposFerramental`);

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
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idUsuario`),
  ADD CONSTRAINT `pedidos_ibfk_2` FOREIGN KEY (`idReceita`) REFERENCES `receitas` (`idReceita`),
  ADD CONSTRAINT `pedidos_ibfk_3` FOREIGN KEY (`idMaquina`) REFERENCES `maquinas` (`idMaquina`);

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
  ADD CONSTRAINT `receitas_ibfk_1` FOREIGN KEY (`idProduto`) REFERENCES `produtos` (`idProduto`),
  ADD CONSTRAINT `receitas_ibfk_2` FOREIGN KEY (`idPigmento`) REFERENCES `pigmentos` (`idPigmento`);

--
-- Limitadores para a tabela `receita_materia_prima`
--
ALTER TABLE `receita_materia_prima`
  ADD CONSTRAINT `receita_materia_prima_ibfk_1` FOREIGN KEY (`idMateriaPrima`) REFERENCES `materia_prima` (`idMateriaPrima`),
  ADD CONSTRAINT `receita_materia_prima_ibfk_2` FOREIGN KEY (`idReceita`) REFERENCES `receitas` (`idReceita`);

--
-- Limitadores para a tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`idTurma`) REFERENCES `turma` (`idTurma`);
COMMIT;
