<?php
class Admin
{
		static private $_usuario="admin";
		static private $_password="123456";
		
		public function autentificar($u,$p)
		{
			if(self::$_usuario==$u && self::$_password==$p){
				return true;
			}
			return false;
		}
	}
?>