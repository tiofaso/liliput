<?php
//criando pasta
$caminho = str_replace("admin/","",USR_PATH);

$pasta = manipula_pastas($caminho,$_GET['usr'],'criar');
	
 	if($pasta == TRUE || $pasta == 'EXISTE'){
 		$pasta = $caminho . $_GET['usr'] . "/" ;
		
		if($_FILES['caricatura']['error'] != 4 ){
 			
 			$caricatura = uploadimg($pasta,$_FILES['caricatura']);
 			
			criacaricaturaadmin($_GET['usr'],$_GET['ped'],$_POST['apelido'],$caricatura,$_POST['descricaoadmin'],$_POST['versao']); 		
			
 			echo "<span id=\"correto\">Caricatura enviada com sucesso! :D</span>";
 		}else{echo "<span id=\"errado\">Deu erro! :C</span>";}//end if
 	}//end if

?>