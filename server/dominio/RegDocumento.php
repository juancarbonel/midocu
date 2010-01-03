<?php
Paquete::usar ( "dominio.INuevoRegistro" );

/**
 * @author Anthony Cantuta Jorge
 * @version 1.0
 * @created 04-dic-2008 08:18:49 p.m.
 */
class RegDocumento implements INuevoRegistro
{

	private $_idAsunto;
	private $_idRemitente;
	private $_idDocumento;
	private $_idEstado;
	private $_idTipoDocumento;
	private $_comentario;
	private $_sumilla;
	private $_ultimoIdInsertado;
	private $_nroDocumento;
	private $_nroFolios;
	private $_asunto;
	
	
	/**
	 * @param String $_idTipoDocumento
	 */
	public function set_idTipoDocumento($_idTipoDocumento) {
		if(!empty($_idTipoDocumento))
		{
			$this->_idTipoDocumento = $_idTipoDocumento;
		}
	}
	/**
	 * @param String $_asunto
	 */
	public function set_asunto($_asunto) {
		if(!empty($_asunto))
		{
			$this->_asunto = $_asunto;
		}
	}
	
	/**
	 * @param String $_comentario
	 */
	public function set_comentario($_comentario) {
		if(!empty($_comentario))
		{
			$this->_comentario = $_comentario;
		}
	}
	
	/**
	 * @param String $_idAsunto
	 */
	public function set_idAsunto($_idAsunto) {
		
		if(!empty($_idAsunto))
		{
			$this->_idAsunto = $_idAsunto;
		}
	}
	
	/**
	 * @param String $_idDocumento
	 */
	public function set_idDocumento($_idDocumento) {
		if(!empty($_idDocumento))
		{
			$this->_idDocumento = $_idDocumento;
		}
	}
	
	/**
	 * @param String $_idEstado
	 */
	public function set_idEstado($_idEstado) {
		if(!empty($_idEstado))
		{
			$this->_idEstado = $_idEstado;
		}
	}
	
	/**
	 * @param String $_idRemitente
	 */
	public function set_idRemitente($_idRemitente) {
		if(!empty($_idRemitente))
		{
			$this->_idRemitente = $_idRemitente;
		}
	}
	
	/**
	 * @param String $_nroDocumento
	 */
	public function set_nroDocumento($_nroDocumento) {
		if(!empty($_nroDocumento))
		{
			$this->_nroDocumento = $_nroDocumento;
		}
	}
	
	/**
	 * @param String $_nroFolios
	 */
	public function set_nroFolios($_nroFolios) {
		if(!empty($_nroFolios))
		{
			$this->_nroFolios = $_nroFolios;
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

	function __destruct()
	{
	}



	public function registrar()
	{
		$db=FabricaBaseDatos::crear();
		
		$nuevoReg=array(
			"nro_documento"=>$this->_nroDocumento,
			"nro_folios"=>$this->_nroFolios,
			"comentario"=>$this->_comentario,
			"sumilla"=>$this->_sumilla,
			"asunto"=>$this->_asunto,
			"id_remitente"=>$this->_idRemitente,
			"id_estado_documento"=>$this->_idEstado,
			"id_tipo_documento"=>$this->_idTipoDocumento,
			"id_asunto"=>$this->_idAsunto,
			"fecha_reg"=>date("Y-m-d H:i:s")
			);
		
		if($db->insert("documento",$nuevoReg)==true)
		{
			$this->_ultimoIdInsertado=$db->lastInsertId();
			return true;
		}else {
			return false;
		}
		
		
	}

	public function get_ultimoIdInsertado()
	{
		return $this->_ultimoIdInsertado;
	}

}
?>