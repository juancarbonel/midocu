<?php
require_once ('RemitenteReg.php');

/**
 * @author Anthony Cantuta Jorge
 * @version 1.0
 * @created 04-dic-2008 08:18:48 p.m.
 */
class PersonaJuridicaReg extends RemitenteReg implements IRemitente
{
	private $_ruc;
	private $_direccion;
	private $_razonSocial;


	

	function __construct()
	{
	}

	function __destruct()
	{
	}

	public function getNombre()
	{
	}

	public function getNombreRemite()
	{
	}

	public function setNombreRemite()
	{
	}



}
?>