<?php
require_once ('BandejaEntradaArea.php');
require_once ('IRegistros.php');
require_once ('IConvertibleXml.php');

/**
 * @author Anthony Cantuta Jorge
 * @version 1.0
 * @created 26-dic-2008 10:53:33 p.m.
 */
class BandejaDocumentosRecepArea extends BandejaDocumentosArea implements IRegistros, IConvertibleXml
{

	function __construct($idArea)
	{	
		if(!empty($idArea)){
			 $this->_idArea = $idArea;
			 
		}
	}

	function __destruct()
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
		if($this->_idArea)
		{
			$select=$db->select()
			->from("v_bandeja_recepciones_doc_areas")
			->limit($numeroElementos,$desde)
			->where("id_area = ? ", $this->_idArea);
			/**
			 * Si existen filtros establecidos
			 * entonces pasamos a armar nuestra consulta SQL
			 * con los filtros
			 */
			 if($this->get_filtro()->get_nombreRemite()!=null){
			 	
			 	$select->where('nombre_remite LIKE ?',
			 	"%".$this->get_filtro()->get_nombreRemite()."%");
			 }
			 
			if($this->get_filtro()->get_idDocumento()!=null){
				$select->where('id_documento = ?',
				$this->get_filtro()->get_idDocumento());
			}
			
			$select->order('fecha_recep DESC');
		}
			
		
			$rows=$db->fetchAll($select);
		
			foreach ($rows as $row){
						
				$unAsunto=new Asunto();
				$unAsunto->set_nombre($row['nombre_asunto']);
			
				$unRemitente=new RemitenteReg($row['id_remitente']);
				$unRemitente->set_nombreRemite($row['remite']);
			
			
				$unDetalle=new DetalleBandejaEntrada();
				$unDetalle->set_idDocumento($row['id_documento']);
				$unDetalle->set_asunto($unAsunto);
				$unDetalle->set_remitente($unRemitente);
				$unDetalle->set_fecha($row['fecha_recep']);
		
			
				array_push($this->_elementosDetalle,$unDetalle);
			
			}
	
		return false;
	}

	public function toXml()
	{
		$salida="<BandejaDocumentosRecepcionadosArea>";
				foreach ($this->_elementosDetalle as $unElemento){
					$salida.="<ElementoDetalle>";
							
							$salida.="<IdDocumento>";
								$salida.=$unElemento->get_idDocumento();
							$salida.="</IdDocumento>";
							
							$salida.="<NombreRemite>";
								$salida.=$unElemento->get_remitente()->get_nombreRemite();
							$salida.="</NombreRemite>";
							
							$salida.="<NombreAsunto>";
								$salida.=$unElemento->get_asunto()->get_nombre();
							$salida.="</NombreAsunto>";
							
							$salida.="<Fecha>";
								$salida.=$unElemento->get_fecha();
							$salida.="</Fecha>";
									
					$salida.="</ElementoDetalle>";		
				}
		$salida.="</BandejaDocumentosRecepcionadosArea>";
		return $salida;
	}

	public function eliminarTodo()
	{
	}

	public function actualizarTodo()
	{
	}

	public function getTotal()
	{
		return count($this->_elementosDetalle);
	}

}
?>