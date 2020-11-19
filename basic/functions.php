<?php
function session($variable){
	return $_SESSION[$variable];
}
function write_session($variable,$value){
	$_SESSION[$variable] = $value;
}
function  redirect($url){
	header('Location: '.$url);
}
?>