<?php
Paquete::usar ( "dominio.INuevoRegistro" );

/**
 * @author Anthony Cantuta Jorge
 * @version 1.0
 * @created 04-dic-2008 08:18:49 p.m.
 */
class RegDerivarDocumento implements INuevoRegistro
{

	private $_idDocumento;
	private $_idAreaEmision;
	private $_idAreaRecepcion;
	private $_idUsuarioDeriva;
	private $_ultimoIdInsertado;

	function __construct()
	{
	}

	function __destruct()
	{
	}
	
	/**
	 * @param String $_idAreaEmision
	 */
	public function set_idAreaEmision($_idAreaEmision) {
		if(!empty($_idAreaEmision))
		{
			$this->_idAreaEmision = $_idAreaEmision;
		}
	}
	
	/**
	 * @param String $_idAreaRecepcion
	 */
	public function set_idAreaRecepcion($_idAreaRecepcion) {
		if(!empty($_idAreaRecepcion))
		{
			$this->_idAreaRecepcion = $_idAreaRecepcion;
		}
	}
	
	/**
	 * @param String $_idDocumento
	 */
	public function set_idDocumento($_idDocumento) {
		if(!empty($_idDocumento))
		{
			$this->_idDocumento = $_idDocumento;
		}
	}
	
	/**
	 * @param String $_idUsuarioDeriva
	 */
	public function set_idUsuarioDeriva($_idUsuarioDeriva) {
		if(!empty($_idUsuarioDeriva))
		{
			$this->_idUsuarioDeriva = $_idUsuarioDeriva;
		}
	}



	public function registrar(){
		
		$db=FabricaBaseDatos::crear();
		
		$nuevoReg=array(
		"id_usuario_derivador"=>$this->_idUsuarioDeriva,
		"id_area_destino"=>$this->_idAreaRecepcion,
		"id_area_emision"=>$this->_idAreaEmision,
		"id_documento"=>$this->_idDocumento,
		"fecha_reg"=>date("Y-m-d H:i:s")
		);
		
		if($db->insert('derivacion_documento',$nuevoReg)==true){
			$this->_ultimoIdInsertado=$db->lastInsertId('derivacion_documento');
			return true;
		}else{
			return false;
		}
	}

	public function get_ultimoIdInsertado(){
		return $this->_ultimoIdInsertado;
	}

}
?>