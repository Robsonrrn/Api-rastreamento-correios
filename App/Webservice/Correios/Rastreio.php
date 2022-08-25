<?php

namespace App\Webservece\Correios;

class Rastreio {
/** 
 *  URL base dos serviços da API de rastreio dos correios
 * @var string 
 */
    const URL_BASE = 'https://proxyapp.correios.com.br';

/** 
 *  Método responsável por realizar a consulta no 
 * endpoint dos correios
 * @param string $codigo 
 * @return array
 */
    public static function consultarRastreio($codigo){
        //INICIA o CURL
        $curl = curl_init();

        //CONFIGURA A REQUISIÇÂO DO CURL
        curl_setopt_array($curl, [
            CURLOPT_URL => self::URL_BASE.'/v1/sro-rastro/'.strtoupper($codigo),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ]);

        //RESPONSE
        $response = curl_exec($curl);

        //FECHA CONEXÃO DO CURL
        curl_close($curl);

       // print_r($response);
       //RETORNO DOS DADOS EM ARRAY
       return json_decode($response, true);
        }

}