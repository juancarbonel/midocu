<?php

Paquete::usar('dominio.IRegistros');
Paquete::usar('dominio.Usuario');
Paquete::usar('dominio.IConvertibleXml');
/**
 * @author Anthony Cantuta Jorge
 * @version 1.0
 * @created 03-ene-2009 06:33:11 p.m.
 */
class Usuarios implements IRegistros, IConvertibleXml
{

	private $_elementos = Array();

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
	public function cargar(  $desde = 0,   $numeroElementos = 0)
	{
		$db = FabricaBaseDatos::crear();
		$select = $db->select()
		->from('usuario')
		->limit($numeroElementos,$desde)
		->order('id_usuario DESC');
		
		$rows= $db->fetchAll($select);
		
		foreach ($rows as $row){
			
			$unUsuario = new Usuario();
			$unUsuario->set_id($row['id_usuario']);
			$unUsuario->set_nombres($row['nombres']);
			$unUsuario->set_apellidos($row['apellidos']);
			$unUsuario->set_domicilio($row['domicilio']);
			$unUsuario->set_telefono($row['telefono']);
			$unUsuario->set_email($row['email']);
			$unUsuario->set_habilitado($row['habilitado']);
			$unUsuario->set_sexo($row['sexo']);
			$unUsuario->set_fecha_nac($row['fecha_nac']);
			
			array_push($this->_elementos,$unUsuario);
		}
		
		return true;
	}

	public function getTotal()
	{
	}

	

	public function toXml()
	{
		$salida="<Usuarios>";
			foreach ($this->_elementos as $unUsuario){
				$salida.=$unUsuario->toXml();
			}
		$salida.="</Usuarios>";
		return $salida;
	}

}
?>