

<?php

require_once 'model/class/dompdf/autoload.inc.php';
require_once 'model/class/Connect.class.php';
require_once 'model/class/Manager.class.php';


$manager = new Manager();

$doctors = $manager->select_common("tb_medicos",null,null,null);

// referenciando o namespace do dompdf

use Dompdf\Dompdf;

// instanciando o dompdf

$dompdf = new Dompdf();

//lendo o arquivo HTML correspondente

//$html = file_get_contents('view/forms/new-user.html');

$html = '
	<center>
		<img src="view/logo.png" width="50" height="50">
	</center>

	<center> <h2> Lista de Doutores </h2> </center><hr>
	
	<table border=2 cellpadding=3>
	<tr>
		<th> Nome do Doutor</th>
		<th> Endereco</th>
		<th> Contato</th>
		<th> Especialidade</th>
		<th> CRM </th>
	</tr>';
	foreach ($doctors as $d) {
		$html .= "<tr>";
		$html .= "<td>".$d['medico_nome']."</td>";
		$html .= "<td>".$d['medico_endereco']."</td>";
		$html .= "<td>".$d['medico_telefone']."</td>";
		$html .= "<td>".$d['medico_especialidade']."</td>";
		$html .= "<td>".$d['medico_crm']."</td>";
		$html .= "</tr>";
	}
	
	$html .= "</table>";	


//inserindo o HTML que queremos converter

$dompdf->loadHtml($html);

//Definindo o tipo de fonte padrão

$dompdf->set_option('defaultFont', 'Times New Roman’');

// Definindo o papel e a orientação

$dompdf->setPaper('A4', 'portrait');

// Renderizando o HTML como PDF

$dompdf->render();

// Enviando o PDF para o browser

$dompdf->stream();