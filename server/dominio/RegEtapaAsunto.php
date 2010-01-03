<?php
Paquete::usar ( "dominio.Asunto" );
Paquete::usar ( "dominio.INuevoRegistro" );

/**
 * @author Anthony Cantuta Jorge
 * @version 1.0
 * @created 04-dic-2008 08:18:49 p.m.
 */
class RegEtapaAsunto implements INuevoRegistro
{
	
	
	private $_idAsunto;
	private $_descripcion;
	private $_nombre;
	private $_ultimoIdInsertado;
	private $_nroOrden;
	private $_idArea;
	
	/**
	 * @param String $_idArea
	 */
	public function set_idArea($_idArea) {
		if(!empty($_idArea))
		{
			$this->_idArea = $_idArea;
		}
	}
	
	/**
	 * @param String $_nroOrden
	 */
	public function set_nroOrden($_nroOrden) {
		if(!empty($_nroOrden))
		{
			$this->_nroOrden = $_nroOrden;
		}
	}
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
	 * @param String $_idAsunto
	 */
	public function set_idAsunto($_idAsunto) {
		if(!empty($_idAsunto))
		{
			$this->_idAsunto = $_idAsunto;
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


	function __construct($idAsunto)
	{
		$this->_idAsunto=$idAsunto;
	}

	function __destruct()
	{
	}



	public function registrar()
	{
		$db=FabricaBaseDatos::crear();
		$nuevoReg=array(
		"nombre"=>$this->_nombre,
		"descripcion"=>$this->_descripcion,
		"id_asunto"=>$this->_idAsunto,
		"nro_orden"=>$this->_nroOrden,
		"id_area"=>$this->_idArea
		);
		
		if($db->insert('etapa_asunto',$nuevoReg)>=1)
		{
			$this->_ultimoIdInsertado=$db->lastInsertId('etapa_asunto');
			return true;
		}else{
			return false;
		}
		
	}

	public function get_ultimoIdInsertado()
	{
	}

}
?>