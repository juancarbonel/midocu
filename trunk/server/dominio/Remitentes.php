<?php
require_once ('RemitenteReg.php');
require_once ('IRegistros.php');

/**
 * @author Anthony Cantuta Jorge
 * @version 1.0
 * @created 10-dic-2008 12:35:53 p.m.
 */
class Remitentes
{

	var $_elementos = Array();
	var $m_RemitenteReg;

	function Remitentes()
	{
	}



	/**
	 * 
	 * @param desde
	 * @param numeroElementos
	 */
	function cargar($desde = 0, $numeroElementos = 0)
	{
		$db=FabricaBaseDatos::crear();
		
		$select=$db
		->select()
		->from('v_remitentes');
		
		$rows=$db->fetchAssoc($select);
		
		foreach($rows as $row){
			$unRemitente=new RemitenteReg($row['id_remitente']);
			$unRemitente->set_nombreRemite($row['remite']);
			$unRemitente->set_email($row['email']);
		
			array_push($this->_elementos,$unRemitente);
		}
		return true;
	}



	function getTotal()
	{
		return count($this->_elementos);
	}

	

	function toXml()
	{
		$salida="<Remitentes>";
		foreach ($this->_elementos as $elemento)
		{
			$salida.="<Remitente>";
			
				$salida.="<Id>";
					$salida.=$elemento->get_id();
				$salida.="</Id>";
				
				$salida.="<Nombre>";
					$salida.=$elemento->get_nombreRemite();
				$salida.="</Nombre>";
				
				$salida.="<Email>";
					$salida.=$elemento->get_email();
				$salida.="</Email>";
				
			$salida.="</Remitente>";
		}
		$salida.="</Remitentes>";
		
		return $salida;
	}

	

}
?>