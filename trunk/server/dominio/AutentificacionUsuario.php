<?php

/**
 * @author Anthony Cantuta Jorge
 * @version 1.0
 * @created 04-dic-2008 08:18:45 p.m.
 */
Paquete::usar ( 'dominio.SessionUsuario' );
Paquete::usar ( 'dominio.IConvertibleXml' );
Paquete::usar ( 'configuracion.Admin' );
class AutentificacionUsuario implements IConvertibleXml {
	private $_autentificado = false;
	
	/**
	 * Autentificar usuario
	 * @param email
	 * @param clave
	 * @return Bool
	 */
	public function conectar($email, $clave) {
	
		if(Admin::autentificar($email,$clave)){
			SessionUsuario::setId (1);
			$this->_autentificado = true;
			return true;
		}
		
		
		$db = FabricaBaseDatos::crear ();
		
		$select = $db->select ()->limit(1,0)
		->from ( 'usuario' )
		->where ( 'email = ? ', $email )
		->where ( 'password = ? ', md5 ( $clave ) );
		
		$rows = $db->fetchAll ( $select );
		
		if (count ( $rows ) >= 1) {
			//SessionUsuario::setId($rows[1]['id_usuario']);
			SessionUsuario::setId ( $rows [0] ['id_usuario'] );
			SessionUsuario::setAreaConectado($rows[0]['id_area']);
			$this->_autentificado = true;
			return true;
		} else {
			$this->_autentificado = false;
			return false;
		}
	
	}
	
	
	public function toXml() {
		$salida = "<AutentificacionUsuario>";
		$salida .= "<Autentificado>";
		if ($this->_autentificado == true) {
			$salida .= "true";
		} else {
			$salida .= "false";
		}
		$salida .= "</Autentificado>";
		$salida .= "</AutentificacionUsuario>";
		
		return $salida;
	}

}

?>