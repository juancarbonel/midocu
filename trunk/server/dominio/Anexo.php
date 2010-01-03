<?php
Paquete::usar ( 'dominio.IRegistro' );

/**
 * @author Anthony Cantuta Jorge
 * @version 1.0
 * @created 04-dic-2008 08:18:44 p.m.
 */
class Anexo implements IRegistro {
	
	private $_id;
	private $_nombre;
	private $_descripcion;
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
	function __construct($id) {
		$this->_id = $id;
	}
	
	function __destruct() {
	}
	
	public function cargar() {
		if (isset ( $this->_id )) {
			$db = FabricaBaseDatos::crear ();
			$select = $db->select ()->from ( "anexo" )->limit ( 1, 0 )->where ( "id_anexo= ? ", $this->_id );
			$filas = $db->fetchAll ( $select );
			
			if (count ( $filas ) == 1) {
				$this->_nombre = $filas [0] ['nombre'];
				$this->_descripcion = $filas [0] ['descripcion'];
				$this->_idDocumento = $filas [0] ['id_documento'];
				return true;
			}
		}
		return false;
	}
	
	public function eliminar() {
		if ($this->_id && ! empty ( $this->_id )) {
			$db = FabricaBaseDatos::crear ();
			if($db->delete ( 'anexo', 'id_anexo = ' . $this->_id )>=1){
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
		
			if($db->update('anexo',$datos,'id_anexo = '.$this->_id)>=1)
			{
				return true;
			}
		}
		return false;
	}
	
	public function toXml() {
		$salida="<Anexo>";
			$salida.="<Id>";
				$salida.=$this->_id;
			$salida.="</Id>";
			
			$salida.="<Nombre>";
				$salida.=$this->_nombre;
			$salida.="</Nombre>";
			
			$salida.="<Descripcion>";
				$salida.=$this->_descripcion;
			$salida.="</Descripcion>";
		$salida.="</Anexo>";
		
		return $salida;
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
	 * @param String $_id
	 */
	public function set_id($_id) {
		$this->_id = $_id;
	}
	
	/**
	 * @param String $_nombre
	 */
	public function set_nombre($_nombre) {
		$this->_nombre = $_nombre;
	}

}
?>