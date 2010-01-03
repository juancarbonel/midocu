<?php
Paquete::usar('dominio.DetalleBandejaEntrada');
Paquete::usar('dominio.IConvertibleXml');
Paquete::usar('dominio.RemitenteReg');
Paquete::usar('dominio.Asunto');
Paquete::usar('dominio.BandejaDocumentosArea');
Paquete::usar('dominio.FiltroDocumentos');

/**
 * @author Anthony Cantuta Jorge
 * @version 1.0
 * @created 17-dic-2008 10:10:11 a.m.
 */
class BandejaEntradaArea extends BandejaDocumentosArea implements IRegistros, IConvertibleXml
{

	

	function __construct($idArea)
	{
		if(!empty($idArea)){
			 $this->_idArea = $idArea;		 
		}
		$this->_filtro=new FiltroDocumentos();
	}

	
	/**
	 * 
	 * @param desde
	 * @param numeroElementos
	 */
	public function cargar(  $desde = 0,   $numeroElementos = 0)
	{
		$db=FabricaBaseDatos::crear();
		if($this->_idArea){
			
			$select=$db->select()
			->from("v_bandeja_entrada_areas")
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
			
			$select->order('fecha DESC');
			
		}
		
		
			
			
		
			$rows=$db->fetchAll($select);
		
			foreach ($rows as $row){
						
				$unAsunto=new Asunto();
				$unAsunto->set_nombre($row['nombre_asunto']);
			
				$unRemitente=new RemitenteReg($row['id_remitente']);
				$unRemitente->set_nombreRemite($row['nombre_remite']);
			
			
				$unDetalle=new DetalleBandejaEntrada();
				$unDetalle->set_idDocumento($row['id_documento']);
				$unDetalle->set_asunto($unAsunto);
				$unDetalle->set_remitente($unRemitente);
				$unDetalle->set_fecha($row['fecha']);
		
			
				array_push($this->_elementosDetalle,$unDetalle);
			
			}
		
		return false;
		
	}


	public function getTotal()
	{
		return count($this->_elementosDetalle);
	}

	
	public function toXml()
	{
		
		$salida="<BandejaEntradaArea>";
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
		$salida.="</BandejaEntradaArea>";
		return $salida;
	}

	
	

}

?>