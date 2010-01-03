<?php

Paquete::usar('dominio.DetalleBandejaEntrada');

/**
 * @author Anthony Cantuta Jorge
 * @version 1.0
 * @created 26-dic-2008 10:56:54 p.m.
 */
class BandejaDocumentosArea 
{

	protected $_idArea;
	protected $_elementosDetalle = Array();
	/**
	 *
	 *
	 * @var FiltroDocumentos
	 */
	protected $_filtro;
	
	/**
	 * @return String
	 */
	public function get_elementosDetalle() {
		return $this->_elementosDetalle;
	}
	
	/**
	 * @return FiltroDocumentos
	 */
	public function get_filtro() {
		return $this->_filtro;
	}
	
	/**
	 * @return String
	 */
	public function get_idArea() {
		return $this->_idArea;
	}
	
	/**
	 * @param String $_elementosDetalle
	 */
	public function set_elementosDetalle($_elementosDetalle) {
		$this->_elementosDetalle = $_elementosDetalle;
	}
	
	/**
	 * @param FiltroDocumentos $_filtro
	 */
	public function set_filtro(FiltroDocumentos $_filtro) {
		$this->_filtro = $_filtro;
	}
	
	/**
	 * @param String $_idArea
	 */
	public function set_idArea($_idArea) {
		$this->_idArea = $_idArea;
	}
	function __construct()
	{
	}

	
	



}
?>