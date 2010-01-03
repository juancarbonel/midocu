<?php

Paquete::usar ( 'dominio.IBuscador' );
Paquete::usar ( 'dominio.CriterioRemitente' );
Paquete::usar ( 'dominio.RemitenteReg' );

/**
 * @author Anthony Cantuta Jorge
 * @version 1.0
 * @created 23-dic-2008 10:42:31 p.m.
 */
class BuscadorRemitente implements IBuscador, IConvertibleXml {
	
	private $_max_mostrar=30;
	private $_mostrar_desde=0;
	private $_remitentes = Array ( );
	/**
	 * 
	 *
	 * @var CriterioRemitente
	 */
	private $_criterio;
	
	/**
	 * @return CriterioRemitente
	 */
	public function get_criterio() {
		return $this->_criterio;
	}
	
	/**
	 * @param String $_remitentes
	 */
	public function set_remitentes($_remitentes) {
		$this->_remitentes = $_remitentes;
	}
	/**
	 * @return String
	 */
	public function get_max_mostrar() {
		return $this->_max_mostrar;
	}
	
	/**
	 * @return String
	 */
	public function get_mostrar_desde() {
		return $this->_mostrar_desde;
	}
	
	/**
	 * @return String
	 */
	public function get_remitentes() {
		return $this->_remitentes;
	}
	
	/**
	 * @param String $_criterio
	 */
	public function set_criterio($_criterio) {
		$this->_criterio = $_criterio;
	}
	
	/**
	 * @param String $_max_mostrar
	 */
	public function set_max_mostrar($_max_mostrar) {
		$this->_max_mostrar = $_max_mostrar;
	}
	
	/**
	 * @param String $_mostrar_desde
	 */
	public function set_mostrar_desde($_mostrar_desde) {
		$this->_mostrar_desde = $_mostrar_desde;
	}
	function __construct() {
		$this->_criterio = new CriterioRemitente ( );
	}
	
	
	
	/**
	 * 
	 * @param criterio
	 */
	
	public function encontrar() {
		$encontro = false;
		
		
		
		$db = FabricaBaseDatos::crear ();
		$select = $db->select ()
		->from ( 'v_remitentes' );
		if($this->_criterio->get_nombreRemitente()){
			
			$select->where("remite LIKE ?","%".$this->_criterio->get_nombreRemitente()."%");
		}
		
		if($this->_criterio->get_email()){
		$select->orWhere('email LIKE ?',"%".$this->_criterio->get_email()."%");
		}
		
		$select->limit($this->_max_mostrar,$this->_mostrar_desde);
	
	
	
			
	
		$rows = $db->fetchAll ($select);
		
		foreach ( $rows as $row ) {
			$unRemitente = new RemitenteReg ( $row ['id_remitente'] );
			$unRemitente->set_nombreRemite ( $row ['remite'] );
			$unRemitente->set_email ( $row ['email'] );
			array_push ( $this->_remitentes, $unRemitente );
			$encontro = true;
		}
		
		return $encontro;
	}
	
	public function toXml() {
		$salida="<Remitentes>";
			foreach ($this->_remitentes as $unRemitente){
			$salida.="<Remitente>";
				$salida.="<Id>";
					$salida.=$unRemitente->get_id();	
				$salida.="</Id>";	
			
				$salida.="<Nombre>";
					$salida.=$unRemitente->get_nombreRemite();
				$salida.="</Nombre>";
				
				$salida.="<Email>";
					$salida.=$unRemitente->get_email();
				$salida.="</Email>";
				
			$salida.="</Remitente>";
			}
		$salida.="</Remitentes>";
		
		return $salida;
	}

}
?>