<?php

Paquete::usar('dominio.INuevoRegistro');
/**
 * @author Anthony Cantuta Jorge
 * @version 1.0
 * @created 07-dic-2008 12:19:32 p.m.
 */
class RegAnexoDocumento implements INuevoRegistro
{

	private $_idDocumento;
	private $_nombre;
	private $_descripcion;
	private $_ultimoIdInsertado;
	
	/**
	 * @param String $_descripcion
	 */
	public function set_descripcion($_descripcion) {
		if(!empty($_descripcion)){
		$this->_descripcion = $_descripcion;
		}
	}
	
	/**
	 * @param String $_idDocumento
	 */
	public function set_idDocumento($_idDocumento) {
		if(!empty($_idDocumento)){
			$this->_idDocumento = $_idDocumento;
		}
		
	}
	
	/**
	 * @param String $_nombre
	 */
	public function set_nombre($_nombre) {
		if(!empty($_nombre)){
			$this->_nombre = $_nombre;
		}
		
	}
	function __construct()
	{
	}

	function __destruct()
	{
	}

	public function registrar()
	{	
		$db = FabricaBaseDatos::crear ();
		
		$nuevoReg = array (
		"id_documento"=>$this->_idDocumento,
		"nombre" => $this->_nombre,
		 "descripcion" => $this->_descripcion);
	
		
		if ($db->insert ( "anexo", $nuevoReg ) == 1) {
			$this->_ultimoIdInsertado = $db->lastInsertId ();
			return true;
		}else {
			return false;
		}
	}

	public function get_ultimoIdInsertado()
	{
		return $this->_ultimoIdInsertado;
	}



}
?>