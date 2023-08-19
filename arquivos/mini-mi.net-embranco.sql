-- phpMyAdmin SQL Dump
-- version 3.1.2deb1ubuntu0.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: Out 05, 2009 as 03:18 PM
-- Versão do Servidor: 5.0.75
-- Versão do PHP: 5.2.6-3ubuntu4.2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de Dados: `mini-mi`
--
CREATE DATABASE `minimi_plushpin` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `minimi_plushpin`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `mini_cadastro`
--

CREATE TABLE IF NOT EXISTS `mini_cadastro` (
  `id` bigint(20) NOT NULL,
  `cadastro_nome` text character set utf8 NOT NULL,
  `cadastro_sexo` varchar(1) character set utf8 NOT NULL,
  `cadastro_cpf` int(11) NOT NULL,
  `cadastro_endereco` text character set utf8 NOT NULL,
  `cadastro_complemento` text character set utf8 NOT NULL,
  `cadastro_bairro` varchar(30) character set utf8 NOT NULL,
  `cadastro_cidade` varchar(30) character set utf8 NOT NULL,
  `cadastro_estado` varchar(2) character set utf8 NOT NULL,
  `cadastro_cep` int(8) NOT NULL,
  `cadastro_telefone` varchar(14) character set utf8 NOT NULL,
  `cadastro_email` varchar(30) character set utf8 NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `mini_cadastro`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `mini_conteudo`
--

CREATE TABLE IF NOT EXISTS `mini_conteudo` (
  `conteudo_numregistro` int(11) NOT NULL auto_increment,
  `conteudo_titulo` text character set utf8 NOT NULL,
  `conteudo_corpo` text character set utf8 NOT NULL,
  `conteudo_tags` text character set utf8 NOT NULL,
  `conteudo_categoria` text character set utf8 NOT NULL,
  `conteudo_permalink` text character set utf8 NOT NULL,
  `conteudo_local` varchar(50) character set utf8 NOT NULL,
  `contedudo_publicado` int(11) NOT NULL default '0',
  PRIMARY KEY  (`conteudo_numregistro`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Extraindo dados da tabela `mini_conteudo`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `mini_financeiro`
--

CREATE TABLE IF NOT EXISTS `mini_financeiro` (
  `id` int(11) NOT NULL,
  `financeiro_numregistro` varchar(16) NOT NULL,
  `financeiro_aplique` float NOT NULL,
  `financeiro_frete` float NOT NULL,
  `financeiro_especial` float NOT NULL,
  `financeiro_especiadescricao` text NOT NULL,
  `financeiro_formapagamento` varchar(10) NOT NULL,
  `financeiro_parcela` int(11) NOT NULL default '1',
  `financeiro_quitado` int(11) NOT NULL default '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `mini_financeiro`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `mini_galeria`
--

CREATE TABLE IF NOT EXISTS `mini_galeria` (
  `id` int(20) NOT NULL,
  `galeria_numregistro` varchar(16) character set utf8 NOT NULL,
  `galeria_idarquivo` varchar(100) character set utf8 NOT NULL,
  `galeria_tipoarquivo` varchar(30) character set utf8 NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `mini_galeria`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `mini_pedido`
--

CREATE TABLE IF NOT EXISTS `mini_pedido` (
  `id` bigint(20) NOT NULL,
  `pedido_numregistro` varchar(16) character set utf8 NOT NULL,
  `pedido_apelido` varchar(20) character set utf8 NOT NULL,
  `pedido_status` varchar(10) character set utf8 NOT NULL,
  `pedido_cabelo` varchar(50) character set utf8 NOT NULL,
  `pedido_rosto` varchar(50) character set utf8 NOT NULL,
  `pedido_roupasuperior` varchar(50) character set utf8 NOT NULL,
  `pedido_roupainferior` varchar(50) character set utf8 NOT NULL,
  `pedido_caracteristicasfisicas` text character set utf8 NOT NULL,
  `pedido_gostosdescricao` text character set utf8 NOT NULL,
  `pedido_dataespecial` date NOT NULL,
  `pedido_aplique` varchar(1) character set utf8 NOT NULL,
  `pedido_apliquedescricao` text character set utf8 NOT NULL,
  `pedido_roupaespecial` varchar(1) character set utf8 NOT NULL,
  `pedido_roupaespecialdescricao` text character set utf8 NOT NULL,
  `pedido_tipocorreio` varchar(10) character set utf8 NOT NULL,
  `pedido_codrastreiro` varchar(13) character set utf8 NOT NULL,
  `pedido_hora` time NOT NULL,
  `pedido_data` date NOT NULL,
  `pedido_foto1` varchar(100) character set utf8 NOT NULL,
  `pedido_foto2` varchar(100) character set utf8 NOT NULL,
  `pedido_foto3` varchar(100) character set utf8 NOT NULL,
  `pedido_horanascimento` time NOT NULL,
  `pedido_datanascimento` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `mini_pedido`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `mini_profile`
--

CREATE TABLE IF NOT EXISTS `mini_profile` (
  `id` int(20) NOT NULL,
  `profile_numregistro` varchar(16) character set utf8 NOT NULL,
  `profile_apelido` varchar(20) character set utf8 NOT NULL,
  `profile_bio` text character set utf8 NOT NULL,
  `profile_horanascimento` time NOT NULL,
  `profile_datanascimento` date NOT NULL,
  `profile_signo` text character set utf8 NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `mini_profile`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `mini_tecidoteca`
--

CREATE TABLE IF NOT EXISTS `mini_tecidoteca` (
  `tecidoteca_codigo` varchar(7) character set utf8 NOT NULL,
  `tecidoteca_corrgb` int(9) NOT NULL,
  `tecidoteca_corhexa` varchar(6) character set utf8 NOT NULL,
  `tecidoteca_retalho` int(1) NOT NULL,
  `tecidoteca_anocompra` date NOT NULL,
  `tecidoteca_tags` text character set utf8 NOT NULL,
  `tecidoteca_idfoto` varchar(100) character set utf8 NOT NULL,
  `tecidoteca_tipotecido` varchar(8) character set utf8 NOT NULL,
  `tecidoteca_metragemtotal` float NOT NULL,
  `tecidoteca_metragematual` float NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `mini_tecidoteca`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `mini_usuario`
--

CREATE TABLE IF NOT EXISTS `mini_usuario` (
  `id` bigint(20) NOT NULL auto_increment,
  `usuario_login` varchar(60) character set utf8 NOT NULL,
  `usuario_senha` int(64) NOT NULL,
  `usuario_email` varchar(100) character set utf8 NOT NULL,
  `usuario_ultimologinhora` time NOT NULL,
  `usuario_ultimologindata` date NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Extraindo dados da tabela `mini_usuario`
--

