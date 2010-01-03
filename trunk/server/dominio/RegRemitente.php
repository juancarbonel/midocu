<?php
Paquete::usar ( "dominio.DocumentoReg" );
Paquete::usar ( "dominio.INuevoRegistro" );

/**
 * @author Anthony Cantuta Jorge
 * @version 1.0
 * @created 04-dic-2008 08:18:50 p.m.
 */
class RegRemitente implements INuevoRegistro {
	
	
	private $_email;
	private $_telefono;
	private $_ultimoIdInsertado;
	
	function __construct() {
	}
	
	function __destruct() {
	}
	
	/**
	 * @param String $_email
	 */
	public function set_email($_email) {
		if (! empty ( $_email )) {
			$this->_email = $_email;
		}
	}
	
	
	
	/**
	 * @param String $_telefono
	 */
	public function set_telefono($_telefono) {
		if(!empty($_telefono))
		{
			$this->_telefono = $_telefono;
		}
	}
	
	public function registrar() {
		$db = FabricaBaseDatos::crear ();
		
		$nuevoReg = array (
		"email" => $this->_email,
		"telefono" => $this->_telefono );
		
		if ($db->insert ( 'remitente', $nuevoReg ) == 1) {
			$this->_ultimoIdInsertado = $db->lastInsertId ( 'remitente' );
			return true;
		} else {
			return false;
		}
	}
	
	public function get_ultimoIdInsertado() {
		return $this->_ultimoIdInsertado;
	}

}
?>