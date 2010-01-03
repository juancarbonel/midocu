<?php
require_once ('IRegistro.php');

/**
 * @author Anthony Cantuta Jorge
 * @version 1.0
 * @created 04-dic-2008 08:18:47 p.m.
 */
class EtapaAsunto implements IRegistro
{

	private $_id;
	private $_descripcion;
	private $_nombre;
	
	/**
	 * @return String
	 */
	public function get_descripcion() {
		return $this->_descripcion;
	}
	
	/**
	 * @return String
	 */
	public function get_id() {
		return $this->_id;
	}
	
	/**
	 * @return String
	 */
	public function get_nombre() {
		return $this->_nombre;
	}
	
	/**
	 * @param String $_descripcion
	 */
	public function set_descripcion($_descripcion) {
		$this->_descripcion = $_descripcion;
	}
	
	/**
	 * @param String $_nombre
	 */
	public function set_nombre($_nombre) {
		$this->_nombre = $_nombre;
	}
	function __construct($id)
	{
		$this->_id=$id;
	}

	function __destruct()
	{
	}



	public function cargar(){
	$db=FabricaBaseDatos::crear();
		$select=$db->select()->from('etapa_asunto')
		->limit(1,0)
		->where('id_etapa_asunto= ? ',$this->_id);
		$rows=$db->fetchAssoc($select);
		if(count($rows)>=1){
			$this->_nombre = $rows[0]['nombre'];
			$this->_descripcion = $rows[0]['descripcion'];
		}
		
	}

	public function eliminar()
	{
		if($this->_id && !empty($this->_id)){
			$db= FabricaBaseDatos::crear();
			if($db->delete("etapa_asunto","id_etapa_asunto = ".$this->_id)>=1){
				return true;
			}
		}
		return false;
	}

	public function actualizar()
	{
	}

	public function toXml()
	{
	}

	
}
?>