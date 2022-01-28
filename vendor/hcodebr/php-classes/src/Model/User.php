<?php

namespace Hcode\Model;
use \Hcode\DB\Sql;
use \Hcode\Model;

class User extends Model{

	const SESSION = "User";

	public static function login($login, $password)
	{

		$sql = new Sql();

		$results = $sql->select("SELECT * FROM tb_users WHERE deslogin = :LOGIN", array(
			":LOGIN"=>$login
		));

  		// Validando o retorno da consulta 
		if(count($results)===0)
		{         
  			// "\" para reconhecer este  exception neste escopo 
			throw new \Exception("Usuário inexistente ou senha inválida");
		}

      	// Data recebendo o usuário para validar a senha 

		$data = $results[0];

		// Função para verificar a senha

		if(password_verify($password, $data["despassword"]))
		{

			$user = new User();

			// $user->setiduser($data["iduser"]);

			// Método para pegar todos os dados no banco
			$user->setData($data);

// Criando uma sessão e utilizando uma constante
			$_SESSION[User::SESSION] = $user->getValues();
			return  $user;

			 // var_dump($user);
			 // exit;
		}else{
						// "\" para reconhecer este  exception 
			throw new \Exception("Usuário inexistente ou senha inválida");

		}

	}

	public static function verifyLogin($inadmin = true)
	{
// Verificando se a sessao foi definida e validando e o usuario é da adimnistração

		if(
			!isset($_SESSION[User::SESSION])
			||
			!$_SESSION[User::SESSION]
			||
			!(int)$_SESSION[User::SESSION]["iduser"]>0
			||
			(bool)$_SESSION[User::SESSION]["inadmin"]!==$inadmin
		){

			// Redirecionar para a página de login
			header("Location: /admin/login");
			exit;
		}
	}


// Método deslogar 
	public static function logout()
	{
		$_SESSION[User::SESSION] = NULL;

	}
}
?>

