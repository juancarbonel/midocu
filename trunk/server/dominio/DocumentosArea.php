<?php


/**
 * @author Anthony Cantuta Jorge
 * @version 1.0
 * @created 11-dic-2008 04:12:09 p.m.
 */
class DocumentosArea implements IRegistros
{

	private $_idArea;
	
	/**
	 * @return String
	 */
	public function get_idArea() {
		return $this->_idArea;
	}
	
	/**
	 * @param String $_idArea
	 */
	public function set_idArea($_idArea) {
		$this->_idArea = $_idArea;
	}
	function __construct($idArea=null)
	{
		$this->_idArea=$idArea;
	}

	function __destruct()
	{
	}

	public function cargar()
	{
		$db=FabricaBaseDatos::crear();
		$select = $db->select()
		->from('documento');
		
		$rows = $db->fetchAll($select);
		
		return true;
		
	}
	



}
?>