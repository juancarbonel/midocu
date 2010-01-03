<?php
require_once ('INuevoRegistro.php');

/**
 * @author Anthony Cantuta Jorge
 * @version 1.0
 * @created 05-dic-2008 01:23:05 a.m.
 */
class RegTipoDocumento implements INuevoRegistro
{

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

	


	public function registrar()
	{
		$db=FabricaBaseDatos::crear();
		$nuevoReg=array("nombre"=>$this->_nombre,
		"descripcion"=>$this->_descripcion
		);
		
		if($db->insert('tipo_documento',$nuevoReg))
		{
			$this->_ultimoIdInsertado=$db->lastInsertId('tipo_documento');
			return true;	
		}else{
			return false;
		}
		
	}

	public function get_ultimoIdInsertado()
	{
		return $this->_ultimoIdInsertado;
	}
	

}
?>