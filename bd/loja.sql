-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 29/06/2026 às 03:53
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `loja`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `anuncios`
--

CREATE TABLE `anuncios` (
  `idAnuncio` int(11) NOT NULL,
  `Usuarios_idUsuario` int(11) NOT NULL,
  `fotoAnuncio` varchar(100) NOT NULL,
  `tituloAnuncio` varchar(30) NOT NULL,
  `categoriaAnuncio` varchar(15) NOT NULL,
  `descricaoAnuncio` varchar(200) NOT NULL,
  `valorAnuncio` decimal(10,2) NOT NULL,
  `dataAnuncio` date NOT NULL,
  `horaAnuncio` time NOT NULL,
  `statusAnuncio` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `anuncios`
--

INSERT INTO `anuncios` (`idAnuncio`, `Usuarios_idUsuario`, `fotoAnuncio`, `tituloAnuncio`, `categoriaAnuncio`, `descricaoAnuncio`, `valorAnuncio`, `dataAnuncio`, `horaAnuncio`, `statusAnuncio`) VALUES
(5, 1, 'assets/img/images (9).jpg', 'Camiseta Eis-me Aqui', 'Camisetas', 'Camiseta Eis-me Aqui Tamanho', 65.00, '2026-06-22', '20:40:58', 'finalizado'),
(6, 1, 'assets/img/images (8).jpg', 'Camiseta Mergulhei', 'Camisetas', 'Camiseta Mergulhei em uma NOVA VIDA', 65.00, '2026-06-22', '20:41:41', 'finalizado'),
(7, 1, 'assets/img/images (7).jpg', 'Camiseta Eu sou  Ressureição', 'Camisetas', 'Camiseta Eu sou  Ressureição', 65.00, '2026-06-22', '20:42:22', 'disponivel'),
(8, 1, 'assets/img/images (6).jpg', 'Camiseta Jesus o Caminho', 'Camisetas', 'Camiseta Jesus o caminho', 70.00, '2026-06-22', '20:43:00', 'finalizado'),
(10, 1, 'assets/img/download (3).jpg', 'Camiseta Jesus Morreu por mim', 'Camisetas', 'Camiseta Jesus Morreu por mim', 95.00, '2026-06-22', '20:44:14', 'disponivel'),
(11, 1, 'assets/img/images (4).jpg', 'Camiseta Nação de Cristo', 'Camisetas', 'Camiseta Nação de Cristo', 80.00, '2026-06-22', '20:44:47', 'disponivel'),
(12, 1, 'assets/img/images (5).jpg', 'Camiseta OFF Duvida', 'Camisetas', 'Camiseta OFF Duvida', 50.00, '2026-06-22', '20:45:16', 'disponivel'),
(13, 1, 'assets/img/images (12).jpg', 'Caneca Jesus', 'Canecas', 'Caneca Jesus', 30.00, '2026-06-22', '20:49:14', 'disponivel'),
(14, 1, 'assets/img/images (11).jpg', 'Caneca A Cada Manhã', 'Canecas', 'Caneca A Cada Manhã', 30.00, '2026-06-22', '20:49:47', 'disponivel'),
(15, 1, 'assets/img/images (10).jpg', 'Caneca Leão de Judá', 'Canecas', 'Caneca Leão de Judá', 35.00, '2026-06-22', '20:50:13', 'disponivel'),
(16, 1, 'assets/img/images (15).jpg', 'Boné Jesus is King', 'Bonés', 'Boné Jesus is King', 70.00, '2026-06-22', '20:51:40', 'disponivel'),
(17, 1, 'assets/img/images (14).jpg', 'Boné 70x7', 'Bonés', 'Boné 70x7', 70.00, '2026-06-22', '20:52:01', 'disponivel'),
(18, 1, 'assets/img/images (13).jpg', 'Boné YESHUA', 'Bonés', 'Boné YESHUA', 70.00, '2026-06-22', '20:52:31', 'disponivel'),
(19, 1, 'assets/img/images (19).jpg', 'Moletom Ate que o Senhor venha', 'Moletons', 'Moletom Ate que o Senhor venha', 150.00, '2026-06-22', '20:55:34', 'disponivel'),
(20, 1, 'assets/img/images (18).jpg', 'Moletom A Terra Clama', 'Moletons', 'Moletom A Terra Clama', 150.00, '2026-06-22', '20:55:59', 'disponivel'),
(21, 1, 'assets/img/images (16).jpg', 'Moletom Jesus me Salvou', 'Moletons', 'Moletom Jesus me Salvou', 150.00, '2026-06-22', '20:56:25', 'disponivel'),
(22, 1, 'assets/img/images (17).jpg', 'Moletom IDE', 'Camisetas', 'Moletom IDE', 150.00, '2026-06-22', '20:56:48', 'disponivel'),
(23, 3, 'assets/img/download.jpg', 'Anuncio de camiseta Usuario', 'Camisetas', 'Camiseta Oversize', 75.00, '2026-06-28', '12:26:03', 'disponivel');

-- --------------------------------------------------------

--
-- Estrutura para tabela `compras`
--

CREATE TABLE `compras` (
  `idCompra` int(11) NOT NULL,
  `Usuarios_idUsuario` int(11) NOT NULL,
  `Anuncios_idAnuncio` int(11) NOT NULL,
  `dataCompra` date NOT NULL,
  `horaCompra` time NOT NULL,
  `valorCompra` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `compras`
--

INSERT INTO `compras` (`idCompra`, `Usuarios_idUsuario`, `Anuncios_idAnuncio`, `dataCompra`, `horaCompra`, `valorCompra`) VALUES
(2, 3, 6, '2026-06-28', '12:17:00', 65.00),
(3, 3, 6, '2026-06-28', '12:20:19', 65.00),
(4, 3, 12, '2026-06-28', '14:15:40', 50.00),
(5, 3, 12, '2026-06-28', '14:40:03', 50.00),
(6, 3, 12, '2026-06-28', '14:42:35', 50.00),
(7, 7, 8, '2026-06-28', '14:48:47', 70.00),
(8, 1, 23, '2026-06-28', '17:54:34', 75.00),
(9, 7, 6, '2026-06-28', '21:26:44', 65.00);

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `idUsuario` int(11) NOT NULL,
  `fotoUsuario` varchar(100) NOT NULL,
  `nomeUsuario` varchar(50) NOT NULL,
  `dataNascimentoUsuario` date NOT NULL,
  `cidadeUsuario` varchar(30) NOT NULL,
  `emailUsuario` varchar(50) NOT NULL,
  `senhaUsuario` varchar(100) NOT NULL,
  `nivelUsuario` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `fotoUsuario`, `nomeUsuario`, `dataNascimentoUsuario`, `cidadeUsuario`, `emailUsuario`, `senhaUsuario`, `nivelUsuario`) VALUES
(1, 'assets/img/images (1).jpg', 'Administrador Admin', '1999-03-23', 'Telêmaco Borba', 'administrador@gmail.com', '202cb962ac59075b964b07152d234b70', 'administrador'),
(3, 'assets/img/download (1).jpg', 'FULANO', '1995-03-04', 'Imbaú', 'usuario@gmail.com', '202cb962ac59075b964b07152d234b70', 'usuario'),
(6, 'assets/img/download (2).jpg', 'Pessoa dog', '2023-01-02', 'Ortigueira', 'dog@gmail.com', '202cb962ac59075b964b07152d234b70', 'usuario'),
(7, 'assets/img/download (2).jpg', 'Teste denovo', '2026-06-10', 'Telêmaco Borba', 'teste@teste.com', '202cb962ac59075b964b07152d234b70', 'usuario');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `anuncios`
--
ALTER TABLE `anuncios`
  ADD PRIMARY KEY (`idAnuncio`),
  ADD KEY `fk_anuncios_usuarios` (`Usuarios_idUsuario`);

--
-- Índices de tabela `compras`
--
ALTER TABLE `compras`
  ADD PRIMARY KEY (`idCompra`),
  ADD KEY `fk_compras_usuarios` (`Usuarios_idUsuario`),
  ADD KEY `fk_compras_anuncios` (`Anuncios_idAnuncio`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUsuario`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `anuncios`
--
ALTER TABLE `anuncios`
  MODIFY `idAnuncio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de tabela `compras`
--
ALTER TABLE `compras`
  MODIFY `idCompra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `anuncios`
--
ALTER TABLE `anuncios`
  ADD CONSTRAINT `fk_anuncios_usuarios` FOREIGN KEY (`Usuarios_idUsuario`) REFERENCES `usuarios` (`idUsuario`);

--
-- Restrições para tabelas `compras`
--
ALTER TABLE `compras`
  ADD CONSTRAINT `fk_compras_anuncios` FOREIGN KEY (`Anuncios_idAnuncio`) REFERENCES `anuncios` (`idAnuncio`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_compras_usuarios` FOREIGN KEY (`Usuarios_idUsuario`) REFERENCES `usuarios` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
