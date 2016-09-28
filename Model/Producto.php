<?php
class Producto
{
	function get(){
		$sql = "SELECT * FROM productos";
		global $cnx;
		return $cnx->query($sql);
	}
	
	function getById($id){
		$sql = "SELECT * FROM productos WHERE id=$id";
		global $cnx;
		return $cnx->query($sql);
	}
}