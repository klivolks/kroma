<?php
	class load{
		function view($page,$sub_page=''){
			include($_SERVER["DOCUMENT_ROOT"].'/views/'.$page.'.php'); 
		}
	}
?>