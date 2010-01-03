<?php
require_once ('EtapasAsunto.php');
require_once ('RequisitosAsunto.php');
require_once ('IRegistro.php');

/**
 * @author Anthony Cantuta Jorge
 * @version 1.0
 * @created 04-dic-2008 08:18:45 p.m.
 */
class Asunto implements IRegistro
{

	private $_etapas;
	private $_id;
	private $_nombre;
	private $_requisitos;
	private $_descripcion;
	
	/**
	 * @param String $_id
	 */
	public function set_id($_id) {
		$this->_id = $_id;
	}
	/**
	 * @return String
	 */
	public function get_descripcion() {
		return $this->_descripcion;
	}
	
	/**
	 * @return String
	 */
	public function get_etapas() {
		return $this->_etapas;
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
	 * @return String
	 */
	public function get_requisitos() {
		return $this->_requisitos;
	}
	
	/**
	 * @param String $_descripcion
	 */
	public function set_descripcion($_descripcion) {
		$this->_descripcion = $_descripcion;
	}
	
	/**
	 * @param String $_etapas
	 */
	public function set_etapas($_etapas) {
		$this->_etapas = $_etapas;
	}
	
	/**
	 * @param String $_nombre
	 */
	public function set_nombre($_nombre) {
		$this->_nombre = $_nombre;
	}
	
	/**
	 * @param String $_requisitos
	 */
	public function set_requisitos($_requisitos) {
		$this->_requisitos = $_requisitos;
	}
	function __construct($id=null)
	{		
			$this->_id=$id;
	}

	function __destruct()
	{
	}



	public function cargar()
	{
		$db=FabricaBaseDatos::crear();
		$select=$db
		->select()
		->limit(1,0)
		->from('asunto')
		->where('id_asunto = ?',$this->_id);
		$rows=$db->fetchAll($select);
		
		if(count($rows)>=1){
			$this->_nombre=$rows[0]['nombre'];
			$this->_descripcion=$rows[0]['descripcion'];
			return true;
		}
		return false;
	}

	public function eliminar() {
		if ($this->_id && ! empty ( $this->_id )) {
			$db = FabricaBaseDatos::crear ();
			if($db->delete ( 'asunto', 'id_asunto = ' . $this->_id )>=1){
				return true;
			}
		}
		return false;
	}
	
	public function actualizar() {
		if($this->_id && !empty($this->_id))
		{
			$db = FabricaBaseDatos::crear ();
		
			$datos = Array(
			'nombre' =>$this->_nombre,
			'descripcion' => $this->_descripcion
			);
		
			$db->update('asunto',$datos,'id_asunto = '.$this->_id);
			
				return true;
			
		}
		return false;
	}

	public function toXml()
	{
		$salida="<Area>";
			$salida.="<Id>";
				$salida.=$this->_id;
			$salida.="</Id>";
			
			$salida.="<Nombre>";
				$salida.=$this->_nombre;
			$salida.="</Nombre>";
			
			$salida.="<Descripcion>";
				$salida.=$this->_descripcion;
			$salida.="</Descripcion>";
		$salida.="</Area>";
		
		return $salida;
	}


}
?>