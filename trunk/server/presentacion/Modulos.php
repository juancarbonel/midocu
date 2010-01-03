<?php

/**
 * @author Anthony Cantuta Jorge
 * @version 1.0
 * @created 04-dic-2008 08:24:00 p.m.
 */
abstract class Modulos {
	
	function __construct() {
	}
	
	function __destruct() {
	}
	
	public static function AppLoginUsuario() {
		Paquete::usar ( "presentacion.paginas.SwfPage" );
		$pag = new SwfPage ( );
		$pag->setTitle ( "Login Usuario" );
		$pag->set_rutaSwf ( ConfigGlobal::getUrlGlobal () . "presentacion/aplicaciones/AppLoginUsuario.swf?sin_cache=".rand());
		$pag->addVar("site_url",ConfigGlobal::getUrlGlobal ());
		$pag->addVar("debug",ConfigGlobal::getDebug());
		echo $pag;
	}
	
	public static function AppPanelUsuario() {
		Paquete::usar ( "presentacion.paginas.SwfPage" );
		
		if (SessionUsuario::existe ()) {
			
			$pag = new SwfPage ( );
			
			if (SessionUsuario::getId () == "1") {
				$pag->setTitle ( "Panel de Administracion" );
				$pag->set_rutaSwf ( ConfigGlobal::getUrlGlobal () . "presentacion/aplicaciones/AppPanelAdmin.swf?sincache=" . rand () );
				$pag->addVar("site_url",ConfigGlobal::getUrlGlobal ());
				$pag->addVar("debug",ConfigGlobal::getDebug());
			} else {
				$pag->setTitle ( "Panel de usuario" );
				$pag->set_rutaSwf ( ConfigGlobal::getUrlGlobal () . "presentacion/aplicaciones/AppPanelUsuario.swf?sincache=" . rand () );
				$pag->addVar("site_url",ConfigGlobal::getUrlGlobal ());
				$pag->addVar("debug",ConfigGlobal::getDebug());
			}
			
			echo $pag;
		} else {
			$pag = new SwfPage ( );
			$pag->setTitle ( "Login Usuario" );
			$pag->set_rutaSwf ( ConfigGlobal::getUrlGlobal () . "presentacion/aplicaciones/AppLoginUsuario.swf?sincache=" . rand () );
			$pag->addVar("site_url",ConfigGlobal::getUrlGlobal ());
			$pag->addVar("debug",ConfigGlobal::getDebug());
			echo $pag;
		
		}
	}
	
	public static function AppPanelUsuarioArea() {
		Paquete::usar ( "presentacion.paginas.SwfPage" );
		if (SessionUsuario::existe ()) {
			$pag = new SwfPage ( );
			$pag->setTitle ( "Panel Usuario Area" );
			$pag->set_rutaSwf ( ConfigGlobal::getUrlGlobal () . "presentacion/aplicaciones/AppPanelUsuarioArea.swf" );
			$pag->addVar("site_url",ConfigGlobal::getUrlGlobal ());
			$pag->addVar("debug",ConfigGlobal::getDebug());
			echo $pag;
		} else {
			$pag = new SwfPage ( );
			$pag->setTitle ( "Login Usuario" );
			$pag->set_rutaSwf ( ConfigGlobal::getUrlGlobal () . "presentacion/aplicaciones/AppLoginUsuarioArea.swf" );
			$pag->addVar("site_url",ConfigGlobal::getUrlGlobal ());
			$pag->addVar("debug",ConfigGlobal::getDebug());
			echo $pag;
		
		}
	}

	public static function AppModuloDefecto()
	{
		Paquete::usar ( "presentacion.paginas.SwfPage" );
		$pag = new SwfPage ( );
		$pag->setTitle ( "Login Usuario" );
		$pag->set_rutaSwf ( ConfigGlobal::getUrlGlobal () . "presentacion/aplicaciones/AppLoginUsuario.swf" );
		$pag->addVar("site_url",ConfigGlobal::getUrlGlobal ());
		$pag->addVar("debug",ConfigGlobal::getDebug());
		echo $pag;
	
	}

}
?>