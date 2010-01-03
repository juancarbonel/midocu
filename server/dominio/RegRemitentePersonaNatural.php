<?php
require_once ('INuevoRegistro.php');

/**
 * @author Anthony Cantuta Jorge
 * @version 1.0
 * @created 07-dic-2008 12:05:49 p.m.
 */
class RegRemitentePersonaNatural implements INuevoRegistro
{

	private $_idRemitente;
	private $_apellidos;
	private $_sexo;
	private $_ultimoIdInsertado;
	private $_nombres;

	function __construct()
	{
	}

	function __destruct()
	{
	}
		
	/**
	 * @param String $_apellidos
	 */
	public function set_apellidos($_apellidos) {
		if(!empty($_apellidos))
		{
			$this->_apellidos = $_apellidos;
		}
	}
	
	/**
	 * @param String $_idRemitente
	 */
	public function set_idRemitente($_idRemitente) {
		if(!empty($_idRemitente)){
		$this->_idRemitente = $_idRemitente;
		}
	}
	
	/**
	 * @param String $_nombres
	 */
	public function set_nombres($_nombres) {
		if(!empty($_nombres))
		{
			$this->_nombres = $_nombres;
		}
	}
	
	/**
	 * @param String $_sexo
	 */
	public function set_sexo($_sexo) {
		if(is_bool($_sexo))
		{
			$this->_sexo = $_sexo;
		}
	}



	public function registrar()
	{
		$db=FabricaBaseDatos::crear();
		$nuevoReg=array(
		"id_remitente"=>$this->_idRemitente,
		"nombres"=>$this->_nombres,
		"apellidos"=>$this->_apellidos,
		"sexo"=>$this->_sexo
		);
		
		if($db->insert('PersonaNatural',$nuevoReg)>=1){
			$this->_ultimoIdInsertado=$db->lastInsertId('PersonaNatural');
			return true;
		}
		return false;
	}

	public function get_ultimoIdInsertado()
	{
	}

}
?>