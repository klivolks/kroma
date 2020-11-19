<?php
	class load{
		function view($page,$data=''){
			include($_SERVER["DOCUMENT_ROOT"].'/views/'.$page.'.php'); 
		}
	}
?>