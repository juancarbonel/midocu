<?php

Paquete::usar("dominio.EtapaAsunto");
Paquete::usar("dominio.Asunto");
Paquete::usar("dominio.IRegistros");


/**
 * @author Anthony Cantuta Jorge
 * @version 1.0
 * @created 05-dic-2008 12:50:12 p.m.
 */
class EtapasAsunto implements IRegistros
{

	private $_idAsunto;
	
	/**
	 * Array de objetos de tipo "EtapaAsunto"
	 *
	 * @var Array
	 */
	private $_elementos;

	function __construct($idAsunto)
	{
		$this->_idAsunto=$idAsunto;
	}

	


	public function getTotal()
	{
		return count($this->_elementos);
	}

	/**
	 * 
	 * @param desde
	 * @param numeroElementos
	 */
	public function cargar($desde=0,$numeroElementos=0)
	{
		$db=FabricaBaseDatos::crear();
		$select=$db->select()
		->from('v_etapas_asunto')
		->where('id_asunto = ? ',$this->_idAsunto);
		
		$rows=$db->fetchAssoc($select);
		
		foreach($rows as $row){
			
			$unaEtapa=new EtapaAsunto($row['e_id_etapa_asunto']);
			$unaEtapa->set_nombre($row['e_nombre']);
			$unaEtapa->set_descripcion($row['e_descripcion']);
			
		}
		return true;
	}

}
?>