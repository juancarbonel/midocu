<?php

Paquete::usar('dominio.IRegistros');
Paquete::usar('dominio.EstadoDocumento');
Paquete::usar('dominio.IRegistros');
Paquete::usar('dominio.IConvertibleXml');
/**
 * @author Anthony Cantuta Jorge
 * @version 1.0
 * @created 07-dic-2008 07:13:33 p.m.
 */
class EstadosDocumento implements IRegistros, IConvertibleXml
{

	private $_elementos = Array();

	function __construct()
	{
	}

	


	/**
	 * 
	 * @param desde
	 * @param numeroElementos
	 */
	public function cargar(  $desde = 0,   $numeroElementos = 0)
	{
		$db=FabricaBaseDatos::crear();
		$select=$db->select()
		->from('estado_documento')
		->limit($numeroElementos,$desde);
		
		$rows=$db->fetchAll($select);
		
		foreach ($rows as $row){
			$unEstado=new EstadoDocumento($row['id_estado_documento']);
			$unEstado->set_nombre($row['nombre']);
			$unEstado->set_descripcion($row['descripcion']);
			array_push($this->_elementos,$unEstado);
		}
		return true;
	}


	public function getTotal()
	{
		return count($this->_elementos);
	}



	public function toXml()
	{
		$nroElementos=0;
		$salida="<EstadosDocumento>";
			foreach ($this->_elementos as $unElemento)
			{
				$salida.="<EstadoDocumento>";
					$salida.="<Id>";
						$salida.=$unElemento->get_id();
					$salida.="</Id>";
					$salida.="<Nombre>";
						$salida.=$unElemento->get_nombre();
					$salida.="</Nombre>";
					$salida.="<Descripcion>";
						$salida.=$unElemento->get_Descripcion();
					$salida.="</Descripcion>";
				$salida.="</EstadoDocumento>";
				$nroElementos++;
			}
					$salida.="<cantidad>";
						$salida.=$nroElementos;
					$salida.="</cantidad>";
					$salida.="";			
		$salida.="</EstadosDocumento>";
		return $salida;
	}

}
?>