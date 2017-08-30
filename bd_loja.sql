-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 30-Ago-2017 às 13:20
-- Versão do servidor: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lojavirtual`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `categoria_produtos`
--

CREATE TABLE `categoria_produtos` (
  `id_categoria` int(11) NOT NULL,
  `categoria` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `categoria_produtos`
--

INSERT INTO `categoria_produtos` (`id_categoria`, `categoria`) VALUES
(1, 'Celulares'),
(2, 'Móveis'),
(3, 'Eletrónicos'),
(4, 'Cozinha'),
(5, 'Quarto'),
(6, 'Banheiro');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cliente`
--

CREATE TABLE `cliente` (
  `ClienteId` int(11) NOT NULL,
  `login` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `senha` varchar(45) NOT NULL,
  `PrimNome` varchar(45) NOT NULL,
  `UltNome` varchar(45) NOT NULL,
  `Endereco` varchar(45) DEFAULT NULL,
  `Cidade` varchar(45) DEFAULT NULL,
  `Cep` varchar(45) DEFAULT NULL,
  `Telefone` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `cliente`
--

INSERT INTO `cliente` (`ClienteId`, `login`, `email`, `senha`, `PrimNome`, `UltNome`, `Endereco`, `Cidade`, `Cep`, `Telefone`) VALUES
(1, 'Jandira', 'Jandira@hotmail.com', '1234', 'Jandira', 'Silva', NULL, NULL, NULL, NULL),
(2, 'Ricardo', 'Ricardo@hotmail.com', '1234', 'Ricardo', 'Ribeiro', NULL, NULL, NULL, NULL),
(3, 'Lucas', 'Lucas@hotmail.com', '1234', 'Lucas', 'Carlos', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedido`
--

CREATE TABLE `pedido` (
  `PedidoId` int(11) NOT NULL,
  `DataCompra` date NOT NULL,
  `DataEntrega` date DEFAULT NULL,
  `Frete` varchar(45) DEFAULT NULL,
  `Status` varchar(45) DEFAULT NULL,
  `referencia` varchar(45) DEFAULT NULL,
  `cliente_ClienteId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedido_has_produto`
--

CREATE TABLE `pedido_has_produto` (
  `pedido_PedidoId` int(11) NOT NULL,
  `produto_ProdutoId` int(11) NOT NULL,
  `Quantidade` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto`
--

CREATE TABLE `produto` (
  `ProdutoId` int(11) NOT NULL,
  `ProdNome` varchar(45) NOT NULL,
  `Descricao` varchar(45) NOT NULL,
  `PrecoVenda` varchar(45) NOT NULL,
  `PrecoCusto` varchar(45) NOT NULL,
  `categoria_produtos_id_categoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `produto`
--

INSERT INTO `produto` (`ProdutoId`, `ProdNome`, `Descricao`, `PrecoVenda`, `PrecoCusto`, `categoria_produtos_id_categoria`) VALUES
(1, 'Samsumg', 'Samsumg', '500.00', '450.00', 1),
(2, 'Guarda Roupa', 'Guarda Roupa', '320.00', '200.00', 2),
(3, 'Smart TV LG - 47000', 'Smart TV LG - 47000, 42 Polegadas', '2000.00', '1500.00', 3),
(4, 'Toalha de Banho', 'Toalha de banho', '10.00', '5.00', 6);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categoria_produtos`
--
ALTER TABLE `categoria_produtos`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indexes for table `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`ClienteId`);

--
-- Indexes for table `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`PedidoId`,`cliente_ClienteId`),
  ADD KEY `fk_pedido_cliente1_idx` (`cliente_ClienteId`);

--
-- Indexes for table `pedido_has_produto`
--
ALTER TABLE `pedido_has_produto`
  ADD PRIMARY KEY (`pedido_PedidoId`,`produto_ProdutoId`),
  ADD KEY `fk_pedido_has_produto_produto_idx` (`produto_ProdutoId`),
  ADD KEY `fk_pedido_has_produto_pedido_idx` (`pedido_PedidoId`);

--
-- Indexes for table `produto`
--
ALTER TABLE `produto`
  ADD PRIMARY KEY (`ProdutoId`,`categoria_produtos_id_categoria`),
  ADD KEY `fk_Produtos_categoria_produtos_idx` (`categoria_produtos_id_categoria`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categoria_produtos`
--
ALTER TABLE `categoria_produtos`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `cliente`
--
ALTER TABLE `cliente`
  MODIFY `ClienteId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `pedido`
--
ALTER TABLE `pedido`
  MODIFY `PedidoId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `produto`
--
ALTER TABLE `produto`
  MODIFY `ProdutoId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `fk_pedido_cliente1` FOREIGN KEY (`cliente_ClienteId`) REFERENCES `cliente` (`ClienteId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `pedido_has_produto`
--
ALTER TABLE `pedido_has_produto`
  ADD CONSTRAINT `fk_pedido_has_produto_pedido` FOREIGN KEY (`pedido_PedidoId`) REFERENCES `pedido` (`PedidoId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_pedido_has_produto_produto` FOREIGN KEY (`produto_ProdutoId`) REFERENCES `produto` (`ProdutoId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `produto`
--
ALTER TABLE `produto`
  ADD CONSTRAINT `fk_Produtos_categoria_produtos` FOREIGN KEY (`categoria_produtos_id_categoria`) REFERENCES `categoria_produtos` (`id_categoria`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
