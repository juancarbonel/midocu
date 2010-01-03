<?php


/**
 * @author Anthony Cantuta Jorge
 * @version 1.0
 * @created 05-dic-2008 04:01:04 p.m.
 */
interface IRegistros
{

	
	public function getTotal();

	/**
	 * 
	 * @param desde
	 * @param numeroElementos
	 */
	public function cargar($desde=0,$numeroElementos=0);



	

}
?>