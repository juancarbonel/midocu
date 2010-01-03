<?php
Paquete::usar ( "dominio.IRegistro" );

/**
 * @author Anthony Cantuta Jorge
 * @version 1.0
 * @created 04-dic-2008 08:18:51 p.m.
 */
class TipoDocumento implements IRegistro
{

	private $_id;
	private $_nombre;
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
		if(!empty($_descripcion)){
		$this->_descripcion = $_descripcion;
		}
	}
	
	/**
	 * @param String $_nombre
	 */
	public function set_nombre($_nombre) {
		if(!empty($_nombre)){
		$this->_nombre = $_nombre;
		}
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
		$select=$db->select()
		->from('tipo_documento')
		->limit(1,0)
		->where('id_tipo_documento = ? ',$this->_id);
		
		$rows=$db->fetchAll($select);
		if (count($rows)==1){
			$this->_nombre=$rows[0]['nombre'];
			$this->_descripcion=$rows[0]['descripcion'];
			return true;
		}
		return false;
	}

public function eliminar() {
		if ($this->_id && ! empty ( $this->_id )) {
			$db = FabricaBaseDatos::crear ();
			if($db->delete ( 'tipo_documento', 'tipo_documento = ' . $this->_id )>=1){
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
		
			if($db->update('tipo_documento',$datos,'id_tipo_documento = '.$this->_id)>=1)
			{
				return true;
			}
		}
		return false;
	}
	
	public function toXml() {
		$salida="<TipoDocumento>";
			$salida.="<Id>";
				$salida.=$this->_id;
			$salida.="</Id>";
			
			$salida.="<Nombre>";
				$salida.=$this->_nombre;
			$salida.="</Nombre>";
			
			$salida.="<Descripcion>";
				$salida.=$this->_descripcion;
			$salida.="</Descripcion>";
		$salida.="</TipoDocumento>";
		
		return $salida;
	}

	
}
?>