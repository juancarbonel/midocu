<?php


/**
 * @author Anthony Cantuta Jorge
 * @version 1.0
 * @created 23-dic-2008 10:42:41 p.m.
 */
class CriterioAsunto
{
	/**
	 * @return String
	 */
	public function get_nombreAsunto() {
		return $this->_nombreAsunto;
	}

	/**
	 * @param String $_nombreAsunto
	 */
	public function set_nombreAsunto($_nombreAsunto) {
		$this->_nombreAsunto = $_nombreAsunto;
	}


	private $_nombreAsunto;

	function __construct()
	{
	}

	



}
?>