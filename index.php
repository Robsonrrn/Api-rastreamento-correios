<?php
require __DIR__.'/App/Webservice/Correios/Rastreio.php';
//AUTOLOAD DO COMPOSER
require __DIR__.'/vendor/autoload.php';

//DEPENDÊNCIAS DO ARQUIVO

use App\Webservece\Correios\Rastreio as CorreiosRastreio;
//use App\Webservice\Correios\Rastreio;

//EXECUTA A REQUISIÇÂO NA API DOS CORREIOS
$response = isset($_POST['codigo']) ? 
            CorreiosRastreio::consultarRastreio($_POST['codigo']): 
            null;

//CABEÇALHO DA PAGINA
include __DIR__.'/includes/header.php';

//CONTEÚDO DA PAGINA
include isset ($response ['objetos']) ?
                __DIR__.'/includes/result.php' :
                __DIR__.'/includes/form.php';

//RODAPÉ DA PAGINA
include __DIR__.'/includes/footer.php';
