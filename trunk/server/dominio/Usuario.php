<?php

Paquete::usar ( "dominio.INuevoRegistro" );
Paquete::usar ( "dominio.RegRemitente" );
Paquete::usar ( "dominio.RegEtapaAsunto" );
Paquete::usar ( "dominio.RegDocumento" );
Paquete::usar ( "dominio.RegRecepcionDocumento" );
Paquete::usar ( "dominio.RegDocumentoGenerar" );
Paquete::usar ( "dominio.RegArea" );
Paquete::usar ( "dominio.RegDerivarDocumento" );
Paquete::usar ( "dominio.AreasPerteneceUsuario" );
/**
 * @author Anthony Cantuta Jorge
 * @version 1.0
 * @created 04-dic-2008 08:18:51 p.m.
 */
class Usuario implements IRegistro {

	private $_id;
	private $_nombres;
	private $_apellidos;
	private $_fecha_reg;
	private $_sexo;
	private $_telefono;
	private $_domicilio;
	private $_email;
	private $_fecha_nac;
	private $_habilitado;
	private $_password;

	/**
	 *
	 * @var AreasPerteneceUsuario
	 */
	private $_areasPertenece;

	function __construct() {
		$this->_areasPertenece = new AreasPerteneceUsuario ( );
	}

	function __destruct() {
	}

	/**
	 *
	 * @param registroDerivacion
	 */
	public function derivarDocumento(RegDerivarDocumento $registroDerivacion) {
	}

	/**
	 *
	 * @param id_documento
	 * @param RegDocumentoGenerar
	 */
	public function generarDocumento($id_documento, $RegDocumentoGenerar) {
	}

	/**
	 *
	 * @param id_documento
	 */
	public function recepcionarDocumento($id_documento) {
	}

	/**
	 *
	 * @param id_documento
	 * @param mensaje
	 */
	public function responderDocumento($id_documento, $mensaje) {
	}

	/**
	 *
	 * @param regDocumento
	 */
	public function registrarDocumento(RegDocumento $regDocumento) {
	}

	public function getEdad() {
	}

	public function desconectar() {
	}

	/**
	 *
	 * @param nombre
	 * @param descripcion
	 */
	public function registrarArea($nombre, $descripcion) {
	}

	public function cargar() {
		$db = FabricaBaseDatos::crear ();

		$select = $db->select ()->from ( 'usuario' )->limit ( 1, 0 )->where ( 'id_usuario = ? ', $this->_id );
		
		$rows = $db->fetchAll ( $select );

		if (count ( $rows ) == 1) {
			$this->_nombres = $rows [0] ['nombres'];
			$this->_apellidos = $rows [0] ['apellidos'];
			$this->_sexo = $rows [0] ['sexo'];
			$this->_domicilio = $rows [0] ['domicilio'];
			$this->_telefono = $rows [0] ['telefono'];
			$this->_email = $rows [0] ['email'];
			$this->_fecha_nac = $rows [0] ['fecha_nac'];
			$this->_habilitado = $rows [0] ['habilitado'];
			return true;
		}
		return false;
	}

	public function eliminar() {
	}

	public function actualizar() {
		if ($this->_id && ! empty ( $this->_id )) {
			if ($this->_nombres)
				$datos ['nombres'] = $this->_nombres;
			if ($this->_apellidos)
				$datos ['apellidos'] = $this->_apellidos;
			if ($this->_email)
				$datos ['email'] = $this->_email;
			if ($this->_domicilio)
				$datos ['domicilio'] = $this->_domicilio;
			if ($this->_telefono)
				$datos ['telefono'] = $this->_telefono;
			if ($this->_fecha_nac)
				$datos ['fecha_nac'] = $this->_fecha_nac;
			if ($this->_password){
				$datos ['password'] = md5 ( $this->_password );
			}
			if ($this->_sexo)
				$datos ['sexo'] = $this->_sexo;

			if (count ( $datos ) >= 1) {
				$db = FabricaBaseDatos::crear ();
				$db->update('usuario', $datos,'id_usuario=' . $this->_id );
				return true;

			}

		}
		return false;
	}

	public function toXml() {

		$salida = "<Usuario>";
		$salida .= "<Id>";
		$salida .= $this->_id;
		$salida .= "</Id>";

		$salida .= "<Nombres>";
		$salida .= $this->_nombres;
		$salida .= "</Nombres>";

		$salida .= "<Apellidos>";
		$salida .= $this->_apellidos;
		$salida .= "</Apellidos>";

		$salida .= "<Domicilio>";
		$salida .= $this->_domicilio;
		$salida .= "</Domicilio>";

		$salida .= "<Telefono>";
		$salida .= $this->_telefono;
		$salida .= "</Telefono>";

		$salida .= "<Email>";
		$salida .= $this->_email;
		$salida .= "</Email>";

		$salida .= "<FechaNac>";
		$salida .= $this->_telefono;
		$salida .= "</FechaNac>";

		$salida .= "<Habilitado>";
		$salida .= $this->_habilitado;
		$salida .= "</Habilitado>";

		$salida .= "<Sexo>";
		$salida .= $this->_sexo;
		$salida .= "</Sexo>";

		$salida .= "</Usuario>";

		return $salida;
	}

	/**
	 * @return String
	 */
	public function get_apellidos() {
		return $this->_apellidos;
	}

	/**
	 * @return String
	 */
	public function get_domicilio() {
		return $this->_domicilio;
	}

	/**
	 * @return String
	 */
	public function get_email() {
		return $this->_email;
	}

	/**
	 * @return String
	 */
	public function get_fecha_nac() {
		return $this->_fecha_nac;
	}

	/**
	 * @return String
	 */
	public function get_fecha_reg() {
		return $this->_fecha_reg;
	}

	/**
	 * @return String
	 */
	public function get_habilitado() {
		return $this->_habilitado;
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
	public function get_nombres() {
		return $this->_nombres;
	}

	/**
	 * @return String
	 */
	public function get_sexo() {
		return $this->_sexo;
	}

	/**
	 * @return String
	 */
	public function get_telefono() {
		return $this->_telefono;
	}

	/**
	 * @param String $_apellidos
	 */
	public function set_apellidos($_apellidos) {
		if (! empty ( $_apellidos )) {
			$this->_apellidos = $_apellidos;
		}
	}

	/**
	 * @param String $_domicilio
	 */
	public function set_domicilio($_domicilio) {
		if (! empty ( $_domicilio )) {
			$this->_domicilio = $_domicilio;
		}
	}

	/**
	 * @param String $_email
	 */
	public function set_email($_email) {
		if (! empty ( $_email )) {
			$this->_email = $_email;
		}
	}

	/**
	 * @param String $_fecha_nac
	 */
	public function set_fecha_nac($_fecha_nac) {
		if (! empty ( $_fecha_nac )) {
			$this->_fecha_nac = $_fecha_nac;
		}
	}

	/**
	 * @param String $_habilitado
	 */
	public function set_habilitado($_habilitado) {
		if ($_habilitado == 1 or $_habilitado == 0) {
			$this->_habilitado = $_habilitado;
		}
	}

	/**
	 * @param String $_nombres
	 */
	public function set_nombres($_nombres) {
		if (! empty ( $_nombres )) {
			$this->_nombres = $_nombres;
		}
	}

/**
	 * @param String $_password
	 */
	public function set_password($_password) {
		if (! empty ($_password)) {
			$this->_password =$_password;
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
		if (! empty ( $_telefono )) {
			$this->_telefono = $_telefono;
		}
	}

	/**
	 * @return AreasPerteneceUsuario
	 */
	public function get_areasPertenece() {
		$this->_areasPertenece->set_idUsuario ( $this->_id );
		return $this->_areasPertenece;
	}

	/**
	 * @param String $_areasPertenece
	 */
	public function set_areasPertenece($_areasPertenece) {
		$this->_areasPertenece = $_areasPertenece;
	}

	/**
	 * @param String $_fecha_reg
	 */
	public function set_fecha_reg($_fecha_reg) {
		if (! empty ( $_fecha_reg )) {
			$this->_fecha_reg = $_fecha_reg;
		}
	}

	/**
	 * @param String $_id
	 */
	public function set_id($_id) {
		if (! empty ( $_id )) {
			$this->_id = $_id;
		}
	}






	/**
	 *
	 * @param idArea
	 */
	public function asociarseArea($idArea)
	{
		if($this->_id && !empty($this->_id) &&!empty($idArea)){
		$db = FabricaBaseDatos::crear();
			$datos['id_area']=$idArea;
			$datos['id_usuario'] = $this->_id;
			
			if($db->insert('usuario_area',$datos)>=1){
				return true;
			}
		}
		return false;
	}
	
	public function desasociarseArea($idArea){
		if($this->_id && !empty($this->_id) &&!empty($idArea)){
		$db = FabricaBaseDatos::crear();
			$where= 'id_usuario='.$this->_id.' AND id_area='.$idArea;
			if($db->delete('usuario_area',$where)>=1){
				return true;				
			}
		}
		return false;
	}

}
?>