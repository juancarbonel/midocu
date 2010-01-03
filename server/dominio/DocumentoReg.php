<?php
require_once ('Asunto.php');
require_once ('TipoDocumento.php');
require_once ('AnexosDocumento.php');
require_once ('RemitenteReg.php');
require_once ('EstadoDocumento.php');
require_once ('IRegistro.php');

/**
 * @author Anthony Cantuta Jorge
 * @version 1.0
 * @created 05-dic-2008 12:50:11 p.m.
 */
class DocumentoReg implements IRegistro
{


	private $_id;
	/**
	 *
	 *
	 * @var Asunto
	 */
	private $_asunto;
	
	/**
	 * *
	 *
	 * @var TipoDocumento
	 */
	private $_tipo;
	
	/**
	 * *
	 *
	 * @var EstadoDocumento
	 */
	private $_estado;

	/**
	 * Conjunto de anexos
	 *
	 * @var AnexosDocumento
	 */
	private $_anexos;
	private $_nroFolios;
	private $_nroDocumento;

	/**
	 * *
	 *
	 * @var RemitenteReg
	 */
	private $_remitente;
	private $_sumilla;
	private $_comentario;
	private $_fecha_reg;
	/**
	 * @return AnexosDocumento
	 */
	public function get_anexos() {
		return $this->_anexos;
	}
	
	/**
	 * @return Asunto
	 */
	public function get_asunto() {
		return $this->_asunto;
	}
	
	/**
	 * @return String
	 */
	public function get_comentario() {
		return $this->_comentario;
	}
	
	/**
	 * @return EstadoDocumento
	 */
	public function get_estado() {
		return $this->_estado;
	}
	
	/**
	 * @return String
	 */
	public function get_id() {
		return $this->_id;
	}
	
	/**
	 * @return String
	 */
	public function get_nroDocumento() {
		return $this->_nroDocumento;
	}
	
	/**
	 * @return String
	 */
	public function get_nroFolios() {
		return $this->_nroFolios;
	}
	
	/**
	 * @return RemitenteReg
	 */
	public function get_remitente() {
		return $this->_remitente;
	}
	
	/**
	 * @return String
	 */
	public function get_sumilla() {
		return $this->_sumilla;
	}
	
	/**
	 * @return TipoDocumento
	 */
	public function get_tipo() {
		return $this->_tipo;
	}
	
	/**
	 * @param AnexosDocumento $_anexos
	 */
	public function set_anexos($_anexos) {
		$this->_anexos = $_anexos;
	}
	
	/**
	 * @param String $_asunto
	 */
	public function set_asunto($_asunto) {
		$this->_asunto = $_asunto;
	}
	
	/**
	 * @param String $_comentario
	 */
	public function set_comentario($_comentario) {
		$this->_comentario = $_comentario;
	}
	
	/**
	 * @param String $_estado
	 */
	public function set_estado($_estado) {
		$this->_estado = $_estado;
	}
	
	/**
	 * @param String $_nroDocumento
	 */
	public function set_nroDocumento($_nroDocumento) {
		$this->_nroDocumento = $_nroDocumento;
	}
	
	/**
	 * @param String $_nroFolios
	 */
	public function set_nroFolios($_nroFolios) {
		$this->_nroFolios = $_nroFolios;
	}
	
	/**
	 * @param String $_remitente
	 */
	public function set_remitente($_remitente) {
		$this->_remitente = $_remitente;
	}
	
	/**
	 * @param String $_sumilla
	 */
	public function set_sumilla($_sumilla) {
		$this->_sumilla = $_sumilla;
	}
	
	/**
	 * @param String $_tipo
	 */
	public function set_tipo($_tipo) {
		$this->_tipo = $_tipo;
	}

	

	function __construct($idDocumento)
	{
		$this->_id=$idDocumento;
		$this->_remitente = new RemitenteReg();
		$this->_asunto = new Asunto();
		$this->_estado = new EstadoDocumento();
		$this->_tipo = new TipoDocumento();
	}

	function __destruct()
	{
	}



	public function cargar()
	{
		$db=FabricaBaseDatos::crear();
		$seleccion=$db->select()->from("v_documento_detallado")
		->limit(1,0)
		->where("id_documento = ? ",$this->_id);
		$rows=$db->fetchAll($seleccion);
		
		if(count($rows)==1)
		{
			$this->_nroDocumento=$rows[0]['nro_documento'];
			$this->_nroFolios=$rows[0]['nro_folios'];
			$this->_comentario=$rows[0]['comentario'];
			$this->_sumilla=$rows[0]['sumilla'];
			$this->_fecha_reg=$rows[0]['fecha_reg'];			

			//objetos que contiene Documento
			$this->_remitente=new RemitenteReg($rows[0]["id_remitente"]);
			$this->_remitente->set_nombreRemite($rows[0]['remite']);
			
			//preparando tipo documento
			$this->_tipo=new TipoDocumento($rows[0]['id_tipo_documento']);
			$this->_tipo->set_nombre($rows[0]["nombre_tipo_documento"]);
			
			//preparando Asunto
			$this->_asunto=new Asunto($rows[0]['id_asunto']);
			$this->_asunto->set_nombre($rows[0]['nombre_asunto']);
			
			//preparando estado documento
			$this->_estado=new EstadoDocumento($rows[0]['id_estado_documento']);
			
			return true;
		}
		
		return false;
		
		
		
	}

	public function eliminar()
	{
		if($this->_id && !empty($this->_id)){
		
			$db=FabricaBaseDatos::crear();
			
			if($db->delete('id_documento', 'id_documento = '.$this->_id)>=1){
				return true;
			}
		}
			
		return false;
	}

	public function actualizar()
	{
		if($this->_id && !empty($this->_id)){
			$db= FabricaBaseDatos::crear();
			$datos=Array(
			'nro_documento'=>$this->get_nroDocumento(),
			'sumilla' => $this->get_sumilla(),
			'comentario' => $this->get_comentario(),
			'nro_folios' => $this->get_nroFolios(),
			'id_remitente' => $this->_remitente->get_id(),
			'id_asunto' => $this->_asunto->get_id(),
			'id_tipo_documento' => $this->_tipo->get_id(),
			'id_estado_documento' => $this->_estado->get_id(),
			'id_asunto' => $this->_asunto->get_id()
			);
			
			if($db->update('documento',$datos,'id_documento = '.$this->get_id())>=1){
				return true;
			}
			
		}
		return false;
	}

	public function toXml()
	{
		$salida='<Documento>';
		
			$salida.="<Id>";
				$salida.=$this->_id;
			$salida.="</Id>";
			//remitente
			$salida.="<IdRemitente>";
				$salida.=$this->_remitente->get_id();
			$salida.="</IdRemitente>";
			
			$salida.="<NombreRemitente>";
				$salida.=$this->_remitente->get_nombreRemite();
			$salida.="</NombreRemitente>";
			
			//asunto
			$salida.="<IdAsunto>";
				$salida.=$this->_asunto->get_id();
			$salida.="</IdAsunto>";
			
			$salida.="<NombreAsunto>";
				$salida.=$this->_asunto->get_nombre();
			$salida.="</NombreAsunto>";
			
			//tipo
			$salida.="<IdTipoDocumento>";
				$salida.=$this->_tipo->get_id();
			$salida.="</IdTipoDocumento>";
			$salida.="<NombreTipoDocumento>";
				$salida.=$this->_tipo->get_nombre();
			$salida.="</NombreTipoDocumento>";
			
			//estado
			$salida.="<IdEstadoDocumento>";
				$salida.=$this->_estado->get_id();
			$salida.="</IdEstadoDocumento>";
			
		
			
			$salida.="<FechaReg>";
				$salida.=$this->_fecha_reg;
			$salida.="</FechaReg>";
			
			$salida.="<NroDocumento>";
				$salida.=$this->_nroDocumento;
			$salida.="</NroDocumento>";
			
			$salida.="<NroFolios>";
				$salida.=$this->_nroFolios;
			$salida.="</NroFolios>";

			$salida.="<Comentario>";
				$salida.=$this->_comentario;
			$salida.="</Comentario>";
			
			$salida.="<Sumilla>";
				$salida.=$this->_sumilla;
			$salida.="</Sumilla>";
			
			
			
		$salida.="</Documento>";
		
		return $salida;		
	}
}
?>