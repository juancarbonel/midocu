<?php

Paquete::usar('dominio.IConvertibleXml');
Paquete::usar('dominio.IRegistros');
Paquete::usar('dominio.Anexo');

/**
 * @author Anthony Cantuta Jorge
 * @version 1.0
 * @created 04-dic-2008 08:18:44 p.m.
 */
class AnexosDocumento implements IConvertibleXml, IRegistros
{

	private $_descripcion;
	private $_idDocumento;
	private $_nombre;
	
	private $_elementos=Array();
	
	/**
	 * @return String
	 */
	public function get_descripcion() {
		return $this->_descripcion;
	}
	
	/**
	 * @return String
	 */
	public function get_nombre() {
		return $this->_nombre;
	}
	
	/**
	 * @param String $_descripcion
	 */
	public function set_descripcion($_descripcion) {
		$this->_descripcion = $_descripcion;
	}
	
	/**
	 * @param String $_elementos
	 */
	public function set_elementos($_elementos) {
		$this->_elementos = $_elementos;
	}
	
	/**
	 * @param String $_idDocumento
	 */
	public function set_idDocumento($_idDocumento) {
		$this->_idDocumento = $_idDocumento;
	}
	
	/**
	 * @param String $_nombre
	 */
	public function set_nombre($_nombre) {
		$this->_nombre = $_nombre;
	}
	/**
	 * Array de objetos de tipo "Asunto"
	 * @return Array
	 */
	public function get_elementos() {
		return $this->_elementos;
	}
	
	/**
	 * @return String
	 */
	public function get_idDocumento() {
		return $this->_idDocumento;
	}
	
	
	

	function __construct($idDocumento=null)
	{
		$this->_idDocumento=$idDocumento;
	}

	public function getTotal(){
		return count($this->_elementos);
	}

	/**
	 * 
	 * @param desde
	 * @param numeroElementos
	 */
	public function cargar(  $desde=0,  $numeroElementos=0){
		
		if($this->_idDocumento){	
			$db=FabricaBaseDatos::crear();
			$select=$db->select()
			->from('v_anexos_documento')
			->limit($numeroElementos,$desde)
			->where('id_documento = ? ',$this->_idDocumento);
			$rows=$db->fetchAll($select);
		
			foreach ($rows as $row){
				$unAnexo=new Anexo($row['a_id_anexo']);
				$unAnexo->set_nombre($row['a_nombre']);
				$unAnexo->set_descripcion($row['a_descripcion']);
				array_push($this->_elementos,$unAnexo);
			}
			
			return true;
		}else{
			return false;
		}
	}

	public function toXml()
	{
			$salida="<AnexosDocumento>";
			foreach ($this->_elementos as $unElemento){
				$salida.="<Anexo>";
					$salida.="<Nombre>";
						$salida.=$unElemento->get_nombre();
					$salida.="</Nombre>";
					$salida.="<Descripcion>";
						$salida.=$unElemento->get_Descripcion();
					$salida.="</Descripcion>";
				$salida.="</Anexo>";
			}
		$salida.="</AnexosDocumento>";
		return $salida;
	}



}
?>