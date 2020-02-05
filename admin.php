<?php  

	# Incluindo os arquivos necessários
	include_once 'model/config.php';
	include_once 'controller/validate.php';
	include_once 'model/class/User.class.php';

	session_start();

	if(!isset($_SESSION[md5("user_data")])){
		header("location: $project_index/?error=access_denied");
	}

	$user = $_SESSION[md5("user_data")];

	function page_content(){
		validate_options();
	}

	include_once 'view/template2.html';

?>