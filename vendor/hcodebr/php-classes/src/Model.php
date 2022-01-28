<?php

namespace Hcode;


class Model{


	private $values=[];

 // Metodo mágico __call pegando o nome do metodo e arqumentos 

	public function __call($name, $args)
	{

 	// Identificando se a chamada e get ou set comparando as três primeiras letras

		$method = substr($name, 0 , 3);
		// Nome do campo que foi chamado

		$fieldname = substr($name, 3, strlen($name));

		// var_dump($method, $fieldname); 
		// exit;

		switch($method)
		{
			// Retornando um valor 
			case "get":
			return $this->values[$fieldname];
			break;
			case "set":
			$this->values[$fieldname] = $args[0];
			break;
		}
	}

	public function setData($data = array())
	{

		foreach($data as $key => $value)
		{
			// Criando dinamicamente {}
			$this->{"set".$key}($value);
		}
	}

	public function getValues()
	{

		return $this->values;


	}

}
?>