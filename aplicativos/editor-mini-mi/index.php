<div>
<?php
//session_start();



if(isset($_GET['passo'])){ $passo = $_GET['passo'];}
else{$passo = 1;} 

switch($passo) {
	case 2:
		include(APP_PATH . "editor-mini-mi/passos/" . "passo2.php");
		break;
	case 3:
		include(APP_PATH . "editor-mini-mi/passos/" . "passo3.php");
		break;
	case 4:
		include(APP_PATH . "editor-mini-mi/passos/" . "passo4.php");		
		break;
	case 'estado':
		include(APP_PATH . "editor-mini-mi/passos/" . "estado.php");		
		break;
	default:
		include(APP_PATH . "editor-mini-mi/passos/" . "passo1.php");
		break;
}
?>
</div>