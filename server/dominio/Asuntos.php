<?php
Paquete::usar ( 'dominio.IRegistros' );
Paquete::usar ( 'dominio.IConvertibleXml' );
Paquete::usar ( 'dominio.Asunto' );

/**
 * @author Anthony Cantuta Jorge
 * @version 1.0
 * @created 06-dic-2008 09:49:29 p.m.
 */
class Asuntos implements IRegistros, IConvertibleXml {
	private $_elementos=Array();
	
	/**
	 * @return String
	 */
	public function get_elementos() {
		return $this->_elementos;
	}
	
	/**
	 * @param String $_elementos
	 */
	public function set_elementos($_elementos) {
		$this->_elementos = $_elementos;
	}
	
	function __construct() {
	}
	
	function __destruct() {
	}
	
	/**
	 * 
	 * @param Int desde
	 * @param Int numeroElementos
	 */
	public function cargar($desde = 0, $numeroElementos = 0) {
		
		$db = FabricaBaseDatos::crear ();
		$select = $db->select ()->from ( 'asunto' )
		->limit($numeroElementos,$desde);
		
		$rows = $db->fetchAll( $select );
		
		foreach ( $rows as $row ) {
			$unAsunto = new Asunto ( $row ['id_asunto'] );
			$unAsunto->set_nombre ( $row ['nombre'] );
			$unAsunto->set_descripcion ( $row ['descripcion'] );
			array_push ( $this->_elementos, $unAsunto );
		}
		return true;
	}
	
	public function toXml() {
		$salida="<AsuntosDocumento>";
		
		foreach ( $this->_elementos as $unElemento ) {
			$salida.="<Asunto>";
					
					$salida.="<Id>";
						$salida.=$unElemento->get_id();
					$salida.="</Id>";
			
					$salida.="<Nombre>";	
						$salida.=$unElemento->get_nombre ();
					$salida.="</Nombre>";
					
					$salida.="<Descripcion>";
						$salida.=$unElemento->get_Descripcion();
					$salida.="</Descripcion>";
					
			$salida.="</Asunto>"; 
		}
		
		$salida.="</AsuntosDocumento>";
		return $salida;
	}
	
	
	public function getTotal() {
		return count ( $this->_elementos );
	}

	/**
	 * 
	 * @param elAsunto
	 */
	public function add(Asunto $elAsunto)
	{
		array_push($this->_elementos,$elAsunto);
	}

	

}
?>