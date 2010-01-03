<?php
require_once ('Area.php');
require_once ('Usuario.php');
require_once ('IRegistros.php');

/**
 * @author Anthony Cantuta Jorge
 * @version 1.0
 * @created 05-dic-2008 12:50:25 p.m.
 */
class UsuariosArea implements IRegistros
{

	private $_idArea;
	private $_usuarios=Array();

	function __construct()
	{
	}

	function __destruct()
	{
	}

	public function getTotal()
	{
	}

	/**
	 * 
	 * @param desde
	 * @param numeroElementos
	 */
	public function cargar(Int $desde, Int $numeroElementos)
	{
	}

}
?>