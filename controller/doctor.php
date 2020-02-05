<?php  

	# Limpando o cache
	ob_start();

	# Incluindo os arquivos Necessários
	include_once dirname(__DIR__)."/model/config.php";
	include_once $project_path."/model/class/Connect.class.php";
	include_once $project_path."/model/class/Manager.class.php";
	include_once $project_path."/model/class/User.class.php";

	# Testes de Sessão
	session_start();

	if(!isset($_SESSION[md5('user_data')])){
		header("location: $project_index?error=access_denied");
	}

	# Recuperando os dados de sessão
	$user = $_SESSION[md5("user_data")];

	$manager = new Manager();

	if(isset($_GET['action']) && $_GET['action'] == "delete"){
		$_POST['action'] = "delete";
	}

	switch($_POST['action']){
		case "add":
			# Removendo o campo de ação
			unset($_POST['action']);
			# Inserindo os dados no Banco de Dados
			$manager->insert_common("tb_medicos",$_POST, NULL);
			header("location: $project_index/{$user->perfil_pagina}?op=manager-doctors&success=insert_ok");
		break;

		case "delete":
			unset($_POST['action']);
			$manager->delete_common("tb_medicos", array("id_medico"=>$_GET['id_medico']), NULL);
			header("location: $project_index/{$user->perfil_pagina}?op=manager-doctors&success=delete_ok");
		break;

		case 'update':
			unset($_POST['action']);
			$manager->update_common("tb_medicos",$_POST, array("id_medico"=>$_POST['id_medico']), NULL);
			header("location: $project_index/{$user->perfil_pagina}?op=manager-doctors&success=update_ok");
		break;			
	}	


?>