<?php
//Rota onde a classe se encontra 
namespace Hcode;
// "use" para informar se utilizar uma classe em outro namespace
use Rain\Tpl;
//Constuindo a classe Page
class Page{
// criando a varivel para ficar acessível dentro da classe
	private $tpl;
	private $options=[];
//Opções default
	private $defaults=[
		"header" => true,
		"footer" => true,
		"data"=>[]
	]; 
	//Métodos construtores __contruct() e __destruct()
                               // tpl_dir = "/views/" como chamada principal
	public function __construct($opt = array(), $tpl_dir = "/views/"){
		// Juntando as opções passadas com as default, atenção com a ordem pois a segunda sobrescreve a primeira
		$this->options = array_merge($this->defaults, $opt);
		// Trecho de código extraido dos exemplos ..
		$config = array(
			//Caminho para ele pegar os arquivos, utilizando a variavel de ambiente
			"tpl_dir"       => $_SERVER['DOCUMENT_ROOT'].$tpl_dir,
			// Após montar o template salva em "cache para posterior utilização"
			"cache_dir"     => $_SERVER['DOCUMENT_ROOT']."/views-cache/",
			//"degug ativo mostra erros na tela "
			"debug"         => false // set to false to improve the speed
		);
		// Montando o template passando a variavel
		Tpl::configure( $config );
		// create the Tpl object
		$this->tpl = new Tpl;
		$this->setData($this->options['data']);
		//Desenhando
		if($this->options["header"]===true)$this->tpl->draw("header"); 
		
	}

	public function setData($data = array())
	{

		foreach($data as $key => $value)
		{
			$this->tpl->assign($key, $value);
		}
	}

// Método que vamos trabalhar o "corpo da página"
	public function setTpl($name , $data=array(), $returnHTML = false){

		$this->setData($data);
		return $this->tpl->draw($name, $returnHTML);
	}
	public function __destruct(){
		//Desenhando 
		// if ...
		if($this->options["footer"]===true)$this->tpl->draw("footer");

	}
}
?>