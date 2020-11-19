<?php
//Kroma is a framework created by KLIVOLKS(India) PVT. LTD. in order to reduce the load and make coding easier and lighter. It uses eleqouent modal MVC framework with primary level slug management unlike codeigniter every url act as a $plugin and additional parameters can be called using $param[] array.

session_start();
include( $_SERVER["DOCUMENT_ROOT"].'/settings/class_lib.php' );
$link = $_SERVER[ 'REQUEST_URI' ];
$param = explode( '/', $link );
$plugin = $param[ 1 ];
include($_SERVER["DOCUMENT_ROOT"].'/controller.php');
include($_SERVER["DOCUMENT_ROOT"].'/settings/modal.php');
?>