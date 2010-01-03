<?php
require_once ('Area.php');
require_once ('IRegistros.php');

/**
 * @author Anthony Cantuta Jorge
 * @version 1.0
 * @created 06-dic-2008 06:33:46 p.m.
 */
class Areas implements IConvertibleXml, IRegistros
{

	/**
	 * Array de objetos de tipo "Area"
	 *
	 * @var Array
	 */
	private $_elementos=Array();

	/**
	 * @return Array
	 */
	public function get_elementos() {
		return $this->_elementos;
	}

	/**
	 * @param Array $_elementos
	 */
	public function set_elementos($_elementos) {
		$this->_elementos = $_elementos;
	}
	function __construct()
	{
	}

	function __destruct()
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

		$select=$db->select()->from('area')
		->limit($numeroElementos,$desde);
		$rows=$db->fetchAll($select);

		foreach($rows as $row)
		{
			$unArea=new Area($row['id_area']);
			$unArea->set_nombre($row['nombre']);
			$unArea->set_descripcion($row['descripcion']);
			array_push($this->_elementos,$unArea);

		}


		return true;
	}




	public function getTotal()
	{
		return count($this->_elementos);
	}







	public function toXml()
	{
		$salida="<Areas>";
			foreach ($this->_elementos as $unElemento)
			{
				$salida.="<Area>";
					$salida.="<Id>";
						$salida.=$unElemento->get_id();
					$salida.="</Id>";

					$salida.="<Nombre>";
						$salida.=$unElemento->get_nombre();
					$salida.="</Nombre>";
					$salida.="<Descripcion>";
						$salida.=$unElemento->get_Descripcion();
					$salida.="</Descripcion>";
				$salida.="</Area>";
			}
				$salida.="<cantidad>";
					$salida.=count($this->_elementos);
				$salida.="</cantidad>";

		$salida.="</Areas>";
		return $salida;
	}

	/**
	 *
	 * @param elArea
	 */
	public function add(Area $elArea)
	{
		array_push($this->_elementos,$elArea);
	}



}
?>