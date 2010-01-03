<?php

Paquete::usar('dominio.IConvertibleXml');
Paquete::usar('dominio.IRegistros');
Paquete::usar('dominio.Area');
Paquete::usar('dominio.Areas');

class AreasPerteneceUsuario implements IConvertibleXml, IRegistros
{

	/**
	 * 
	 *
	 * @var Areas
	 */
	private $_areas ;
	private $_idUsuario;
	
	/**
	 * @return Areas
	 */
	public function get_areas() {
		return $this->_areas;
	}
	
	/**
	 * @return String
	 */
	public function get_idUsuario() {
		return $this->_idUsuario;
	}
	
	/**
	 * @param Areas $_areas
	 */
	public function set_areas($_areas) {
		$this->_areas = $_areas;
	}
	
	/**
	 * @param String $_idUsuario
	 */
	public function set_idUsuario($_idUsuario) {
		$this->_idUsuario = $_idUsuario;
	}
	function __construct()
	{
		$this->_areas=new Areas();
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
		if($this->_idUsuario){
			$db=FabricaBaseDatos::crear();
			$select=$db->select()
			->from('v_usuario_area')
			->limit($numeroElementos,$desde)
			->where('id_usuario = ?', $this->_idUsuario);
			$rows=$db->fetchAll($select);
			foreach ($rows as $row){
				$unArea=new Area($row['id_area']);
				$unArea->set_nombre($row['nombre_area']);
				$unArea->set_descripcion($row['descripcion_area']);
				$this->_areas->add($unArea);
			}
		}
		
		return true;
		
	}

	public function toXml()
	{
		return $this->_areas->toXml(); 	
	}

	

	public function getTotal()
	{
		return $this->_areas->getTotal();
	}

	
}
?>