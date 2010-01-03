<?php
Paquete::usar ( "configuracion.ConfigGlobal" );
Paquete::usar ( "Zend.Db" );
abstract class FabricaBaseDatos {
	
	/**
	 * Fabrica de objetos de base de datos
	 *
	 * @param String $gestor
	 * @return Zend_Db_Adapter_Abstract
	 */
	public function crear($gestor = "MySql") {
		switch ( $gestor) {
			case "MySql" :
				$db = Zend_Db::factory ("Pdo_Mysql", ConfigGlobal::getDb ()->toArray () );
				return $db;
			
			default :
				return NULL;
		
		}
	}
}

?>
