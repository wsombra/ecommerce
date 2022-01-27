<?php

namespace Hcode;

//Herança....
class PageAdmin extends Page {

	public function __construct($opt = array(), $tpl_dir ="/views/admin/"){

		//chamando o construtor da class Page
		parent::__construct($opt, $tpl_dir);
	}
}



?>