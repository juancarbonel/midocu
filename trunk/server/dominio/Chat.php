<?php
class Chat
{
	
	
	public function Chat(){
		
	}
	
	
	

	function toXmlMensajes()
	{
		$db=FabricaBaseDatos::crear();
		
		$select=$db
		->select()
		->from('chat')
		->join("usuario", "usuario.id_usuario = chat.usuario_id", array("nombres" => "nombres"))
		->limit(25,0)
		->order("id DESC")
		
		;
		
		$rows=$db->fetchAssoc($select);
		
		$salida="<Mensajes>";
		foreach($rows as $row){
			$salida.="<Mensaje>";
			
				$salida.="<Contenido>";
					$salida.=$row["nombres"].":";
					$salida.=$row["mensaje"];
				$salida.="</Contenido>";
				
				$salida.="<Fecha>";
					$salida.=$row["fecha"];
				$salida.="</Fecha>";
				
			$salida.="</Mensaje>";
		}
		$salida.="</Mensajes>";
		
		return $salida;
	
	}
	
	public function agregarMensaje($idusuario,$contenidoMensaje){
		$db = FabricaBaseDatos::crear ();
		if(empty($contenidoMensaje)){
			$contenidoMensaje="";
		}
		$fecha=date("Y-m-d H:i:s");
		$arrayInsertar = array (
		"usuario_id" =>$idusuario,
		"mensaje" => $contenidoMensaje,
		"fecha" =>$fecha
		);
		
		if ($db->insert ( "chat", $arrayInsertar )>= 1) {
			$this->_ultimoIdInsertado = $db->lastInsertId ();
			return true;
		} 
		return false;
	}
	
	
} 
?>