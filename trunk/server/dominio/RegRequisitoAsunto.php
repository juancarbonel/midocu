<?php
require_once ('INuevoRegistro.php');

/**
 * @author Anthony Cantuta Jorge
 * @version 1.0
 * @created 07-dic-2008 01:14:13 p.m.
 */
class RegRequisitoAsunto implements INuevoRegistro {
	
	private $_idRequisito;
	private $_idAsunto;
	
	function __construct($idAsunto) {
		$this->_idAsunto = $idAsunto;
	}
	
	function __destruct() {
	}
	
	/**
	 * @param String $_idAsunto
	 */
	public function set_idAsunto($_idAsunto) {
		if (! empty ( $_idAsunto )) {
			$this->_idAsunto = $_idAsunto;
		}
	}
	
	/**
	 * @param String $_idRequisito
	 */
	public function set_idRequisito($_idRequisito) {
		if (! empty ( $_idRequisito )) {
			$this->_idRequisito = $_idRequisito;
		}
	}
	
	public function registrar() {
		$db=FabricaBaseDatos::crear();
		$nuevoReg=Array(
		'asunto_id_asunto'=>$this->_idAsunto,
		'requisitos_id_requisito' => $this->_idRequisito		
		);
		
		if($db->insert('requisitos_asunto',$nuevoReg)==1){
			
			return true;
		}
		return false;
		
	}
	
	public function get_ultimoIdInsertado() {
	}

}
?>