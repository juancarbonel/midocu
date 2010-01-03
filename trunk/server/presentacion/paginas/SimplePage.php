<?php
require_once ('Page.php');

/**
 * @author Anthony Cantuta Jorge
 * @version 1.0
 * @created 18-dic-2008 06:23:38 p.m.
 */
class SimplePage extends Page
{
	protected  $_title;
	protected  $_body;
	function __construct()
	{
	}

	function __destruct()
	{
	}



	/**
	 * 
	 * @param unTititulo
	 */
	public function setTitle($unTitulo)
	{
		$this->_title= $unTitulo;
	}

	/**
	 * 
	 * @param contenido
	 */
	public function setBody($contenido)
	{
		$this->_body=$contenido;
	}

	public function toString()
	{
	}

}
?>