<?php
require_once ('DerivacionDocumento.php');
require_once ('IRegistros.php');

/**
 * @author Anthony Cantuta Jorge
 * @version 1.0
 * @created 05-dic-2008 12:50:11 p.m.
 */
class DerivacionesDocumento implements IRegistros
{

	private $_elementos;

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
		->from('v_derivaciones_documento')
		->limit($numeroElementos,$desde)
		->where('id_documento = ? ',$this->_id);
		
		$rows=$db->fetchAll($select);
		
		foreach ($rows as $row){
			$unaDerivacion=new DerivacionDocumento();
			$unaDerivacion->set_fecha($row['d_fecha_reg']);
			$unaDerivacion->set_idAreaDestino($row['d_id_area_destino']);
			$unaDerivacion->set_idAreaEmisor($row['d_id_area_emision']);
			$unaDerivacion->set_idUsuarioDerivador($row['d_id_usuario_derivador']);
			$unaDerivacion->set_idDocumento('id_documento');
		}
		
		return true;
	}

}
?>