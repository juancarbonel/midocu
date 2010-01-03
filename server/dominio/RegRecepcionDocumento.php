<?php
Paquete::usar ( "dominio.INuevoRegistro" );

/**
 * @author Administrador
 * @version 1.0
 * @created 04-dic-2008 08:18:50 p.m.
 */
class RegRecepcionDocumento implements INuevoRegistro
{

	private $_idDocumento;
	private $_idUsuarioRecepcionista;
	private $_ultimoIdInsertado;
	private $_idAreaRecepciona;
	
	/**
	 * @param String $_idDocumento
	 */
	public function set_idDocumento($_idDocumento) {
		if(!empty($_idDocumento))
		{
			$this->_idDocumento = $_idDocumento;
		}
	}
	
	/**
	 * @param String $_idUsuarioRecepcionista
	 */
	public function set_idUsuarioRecepcionista($_idUsuarioRecepcionista) {
		if(!empty($_idUsuarioRecepcionista))
		{
			$this->_idUsuarioRecepcionista = $_idUsuarioRecepcionista;
		}
	}
	function __construct()
	{
	}

	function __destruct()
	{
	}
/**
	 * @param String $_idAreaRecepciona
	 */
	public function set_idAreaRecepciona ($_idAreaRecepciona) {
		if (!empty($_idAreaRecepciona))
		{ 
			$this->_idAreaRecepciona = $_idAreaRecepciona;
		}
	}




	public function registrar()
	{
		$db=FabricaBaseDatos::crear();
		$nuevoReg=array(
		"id_usuario_recepciona"=>$this->_idUsuarioRecepcionista,
		"id_area_recepcion"=>$this->_idAreaRecepciona,
		"id_documento_recibido"=>$this->_idDocumento,
		"fecha_recep"=>date("Y-m-d H:i:s")
		);
		
		if($db->insert('recepcion_documento',$nuevoReg)>=1){
			$this->_ultimoIdInsertado=$db->lastInsertId('recepcion_documento');
			return true;
		}else{
			return false;
		}
	}

	public function get_ultimoIdInsertado(){
		return $this->_ultimoIdInsertado;
	}

}
?>