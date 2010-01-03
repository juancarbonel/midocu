<?php
Paquete::usar ( "dominio.INuevoRegistro" );

/**
 * @author Anthony Cantuta Jorge
 * @version 1.0
 * @created 04-dic-2008 08:18:49 p.m.
 */
class RegDocumentoGenerar implements INuevoRegistro
{

	private $_idDocumento_generador;
	private $_idTipoDocumentoGenerar;
	private $_idAreaGeneraDoc;
	private $_sumilla;
	private $_ultimoIdInsertado;
	
	/**
	 * @param String $_idAreaGeneraDoc
	 */
	public function set_idAreaGeneraDoc($_idAreaGeneraDoc) {
		if(!empty($_idAreaGeneraDoc))
		{
			$this->_idAreaGeneraDoc = $_idAreaGeneraDoc;
		}
	}
	
	/**
	 * @param String $_idDocumento_generador
	 */
	public function set_idDocumento_generador($_idDocumento_generador) {
		if(!empty($_idDocumento_generador))
		{
			$this->_idDocumento_generador = $_idDocumento_generador;
		}
	}
	
	/**
	 * @param String $_idTipoDocumentoGenerar
	 */
	public function set_idTipoDocumentoGenerar($_idTipoDocumentoGenerar) {
		if(!empty($_idTipoDocumentoGenerar))
		{
			$this->_idTipoDocumentoGenerar = $_idTipoDocumentoGenerar;
		}
	}
	
	/**
	 * @param String $_sumilla
	 */
	public function set_sumilla($_sumilla) {
		if(!empty($_sumilla))
		{
			$this->_sumilla = $_sumilla;
		}
	}
	function __construct()
	{
	}

	



	public function registrar()
	{
	
		$db=FabricaBaseDatos::crear();
		
		$nuevoReg=array(
		"sumilla"=>$this->_sumilla,
		"id_area_generadora"=>$this->_idAreaGeneraDoc,
		"id_documento_generador",$this->_idDocumento_generador,
		"id_tipo_documento_generado",$this->_idTipoDocumentoGenerar
		);
		
		if($db->insert('documento_generado',$nuevoReg)==true)
		{
			$this->_ultimoIdInsertado=$db->lastInsertId('documento_generado');
			return true;
		}else{
			return false;
		}
	}

	public function get_ultimoIdInsertado()
	{
		return $this->_ultimoIdInsertado;
	}

}
?>