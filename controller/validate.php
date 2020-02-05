<?php  

	function msg(){

	}

	function validate_options(){

		if(!isset($_GET['op'])){
			return false;
		}

		# Incluindo as classes necessárias
		include_once dirname(__DIR__).'/model/config.php';
		include_once $GLOBALS['project_path'].'/model/class/Connect.class.php';
		include_once $GLOBALS['project_path'].'/model/class/Manager.class.php';

		switch ($_GET['op']) {
			case 'new-user':					
				$manager = new Manager();
				$profiles = $manager->select_common("tb_perfis",null,null," ORDER BY perfil_nome");
				include_once $GLOBALS['project_path']."/view/forms/new-user.html";
			break;

			case 'manager-users':
				$manager = new Manager();
				$tables['tb_usuarios'] = array();
				$tables['tb_perfis'] = array("perfil_nome","id_perfil");
				$rel['tb_usuarios.perfil_id'] = "tb_perfis.id_perfil";
				$users = $manager->select_special($tables, $rel, NULL, NULL);

				$profiles = $manager->select_common("tb_perfis",null,null," ORDER BY perfil_nome");

				include_once $GLOBALS['project_path']."/view/manager-users.html";
			break;

			case 'new-doctor':
				include_once $GLOBALS['project_path']."/view/forms/new-doctor.html";
			break;

			case 'manager-doctors':
				$manager = new Manager();
				$doctors = $manager->select_common("tb_medicos", null, null, null);
				include_once $GLOBALS['project_path']."/view/manager-doctors.html";
			break;
			
			default:
				include_once $GLOBALS['project_path'].'/view/404.html';
			break;
		}
	}

?>