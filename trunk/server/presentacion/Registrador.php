<?php

/**
 * @author Anthony Cantuta Jorge
 * @version 1.0
 * @created 04-dic-2008 08:24:00 p.m.
 */
class Registrador {
	
	/**
	 * 
	 * @param nombres
	 * @param apellidos
	 * @param sexo
	 * @param domicilio
	 * @param telefono
	 * @param email
	 * @param fecha_nac
	 * @param habilitado
	 * @param password
	 */
	public static function RegUsuario() {
		Paquete::usar ( "dominio.RegUsuario" );
		$newUsuario = new RegUsuario ( );
		$newUsuario->set_nombres ( $_POST ['nombres'] );
		$newUsuario->set_apellidos ( $_POST ['apellidos'] );
		$newUsuario->set_domicilio ( $_POST ['domicilio'] );
		$newUsuario->set_telefono ( $_POST ['telefono'] );
		$newUsuario->set_email ( $_POST ['email'] );
		$newUsuario->set_fecha_nac ( $_POST ['fecha_nac'] );
		$newUsuario->set_password ( $_POST ['password'] );
		$newUsuario->set_sexo ( $_POST ['sexo'] );
		
		if ($newUsuario->registrar () == true) {
			echo "usuario registrado exitosamente ";
		} else {
			echo "no pudo registrarse";
		}
	
	}
	
	/**
	 * 
	 * @param nombre
	 * @param descripcion
	 * @param idAreaPadre
	 */
	public static function RegArea() {
		Paquete::usar ( "dominio.RegArea" );
		$regArea = new RegArea ( );
		$regArea->set_nombre ( $_POST ['nombre'] );
		$regArea->set_descripcion ( $_POST ['descripcion'] );
		$regArea->set_idAreaPadre ( null );
		if ($regArea->registrar ()) {
			echo "Area registrada exitosamente" . $regArea->get_ultimoIdInsertado ();
		} else {
			echo "no pudo registrarse";
		}
	
	}
	
	/**
	 * 
	 * @param idUsuarioRecepciona
	 * @param idAreaRecepcion
	 * @param idDocumentoRecibido
	 */
	public static function RegRecepcionDocumento() {
		
		Paquete::usar ( "dominio.RegRecepcionDocumento" );
		if (SessionUsuario::existe ()) {
			
			$_POST ['idUsuarioRecepcion'] = SessionUsuario::getId ();
			$_POST ['idAreaRecepcion'] = SessionUsuario::getAreaConectado ();
		}
		$nuevoReg = new RegRecepcionDocumento ( );
		$nuevoReg->set_idUsuarioRecepcionista ($_POST ['idUsuarioRecepcion']);
		$nuevoReg->set_idDocumento ($_POST ['idDocumentoRecibido']);
		$nuevoReg->set_idAreaRecepciona ($_POST ['idAreaRecepcion']);
		
		if ($nuevoReg->registrar () == true) {
			echo "recepcion registrada exitosamente" . $nuevoReg->get_ultimoIdInsertado ();
		} else {
			echo "no pudo registrarse recepcion";
		}
	
	}
	
	/**
	 * 
	 * @param nombre
	 * @param email
	 * @param telefono
	 */
	public static function RegRemitente() {
		Paquete::usar ( 'dominio.RegRemitente' );
		$newRemitente = new RegRemitente ( );
		$newRemitente->set_email ( $_POST ['email'] );
		$newRemitente->set_telefono ( $_POST ['telefono'] );
		if ($newRemitente->registrar () == true) {
			echo "remitente registrado exitosamente";
		} else {
			echo "no se pudo registrar remitente";
		}
	}
	
	/**
	 * 
	 * @param idRemitente
	 * @param sexo
	 * @param email
	 */
	public static function RegRemitenteNatural() {
		Paquete::usar ( "dominio.RegRemitente" );
		Paquete::usar ( "dominio.RegRemitentePersonaNatural" );
		
		$newRemitente = new RegRemitente ( );
		$newRemitente->set_email ( $_POST ['email'] );
		$newRemitente->set_telefono ( $_POST ['telefono'] );
		
		//si se registra Remitente, entonces registramos persona natural
		if ($newRemitente->registrar () == true) {
			
			//si se registro, entonces obteneos el id Insertado
			$idRemitente = $newRemitente->get_ultimoIdInsertado ();
			
			$nuevoReg = new RegRemitentePersonaNatural ( );
			$nuevoReg->set_idRemitente ( $idRemitente );
			$nuevoReg->set_nombres ( $_POST ['nombres'] );
			$nuevoReg->set_apellidos ( $_POST ['apellidos'] );
			$nuevoReg->set_sexo ( $_POST ['sexo'] );
			
			if ($nuevoReg->registrar () == true) {
				echo "remitente registrado exitosamente";
			} else {
				echo "no pudo registrarse";
			}
		} else {
			echo "no pudo registrarse remitente";
		}
	
	}
	
	/**
	 * 
	 * @param idRemitente
	 * @param direccion
	 * @param ruc
	 * @param telefono
	 */
	public static function RegRemitenteJuridico() {
		Paquete::usar ( "dominio.RegRemitente" );
		Paquete::usar ( "dominio.RegRemitentePersonaJuridica" );
		
		$newRemitente = new RegRemitente ( );
		$newRemitente->set_email ( $_POST ['email'] );
		$newRemitente->set_telefono ($_POST['telefono']);
		
		//si se registra Remitente, entonces registramos persona natural
		if ($newRemitente->registrar () == true) {
			
			//si se registro, entonces obtenemos el id Insertado
			$idRemitente = $newRemitente->get_ultimoIdInsertado ();
			$nuevoReg = new RegRemitentePersonaJuridica ( );
			$nuevoReg->set_idRemitente ( $idRemitente );
			$nuevoReg->set_razonSocial ( $_POST ['razonSocial'] );
			
			$nuevoReg->set_direccion ( $_POST ['direccion'] );
			$nuevoReg->set_ruc ( $_POST ['ruc'] );
			$nuevoReg->set_telefono ( $_POST ['telefono'] );
			
			if ($nuevoReg->registrar () == true) {
				echo 'Remitente registrado exitosamente';
			} else {
				echo 'No pudo registrarse remitente';
			}
		} else {
			echo "No pudo registrarse remitente.";
		}
	
	}
	
	/**
	 * 
	 * @param idDocumento
	 * @param nombre
	 * @param descripcion
	 */
	public static function RegAnexo() {
		
		Paquete::usar ( "dominio.RegAnexoDocumento" );
		
		$nuevoReg = new RegAnexoDocumento ( );
		$nuevoReg->set_idDocumento ( $_POST ['idDocumento'] );
		$nuevoReg->set_nombre ( $_POST ['nombre'] );
		$nuevoReg->set_descripcion ( $_POST ['descripcion'] );
		
		if ($nuevoReg->registrar () == true) {
			echo 'Anexo registrado exitosamente';
		} else {
			echo 'no se registro anexo';
		}
	
	}
	
	/**
	 * 
	 * @param nroDocumento
	 * @param nroFolios
	 * @param comentario
	 * @param sumilla
	 * @param asunto
	 * @param idAsunto
	 * @param idEstadoDocumento
	 * @param idTipoDocumento
	 */
	public static function RegDocumento() {
		
		Paquete::usar ( "dominio.RegDocumento" );
		Paquete::usar ( "dominio.RegRecepcionDocumento" );
		
		$nuevoDoc = new RegDocumento ( );
		$nuevoDoc->set_comentario ( $_POST ['comentario'] );
		$nuevoDoc->set_idAsunto ( $_POST ['idAsunto'] );
		$nuevoDoc->set_nroDocumento ( $_POST ['nroDocumento'] );
		$nuevoDoc->set_sumilla ( $_POST ['sumilla'] );
		$nuevoDoc->set_idEstado ( $_POST ['idEstadoDocumento'] );
		$nuevoDoc->set_idRemitente ( $_POST ['idRemitente'] );
		$nuevoDoc->set_idTipoDocumento ( $_POST ['idTipoDocumento'] );
		$nuevoDoc->set_nroFolios ( $_POST ['nroFolios'] );
		
		if ($nuevoDoc->registrar () == true) {
			echo "documento " . $nuevoDoc->get_ultimoIdInsertado () . " registrado exitosamente";
			if (SessionUsuario::getAreaConectado ()) {
				$nuevoRegRecepcion = new RegRecepcionDocumento ( );
				$nuevoRegRecepcion->set_idUsuarioRecepcionista ( SessionUsuario::getId () );
				$nuevoRegRecepcion->set_idAreaRecepciona ( SessionUsuario::getAreaConectado () );
				$nuevoRegRecepcion->set_idDocumento ( $nuevoDoc->get_ultimoIdInsertado () );
				$nuevoRegRecepcion->registrar ();
			
			}
		
		} else {
			echo "documento no pudo registrarse ";
		}
	}
	
	/**
	 * 
	 * @param nombre
	 * @param descripcion
	 */
	public static function RegTipoDocumento() {
		
		Paquete::usar ( "dominio.RegTipoDocumento" );
		$newTipoDocumento = new RegTipoDocumento ( );
		$newTipoDocumento->set_nombre ( $_POST ['nombre'] );
		$newTipoDocumento->set_descripcion ( $_POST ['descripcion'] );
		
		if ($newTipoDocumento->registrar () == true) {
			echo "tipo de documento registrado con exito";
		} else {
			echo "no se pudo registrar";
		}
	
	}
	
	/**
	 * 
	 * @param nombre
	 * @param descripcion
	 */
	public static function RegEstadoDocumento() {
		
		Paquete::usar ( "dominio.RegEstadoDocumento" );
		
		$nuevoReg = new RegEstadoDocumento ( );
		$nuevoReg->set_nombre ( $_POST ['nombre'] );
		$nuevoReg->set_descripcion ( $_POST ['descripcion'] );
		if ($nuevoReg->registrar () == true) {
			echo "Estado de documento registrado con exito";
		} else {
			echo "no pudo registrarse estado";
		}
	
	}
	
	/**
	 * 
	 * @param idDocumento
	 * @param nombre
	 * @param descripcion
	 */
	public static function RegAsunto() {
		
		Paquete::usar ( "dominio.RegAsunto" );
		
		$newAsunto = new RegAsunto ( );
		$newAsunto->set_nombre ( $_POST ['nombre'] );
		$newAsunto->set_descripcion ( $_POST ['descripcion'] );
		
		if ($newAsunto->registrar () == true) {
			echo "Asunto registrado exitosamente";
		} else {
			echo "no se pudo registrar";
		}
	
	}
	
	/**
	 * 
	 * @param nombre
	 * @param descripcion
	 */
	public static function RegRequisito() {
		
		Paquete::usar ( "dominio.RegEstadoDocumento" );
		
		$nuevoReg = new RegRequisito ( );
		$nuevoReg->set_nombre ( $_POST ['nombre'] );
		$nuevoReg->set_descripcion ( $_POST ['descripcion'] );
		
		if ($nuevoReg->registrar () == true) {
			echo "requisito registrado exitosamente";
		} else {
			echo "no pudo registrarse requisito";
		}
	}
	
	/**
	 * 
	 * @param idAsunto
	 * @param nombre
	 * @param descripcion
	 * @param idArea
	 * @param nroOrden
	 */
	public static function RegEtapaAsunto() {
		
		Paquete::usar ( "dominio.RegEtapaAsunto" );
		
		$nuevoReg = new RegEtapaAsunto ( $idAsunto );
		$nuevoReg->set_nombre ( $nombre );
		$nuevoReg->set_descripcion ( $descripcion );
		$nuevoReg->set_idArea ( $idArea );
		$nuevoReg->set_nroOrden ( $nroOrden );
		
		if ($nuevoReg->registrar () == true) {
			echo "Etapa registrada exitosamente";
		} else {
			echo "no pudo registrarse EtapaAsunto";
		}
	}
	
	/**
	 * 
	 * @param idDocumento
	 * @param idUsuarioDerivador
	 * @param idAreaEmite
	 * @param idAreaDestino
	 */
	public function RegDerivacionDocumento() {
		
		Paquete::usar ( "dominio.RegDerivarDocumento" );
		
		$nuevoReg = new RegDerivarDocumento ( );
		$nuevoReg->set_idDocumento ( $_POST ['idDocumento'] );
		$nuevoReg->set_idAreaEmision ( $_POST ['idAreaDerivadora'] );
		$nuevoReg->set_idAreaRecepcion ( $_POST ['idAreaRecepcion'] );
		$nuevoReg->set_idUsuarioDeriva ( $idUsuarioDerivador );
		
		if ($nuevoReg->registrar () == true) {
			echo "Derivacion registrada";
		} else {
			echo "No pudo registrar derivacion";
		}
	}
	
	public static function RegAnexoDocumento() {
		Paquete::usar ( 'dominio.RegAnexoDocumento' );
		$nuevoAnexo = new RegAnexoDocumento ( );
		$nuevoAnexo->set_idDocumento ( $_POST ['idDocumento'] );
		$nuevoAnexo->set_nombre ( $_POST ['nombre'] );
		$nuevoAnexo->set_descripcion ( $_POST ['descripcion'] );
		
		if ($nuevoAnexo->registrar ()) {
			echo "anexo registrado Exitosamente";
		} else {
			echo "no pudo registrarse anexo";
		}
	}
	
	public static function RegRequisitoAsunto() {
		
		Paquete::usar ( 'dominio.RegRequisito' );
		$regRequisito = new RegRequisito ( );
		$regRequisito->set_nombre ( $_POST ['nombre'] );
		$regRequisito->set_descripcion ( $_POST ['descripcion'] );
		if ($regRequisito->registrar () == true) {
			Paquete::usar ( 'dominio.RegRequisitoAsunto' );
			$regReqAsunto = new RegRequisitoAsunto ( $_POST ['idAsunto'] );
			$regReqAsunto->set_idRequisito ( $regRequisito->get_ultimoIdInsertado () );
			if ($regReqAsunto->registrar () == true) {
				echo 'requisito registrado exitosamente..';
			} else {
				echo 'no se pudo registrar requisitoAsunto con idAsunto' . $regRequisito->get_ultimoIdInsertado ();
			}
		} else {
			echo 'no se pudo registrar requisito';
		}
	}
	
	public static function asociarAreaUsuario() {
		Paquete::usar ( 'dominio.Usuario' );
		$usuario = new Usuario ( );
		$usuario->set_id ( $_POST ['idUsuario'] );
		if ($usuario->asociarseArea ( $_POST ['idArea'] )) {
			echo "se asocio exitosamente";
		} else {
			echo 'error al asociar';
		}
	}
	
	public static function desasociarAreaUsuario() {
		
		Paquete::usar ( 'dominio.Usuario' );
		$usuario = new Usuario ( );
		$usuario->set_id ( $_POST ['idUsuario'] );
		if ($usuario->desasociarseArea ( $_POST ['idArea'] )) {
			echo "se disocio exitosamente";
		} else {
			echo 'error al asociar';
		}
	}
	
	public static function usuarios() {
		Paquete::usar ( 'dominio.Usuarios' );
		$usuarios = new Usuarios ( );
		if ($usuarios->cargar () == true) {
			echo $usuarios->toXml ();
		} else {
			echo 'no se pudo cargar usuarios';
		}
	}
	
	public static function RegMensajeChat(){
		Paquete::usar ( 'dominio.Chat');
		$se = new SessionUsuario();
		$mensaje=$_POST["mensaje"];
		if($se->existe()){
			$chat= new Chat();
			$chat->agregarMensaje($se->getId(),$mensaje);
		}else{
			echo "no existe session";
		}
		
		
	}
}
?>