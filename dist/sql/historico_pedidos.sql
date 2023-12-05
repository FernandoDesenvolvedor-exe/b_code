
drop table historico_pedidos;

CREATE TABLE `historico_pedidos` (
  `idHistorico` int(11) NOT NULL COMMENT 'Chave identificadora de registros da tabela histórico',
  `nomeUsuario` varchar(80) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT 'Registra o nome do usuário que fez o pedido',
  `tipoUsuario` tinyint(1) NOT NULL COMMENT 'Registra o nível de acesso de quem fez o pedido',
  `turma` varchar(32) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT 'Registra a turma de quem fez o pedido. Se foi um adm, este valor será nulo',
  `turno` char(1) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT 'Registra o turno de quem fez o pedido. Se foi um adm, este valor será nulo',
  `idPedido` int(11) NOT NULL COMMENT 'Chave identificadora de registros da tabela pedidos',
  `idMateriaPrima` int(11) NOT NULL COMMENT 'Registra a chave identificadora do material virgem usado na produção',
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
  `idFerramental` int(11) NOT NULL COMMENT 'Registra a id de um molde relacionado a um produto',
  `ferramental` varchar(80) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT 'Registra no histórico de pedidos qual molde foi usado',
  `tipoFerramental` varchar(80) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT 'Registra no histórico de pedidos qual o tipo de molde usado',
  `maquina` varchar(80) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT 'Registro de máquina usada para atender um pedido',
  `producaoPrevista` int(11) NOT NULL COMMENT 'Registra a quantidade de produtos feitos em um pedido',
  `refugo` int(11) DEFAULT NULL COMMENT 'Registra a quantidade de refugos feita em uma ordem de produção',
  `producaoRealizada` int(11) DEFAULT NULL COMMENT 'Registra a quantidade real de produção(QUANTIDADE REALMENTE PRODUZIDA - REFUGO).',
  `quantidadeMateria_prima` float NOT NULL COMMENT 'Registra a quantidade de matéria prima usada em uma receita',
  `quantidadeReciclado` float NOT NULL COMMENT 'Registro de quantidade de materiais reciclados reutilizados neste pedido',
  `quantidadePigmento` float NOT NULL COMMENT 'registra a quantidade de pigmento usado em uma receita',
  `dataHora_aberto` datetime DEFAULT NULL COMMENT 'Registra a data e hora em que um pedido foi aberto ',
  `dataHora_producao` datetime DEFAULT NULL COMMENT 'Registra a data e hora em que é iniciado a produção de um pedido. ',
  `dataHora_fechado` datetime DEFAULT NULL COMMENT 'Registra a data e hora em que um pedido foi fechado',
  `dataHora_alterado` datetime DEFAULT NULL COMMENT 'Registra a data e hora em que um pedido foi alterado',
  `statusPedido` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT 'Registra o status de um pedido da tabela pedidos',
  `obsPedido` text CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL COMMENT 'Registra as observações registradas na tabela pedidos'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Registro de histórico de pedidos';

--
-- Extraindo dados da tabela `historico_pedidos`
--

INSERT INTO `historico_pedidos` (`idHistorico`, `nomeUsuario`, `tipoUsuario`, `turma`, `turno`, `idPedido`, `idMateriaPrima`, `materiaPrima`, `tipoMateria_prima`, `classeMateria_prima`, `fornecedorMateria_Prima`, `pigmento`, `tipoPigmento`, `codigo`, `lote`, `fornecedorPigmento`, `produto`, `idFerramental`, `ferramental`, `tipoFerramental`, `maquina`, `producaoPrevista`, `refugo`, `producaoRealizada`, `quantidadeMateria_prima`, `quantidadeReciclado`, `quantidadePigmento`, `dataHora_aberto`, `dataHora_producao`, `dataHora_fechado`, `dataHora_alterado`, `statusPedido`, `obsPedido`) VALUES
(5, 'Luis Fernando Pereira', 1, '', '', 5, 17, 'Poliéster', 'Virgem', 'Comodities', 'SGS Polímeros', 'Amarelo', 'MTB', '3907.30', 0, 'CRISTAL MASTER', 'Garrafinha', 2, 'GARR8484654', 'Injetadas Auto.', 'VF - 35', 10, NULL, NULL, 19, 6, 0.6, '2023-12-05 19:30:00', '2023-12-05 19:42:26', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2', '');
COMMIT;
