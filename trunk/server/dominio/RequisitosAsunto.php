<?
Paquete::usar('dominio.IRegistros');
Paquete::usar('dominio.IConvertibleXml');
Paquete::usar('dominio.RequisitoAsunto');



/**
 * @author Administrador
 * @version 1.0
 * @created 05-dic-2008 03:54:44 p.m.
 */
class RequisitosAsunto implements IRegistros, IConvertibleXml
{

	private $_elementos=Array();
	private $_idAsunto;
	
	
	/**
	 * @return String
	 */
	public function get_elementos() {
		return $this->_elementos;
	}
	
	/**
	 * @return String
	 */
	public function get_idAsunto() {
		return $this->_idAsunto;
	}
	
	/**
	 * @param String $_elementos
	 */
	public function set_elementos($_elementos) {
		$this->_elementos = $_elementos;
	}
	function __construct($idAsunto)
	{
		$this->_idAsunto=$idAsunto;
	}

	function __destruct()
	{
	}




	public function eliminarTodo()
	{
	}

	public function actualizarTodo()
	{
	}

	public function getTotal()
	{
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
		->from('v_requisitos_asuntos')
		->where('id_asunto = ? ', $this->_idAsunto);
		$rows=$db->fetchAll($select);
		foreach ($rows as $row){
			$unRequisito=new RequisitoAsunto($row['id_requisito']);
			$unRequisito->set_nombre($row['nombre_requisito']);
			$unRequisito->set_descripcion($row['descripcion_requisito']);
			array_push($this->_elementos,$unRequisito);
		}
		
		return true;
	}

	public function toXml()
	{
		$salida="<RequisitosAsunto>";
			$salida.="<idAsunto>";
				$salida.=$this->_idAsunto;
			$salida.="</idAsunto>";
			
			foreach ($this->_elementos as $unElemento){
				
				$salida.='<Requisito>';
					$salida.='<Nombre>';
						$salida.=$unElemento->get_nombre();
					$salida.='</Nombre>';
					
					$salida.='<Descripcion>';
						$salida.=$unElemento->get_descripcion();
					$salida.='</Descripcion>';
					
				$salida.='</Requisito>';
			}
			
		$salida.="</RequisitosAsunto>";
		return $salida;
	}

}
?>