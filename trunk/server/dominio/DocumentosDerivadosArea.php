<?php

Paquete::usar('dominio.IRegistros'); 
Paquete::usar('dominio.IConvertibleXml');
Paquete::usar('dominio.DocumentoReg');

/**
 * @author Anthony Cantuta Jorge
 * @version 1.0
 * @created 11-dic-2008 04:20:41 p.m.
 */

class DocumentosDerivadosArea implements IConvertibleXml, IRegistros
{

	private $_idArea;
	private $_elementos=Array();
	private $_idUsuarioDerivador;
	private $_idAreaEmite;
	
	/**
	 * @return String
	 */
	public function get_elementos() {
		return $this->_elementos;
	}
	
	/**
	 * @return String
	 */
	public function get_idArea() {
		return $this->_idArea;
	}
	
	/**
	 * @return String
	 */
	public function get_idAreaEmite() {
		return $this->_idAreaEmite;
	}
	
	/**
	 * @return String
	 */
	public function get_idUsuarioDerivador() {
		return $this->_idUsuarioDerivador;
	}
	
	/**
	 * @param String $_elementos
	 */
	public function set_elementos($_elementos) {
		$this->_elementos = $_elementos;
	}
	
	/**
	 * @param String $_idArea
	 */
	public function set_idArea($_idArea) {
		$this->_idArea = $_idArea;
	}
	
	/**
	 * @param String $_idAreaEmite
	 */
	public function set_idAreaEmite($_idAreaEmite) {
		$this->_idAreaEmite = $_idAreaEmite;
	}
	
	/**
	 * @param String $_idUsuarioDerivador
	 */
	public function set_idUsuarioDerivador($_idUsuarioDerivador) {
		$this->_idUsuarioDerivador = $_idUsuarioDerivador;
	}
	function __construct($idArea)
	{
		$this->_idArea=$idArea;
	}

	function __destruct()
	{
	}



	

	

	public function toXml()
	{
		$salida="<Documentos>";
			foreach($this->_elementos as $unElemento){
				$salida.=$unElemento->toXml();
			}
		$salida.="</Documentos>";
		
		return $salida;
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
		->from("v_derivaciones_documentos","*")
		->where('de_id_area_destino = ? ',$this->_idArea);
		
		$rows=$db->fetchAll($select);
	
		foreach($rows as $row){
			
			//armando Documento y sus atributos
			
			$unElemento=new DocumentoReg($row['id_documento']);
			$unElemento->set_comentario($row["do_comentario"]);
			$unElemento->set_nroDocumento($row['do_nro_documento']);
			$unElemento->set_nroFolios($row['do_nro_folios']);
			$unElemento->set_sumilla($row['do_sumilla']);
			
			//agregando a lista de documentos
			array_push($this->_elementos,$unElemento);
			
		}
	}

	

	public function getTotal()
	{
		return count($this->_elementos);
	}

}
?>