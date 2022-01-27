<?php 

//index é a página principal 

// Autoload do composer para as dependencias 
require_once("vendor/autoload.php");
// namespaces - rotas
use \Slim\Slim;
use \Hcode\Page;
$app = new \Slim\Slim();

$app->config('debug', true);

$app->get('/', function() {

	$page  = new Page();
	$page->setTpl("index");
	//echo "OK";
// $sql = new Hcode\DB\Sql();
// $results = $sql->select("SELECT * FROM tb_users");
// echo json_encode($results);


});

$app->run();

?>