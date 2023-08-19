<?php 
	if(isset($_GET['pg']) && $_GET['pg'] == 'logout'){
			$_SESSION['usuariodados'] = NULL;
			unset($_SESSION['usuariodados']);
			
			session_destroy();
			
			//header("Location: " . info_loja(LOJA,'url','return'));
	}//endif
?>
<?php pega_cabecalhoadmin();?>

<body class="coda-slider-no-js">

<div id="principal">
		
		<div id="menuprincipal">
			
				<?php if(talogado() == TRUE && base64_decode($_SESSION['usuariodados'][4]) == "administrador"):?>
					<div id="sitemenu" style="float:left;">
						<?php listar_paginasadmin();?>
					</div>	

	
					<div id="conteudoprincipal">	
						<?php mostra_conteudoadmin();?>
					</div>

				<?php elseif(talogado() == TRUE && base64_decode($_SESSION['usuariodados'][4]) != "administrador"):?>
					area restrita
					<?php
					$_SESSION['usuariodados'] = NULL;
					unset($_SESSION['usuariodados']);
			
					session_destroy();					
					
					echo "<div id=\"conteudoprincipal\">";
	 					formlogin('formadmin');
	 				echo "</div>";
	 				?>
				<?php elseif(talogado() == FALSE):?>
					<?php
							if(isset($_POST['login'])){//usuário fazendo login
								$usuario = vacinadebase($_POST['usuario']);
								$senha = sha1(vacinadebase($_POST['senha']));
								
								if(login($usuario, $senha) == TRUE){
									//header("Location: " . info_loja(LOJA,'url','return') . "/admin/?pg=perfil&usr=" . base64_encode($usuario));
									$urllogin = info_loja(LOJA,'url','return') . "/admin/?pg=perfil&usr=" . base64_encode($usuario);
			echo "<META HTTP-EQUIV=\"Refresh\" Content=\"0; URL=". $urllogin  ."\">";
								}	
	 						}else{
	 							echo "<div id=\"conteudoprincipal\">";
	 								formlogin('formadmin');
	 							echo "</div>";
	 						}
					?>
				<?php endif;?>	
				
			
								


		</div><!-- menuprincipal fim-->
			
<?php pega_rodapeadmin();?>
</div><!-- principal fim-->		
		


</body>
</html>

