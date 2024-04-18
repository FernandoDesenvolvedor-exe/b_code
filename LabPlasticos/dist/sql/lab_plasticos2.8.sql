-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 04-Dez-2023 às 18:50
-- Versão do servidor: 10.4.18-MariaDB
-- versão do PHP: 7.3.27

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



--
-- Estrutura da tabela `classe_material`
--

CREATE TABLE `classe_material` (
  `idClasse` int(11) NOT NULL COMMENT 'PK - chave identificadora que guarda a id de cada classe da matéria prima',
  `descricao` varchar(32) COLLATE utf8_bin NOT NULL COMMENT 'Descrição da classe da matéria prima(comodities, engenharia)',
  `ativo` tinyint(1) NOT NULL COMMENT 'Verifica se a classe esta ativa'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Registro da classe associada a uma matéria prima';



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
-- Estrutura da tabela `ferramental_maquina`
--

CREATE TABLE `ferramental_maquina` (
  `idFerramental` int(11) NOT NULL COMMENT 'PK/FK - chave composta identificadora de IDs da tabela ferramental',
  `idMaquina` int(11) NOT NULL COMMENT 'PK/FK - chave composta identificadora de IDs da tabela maquinas'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Tabela associativa entre ferramental e maquinas';

 

--
-- Estrutura da tabela `fornecedores`
--

CREATE TABLE `fornecedores` (
  `idFornecedor` int(11) NOT NULL COMMENT 'PK - chave identificadora das ids de cada fornecedor',
  `descricao` varchar(50) NOT NULL COMMENT 'Descrição de cada fornecedor(Nome);',
  `ativo` tinyint(1) NOT NULL COMMENT 'Verifica se este fornecedor irá aparecer nas pesquisas.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Registro dos fornecedores de materiais do laboratório';



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
-- Estrutura da tabela `materia_fornecedor`
--

CREATE TABLE `materia_fornecedor` (
  `idMateriaPrima` int(11) NOT NULL COMMENT 'PK/FK - chave composta desta tabela associativa com a tabela materia_prima',
  `idFornecedor` int(11) NOT NULL COMMENT 'PK/FK - chave composta desta tabela associativa com a tabela fornecedores'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Tabela associatica entre materia_prima e fornecedores';





--
-- Estrutura da tabela `materia_pigmento`
--

CREATE TABLE `materia_pigmento` (
  `idMateriaPrima` int(11) NOT NULL COMMENT 'PK/FK - chave composta identificadora de IDs da tabela materia_prima',
  `idPigmento` int(11) NOT NULL COMMENT 'PK/FK - chave composta identificadora de IDs da tabela pigmentos'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Tabela associatica entre materia_prima e pigmentos';




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
-- Estrutura da tabela `pigmento_fornecedor`
--

CREATE TABLE `pigmento_fornecedor` (
  `idPigmento` int(11) NOT NULL COMMENT 'PK/FK - chave composta identificadora de IDs da tabela pigmentos',
  `idFornecedor` int(11) NOT NULL COMMENT 'PK/FK - chave composta identificadora de IDs da tabela fornecedores'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Tabela que associa um pigmento com um fornecedor';


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
-- Estrutura da tabela `receita_materia_prima`
--

CREATE TABLE `receita_materia_prima` (
  `idReceita` int(11) NOT NULL COMMENT 'PK/FK- Chave identificadora de IDs da tabela receitas',
  `idMateriaPrima` int(11) NOT NULL COMMENT 'PK/FK- Chave identificadora de IDs da tabela materia_prima',
  `quantidadeMaterial` int(11) NOT NULL COMMENT 'Registra a quantidade de matéria prima usada nesta receita'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Tabela associativa das tabelas receitas com materia_prima';



--
-- Estrutura da tabela `tipos_ferramental`
--

CREATE TABLE `tipos_ferramental` (
  `idTiposFerramental` int(11) NOT NULL COMMENT 'PK - chave identificadora das ids dos tipos de moldes das maquinas.',
  `descricao` varchar(50) NOT NULL COMMENT 'Descrição do molde a ser usado(Nome e algumas observações).',
  `ativo` tinyint(1) NOT NULL COMMENT 'Verifica se esta maquina esta ativa'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Tabela de registro dos tipos de moldes usados no laboratório';


--
-- Estrutura da tabela `tipo_materia_prima`
--

CREATE TABLE `tipo_materia_prima` (
  `idTipoMateriaPrima` int(11) NOT NULL COMMENT 'PK - chave identificadora de id dos tipos de matéria prima',
  `descricao` varchar(32) COLLATE utf8_bin NOT NULL COMMENT 'Descrição dos tipos de matéria prima(virgem, reciclado, remoído, scrap);',
  `ativo` tinyint(1) NOT NULL COMMENT 'Verifica se esta tipo de matéria prima esta ativa'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Tabela identificadora dos tipos de matéria prima ';



--
-- Estrutura da tabela `tipo_pigmentos`
--

CREATE TABLE `tipo_pigmentos` (
  `idTipoPigmento` int(11) NOT NULL COMMENT 'PK - codigo identificador dos tipos de pigmentos',
  `descricao` varchar(80) NOT NULL COMMENT 'descricao do tipo pigmento',
  `ativo` tinyint(1) NOT NULL COMMENT 'Verifica se este tipo de pigmento esta ativo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


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
