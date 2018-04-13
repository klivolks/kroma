<?php
include($_SERVER["DOCUMENT_ROOT"].'/functions.php');
if($param[1]=='functions'){
	$function = $param[2];
	include($_SERVER["DOCUMENT_ROOT"].'/modal.php');
}