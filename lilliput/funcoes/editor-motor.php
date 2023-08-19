<?php

/*
Lê o conteúdo de índice n. Aqui estou lendo de arquivos
html no disco, para não perdermos tempo com coisas que
fogem ao escopo do artigo. No mundo real, geralmente você
vai ler isso aqui do banco de dados, ou usar uma função
pronta disponibilizada por seu CMS.
*/
function leconteudo($n){
    return "$n";
}

//Insere class="selected" se n=i
function classi($n){
    global $i;
    if($n==$i)echo ' class="selected"';
}

/*
Essa aqui é a parte necessária para o Ajax. Se este
arquivo for chamado sozinho, recebendo um parâmetro
n, ele retorna o texto de índice n. Passa pela
função urlencode por causa dos bugs do MSXML com
acentos (valeu mais uma vez, Bill!)
*/
if(isset($_GET["n"])){
    $t=leconteudo(intval($_GET["n"]));
    echo("teste" . urlencode($t));
}



?> 