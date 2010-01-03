<?php
Paquete::usar ( 'dominio.IRegistros' );
Paquete::usar ( 'dominio.IConvertibleXml' );
Paquete::usar ( 'dominio.TipoDocumento' );

/**
 * @author Anthony Cantuta Jorge
 * @version 1.0
 * @created 06-dic-2008 09:43:50 p.m.
 */
class TiposDocumento {
	private $_elementos = Array ( );
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
	
	/**
	 * 
	 * @param desde
	 * @param numeroElementos
	 */
	function cargar($desde = 0, $numeroElementos = 0) {
		$db = FabricaBaseDatos::crear ();
		$select = $db->select ()->from ( 'tipo_documento' );
		
		$rows = $db->fetchAssoc ( $select );
		
		foreach ( $rows as $row ) {
			$unTipoDoc = new TipoDocumento ( $row ['id_tipo_documento'] );
			$unTipoDoc->set_nombre ( $row ['nombre'] );
			$unTipoDoc->set_descripcion ( $row ['descripcion'] );
			array_push ( $this->_elementos, $unTipoDoc );
		}
		return true;
	}
	
	function toXml() {
		$nroElementos=0;
		$salida="<TiposDocumento>";
			foreach ($this->_elementos as $unElemento)
			{
				$salida.="<TipoDocumento>";
					$salida.="<Id>";
						$salida.=$unElemento->get_id();
					$salida.="</Id>";
					$salida.="<Nombre>";
						$salida.=$unElemento->get_nombre();
					$salida.="</Nombre>";
					$salida.="<Descripcion>";
						$salida.=$unElemento->get_Descripcion();
					$salida.="</Descripcion>";
				$salida.="</TipoDocumento>";
				$nroElementos++;
			}
					$salida.="<cantidad>";
						$salida.=$nroElementos;
					$salida.="</cantidad>";
					$salida.="";			
		$salida.="</TiposDocumento>";
		return $salida;
	}
	
	function eliminarTodo() {
	}
	
	function actualizarTodo() {
	}
	
	function getTotal() {
		return count ( $this->_elementos );
	}

}
?>