<?php
//Definindo configurações globais
define("DB_SERVIDOR","localhost");
define("DB_USUARIO",");
define("DB_SENHA","");
define("DB_BASE","minimi_lilliput"); 
define("LOJA","mini-mi");
define("TEMPLATE_PATH", "template/" . LOJA . "/");
define("ADMINTEMPLATE_PATH", "../admin/template/");
define("IMG_PATH", "img/");
define("APP_PATH", "aplicativos/");
define("CLASS_PATH", "admin/classes/");
define("SUBFOLDER", "/lilliput/"); //se a loja estiver instalada em um subdiretório
define("USR_PATH", str_replace("index.php","",$_SERVER['SCRIPT_FILENAME']) . "usuarios/"); //pasta padrão para armazenagem de fotos dos usuários
define("USR_PAGES", "usr/"); //pasta padrão aonde ficam os arquivos de perfil de usuário
date_default_timezone_set("America/Sao_Paulo"); //timezone padrão

 
//Incluindo funções básicas
include("admin/funcoes/template.php"); //funções de montagem de template
include("admin/funcoes/basededados.php"); //funções de manipulação de DB
include("admin/funcoes/diversas.php"); //funções diversas do sistema
include("admin/funcoes/validacao.php"); //funções de validação de dados

//Funções do editor de mini-mi
include(APP_PATH . "editor-mini-mi/funcoes/basicas.php");
?>