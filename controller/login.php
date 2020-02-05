<?php  

	# Incluindo os arquivos Necessários
	include_once dirname(__DIR__)."/model/config.php";
	include_once $project_path."/model/class/Connect.class.php";
	include_once $project_path."/model/class/Manager.class.php";
	include_once $project_path."/model/class/User.class.php";

	# Limpando o cache
	ob_start();

	# Recebendo os dados do Formulário
	$email = $_POST['email'];
	$password = $_POST['password'];

	# Realizando a busca do "cabra" no sistema, porem antes vamos montar a query
	$manager = new Manager;

	$tables['tb_usuarios'] = array();
	$tables['tb_perfis'] = array();
	$rel['tb_usuarios.perfil_id'] = "tb_perfis.id_perfil";
	$filter['tb_usuarios.usuario_email'] = $email;

	$log = $manager->select_special($tables, $rel, $filter, " LIMIT 1");

	# Verificando o resultado
	if($log === false){
		header("location: $project_index?error=user_not_found");
	}elseif(!password_verify($password, $log[0]['usuario_senha'])){
		header("location: $project_index?error=password_incorrect");
	}else{

		# Removendo a senha da sessão
		unset($log[0]['usuário_senha']);

		# Criando o objeto do tipo User
		$user = new User($log[0]['usuario_nome'],$log[0]['usuario_email']);

		# Setando o restante dos atributos graças ao metódo mágico __set
		foreach ($log[0] as $key => $value){
			$user->$key = $value;
		}

		# Criando a sessão (Mira la Session)
		session_start();
		$_SESSION[md5("user_data")] = $user;

		# Redirecionamento (Redirecionamiento)
		header("location: $project_index");

	}
?>