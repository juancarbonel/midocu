<?php
Paquete::usar ( "dominio.IRegistro" );

/**
 * @author Administrador
 * @version 1.0
 * @created 04-dic-2008 08:18:50 p.m.
 */
class RequisitoAsunto implements IRegistro {
	
	private $_id;
	private $_nombre;
	private $_descripcion;
	
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
	function __construct($id) {
		$this->_id=$id;
	}
	
	function __destruct() {
	}
	
	public function cargar() {
		$db=FabricaBaseDatos::crear();
		$select=$db->select()
		->from('requisito')
		->limit(1,0)
		->where(' id_requisito = ? ',$this->_id);
		
		$rows=$db->fetchAll($select);
		if(count($rows)==1){
			$this->_nombre=$rows[0]['nombre'];
			$this->_descripcion=$rows[0]['descripcion'];
			return true;
		}
		return false;
	}
	
	public function eliminar() {
	}
	
	public function actualizar() {
	}
	
	public function toXml() {
		$salida="<Requisitos>";
			foreach ($this->_elementos as $unElemento)
			{
				$salida.="<Requisito>";
					$salida.="<Nombre>";
						$salida.=$unElemento->get_nombre();
					$salida.="</Nombre>";
					$salida.="<Descripcion>";
						$salida.=$unElemento->get_Descripcion();
					$salida.="</Descripcion>";
				$salida.="</Requisito>";
			}
		$salida.="</Requisitos>";
		return $salida;
	}

}
?>