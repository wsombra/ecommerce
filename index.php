<?php 

//index é a página principal 

// Autoload do composer para as dependencias 
require_once("vendor/autoload.php");
// namespaces - rotas
use \Slim\Slim;
use \Hcode\Page;
use \Hcode\PageAdmin;
$app = new \Slim\Slim();

$app->config('debug', true);

//Rota Principal 
$app->get('/', function() {

	$page  = new Page();
	$page->setTpl("index");
});

//Rota Adm
$app->get('/admin', function() {

	$page  = new PageAdmin();
	$page->setTpl("index");
});

$app->run();

?>