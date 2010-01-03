<?php
 /*
 * Autor:Anthony Cantuta J.
 * Email: anthony@cantuta.org
 * Blog: http://www.cantuta.org
 * Hecho: 26-nov-2008
 * Version:0.1
 * 
 * Descripcion:
 * Clase que permite incluir paquetes,clases determinando una expresion
 * facilitando la visualizacion de estas
 * Ejemplo: 
 * *
 */

abstract  class Paquete
{
		
		
		 
	
		static function usar($paquete)
		{
			
			$usar = str_replace(".","/",$paquete).".php";
			require_once($usar);
		}
}



?>
