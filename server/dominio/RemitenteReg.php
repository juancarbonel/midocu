<?php

/**
 * @author Anthony Cantuta Jorge
 * @version 1.0
 * @created 04-dic-2008 08:18:50 p.m.
 */
class RemitenteReg {
	
	private $_id;
	private $_telefono;
	private $_email;
	private $_nombreRemite;
	
	/**
	 * @return String
	 */
	public function get_email() {
		return $this->_email;
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
	public function get_telefono() {
		return $this->_telefono;
	}
	
	/**
	 * @param String $_id
	 */
	public function set_id($_id) {
		$this->_id = $_id;
	}
	/**
	 * @param String $_email
	 */
	public function set_email($_email) {
		if (! empty ( $_email )) {
			$this->_email = $_email;
		}
	}
	
	/**
	 * @param String $_telefono
	 */
	public function set_telefono($_telefono) {
		if (! empty ( $_telefono )) {
			$this->_telefono = $_telefono;
		}
	}
	function __construct($id = null) {
		if (! empty ( $id )) {
			$this->_id = $id;
		}
	}
	
	function __destruct() {
	}
	
	public function cargar() {
		$db = FabricaBaseDatos::crear ();
		
		$select = $db->select ()->from ( 'remitente' )->limit ( 1, 0 )->where ( 'id_remitente = ?', $this->_id );
		
		$rows = $db->fetchAssoc ( $select );
		
		if (count ( $rows ) == 1) {
			$this->_email = $rows ['email'];
			$this->_telefono = $rows ['telefono'];
			return true;
		}
		return false;
	}
	
	public function eliminar() {
		if ($this->_id && ! empty ( $this->_id )) {
			$db = FabricaBaseDatos::crear ();
			if($db->delete('remitente','id_remitente = '.$this->_id)>=1){
				return true;
			}
		}
		return false;
	}
	
	public function actualizar() {
		if ($this->_id && ! empty ( $this->_id )) {
			$db = FabricaBaseDatos::crear ();
			$datos=Array(
			'email'=> $this->_email,
			'telefono' =>$this->_telefono
			);
			
			if($db->update('remitente',$datos,'id_remitente = '.$this->_id)>=1){
				return true;
			}
		}
		return false;
	}
	
	public function toXml() {
		$salida = "<Remitente>";
			$salida .= "<NombreRemite>";
				$salida .= $this->_nombreRemite;
			$salida .= "</NombreRemite>";
		
			$salida .= "<Email>";
				$salida .= $this->_email;
			$salida .= "</Email>";
		
			$salida .= "<Telefono>";
				$salida .= $this->_telefono;
			$salida .= "</Telefono>";
		
		$salida .= "</Remitente>";
	}
	
	/**
	 * @return String
	 */
	public function get_nombreRemite() {
		return $this->_nombreRemite;
	}
	
	/**
	 * @param String $_nombreRemite
	 */
	public function set_nombreRemite($_nombreRemite) {
		$this->_nombreRemite = $_nombreRemite;
	}

}
?>