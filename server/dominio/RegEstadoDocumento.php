<?php

Paquete::usar('dominio.INuevoRegistro');
/**
 * @author Anthony Cantuta Jorge
 * @version 1.0
 * @created 07-dic-2008 12:48:47 p.m.
 */
class RegEstadoDocumento implements INuevoRegistro
{

	private $_nombre;
	private $_descripcion;
	private $_ultimoIdInsertado;
	
	
	
	/**
	 * @param String $_descripcion
	 */
	public function set_descripcion($_descripcion) {
		if(!empty($_descripcion))
		{
			$this->_descripcion = $_descripcion;
		}
	}
	
	/**
	 * @param String $_nombre
	 */
	public function set_nombre($_nombre) {
		if(!empty($_nombre))
		{
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
		$db=FabricaBaseDatos::crear();
		$nuevoReg=array(
		'nombre'=>$this->_nombre,
		'descripcion'=>$this->_descripcion
		);
		
		if($db->insert('estado_documento',$nuevoReg)>=1){
			$this->_ultimoIdInsertado=$db->lastInsertId();
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