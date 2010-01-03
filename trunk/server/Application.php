<?php

require_once 'library/Paquete.php';
Paquete::usar ( 'configuracion.ConfigGlobal' );
Paquete::usar ( "Zend.Session" );
Paquete::usar ( "persistencia.FabricaBaseDatos" );
Paquete::usar ( "presentacion.Registrador" );
Paquete::usar ( "presentacion.MostradorXml" );
Paquete::usar ( "dominio.SessionUsuario" );
Paquete::usar ( "presentacion.Modulos" );
abstract class Application{
	
	static function execute() {
		
		Zend_Session::start ();
		
		/*********************************************************
		 * REGISTRADOR 
		 *******************************************************
		 */
		$registrar = $_POST ["registrar"];
		switch ( $registrar) {
			case "area" :
				Registrador::RegArea ();
			break;
			case "tipoDocumento" :
				Registrador::RegTipoDocumento ();
			break;
			case 'documento' :
				Registrador::RegDocumento ();
			break;
			case "usuario" :
				Registrador::RegUsuario ();
			break;
			case 'recepcionDocumento' :
				Registrador::RegRecepcionDocumento ();
			break;
			
			case 'derivacionDocumento' :
				Registrador::RegDerivacionDocumento ();
			break;
			
			case 'asuntoDocumento' :
				Registrador::RegAsunto ();
			break;
			
			case 'remitente' :
				Registrador::RegRemitente ();
			break;
			case 'remitenteNatural' :
				Registrador::RegRemitenteNatural ();
			break;
			
			case 'remitenteJuridico' :
				Registrador::RegRemitenteJuridico ();
			break;
			case "estadoDocumento" :
				Registrador::RegEstadoDocumento ();
			break;
			
			case 'anexoDocumento' :
				Registrador::RegAnexoDocumento ();
			break;
			
			case 'requisitoAsunto' :
				Registrador::RegRequisitoAsunto ();
			break;
			
			case 'asociarAreaUsuario' :
				Registrador::asociarAreaUsuario ();
			break;
			case 'desasociarAreaUsuario' :
				Registrador::desasociarAreaUsuario();
			break;
			case 'mensajeChat' :
				Registrador::RegMensajeChat();
			break;
			
		}
		
		//--------------------------------------------
		

		/*********************************************
		 * 
		 * MOSTRADOR DE XML
		 * 
		 ********************************************/
		
		$mostradorXml = $_POST['mostradorXml'];
		switch ( $mostradorXml) {
			case 'estadosDocumento' :
				MostradorXml::estadosDocumento ();
			break;
			
			case 'tiposDocumento' :
				MostradorXml::tiposDocumento ();
			break;
			case 'asuntosDocumento' :
				MostradorXml::asuntosDocumento ();
			break;
			
			case 'remitentes' :
				MostradorXml::remitentes ();
			break;
			case 'asuntos' :
				MostradorXml::asuntosDocumento ();
			break;
			case "areas" :
				MostradorXml::areas ();
			break;
			case 'areasPerteneceUsuario' :
				MostradorXml::areasPerteneceUsuario ();
			break;
			case 'sessionUsuario' :
				MostradorXml::sessionUsuario ();
			break;
			
			case 'bandejaEntradaArea' :
				
				MostradorXml::bandejaEntradaArea ();
			break;
			
			case 'bandejaDocumentosRecepArea' :
				MostradorXml::bandejaDocumentosRecepcionadosArea ();
			break;
			
			case 'documento' :
				MostradorXml::documento ();
			break;
			
			case 'remitentesEncontradosBuscador' :
				MostradorXml::remitentesEncontradosBuscador ();
			break;
			case 'asuntosEncontradosBuscador' :
				MostradorXml::asuntosEncontradosBuscador ();
			break;
			
			case 'anexosDocumento' :
				 MostradorXml::anexosDocumento();
			break;
			
			case 'requisitosAsunto' :
				MostradorXml::requisitosAsunto();
			break;
			case 'usuario' :
				MostradorXml::usuario();
			break;
			
			case 'usuarios' :
				MostradorXml::usuarios();
			break;
			
			
			case "area":
				MostradorXml::area();
				break;
			case "asunto":
				MostradorXml::asunto();
				break;
			case "tipoDocumento":
				MostradorXml::tipoDocumento();
				break;
			case "estadoDocumento":
				MostradorXml::estadoDocumento();
				
				break;
			case "mensajesChat":
				MostradorXml::mensajesChat();
				break;
				
		}
		
		//-------------------------------------
		
		

		$actualizar = $_POST ['actualizar'];
		switch ( $actualizar) {
			case 'documento' :
				Paquete::usar ( 'dominio.DocumentoReg' );
				$editDocumento = new DocumentoReg ( $_POST ['idDocumento'] );
				$editDocumento->get_remitente ()->set_id ( $_POST ['idRemitente'] );
				$editDocumento->get_asunto ()->set_id ( $_POST ['idAsunto'] );
				$editDocumento->get_tipo ()->set_id ( $_POST ['idTipo'] );
				$editDocumento->get_estado ()->set_id ( $_POST ['idEstado'] );
				
				$editDocumento->set_nroDocumento ( $_POST ['nroDocumento'] );
				$editDocumento->set_nroFolios ( $_POST ['nroFolios'] );
				$editDocumento->set_sumilla ( $_POST ['sumilla'] );
				$editDocumento->set_comentario ( $_POST ['comentario'] );
				
				if ($editDocumento->actualizar () == true) {
					echo 'se actualizo exitosamente';
				} else {
					echo 'no se actualizo documento';
				}
			break;
			
			case 'usuario' :
				Paquete::usar ( 'dominio.Usuario' );
				$usuario = new Usuario ( );
				$usuario->set_id ( $_POST ['id'] );
				$usuario->set_nombres ( $_POST ['nombres'] );
				$usuario->set_apellidos ( $_POST ['apellidos'] );
				$usuario->set_domicilio ( $_POST ['domicilio'] );
				$usuario->set_telefono ( $_POST ['telefono'] );
				$usuario->set_email ( $_POST ['email'] );
				$usuario->set_sexo($_POST["sexo"]);
				$usuario->set_password ( $_POST ['password'] );
				if ($usuario->actualizar () == true) {
					echo 'datos actualizados exitosamente';
				} else {
					echo "error al actualizar datos";
				}
			break;
			case "area":
				Paquete::usar('dominio.Area');
				$edit = new Area();
				$edit->set_id($_POST['id']);
				$edit->set_nombre($_POST['nombre']);
				$edit->set_descripcion($_POST['descripcion']);
				if($edit->actualizar()==true){
					echo 'actualizado exitosamente';
				}else{
					echo 'error al actualizarr';
				}
			break;
			case 'estadoDocumento':
				Paquete::usar('dominio.EstadoDocumento');
				$edit = new EstadoDocumento();
				$edit->set_id($_POST['id']);
				$edit->set_nombre($_POST['nombre']);
				$edit->set_descripcion($_POST['descripcion']);
				if($edit->actualizar()==true){
					echo 'actualizado exitosamente';
				}else{
					echo 'error al actualizar';
				}
				break;
			case 'tipoDocumento':
				Paquete::usar('dominio.TipoDocumento');
				$edit = new TipoDocumento();
				$edit->set_id($_POST['id']);
				$edit->set_nombre($_POST['nombre']);
				$edit->set_descripcion($_POST['descripcion']);
				if($edit->actualizar()==true){
					echo 'actualizado exitosamente';
				}else{
					echo 'error al actualizar';
				}
				break;
				case 'asuntoDocumento':
				Paquete::usar('dominio.Asunto');
				$edit = new Asunto();
				$edit->set_id($_POST['id']);
				$edit->set_nombre($_POST['nombre']);
				$edit->set_descripcion($_POST['descripcion']);
				if($edit->actualizar()==true){
					echo 'actualizado exitosamente';
				}else{
					echo 'error al actualizar';
				}
				
				break;
		
		}
		
		/**************************************
		 * 
		 * ACCIONES
		 * 
		 *************************************/
		$accion = $_REQUEST['accion'];
		switch ( $accion) {
			case 'autentificacionUsuario' :
				Paquete::usar ( 'dominio.AutentificacionUsuario' );
				$autUsuario = new AutentificacionUsuario ( );
				$autUsuario->conectar ( $_POST ['email'], $_POST ['password'] );
				echo $autUsuario->toXml ();
			break;
			case 'cerrarSesion' :
				Paquete::usar ( 'dominio.SessionUsuario' );
				SessionUsuario::borrar();
				header("location: index.php");
			break;
			case 'usuarioConectaArea' :
				SessionUsuario::setAreaConectado ( $_POST ['idArea'] );
			break;
		}
		
		/**************************************
		 * 
		 * MOSTRADOR MODULOS
		 *  
		 *************************************/
		$modulo = $_GET ['modulo'];
		switch ( $modulo) {
			case "loginUsuario" :
				Modulos::AppLoginUsuario();
			break;
			case "panelUsuario" :
				Modulos::AppPanelUsuario();
			break;
			
			case 'panelUsuarioArea' :
				Modulos::AppPanelUsuarioArea();
			break;
			
		}
		//-------------------------------------------------
	

	}
	
	static function run(){
		if(count($_GET)==0 && count($_POST)==0){
		
			Modulos::AppModuloDefecto();
	
		}else{
			self::execute();
		}
	}

}


