<?php
require_once ('INuevoRegistro.php');

/**
 * @author Anthony Cantuta Jorge
 * @version 1.0
 * @created 07-dic-2008 12:06:01 p.m.
 */
class RegRemitentePersonaJuridica {
	
	private $_direccion;
	private $_ruc;
	private $_telefono;
	private $_ultimoIdInsertado;
	private $_razonSocial;
	private $_idRemitente;
	
	/**
	 * @param String $_direccion
	 */
	public function set_direccion($_direccion) {
		if (! empty ( $_direccion )) {
			$this->_direccion = $_direccion;
		}
	}
	
	/**
	 * @param String $_idRemitente
	 */
	public function set_idRemitente($_idRemitente) {
		if (! empty ( $_idRemitente )) {
			$this->_idRemitente = $_idRemitente;
		}
	}
	
	/**
	 * @param String $_razonSocial
	 */
	public function set_razonSocial($_razonSocial) {
		if (! empty ( $_razonSocial )) {
			$this->_razonSocial = $_razonSocial;
		}
	}
	
	/**
	 * @param String $_ruc
	 */
	public function set_ruc($_ruc) {
		if (! empty ( $_ruc )) {
			$this->_ruc = $_ruc;
		}
	}
	
	/**
	 * @param String $_telefono
	 */
	public function set_telefono($_telefono) {
		if(!empty($_telefono)){
		$this->_telefono = $_telefono;
		}
		
	}
	
	function registrar() {
		$db = FabricaBaseDatos::crear ();
		$nuevoReg = array (
		"id_remitente" => $this->_idRemitente,
		"razon_social" =>$this->_razonSocial,
		"ruc"=>$this->_ruc,
		"direccion"=>$this->_direccion,
		);
		
		if ($db->insert ( 'PersonaJuridica', $nuevoReg ) >= 1) {
			$this->_ultimoIdInsertado = $db->lastInsertId ( 'PersonaJuridica' );
			return true;
		}
		return false;
	}
	
	function get_ultimoIdInsertado() {
	}

}
?>