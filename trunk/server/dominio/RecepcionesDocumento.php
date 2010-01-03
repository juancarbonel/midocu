<?php
require_once ('RecepcionDocumento.php');
require_once ('IRegistros.php');

/**
 * @author Anthony Cantuta Jorge
 * @version 1.0
 * @created 05-dic-2008 12:50:19 p.m.
 */
class RecepcionesDocumento implements IRegistros
{

	private $_elementos=Array();
	private $_idDocumento;

	function __construct()
	{
	}





	

	public function getTotal()
	{
		return count($this->_elementos);
	}

	/**
	 * 
	 * @param desde
	 * @param numeroElementos
	 */
	public function cargar($desde,$numeroElementos)
	{
		$db=FabricaBaseDatos::crear();
		
		$select=$db->select()
		->from('v_recepciones_documento')
		->where('id_documento = ? ', $this->_idDocumento);
		
		$rows=$db->fetchAll($select);
		
		foreach ($rows as $row){
			$unaRecepcion=new RecepcionDocumento();
			$unaRecepcion->set_fecha($row['r_fecha']);
			$unaRecepcion->set_idAreaRecepciona($row['r_id_area_recepciona']);
			$unaRecepcion->set_idDocumento($row['id_documento']);
		}
		
		return true;
	}

}
?>