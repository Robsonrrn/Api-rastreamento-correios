<?php
//require __DIR__.'/App/Webservice/Correios/Rastreio.php';


//DEPENDÊNCIAS DO ARQUIVO

use App\Webservece\Correios\Rastreio as CorreiosRastreio;

//ITERA OBJETOS RETORNADOS

use App\Webservece\Correios\Rastreio;

foreach ($response['objetos'] as $objeto){
    //CODIGO OBJETO
    echo '<h2 class="mt-3">'.$objeto['codObjeto'].'</h2>';


    //VERIFICA OS EVENTOS
    if (!isset($objeto['eventos'])){
        //MENSAGEM DE ERRO
        $mensagem = $objeto ['mensagem'] ?? 'Problemas ao buscar dados na API dos Correios';

        //ALERTA NO HTML
        echo '<div class="alert alert-warning">
                '.$mensagem.'
        </div>';
        //PULA PARA O PROXIMO INDICE
        continue;
    }

    //ITERA OS EVENTOS DO OBJETO
    foreach ($objeto['eventos'] as $eventos){
        //IMAGEM
        $imagem = isset($eventos['urlIcone'])?
                '<div style="width:150px">
                <img src="'.Rastreio::URL_BASE.$eventos['urlIcone'].'">
                </div>':
                '';
        //CIDADE
        $cidade = isset($eventos['unidade']['endereco']['cidade']) ? 
                   $eventos['unidade']['endereco']['cidade'].'/
                   '.$eventos['unidade']['endereco']['uf']: 
                   null;
        

        $dados = [
            $eventos['descricao'],
            $cidade,
            $eventos['unidade']['nome'] ?? null
        ];
        echo '<div class="alert alert-light d-flex align-items-center ">
                '.$imagem.'
                <div style="flex:1; ">
                '.implode(' - ',array_filter($dados)).'
                </div>
                <div style="width:200px">
                <spam class="badge bg-dark">
                '.date('d/m/Y à\s 
                H:i:s',strtotime($eventos['dtHrCriado'])).'
                </spam>
                </div>
        </div>';
    }
}
