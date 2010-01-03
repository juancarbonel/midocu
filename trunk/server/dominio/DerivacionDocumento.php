<?php
require_once ('IRegistro.php');

/**
 * @author Anthony Cantuta Jorge
 * @version 1.0
 * @created 04-dic-2008 08:18:45 p.m.
 */
class DerivacionDocumento implements IConvertibleXml  {
	
	private $_fecha;
	private $_idDocumento;
	private $_idAreaDestino;
	/**
	 * @return String
	 */
	public function get_idAreaEmisor() {
		return $this->_idAreaEmisor;
	}
	
	/**
	 * @param String $_idAreaEmisor
	 */
	public function set_idAreaEmisor($_idAreaEmisor) {
		$this->_idAreaEmisor = $_idAreaEmisor;
	}

	private $_idUsuarioDerivador;
	private $_idAreaEmisor;
	
	/**
	 * @return String
	 */
	public function get_fecha() {
		return $this->_fecha;
	}
	
	/**
	 * @return String
	 */
	public function get_idAreaDestino() {
		return $this->_idAreaDestino;
	}
	
	
	
	/**
	 * @return String
	 */
	public function get_idDocumento() {
		return $this->_idDocumento;
	}
	
	/**
	 * @return String
	 */
	public function get_idUsuarioDerivador() {
		return $this->_idUsuarioDerivador;
	}
	
	/**
	 * @param String $_fecha
	 */
	public function set_fecha($_fecha) {
		$this->_fecha = $_fecha;
	}
	
	/**
	 * @param String $_idAreaDestino
	 */
	public function set_idAreaDestino($_idAreaDestino) {
		$this->_idAreaDestino = $_idAreaDestino;
	}
	
	
	
	/**
	 * @param String $_idDocumento
	 */
	public function set_idDocumento($_idDocumento) {
		$this->_idDocumento = $_idDocumento;
	}
	
	/**
	 * @param String $_idUsuarioDerivador
	 */
	public function set_idUsuarioDerivador($_idUsuarioDerivador) {
		$this->_idUsuarioDerivador = $_idUsuarioDerivador;
	}
	function __construct($idDocumento) {
		$this->_idDocumento = $idDocumento;
	}
	
	function __destruct() {
	
	}
	
	public function toXml() {
	}

}
?>