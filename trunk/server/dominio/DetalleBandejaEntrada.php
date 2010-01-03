<?php
require_once ('Asunto.php');
require_once ('RemitenteReg.php');

/**
 * @author Anthony Cantuta Jorge
 * @version 1.0
 * @created 17-dic-2008 10:11:20 a.m.
 */
class DetalleBandejaEntrada
{

	private $_asunto;
	private $_remitente;
	private $_fecha;
	private $_idDocumento;
	
	/**
	 * @return String
	 */
	public function get_idDocumento() {
		return $this->_idDocumento;
	}
	
	/**
	 * @param String $_idDocumento
	 */
	public function set_idDocumento($_idDocumento) {
		$this->_idDocumento = $_idDocumento;
	}
	/**
	 * @return String
	 */
	public function get_asunto() {
		return $this->_asunto;
	}
	
	/**
	 * @return String
	 */
	public function get_fecha() {
		return $this->_fecha;
	}
	
	/**
	 * @return String
	 */
	public function get_remitente() {
		return $this->_remitente;
	}
	
	/**
	 * @param String $_asunto
	 */
	public function set_asunto($_asunto) {
		$this->_asunto = $_asunto;
	}
	
	/**
	 * @param String $_fecha
	 */
	public function set_fecha($_fecha) {
		$this->_fecha = $_fecha;
	}
	
	/**
	 * @param String $_remitente
	 */
	public function set_remitente($_remitente) {
		$this->_remitente = $_remitente;
	}
	function __construct()
	{
	}

	



}
?>