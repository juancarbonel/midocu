<?php


/**
 * @author Anthony Cantuta Jorge
 * @version 1.0
 * @created 23-dic-2008 10:42:25 p.m.
 */
class CriterioRemitente
{

	private $_nombreRemitente;
	private $_email;
	
	/**
	 * @return String
	 */
	public function get_email() {
		return $this->_email;
	}
	
	/**
	 * @return String
	 */
	public function get_nombreRemitente() {
		return $this->_nombreRemitente;
	}
	/**
	 * @param String $_email
	 */
	public function set_email($_email) {
		$this->_email = $_email;
	}
	
	/**
	 * @param String $_nombreRemitente
	 */
	public function set_nombreRemitente($_nombreRemitente) {
		$this->_nombreRemitente = $_nombreRemitente;
	}
	function __construct()
	{
	}

	



}
?>