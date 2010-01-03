<?php
Paquete::usar ( "dominio.INuevoRegistro" );

/**
 * @author Anthony Cantuta Jorge
 * @version 1.0
 * @created 04-dic-2008 08:18:50 p.m.
 */
class RegUsuario implements INuevoRegistro
{

	private $_nombres;
	private $_apellidos;
	private $_fecha_reg;
	private $_telefono;
	private $_domicilio;
	private $_email;
	private $_fecha_nac;
	private $_habilitado;
	private $_sexo;
	private $_password;
	private $_ultimoIdInsertado;
	/**
	 * @param String $_apellidos
	 */
	public function set_apellidos($_apellidos) {
		if(!empty($_apellidos)){
		$this->_apellidos = $_apellidos;
		}
	}
	
	/**
	 * @param String $_domicilio
	 */
	public function set_domicilio($_domicilio) {
		if(!empty($_domicilio)){
		$this->_domicilio = $_domicilio;
		}
	}
	
	/**
	 * @param String $_email
	 */
	public function set_email($_email) {
		if(!empty($_email)){
		$this->_email = $_email;
		}
	}
	
	/**
	 * @param String $_fecha_nac
	 */
	public function set_fecha_nac($_fecha_nac) {
		if(!empty($_fecha_nac)){
		$this->_fecha_nac = $_fecha_nac;
		}
	}
	
	/**
	 * @param String $_fecha_reg
	 */
	public function set_fecha_reg($_fecha_reg) {
		if(!empty($_fecha_reg)){
		$this->_fecha_reg = $_fecha_reg;
		}
	}
	
	/**
	 * @param String $_habilitado
	 */
	public function set_habilitado($_habilitado) {
		if(is_bool($_habilitado)){
		$this->_habilitado = $_habilitado;
		}
	}
	
	/**
	 * @param String $_nombres
	 */
	public function set_nombres($_nombres) {
		if(!empty($_nombres)){
		$this->_nombres = $_nombres;
		}
	}
	
	/**
	 * @param String $_password
	 */
	public function set_password($_password) {
		if(!empty($_password)){
		$this->_password = $_password;
		}
	}
	
	/**
	 * @param String $_sexo
	 */
	public function set_sexo($_sexo) {
		$this->_sexo = $_sexo;
	}
	
	/**
	 * @param String $_telefono
	 */
	public function set_telefono($_telefono) {
		if(!empty($_telefono)){
		$this->_telefono = $_telefono;
		}
	}

	

	function __construct()
	{
	}

	



	public function registrar()
	{
		$passwordEncriptada=md5($this->_password);
		
		$db=FabricaBaseDatos::crear();
		$nuevoRegistro=array(
		"nombres"=>$this->_nombres,
		"apellidos"=>$this->_apellidos,
		"sexo"=>$this->_sexo,
		"domicilio"=>$this->_domicilio,
		"telefono"=>$this->_telefono,
		"email"=>$this->_email,
		"fecha_nac"=>$this->_fecha_nac,
		"habilitado"=>1,
		"password"=>$passwordEncriptada
		);
		if($db->insert('usuario',$nuevoRegistro)>=1){
			$this->_ultimoIdInsertado=$db->lastInsertId('usuario');
			return true;
		}else{
			return false;
		}
		
		
	}

	public function get_ultimoIdInsertado()
	{
		return $this->_ultimoIdInsertado;
	}

}
?>