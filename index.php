<?php 

//index é a página principal 

//Start da sessão

session_start();
// Autoload do composer para as dependencias 
require_once("vendor/autoload.php");
// namespaces - rotas
use \Slim\Slim;
use \Hcode\Page;
use \Hcode\PageAdmin;
use \Hcode\Model\User;

$app = new \Slim\Slim();

$app->config('debug', true);

//Rota Principal 
$app->get('/', function() {

	$page  = new Page();
	$page->setTpl("index");
});

//Rota Adm
$app->get('/admin', function() {

 //Método para verifica se o usuario já esta logado

	User::verifyLogin();

	$page  = new PageAdmin();
	$page->setTpl("index");
});

//Rota login
$app->get('/admin/login', function() {
// header e footer false para não chamar o construtor de destrutor de Page 
	$page  = new PageAdmin([
		"header"=> false,
		"footer"=> false
	]);
	$page->setTpl("login");
});

 // Recebendo o fomulário login
$app->post('/admin/login', function(){

	//Método estático login 
	User::login($_POST["login"], $_POST["password"]);
	// Redirecionando para a pagina de administração
	header("Location: /admin");
	exit;
});

// RestFull...trabalhar com rotas...
$app->get('/admin/logout', function()
{
	User::logout();
	// Redirecionando
	header('Location: /admin/login');
	exit;
});

$app->run();

?>