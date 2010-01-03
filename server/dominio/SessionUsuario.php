<?php

Paquete::usar('dominio.IConvertibleXml');
/**
 * @author Anthony Cantuta Jorge
 * @version 1.0
 * @created 04-dic-2008 08:18:51 p.m.
 */
class SessionUsuario implements IConvertibleXml 
{
	private static $_nombreSession="SesUsuario"; 
	
	function __construct()
	{
	}

	function __destruct()
	{
	}



	public function getId()
	{
		return self::getSessionUsuario()->id;
	}
	
	public  function setId($valor){
		self::getSessionUsuario()->id=$valor;
	}
	public function setAreaConectado($valor) {
		self::getSessionUsuario()->areaConectado=$valor;
	}
	public function getAreaConectado() {
		return self::getSessionUsuario()->areaConectado;
	}
	
	
	public function existe(){
		
		if(isset(self::getSessionUsuario()->id)){
			return true;
		}else{
			return false;
		}
	} 
	
	public function borrar(){
		session_destroy();
	}
	
	public function toXml(){
		
		$salida="<SessionUsuario>";
			$salida.="<Existe>";
				if(self::existe()==true){
					$salida.="true";
				}else{
					$salida.="false";
				}
			$salida.="</Existe>";
			
			$salida.="<IdUsuario>";
				$salida.=self::getId();
			$salida.="</IdUsuario>";
			
			$salida.="<IdAreaConectado>";
				$salida.=self::getAreaConectado();
			$salida.="</IdAreaConectado>";
			
		$salida.="</SessionUsuario>";
		
		return $salida;
	}
	
	
	
	/**
	 * @return Zend_Session_Namespace
	 */
	private function getSessionUsuario(){
		 $sesUsuario=new Zend_Session_Namespace(self::$_nombreSession);
		 return  $sesUsuario;	
	}

}
?>