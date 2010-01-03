<?php

/**
 * @author Anthony Cantuta Jorge
 * @version 1.0
 * @created 07-dic-2008 07:09:05 p.m.
 */
class MostradorXml {
	
	function MostradorXml() {
	}
	
	static function estadosDocumento() {
		Paquete::usar ( 'dominio.EstadosDocumento' );
		$estadosDoc = new EstadosDocumento ( );
		if ($estadosDoc->cargar () == true) {
			echo $estadosDoc->toXml ();
		} else {
			echo "imposible cargar Estados";
		}
	}
	
	static function tiposDocumento() {
		Paquete::usar ( 'dominio.TiposDocumento' );
		$tiposDoc = new TiposDocumento ( );
		if ($tiposDoc->cargar () == true) {
			echo $tiposDoc->toXml ();
		} else {
			echo "imposible cargar Tipos";
		}
	}
	
	
	
	static function asuntosDocumento() {
		Paquete::usar ( 'dominio.Asuntos' );
		$asuntos = new Asuntos ( );
		
		if ($asuntos->cargar () == true) {
			echo $asuntos->toXml ();
		} else {
			echo "imposible cargar asuntos";
		}
	}
	
	public static function remitentes() {
		Paquete::usar ( 'dominio.Remitentes' );
		$remitentes = new Remitentes ( );
		$remitentes->cargar ();
		echo $remitentes->toXml ();
	}
	
	/**
	 * 
	 * @param idArea
	 */
	public static function bandejaEntradaArea() {
		Paquete::usar ( 'dominio.BandejaEntradaArea' );
		Paquete::usar ( 'dominio.FiltroDocumentos' );
		/**
		 * Estableciendo Filtro
		 * si los los parametros de filtro son nulos,estos no afectaran
		 * en el muestra de bandeja de documentos
		 */
		
		$filtro = new FiltroDocumentos ( );
		$filtro->set_idDocumento ( $_POST ['filtIdDocumento'] );
		$filtro->set_nombreRemite ( $_POST ['filtNombreRemite'] );
		
		$bandeja = new BandejaEntradaArea ( $_POST ['idArea'] );
		$bandeja->set_filtro ( $filtro );
		$bandeja->cargar ();
		echo $bandeja->toXml ();
	}
	
	public static function bandejaDocumentosRecepcionadosArea() {
		Paquete::usar ( 'dominio.BandejaDocumentosRecepArea' );
		Paquete::usar ( 'dominio.FiltroDocumentos' );
		
		/**
		 * Estableciendo Filtro
		 * si los los parametros de filtro son nulos,estos no afectaran
		 * en el muestra de bandeja de documentos
		 */
		$filtro= new FiltroDocumentos();
		$filtro->set_idDocumento ($_POST ['filtIdDocumento']);
		$filtro->set_nombreRemite ($_POST ['filtNombreRemite']);
		
		$bandeja = new BandejaDocumentosRecepArea ( $_POST ['idArea'] );
		$bandeja->set_filtro ( $filtro );
		$bandeja->cargar ();
		echo $bandeja->toXml ();
	}
	
	public static function areas() {
		
		Paquete::usar ( "dominio.Areas" );
		$areas = new Areas ( );
		if ($areas->cargar ()) {
			echo $areas->toXml ();
		}
	}
	
	public static function documento() {
		Paquete::usar ( 'dominio.DocumentoReg' );
		
		if (! empty ( $_POST ['idDocumento'])) {
			$unDocumento = new DocumentoReg ( $_POST ['idDocumento'] );
			if ($unDocumento->cargar ()) {
				echo $unDocumento->toXml ();
			}
		} else {
			echo "error al cargar:no indico Documento";
		}
	
	}
	
	public static function remitentesEncontradosBuscador() {
		
		Paquete::usar ( 'dominio.BuscadorRemitente' );
		$b = new BuscadorRemitente ( );
		$b->get_criterio ()->set_nombreRemitente ( $_POST ['nombreRemite'] );
		$b->get_criterio ()->set_email ( $_POST ['email'] );
		if ($b->encontrar () == true) {
			echo $b->toXml ();
		} else {
			echo "no encontraron Remitentes";
		}
	
	}
	
	public static function asuntosEncontradosBuscador() {
		Paquete::usar ( 'dominio.BuscadorAsunto' );
		$b = new BuscadorAsunto ( );
		$b->get_criterio ()->set_nombreAsunto ( $_POST ['nombre'] );
		if ($b->encontrar ()) {
			echo $b->toXml ();
		} else {
			echo 'no se encontraron Asuntos';
		}
	
	}
	
	public static function areasPerteneceUsuario() {
		Paquete::usar ( 'dominio.AreasPerteneceUsuario' );
		
		if (SessionUsuario::existe ()) {
			if (! isset ( $_POST ['idUsuario'] )) {
				$_POST ['idUsuario'] = SessionUsuario::getId ();
			}
			
			$usuario = new Usuario ( );
			$usuario->set_id ( $_POST ['idUsuario'] );
			
			if ($usuario->get_areasPertenece ()->cargar () == true) {
				echo $usuario->get_areasPertenece ()->toXml ();
			} else {
				echo "usuario no esta asociado a ninguna area";
			}
		
		} else {
			echo "no esta conectado";
		}
	}
	
	public static function sessionUsuario() {
		Paquete::usar ( 'dominio.SessionUsuario' );
		echo SessionUsuario::toXml ();
	}
	
	public static function requisitosAsunto() {
		
		Paquete::usar ( 'dominio.RequisitosAsunto' );
		$requisitos = new RequisitosAsunto ( $_POST ['idAsunto'] );
		$requisitos->cargar ();
		echo $requisitos->toXml ();
	}
	
	public static function usuario() {
		
		Paquete::usar ( 'dominio.Usuario');
		$usuario = new Usuario();
		$usuario->set_id ( $_POST ['idUsuario'] );
		if ($usuario->cargar () == true) {
			echo $usuario->toXml ();
		} else {
			echo 'no pudo cargarse datos de usuario';
		}
	}
	
	public static function usuarios() {
		
		Paquete::usar ( 'dominio.Usuarios');
		$usuarios = new Usuarios();
		
		if ($usuarios->cargar () == true) {
			echo $usuarios->toXml ();
		} else {
			echo 'no pudo cargarse datos de usuario';
		}
	}
	
	public static function anexosDocumento() {
		Paquete::usar ( 'dominio.AnexosDocumento' );
		$anexos = new AnexosDocumento ( );
		$anexos->set_idDocumento ( $_POST ['idDocumento'] );
		$anexos->cargar ();
		echo $anexos->toXml ();
	
	}
	
	public static function area(){
		Paquete::usar("dominio.Area");
		$reg=new Area($_POST["id"]);
		if($reg->cargar()==true){
			echo $reg->toXml();
		}else{
			echo "error al cargar";
		}
	}
	
	public static function asunto(){
	Paquete::usar("dominio.Asunto");
		$reg=new Asunto($_POST["id"]);
		if($reg->cargar()==true){
			echo $reg->toXml();
		}else{
			echo "error al cargar";
		}
	}
	
	public static function tipoDocumento(){
	Paquete::usar("dominio.TipoDocumento");
		$reg=new TipoDocumento($_POST["id"]);
		if($reg->cargar()==true){
			echo $reg->toXml();
		}else{
			echo "error al cargar";
		}
	}
	
	public static function estadoDocumento(){
	Paquete::usar("dominio.EstadoDocumento");
		$reg=new EstadoDocumento($_POST["id"]);
		if($reg->cargar()==true){
			echo $reg->toXml();
		}else{
			echo "error al cargar";
		}
	}
	
	public static function mensajesChat()
	{
		Paquete::usar("dominio.Chat");
		$chat = new Chat();
		echo $chat->toXmlMensajes();
	}

}
?>