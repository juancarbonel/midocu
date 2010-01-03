<?php
require_once ('IRegistro.php');

/**
 * @author Anthony Cantuta Jorge
 * @version 1.0
 * @created 04-dic-2008 08:18:46 p.m.
 */
class DocumentoGenerado implements IRegistro {
	
	private $_id;
	private $_idDocumentoGenerador;
	private $_idAreaGeneradora;
	private $_idTipoDocumentoGenerado;
	private $_fechaReg;
	private $_sumilla;
	
	function __construct($id) {
		$this->_id = $id;
	}
	
	function __destruct() {
	}
	
	public function cargar() {
		$cargado = false;
		$db = FabricaBaseDatos::crear ();
		$select = $db->select ()->limit ( 0, 1 )->from ( 'documento_generado' )->where ( 'id_documento_generado = ? ', $this->_id );
		
		$rows = $db->fetchAll ( $select );
		
		if (count ( $rows ) >= 1) {
			$this->_fecha_reg = $rows [0] ['fecha_reg'];
			$this->_idAreaGeneradora = $rows [0] ['id_area_generadora'];
			$this->_idTipoDocumentoGenerado = $rows [0] ['id_tipo_generado'];
			$this->_idDocumentoGenerador = $rows [0] ['id_documento_generador'];
			$this->_sumilla = $rows [0] ['sumilla'];
			$cargado = true;
		}
		
		return $cargado;
	}
	
	public function eliminar() {
		if ($this->_id && ! empty ( $this->_id )) {
			
			$db = FabricaBaseDatos::crear ();
			
			if ($db->delete ( 'documento_generado', 'id_documento_generado = ' . $this->_id ) >= 1) {
				return true;
			}
		}
		
		return false;
	}
	
	public function actualizar() {
		if ($this->_id && ! empty ( $this->_id )) {
			
			$db = FabricaBaseDatos::crear ();
			
			$datos = Array();
			if($db->update('documento_generado',$datos,'id_documento='.$this->_id)>=1){
					return true;
			}
		}
		
		return false;
	}
	
	public function toXml() {
	}

}
?>