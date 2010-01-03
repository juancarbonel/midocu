<?php


Paquete::usar('dominio.CriterioAsunto');
Paquete::usar('dominio.IBuscador');
Paquete::usar('dominio.Asunto');
/**
 * @author Anthony Cantuta Jorge
 * @version 1.0
 * @created 23-dic-2008 10:42:36 p.m.
 */
class BuscadorAsunto implements IBuscador, IConvertibleXml
{

	private $_max_mostrar;
	private $_mostrar_desde;
	private $_asuntos = Array();
	/**
	 *
	 *@var CriterioAsunto
	 */
	private $_criterio;
	
	/**
	 * @return CriterioAsunto
	 */
	public function get_criterio() {
		return $this->_criterio;
	}
	
	/**
	 * @param Array $_asuntos
	 */
	public function set_asuntos($_asuntos) {
		$this->_asuntos = $_asuntos;
	}
	/**
	 * @return String
	 */
	public function get_asuntos() {
		return $this->_asuntos;
	}
	
	/**
	 * @return String
	 */
	public function get_max_mostrar() {
		return $this->_max_mostrar;
	}
	
	/**
	 * @return String
	 */
	public function get_mostrar_desde() {
		return $this->_mostrar_desde;
	}
	
	/**
	 * @param String $_criterio
	 */
	public function set_criterio($_criterio) {
		$this->_criterio = $_criterio;
	}
	
	/**
	 * @param String $_max_mostrar
	 */
	public function set_max_mostrar($_max_mostrar) {
		$this->_max_mostrar = $_max_mostrar;
	}
	
	/**
	 * @param String $_mostrar_desde
	 */
	public function set_mostrar_desde($_mostrar_desde) {
		$this->_mostrar_desde = $_mostrar_desde;
	}
	function __construct()
	{
		$this->_criterio=new CriterioAsunto();
	}

	



	

	public function encontrar()
	{
		$encontrado=false;
		$db=FabricaBaseDatos::crear();
		$select=$db->select()
		->from('asunto')
		->where('nombre LIKE ?','%'.$this->_criterio->get_nombreAsunto().'%');
		
		$rows=$db->fetchAll($select);
		
		foreach ($rows as $row) {
			$unAsunto=new Asunto();
			$unAsunto->set_id($row['id_asunto']);
			$unAsunto->set_nombre($row['nombre']);
			$unAsunto->set_descripcion($row['descripcion']);
			array_push($this->_asuntos,$unAsunto);
			$encontrado=true;
		}
		
		
		return $encontrado;
	}

	public function toXml()
	{
		$salida="<Asuntos>";
			foreach ($this->_asuntos as $unAsunto){
				
				$salida.="<Asunto>";
					$salida.="<Id>";
						$salida.=$unAsunto->get_id();
					$salida.="</Id>";
					
					$salida.="<Nombre>";
						$salida.=$unAsunto->get_nombre();
					$salida.="</Nombre>";
					
					$salida.="<Descripcion>";
						$salida.=$unAsunto->get_descripcion();
					$salida.="</Descripcion>";
					
				$salida.="</Asunto>";
			}
		$salida.="</Asuntos>";
		
		return $salida;
	}

}
?>