<?php

Paquete::usar('presentacion.paginas.SimplePage');

/**
 * @author Anthony Cantuta Jorge
 * @version 1.0
 * @created 18-dic-2008 06:23:38 p.m.
 */
class SwfPage extends SimplePage
{
	private $_rutaSwf;
	private $_flasvars;
	
	/**
	 * @return String
	 */
	public function get_rutaSwf() {
		return $this->_rutaSwf;
	}
	
	/**
	 * @param String $_rutaSwf
	 */
	public function set_rutaSwf($_rutaSwf) {
		$this->_rutaSwf = $_rutaSwf;
	}
	function __construct()
	{
		$this->_flashvars=new ArrayObject();
	}
	
	function addVar($var_name,$var_value){
		$var1["name"]=$var_name;
		$var1["value"]=$var_value;
		$this->_flashvars->append($var1);
	}

	function __destruct()
	{
	}
	
	/*****************************************
	* Convert flash vars as URL
	******************************************/
	function _getVarsAsUrl(){
		$url="";
		foreach($this->_flashvars as $it){
			$url.="&".$it["name"]."=".urlencode($it["value"]);
		}
		return $url;
	}
	
	function __toString(){
		$_rutaSwf=$this->_rutaSwf;
		$salida='

<html lang="en">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />


<style>
body { margin: 0px; overflow:hidden }
</style>
<title>
'.$this->_title.'
</title>
</head>

<body scroll="no">

  	<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
			id="AppLoginUsuario" width="100%" height="100%"
			codebase="http://fpdownload.macromedia.com/get/flashplayer/current/swflash.cab">
			<param name="movie" value="'.$_rutaSwf.'?'.$this->_getVarsAsUrl().'" />
			<param name="quality" value="high" />
			<param name="bgcolor" value="#869ca7" />
			<param name="allowScriptAccess" value="sameDomain" />
			<param name="flashvars" value="'.$this->_getVarsAsUrl().'" />
			<embed src="'.$_rutaSwf.'?'.$this->_getVarsAsUrl().'" quality="high" bgcolor="#869ca7"
				width="100%" height="100%" name="AppLoginUsuario" align="middle"
				
				type="application/x-shockwave-flash"
				pluginspage="http://www.adobe.com/go/getflashplayer">
			</embed>
	</object>

</body>

</html>
		
		';

		return $salida;
		
		
	}





}
?>