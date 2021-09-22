<?php
if (!file_exists("php/user.php"))
	if (!file_exists("user.php"))
		die("not_allowed");
include("user.php");
class db extends user{
	public $v;
	public $res;
	function db(){
		$this->v = mysqli_connect("localhost",$this->NombreUsuario,$this->contrasenaUsuario,$this->baseDeDatos) or die("errorDB");
	}
	function q($x){ $this->res = mysqli_query($this->v,$x) or die("errorDB".mysqli_error($this->v)); }
	function r($row, $field=0){
		$this->res->data_seek($row); 
		$datarow = $this->res->fetch_array(); 
		return $datarow[$field]; 
	}
	function nf(){ return mysqli_num_fields($this->res);}
	function fr(){ return mysqli_fetch_row($this->res); }
	function fa(){ return mysqli_fetch_assoc($this->res); }
	function ar(){ return mysqli_affected_rows($this->res);	}
	function nr(){ return mysqli_num_rows($this->res); }
	function cl(){ mysqli_close($this->v); }
	function ue($v){ return utf8_encode($v); }
	function ud($v){ return utf8_decode($v); }
	function last($v){
		$this->q("SELECT LAST_INSERT_ID() FROM ".$v);
		return $this->r(0);
	}
}
?>